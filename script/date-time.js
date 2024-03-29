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
  fetchAppointments()
  .then(appointments => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(),
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(),
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(),
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate();
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) {
      liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    // For currdate and set time to midnight
    let today = new Date();
    today.setHours(0, 0, 0, 0);

    for (let i = 1; i <= lastDateofMonth; i++) {
      let currDate = new Date(currYear, currMonth, i);
      currDate.setHours(0, 0, 0, 0);

      let isBeforeToday = currDate < today;
      let isToday =
        i === selectedDate.getDate() &&
        currMonth === selectedDate.getMonth() &&
        currYear === selectedDate.getFullYear()
          ? "active"
          : "";
      
      let tooltipText = '';
      let hasAppointment = '';
      let disableClick = false;

      const appointmentData = appointments.find(appointment =>
        appointment.date === formatDate(currDate));
      if (appointmentData) {
        tooltipText = `${appointmentData.appointment_count} Appointments on this Date`;


        // IF APPOINTMENT IS GREATER THAN 3 CHANGE COLOR TO RED
        hasAppointment = appointmentData.appointment_count > 9 ?
        'red-appointment' : 'green-appointment';

        // DISABLE IF ITS RED
        disableClick = hasAppointment === 'red-appointment';
      
      } else {
        tooltipText = 'No bookings on this date 😁';
      }
      
      if (isBeforeToday) {
        liTag += `<li class="${isToday} inactive">${i}</li>`;
      } else {
        liTag += `<li class="${isToday} ${hasAppointment ? hasAppointment : ''}"
                  onclick="${disableClick ? '' : `setActiveDate(${i})`}"
                  title="${tooltipText}">${i}</li>`;
      }
    }

    for (let i = lastDayofMonth; i < 6; i++) {
      liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`;
    daysTag.innerHTML = liTag;

    updateSelectedDateInput();
  });
};

// GO FETCH BOY!!
async function fetchAppointments() {
  const response = await fetch('lib/getAppointmentCount.php');
  return await response.json();
}

// FORMAT NOTRE DATE (YYYY-MM-DD)
function formatDate(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${year}-${month}-${day}`;
}

const setActiveDate = (day) => {
  // Adjust for timezone offset
  const timezoneOffset = selectedDate.getTimezoneOffset();
  selectedDate = new Date(currYear, currMonth, day, 0, -timezoneOffset, 0, 0);
  updateSelectedDateInput();
  renderCalendar();
  renderTimeSlots("Morning");
};

//Send the date 'NUDES' to input box
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
    "9:00", "09:30", "10:00", "10:30",
    "11:00", "11:30", "12:00", "12:30"
  ],
  Afternoon: [
    "1:00", "1:30", "2:00", "2:30",
    "3:00", "3:30", "4:00", "4:30"
  ],
  Evening: [
    "5:00", "5:30", "6:00", "6:30",
  ]
};

const renderTimeSlots = (selectedOption) => {
  const radioGroupContainer = document.getElementById("timeSlotsContainer");

  const currentDateTime = new Date();
  const currentTime = currentDateTime.getHours() * 60 + currentDateTime.getMinutes();

  const timeSlotHTML = timeOptions[selectedOption].map((time) => {
    const timeInMinutes = parseInt(time.split(":")[0]) * 60 + parseInt(time.split(":")[1]);
    let isDisabled = timeInMinutes <= currentTime ? 'disabled' : '';

    if (selectedDate.toISOString().split('T')[0] !== currentDateTime.toISOString().split('T')[0]) {
      isDisabled = '';
    }

    return `
      <li>
        <input type="radio" id="${time.replace(/:/g, '')}" name="time" value="${time}" ${isDisabled}>
        <label for="${time.replace(/:/g, '')}" ${isDisabled}>${time}</label>
      </li>
    `;
  }).join("");

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
