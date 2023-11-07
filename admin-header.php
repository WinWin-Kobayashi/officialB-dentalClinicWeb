<!-- HEADER -->
<header class="admin-header" style="border: 1px solid black; width: 20%;">

<div class="comp">
    <a href="#" class="comp-logo">
        <img src="img/mayollogo.png" alt="">
    </a>
    <a href="#" class="comp-name"><h2><span>Admin Dashboard</span></h2></a>
</div>

<ul class="navlist">
    <li><a href="admin-dashboard.php">Home</a></li>
    <li><a href="admin-appointment.php">Appointments</a></li>
    <li><a href="admin-patients.php">Patients</a></li>
    <li><a href="#contact">Logs</a></li>
</ul>

<div class="bx bx-menu" id="menu-icon">
    
</div>

<div class="hamburger">
    <i class="fa-solid fa-bars"></i>
</div>

<div class="dropdown">
    <button class="user-profile dropbtn" id="profile-wrapper" onclick="myFunction()" >
        <i class='bx bxs-user'></i>
        <!-- <h4>User Name</h4> -->
    </button>
    <div id="myDropdown" class="dropdown-content">
        <a href="book-history.php">Booking History</a>
        <a href="treatment-record.php">My Treatments</a>
        <a href="#" id="logout-btn">Logout</a>
    </div>
</div>

</header>