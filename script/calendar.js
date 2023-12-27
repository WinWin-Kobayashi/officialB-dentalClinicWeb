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

const fetchAppointments = () => {
  // Get the selected date from the input field
  const selectedDate = document.getElementById("selectedDateInput").value;

  // Check if the date is not null
  if (selectedDate) {
    // Prepare the data to be sent in the POST request
    const data = new FormData();
    data.append("appointment", selectedDate);

    // Fetch API to send the AJAX request
    fetch("fetch_daily_appointments.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((data) => {
        // Display the fetched data in the 'appointmentContainer' div
        document.getElementById("appointmentContainer").innerHTML = data;
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
};


const renderCalendar = () => {
    let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
    lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
    lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
    lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
    let liTag = "";

    for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
        liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
    }

    for (let i = 1; i <= lastDateofMonth; i++) {
        // Check if the current day, month, and year match the date being rendered
        let isToday = 
        i=== selectedDate.getDate() &&
        currMonth === selectedDate.getMonth() &&
        currYear === selectedDate.getFullYear()
            ? "active"
            : "";
        // on click send the date to showDate
        liTag += `<li class="${isToday}" onclick="setActiveDate(${i})">${i}</li>`;
    }    

    for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
        liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
    }
    currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
    daysTag.innerHTML = liTag;

    updateSelectedDateInput();
    fetchAppointments();
};

document.getElementById("selectedDateInput").addEventListener("change", function () {
    setActiveDate(selectedDate.getDate());
    fetchAppointments();
});

const setActiveDate = (day) => {
    // Adjust for timezone offset
    const timezoneOffset = selectedDate.getTimezoneOffset();
    selectedDate = new Date(currYear, currMonth, day, 0, -timezoneOffset, 0, 0);
    updateSelectedDateInput();
    renderCalendar();
  
    // Update URL with selected date
    const formattedDate = selectedDate.toISOString().split('T')[0];
    const newURL = `${window.location.pathname}?date=${formattedDate}`;
    window.history.pushState({ path: newURL }, '', newURL);
};

const updateSelectedDateInput = () => {
    const selectedDateInput = document.getElementById("selectedDateInput");
    const formattedDate = selectedDate.toISOString().split('T')[0];
    selectedDateInput.value = formattedDate;
};

renderCalendar();

prevNextIcon.forEach(icon => { // getting prev and next icons
    icon.addEventListener("click", () => { // adding click event on both icons
        // if clicked icon is previous icon then decrement current month by 1 else increment it by 1
        currMonth = icon.id === "prev" ? currMonth - 1 : currMonth + 1;

        if(currMonth < 0) { // if current month is less than 0 or greater than 11
            // creating a new date of current year & month and pass it as date value
            // date = new Date(currYear, currMonth, new Date().getDate());
            currMonth = 11; // updating current year with new date year
            currYear -= 1; // updating current month with new date month
        } else if (currMonth > 11) {
            // date = new Date();
            // pass the current date as date value
            currMonth = 0;
            currYear += 1;
        }
        renderCalendar(); // calling renderCalendar function
    });
});