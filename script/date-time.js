const daysTag = document.querySelector(".days"),
currentDate = document.querySelector(".current-date"),
prevNextIcon = document.querySelectorAll(".icons span");

// getting new date, current year and month
let date = new Date(),
currYear = date.getFullYear(),
currMonth = date.getMonth();

// storing full name of all months in array
const months = ["January", "February", "March", "April", "May", "June", "July",
              "August", "September", "October", "November", "December"];

let selectedDate = date;

const renderCalendar = () => {
  let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
  let liTag = "";

  for (let i = firstDayofMonth; i > 0; i--) {
    liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
  }

  for (let i = 1; i <= lastDateofMonth; i++) {
    let isToday =
      i === selectedDate.getDate() &&
      currMonth === selectedDate.getMonth() &&
      currYear === selectedDate.getFullYear()
        ? "active"
        : "";
    liTag += `<li class="${isToday}" onclick="setActiveDate(${i})">${i}</li>`;
  }

  for (let i = lastDayofMonth; i < 6; i++) {
    liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
  }
  currentDate.innerText = `${months[currMonth]} ${currYear}`;
  daysTag.innerHTML = liTag;

  updateSelectedDateInput();
};

const setActiveDate = (day) => {
  // Adjust for timezone offset
  const timezoneOffset = selectedDate.getTimezoneOffset();
  selectedDate = new Date(currYear, currMonth, day, 0, -timezoneOffset, 0, 0);
  updateSelectedDateInput();
  renderCalendar();
};

const updateSelectedDateInput = () => {
  const selectedDateInput = document.getElementById("selectedDateInput");
  const formattedDate = selectedDate.toISOString().split('T')[0];
  selectedDateInput.value = formattedDate;
};

// const openCalendar = () => {
//   console.log("Calendar opened");
// };

renderCalendar();

prevNextIcon.forEach((icon) => {
  icon.addEventListener("click", () => {
    currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;
  
    if (currMonth < 0) {
      currMonth = 11;
      currYear -= 1;
    } else if (currMonth > 11) {
      currMonth = 0;
      currYear += 1;
    }
  
    renderCalendar();
  });
});
  




const timeOptions = {
  Morning: [
    "08:00", "08:30", "09:00", "09:30",
    "10:00", "10:30", "11:00", "11:30"
  ],
  Afternoon: [
    "13:00", "13:30", "14:00", "14:30",
    "15:00", "15:30", "16:00", "16:30"
  ]
};

const renderTimeSlots = (selectedOption) => {
  const radioGroupContainer = document.getElementById("timeSlotsContainer");
  const timeSlotHTML = timeOptions[selectedOption].map((time) => `
    <li>
      <input type="radio" id="${time.replace(/:/g, '')}" name="time" value="${time}">
      <label for="${time.replace(/:/g, '')}">${time}</label>
    </li>
  `).join("");
  radioGroupContainer.innerHTML = timeSlotHTML;
};

const updateSelectedTime = () => {
  const selectedTimeInput = document.getElementById("selectedTime");
  const selectedRadio = document.querySelector('input[name="time"]:checked');
  if (selectedRadio) {
    selectedTimeInput.value = selectedRadio.value;
  } else {
    selectedTimeInput.value = "";
}
};

// Event listener for dropdown change
const dropdown = document.querySelector(".options-type");
dropdown.addEventListener("change", () => {
  const selectedOption = dropdown.value;
  renderTimeSlots(selectedOption);
  updateSelectedTime();
});

// Event listener for radio button change
const radioGroup = document.querySelector("#timeSlotsContainer");
radioGroup.addEventListener("change", updateSelectedTime);

// Initial rendering with the default selected option
renderTimeSlots("Morning");