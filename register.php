<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="style/register.css">
</head>
<body class="register-body">
    <div class="wrapper">
        <form action="data-processor.php" method="POST">
            <h1>Register</h1>

            <div id="PageOne" class="tabcontent">
                <div class="row">
                <div class="input-box">
                        <input type="text" placeholder="First Name" required name="first_name">
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Last Name" required name="last_name">
                    </div>
                </div>

                <div class="row">
                    <div class="input-box">
                        <input type="date" placeholder="Birthdate" required name="birthdate">
                    </div> 

                    <select class="input-box drop-down" id="gender" required name="gender" placeholder="Select Gender">
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                </div>

                <div class="column">
                    <div class="input-box">
                        <input type="text" placeholder="Address" required name="address">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Contact Number" required name="contact_number">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Active Gmail" required name="active_gmail">
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Password" required name="password">
                    </div>

                    <div class="input-box">
                        <input type="password" placeholder="Repeat Password" required name="repeat_password">
                    </div>
                
                </div>

                <button type="button" class="tablinks btn-next" onclick="openTab(event, 'PageTwo')" required>Next</button>
            </div>

            <div id="PageTwo" class="tabcontent">
                <h1>Health</h1>

                <div class="con">
                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 1" required name="medical_info_1">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 2" required name="medical_info_2">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 3" required name="medical_info_3">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 4" required name="medical_info_4">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 5" required name="medical_info_5">
                    </div>
                </div>

                <div class="con">
                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 6" required name="medical_info_6">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 7" required name="medical_info_7">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 8" required name="medical_info_8">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 9" required name="medical_info_9">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Medical Info 10" required name="medical_info_10">
                    </div>

                    <div class="row">
                        <button class="tablinks btn-prev" onclick="openTab(event, 'PageOne')" id="defaultOpen">Back</button>
                        <button type="submit" class="btn-next" name="submit_registration" required>Next</button>
                    </div>

                </div>
            </div>
           
        </form>
    </div>
    <script>
        document.getElementById("defaultOpen").click();
        function openTab(evt, tabIndex) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabIndex).style.display = "block";
        evt.currentTarget.className += " active";
        } 
    </script>
</body>
</html>