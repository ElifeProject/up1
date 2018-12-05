<?php
// get ID of the product to be edited
//$Pro_id = isset($_GET['Pro_id']) ? $_GET['Pro_id'] : die('ERROR: missing ID.');
$Pro_id= 2;
 
// include database and object files
include_once 'config/database.php';
include_once 'object/product.php';
include_once 'object/category.php';
 
// get database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>E-Life</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        

        <!-- ***** Navbar Area ***** -->
        <div class="alazea-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="alazeaNav">

                        <!-- Nav Brand -->
                        <a href="index.php" class="nav-brand"><img src="img/logo.png" style="width: 100px;"></a>

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
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    
                                    <li><a href="logout.php">Log Out</a></li>
                                </ul>
                            </div>
                            <!-- Navbar End -->
                        </div>
                    </nav>

                    <!-- Search Form -->
                    <div class="search-form">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type keywords &amp; press enter...">
                            <button type="submit" class="d-none"></button>
                        </form>
                        <!-- Close Icon -->
                        <div class="closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
 
// set page header
$page_title = "Update_product";
//include_once "layout_header.php";
 
// set page footer
//include_once "layout_footer.php";
?>

<?php
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$product = new Product($db);
$category = new Category($db);
 
// set ID property of product to be edited
$product->Pro_id = $Pro_id;
 
// read the details of product to be edited
$product->readOne(); 

if($_POST){
    $product->Pro_name=$_POST['Pro_name'];
    $product->price=$_POST['price'];
    $product->cat_id=$_POST['Catagory_id'];
    if($product->update()){
        echo "<div class ='alert alert-success'> Product was updated successfully </div>";
    }
    else{
        echo "<div class ='alert alert-danger'> Sorry! product cannot be updated </div>";
    }
}

?>


<section class="hero-area">
        <div class="hero-post-slides owl-carousel">

            <!-- Single Hero Post -->
            <div class="single-hero-post bg-overlay">
                <!-- Post Image -->
                <div class="container">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <!-- Post Content -->
                            <div class="hero-slides-content font-cursive">
                                <div class="row mt-30">
                                    <div class="col-md-8 col-sm-12">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?Pro_id={$Pro_id}");?>"method="post">
                                            <div class="form-group">
                                                <label for="name"><div class="font-clr">Name:</div></label>
                                                <input type="text" name="Pro_name" class="form-control" id="" placeholder="Enter name" name="" required value ="<?php echo isset($_POST['Pro_name']) ? htmlspecialchars($_POST['Pro_name'], ENT_QUOTES) : ""; ?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="price"><div class="font-clr">Price:</div></label>
                                                <input type="text" name="price" class="form-control" id="" placeholder="Enter Price" name="" required value ="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price'], ENT_QUOTES) : ""; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="category"><div class="font-clr">Category:</div></label>
                                                <?php
                                                    $stmt = $category->read();
                                                    echo "<select class='form-control' name='Catagory_id'>";
                                                    echo "<option> Select Category </option>";
                                                    while($row_category = $stmt->fetch(PDO::FETCH_ASSOC))
                                                        {
                                                            extract($row_category);
                                                            echo "<option value='{$Catagory_id}'> {$Catagory_title}</option>";
                                                        }
                                                        echo "</select>";
                                                ?>
                                            </div>
                                            <br>
                                            <button type="submit" value="update_product"  name="update_product" class="btn btn-default"> Update </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php 
// if the form was submitted
if($_POST){
 
    // set product property values
    $product->name = $_POST['Pro_name'];
    $product->price = $_POST['price'];
    $product->category_id = $_POST['cat_id'];
 
    // update the product
    if($product->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "HURRAH! Product was updated succesfully.";
        echo "</div>";
    }
 
    // if unable to update the product, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Sorry! Product cannot be updated.";
        echo "</div>";
    }
}
?>


<!-- ##### Footer Area Start ##### -->
    <footer class="footer-area bg-img font-cursive" style="background-image: url(img/footer.jpg);">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>E-Life</h5>
                            </div>
                            <p>Join Us</p>
                            <div class="social-info">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget">
                            <div class="widget-title">
                                <h5>CONTACT</h5>
                            </div>

                            <div class="contact-information">
                                <p><span>Address:</span> UET, Lahore</p>
                                <p><span>Phone:</span> +92 322 4375787</p>
                                <p><span>Email:</span> elife@gmail.com</p>
                                <p><span>Open hours:</span> 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="border-line"></div>
                    </div>
                    <!-- Copywrite Text -->
                    <div class="col-12 col-md-6">
                        <div class="copywrite-text">
                            <p>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>