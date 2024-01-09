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
    fetchAppointmentCount()
    .then(appointments => {
        let firstDayofMonth = new Date(currYear, currMonth, 1).getDay(), // getting first day of month
        lastDateofMonth = new Date(currYear, currMonth + 1, 0).getDate(), // getting last date of month
        lastDayofMonth = new Date(currYear, currMonth, lastDateofMonth).getDay(), // getting last day of month
        lastDateofLastMonth = new Date(currYear, currMonth, 0).getDate(); // getting last date of previous month
        let liTag = "";

        for (let i = firstDayofMonth; i > 0; i--) { // creating li of previous month last days
            liTag += `<li class="inactive">${lastDateofLastMonth - i + 1}</li>`;
        }

        // For currdate and set time to midnight
        let today = new Date();
        today.setHours(0, 0, 0, 0);

        for (let i = 1; i <= lastDateofMonth; i++) {
            let currDate = new Date(currYear, currMonth, i);
            currDate.setHours(0, 0, 0, 0);
            // Check if the current day, month, and year match the date being rendered
            let isBeforeToday = currDate < today;
            let isToday = 
            i=== selectedDate.getDate() &&
            currMonth === selectedDate.getMonth() &&
            currYear === selectedDate.getFullYear()
                ? "active"
                : "";

            let tooltipText = '';
            let hasAppointment = '';

            const appointmentData = appointments.find(appointment =>
                appointment.date === formatDate(currDate));
                if (appointmentData) {
                    tooltipText = `${appointmentData.appointment_count} Appointments on this Date`;
            
                    // IF APPOINTMENT IS GREATER THAN 3 CHANGE COLOR TO RED
                    hasAppointment = appointmentData.appointment_count > 5 ?
                    'red-appointment' : 'green-appointment';
                
                } else {
                    tooltipText = 'No Appointments on this Date';
                }

                // on click send the date to showDate
                liTag += `<li class="${isToday} ${hasAppointment ? hasAppointment : ''}"
                onclick="setActiveDate(${i})" title="${tooltipText}">${i}</li>`;
            }    

        for (let i = lastDayofMonth; i < 6; i++) { // creating li of next month first days
            liTag += `<li class="inactive">${i - lastDayofMonth + 1}</li>`;
        }
        currentDate.innerText = `${months[currMonth]} ${currYear}`; // passing current mon and yr as currentDate text
        daysTag.innerHTML = liTag;

        updateSelectedDateInput();
        fetchAppointments();
    });
};

// GO FETCH BOY!!
async function fetchAppointmentCount() {
    const response = await fetch('lib/getAppointmentCountAdmin.php');
    return await response.json();
}
  
// FORMAT NOTRE DATE (YYYY-MM-DD)
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

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