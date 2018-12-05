<?php
include_once "config/core.php";
include_once "object/user.php";
?>
<!-- ***** Navbar Area ***** -->
<div class="alazea-main-menu">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="alazeaNav">
                <!-- Nav Brand -->
                <a href="index.php" class="nav-brand"><img src="img/logo.png" style="width: 100px";></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- Close Button -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Navbar Start -->
                    <div class="classynav font-cursive">
                       <!-- <a class="navbar-brand" href="<?php echo $home_url; ?>">E-Life</a>-->
                        <ul class="nav navbar-nav">   
                           <li <?php echo "class='active'"?>>
                                <a href="<?php echo $home_url; ?>">Home</a>
                            </li>
                            <!--<li><a href="index.php">Home</li>--> <li><a href="index.php">About Us</a></li>
                            <li><a href="#">Catalogue</a>  
                                <ul class="dropdown">
                                    <li><a href="E-Life_Computer_Accessories.php">Computer Peripherals</a></li>   
                                    <li><a href="Project_Accessories.php">Project Accessories</a></li>
                                    <li><a href="E-Life_Book_Store.php">Book Store</a></li>
                                    <li><a href="Stationary_Store.php">Stationary Store</a></li>
                                    <li><a href="E-Life_Grocery_Store.php">Grocery Store</a></li>           
                                    <li><a href="Men's_Fashion.php">Men's Fashion</a></li>
                                    <li><a href="Women's_Fashion.php">Women's Fashion</a></li> 
                                    <li><a href="E-Life_Special.php">E-Life Special</a></li>
                                </ul>
                            </li>
                            <?php
                            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true && $_SESSION['access_level']=='User' )
                            ?>
                            <ul class="dropdown">
                                <li <?php echo "class='active'"?>>
                                    <a href="#"><span><?php echo $_SESSION['firstname']; ?></span></a>
                                    <ul class="dropdown">
                                        <li><a href="<?php echo $home_url ;?>logout.php">Log out</a></li>
                                    </ul>
                                </li>
                                <!--<li <?php echo "class='active'"?>>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        &nbsp;&nbsp;<?php echo $_SESSION['firstname']; ?>
                                        &nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="logout.php">Log out</a></li>
                                    </ul>
                                </li>-->
                            </ul>
                            <?php}
                         else{
                                ?>
                                <ul class="nav navbar-nav navbar-right">
                                    <li <?php echo "class='active'" ?>>
                                        <a href="login.php">
                                            <span class="glyphicon glyphicon-log-in"></span>Log in
                                        </a>
                                    </li>

                                    <li <?php echo "class='active'"?>>
                                        <a href="SignUp.php">
                                            <span class="glyphicon glyphicon-check"></span>Sign Up
                                        </a>
                                    </li>
                                </ul>
                                <?php}
                            ?>
                            <!--check customer was logged in or not-->
                           
                                   <!-- <li><a href="SignUp.php">Sign Up</a></li><li><a href="login.php">Log In</a></li><li><a href="">Cart</a></li>-->
                        </ul>           
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- ***** Navbar Area End ***** -->