<?php 
    session_start();
    if($_SESSION['id'] == null){   
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('globalHead.php'); ?>
    <link rel="stylesheet" href="indexStyle.css">
</head>
<body>

    <!-- HEADER -->
    <header>

        <div class="comp">
            <a href="#" class="comp-logo">
                <img src="img/mayollogo.png" alt="">
            </a>
            <a href="#" class="comp-name"><h2><span>Mayol Dental Clinic</span></h2></a>
        </div>

        <ul class="navlist">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact Us</a></li>
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
                <a href="user-profile.php">My Profile</a>
                <a href="book-history.php">Booking History</a>
                <a href="dental-records.php">My Treatments</a>
                <a href="logout.php" id="logout-btn">Logout</a>
            </div>
        </div>

    </header>

    <!-- HOME -->
    <section class="home" id="home">

        <div class="home-left">
            <div class="home-text">
                <div class="slide">                 
                    <!-- the variable wrappen in in the php tag below displays the data from the "login.php" -->
                    <div class="welcome">Welcome, <?php echo $_SESSION['first_name']; ?>,</div>
                </div>
    
                <h1><span>to Mayol Dental Clinic</span></h1>
    
                
            </div>
    
            <div class="home-text2">
                <p>We provide dental treatments that are customized for your needs.</p>
            </div>
        </div>

        <div class="home-right">
    
            <!-- <div class="mayol">
                <img src="img/wallpaper.png" alt="">
            </div> -->
    
            <div class="cont">
                <div class="check">
                    <img src="img/check.png" alt="">
                </div>
                <div class="num">
                    <h3>5.0</h3>
                    <h5><small>Rating</small></h5>
                </div>
            </div>

            <div class="button" id="bookButton">
                <a href="#" class="btn" id="open-popup-btn">Book an appointment</a>
            </div>

            <div class="profile">
                <a href="#" class="user-profile"></a>
            </div>
        </div>

    </section>

    <!-------- ABOUT US -------------->
     <section class="about" id="about">
        <div class="about-vid">
            <video width="1366px" controls autoplay muted>
                <source src="img/ad (online-video-cutter.com).mp4" type="video/mp4">
                <!--Below is a likely backup file if the web browser doesn't support an mp4 file-->
                <!-- <source src="allVideos/Mental Health Awareness PerDev Project.webm" type="video/webm"> -->
            </video>
        </div>
    </section>

    <!-- SERVICES -->
    <section class="services" id="services">
        <h3>What we can do for your teeth</h3>

        <div class="card-grid">
            <div class="card1">
                <div class="img1"><img src="img/genden.png" alt=""></div>
                <h4>General Denistry</h4>
                <p>Comprehensive oral health care,
                    including check-ups, treatments for a 
                    wide range of dental issues.
                </p>
            </div>

            <div class="card2">
                <div class="img2"><img src="img/orthodontics-removebg-preview 2.png" alt=""></div>
                <h4>Orthodontics</h4>
                <p>Diagnosis and treatment of
                   malocclusions, which are
                   misalignments of the teeth and jaws
                </p>
            </div>

            <div class="card3">
                <div class="img3"><img src="img/oralsurgerymain 2.png" alt=""></div>
                <h4>Oral Surgery</h4>
                <p>Surgical Procedures to improve oral
                   health and aesthetics
                </p>
            </div>
            
            <div class="card4">
                <div class="img4"><img src="img/shinytooth 1.png" alt=""></div>
                <h4>Aesthetic Dentistry</h4>
                <p>Enhance the look of teeth and smiles
                </p>
            </div>
        </div>

        <div class="grid-container">

            <div class="grid-item">
                <div class="img4"><img src="img/toothFilling 1.png" alt=""></div>
                <h4>Tooth Filling</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/denX-ray 1.png" alt=""></div>
                <h4>Radiographic Examination</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/oper 1.png" alt=""></div>
                <h4>Operculectomy</h4>
            </div>  

            <div class="grid-item">
                <div class="img4"><img src="img/dencrown 1.png" alt=""></div>
                <h4>Dental Crowns</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/denbridge 1.png" alt=""></div>
                <h4>Dental Bridges</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/rootcan 1.png" alt=""></div>
                <h4>Pulpotomy and Root Canal Treatment</h4>
            </div>  

            <div class="grid-item">
                <div class="img4"><img src="img/completeDenture 1.png" alt=""></div>
                <h4>Complete Denture</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/dencheck 1.png" alt=""></div>
                <h4>Dental Consultation or Check-up</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/wisdomExtrac 1.png" alt=""></div>
                <h4>Wisdom Tooth Removal</h4>
            </div>  

            <div class="grid-item">
                <div class="img4"><img src="img/veneers 1.png" alt=""></div>
                <h4>Composite or Porcelain Veneers</h4>
            </div>  

            <div class="grid-item">
                <div class="img4"><img src="img/fixedBridge 1.png" alt=""></div>
                <h4>Fixed Bridge</h4>
            </div> 

            <div class="grid-item">
                <div class="img4"><img src="img/partialDen 1.png" alt=""></div>
                <h4>Removable Denture</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/braces 1.png" alt=""></div>
                <h4>Orthodontic Braces and Braces Adjustment</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/toothExtrac 1.png" alt=""></div>
                <h4>Tooth Extraction</h4>
            </div>

            <div class="grid-item">
                <div class="img4"><img src="img/cleanTeeth 1.png" alt=""></div>
                <h4>Oral Prophylaxis (Cleaning)</h4>
            </div>  
        </div>
    </section>

    <!------ CONTACT US --------------->
    <section class="contact" id="contact">

        <div class="mayclin"><img src="img/mayclin 1.png" alt=""></div>

        <div class="grid-contact">
            <div class="row" id="row1">
                <img src="img/Elegantthemes-Beautiful-Flat-Location 1.png" alt="">
                <h4>San Vicente St. Brgy. Bungtod, Bogo City, Cebu</h4>
            </div>
            <div class="row" id="row2">
                <img src="img/tele 1.png" alt="">
                <h4>(032) 260 1038</h4>
            </div>
            <div class="row" id="row3">
                <img src="img/Paomedia-Small-N-Flat-Phone 1.png" alt="">
                <h4>09996666999</h4>
            </div>
            <div class="row" id="row4">
                <img src="img/gmail 1.png" alt="">
                <h4>mayoldentalclinic@gmail.com</h4>
            </div>
        </div>
    </section>

    <!-- JAVASCRIPT -->
    <script type="text/javascript" src="script.js"></script>


    <script>    //The user can only book an appointment and logout on this page so the script is embedded here instead of the indexStyle.css

        // Book an appointment button: will send you to the booking page
        const bookButton = document.getElementById("bookButton");

        bookButton.addEventListener("click", () => {
            window.location.href = "book.php";
        });

        // Logout button: will send you back to the landing page with the login button in its header
        const logoutButton = document.getElementById("logout-btn");

        logoutButton.addEventListener("click", () => {
            window.location.href = "index.php";
        })


        /* When the user clicks on the button,
        toggle between hiding and showing the dropdown content */
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        } 
    </script>

</body>
</html>