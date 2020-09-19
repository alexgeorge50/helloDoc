   <nav class="container-fluid navbar navbar-expand-lg bg-dark navbar-dark" >
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <!-- md-auto: left, ml-auto: right, mx-auto: center -->
            <ul class="navbar-nav md-auto">
                <li class="nav-item"><a class="nav-link" id="0" onClick="nav_item_selected(0)" href="index.php">Home</a></li>
                <?php if(!isset($_SESSION['valid_user'])): ?>
                <li class="nav-item">
                	<a class="nav-link" href="doctorlogin.php" id="1" onClick="nav_item_selected(1)">Are you a Practitioner</a>
                </li>
                <?php endif; ?>
                <?php if(isset($_SESSION['valid_user']) && $_SESSION['user_type']=="patient"): ?>
                <li class="nav-item">
                    <a class="nav-link" href="appointment.php" id="2" onClick="nav_item_selected(2)">Book an Appointment</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="healthtips.php" id="3" onClick="nav_item_selected(3)">Health Tips</a>
                </li>
                <?php if(isset($_SESSION['valid_user'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" id="4" onClick="nav_item_selected(4)">Sign-out</a>
                </li>
                <?php if($_SESSION['user_type']=="doctor"): ?>
                <li class="nav-item">
                    <a class="nav-link" href="updateAvailability.php" id="5" onClick="nav_item_selected(5)">Update Availability</a>
                </li>
                 <?php endif; ?>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php" id="6" onClick="nav_item_selected(6)">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="member.php" id="7" onClick="nav_item_selected(7)">Register</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <form class="form-inline" action="search.php" method="get">
            <input class="form-control mr-sm-2" type="Search" name="search" placeholder="Search for Doctors">
            <button class="btn light my-sm-0" type="submit">Search</button>
        </form>
    </nav>