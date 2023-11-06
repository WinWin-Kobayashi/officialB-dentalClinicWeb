<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="admin-dashboard.css">
    <link rel="stylesheet" href="indexStyle.css">
</head>
<body>

    <?php include('admin-header.php');?>

    <section id="home">
        <div class="row">
            <div class="confirmed-appointments-container">Confirmed Appointments</div>
            <div class="numbers-container">
                <div class="cancellations">Cancelled: </div>
                <div class="accepted">Accepted: </div>
            </div>
        </div>

        <div class="appointment-requests-container">
            <h3>Appointment Requests</h3>
            <div class="appointment-req-table">
                <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Id</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Appointment Date</th>
                            <th scope="col">Appointment Time</th>
                            <th scope="col">Service</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2023-10-01</td>
                            <td>2023-11-15</td>
                            <td>10:00 AM</td>
                            <td>Dental Checkup</td>
                            <td>Accepted</td>
                            <td>
                                <button>Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2023-10-02</td>
                            <td>2023-11-16</td>
                            <td>2:30 PM</td>
                            <td>Tooth Cleaning</td>
                            <td>Pending</td>
                            <td>
                                <button>Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2023-10-03</td>
                            <td>2023-11-17</td>
                            <td>4:00 PM</td>
                            <td>Tooth Extraction</td>
                            <td>Cancelled</td>
                            <td>
                                <button>Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>2023-10-04</td>
                            <td>2023-11-18</td>
                            <td>1:15 PM</td>
                            <td>Root Canal</td>
                            <td>Accepted</td>
                            <td>
                                <button>Cancel</button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>2023-10-05</td>
                            <td>2023-11-19</td>
                            <td>11:30 AM</td>
                            <td>Dental Implant</td>
                            <td>Pending</td>
                            <td>
                                <button>Cancel</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</body>
</html>