<dialog id="viewBookingHistory" class="modal">
    <!-- <div class="text">View Screenshot</div> -->
    <form id="viewBookingHistoryForm" method="POST">
        <input type="hidden" id="viewBookingHistoryId" name="viewBookingHistoryId" readonly>
        <br>
        <!-- first name -->
        <label for="bookerFirstName"> <b>First Name:</b> </label>
        <input type="text" id="bookerFirstName" name="firstName" placeholder="First Name" readonly><br>
        <!-- last name -->
        <label for="bookerLastName"> <b>Last Name:</b> </label> 
        <input type="text" id="bookerLastName" name="lastName" placeholder="Last Name" readonly><br>

        <!-- date -->
        <label for="bookDate"> <b>Appointment Date:</b> </label>
        <input type="text" id="bookDate" name="appointmentDate" placeholder="Appointment Date" readonly><br>
        <!-- time -->
        <label for="bookTime"> <b>Appointment Time:</b> </label>
        <input type="text" id="bookTime" name="appointmentTime" placeholder="Appointment Time" readonly><br>
        <!-- service -->
        <label for="bookService"> <b>Service:</b> </label>
        <input type="text" id="bookService" name="service" placeholder="Service" readonly><br>
        <!-- date created -->
        <label for="bookDateCreated"> <b>Date Created:</b> </label>
        <input type="text" id="bookDateCreated" name="dateCreated" placeholder="Booking Date Created" readonly><br>

        <button onclick="closeviewBookingHistoryModal()" type="button" class="close-modal-full">Close</button>
    </form>
</dialog>

<script>
    // Open/Close Modal + get patient data base on ID
    const view_booking_history = document.getElementById("viewBookingHistory");

    function openviewBookingHistoryModal(bookingId) {
        document.getElementById('viewBookingHistoryId').value = bookingId;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'lib/getBookingHistory.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const bookingDetails = JSON.parse(xhr.responseText);

                    // Display details in textbox
                    document.getElementById('bookerFirstName').value = bookingDetails.first_name;
                    document.getElementById('bookerLastName').value = bookingDetails.last_name;

                    // Display details in textbox
                    document.getElementById('bookDate').value = bookingDetails.date;
                    document.getElementById('bookTime').value = bookingDetails.time;
                    document.getElementById('bookService').value = bookingDetails.service;
                    document.getElementById('bookDateCreated').value = bookingDetails.date_created;
                 

                } else {
                    console.error('Error fetching appointment details');
                }
            }
        };

        xhr.send('bookingId=' + encodeURIComponent(bookingId));

        view_booking_history.showModal();
    }

    function closeviewBookingHistoryModal() {
        view_booking_history.close();
    }
</script>
