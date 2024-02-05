<link rel="stylesheet" href="style/admin-sidebar.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="img/mayollogo.png" alt="">
        </div>

        <span class="logo_name">Admin</span>
    </div>

    <div class="menu-items" >
        <ul class="nav-links">
            <li><a href="admin-dashboard.php">
                <i class="material-icons">home</i>
                <span class="link-name">Home</span></a>
            </li>
            <li><a href="admin-appointment.php">
                <i class="material-icons">event</i>
                <span class="link-name">Appointments</span></a>
            </li>
            <li><a href="admin-patRecHistory.php">
                <i class="material-icons">history</i>
                <span class="link-name">Records & History</span></a>
            </li>

            <!-- <li><a href="admin-patients-list/add_patient_index.php">
                <i class="material-icons">personal_injury</i>
                <span class="link-name">Patients</span></a>
            </li> -->

            <li><a href="admin-p_management.php">
                <i class="material-icons">personal_injury</i>
                <span class="link-name">Patients</span></a>
            </li>

            <li><a href="admin-refund.php">
                <i class="material-icons">payments</i>
                <span class="link-name">Refunds</span></a>
            </li>

            <!-- <li><a href="admin-treatment-records/add-treatment.php">
                <i class="material-icons">timeline</i>
                <span class="link-name">Dental Record</span></a>
            </li> -->

            <!-- <li><a href="admin-chat.php">
                <i class="material-icons">message</i>
                <span class="link-name">Chat</span></a>
            </li> -->
        </ul>
            
        <ul class="logout-mode">
            <li><a href="#">
                <i class="material-icons">logout</i>
                <span class="link-name">Logout</span>
            </a></li>

            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </ul>
    </div>
</nav>

<!-- <section class="dashboard"> -->
    <div class="top">
        <i class="material-icons sidebar-toggle">menu</i>
    </div>
<!-- </section> -->


<script>
    // MARK ACTIVE SIDE BAR
    if (document.querySelector('.nav-links')) {
        var currentUrl = window.location.href;

        var menuLinks = document.querySelectorAll('.nav-links li a');

        menuLinks.forEach(function(link) {
            if (link.href === currentUrl) {
                link.parentElement.classList.add('active');
            }
        });
    }
</script>
<script src="script/sidebar-toggle.js"></script>