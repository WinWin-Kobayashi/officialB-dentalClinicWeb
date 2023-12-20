<link rel="stylesheet" href="admin-sidebar.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<style>
    .menu-items li a .link-name,  .menu-items li a .material-icons{
        color: var(--v-dark-purple);
    }

    .top .sidebar-toggle{
        color: var(--v-dark-purple);
    }

    .top .sidebar-toggle:hover{
        color: var(--dark-purple);
    }

    .menu-items li:hover{
        background: var(--dark-purple);
        border-radius: 5px;
        transition: width 2s ease-in-out 1s;
    }

    .menu-items li:hover a .link-name, .menu-items li:hover a .material-icons{
        color: white;
        transition: none;
    }

</style>
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

            <!-- <li><a href="admin-treatment-records/add-treatment.php">
                <i class="material-icons">timeline</i>
                <span class="link-name">Dental Record</span></a>
            </li> -->

            <li><a href="admin-chat.php">
                <i class="material-icons">message</i>
                <span class="link-name">Chat</span></a>
            </li>
        </ul>
            
        <ul class="logout-mode">
            <li><a href="#">
                <i class="material-icons">logout</i>
                <span class="link-name">Logout</span>
            </a></li>

            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </li>
        </ul>
    </div>
</nav>

<!-- <section class="dashboard"> -->
    <div class="top">
        <i class="material-icons sidebar-toggle">menu</i>
    </div>
<!-- </section> -->

<script src="script/sidebar-toggle.js"></script>