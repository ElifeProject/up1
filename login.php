<?php
include_once "config/core.php";
//page title
$page_title = "Login";
//include login cheker
$require_login =false;
include_once "login_checker.php";
//default  to false
$access_denied=false;

//when login form was submitted
if($_POST){
    include_once 'config/database.php';
    include_once 'object/user.php';
    $database = new Database();
    $db = $database->getConnection();

    //initializing object
    $user = new User($db);
    //check email $ password exist in database
    $user->email =$_POST['email'];
    //if email exist in database and egt user detail using this function/method
    $email_exists = $user->emailExists();

    if($email_exists && password_verify($_POST['password'] , $user->password) && $user->status==1 ){
        //if than set session
        $_SESSION['logged_in'] = true ;
        $_SESSION['user_id'] = $user->id ;
        $_SESSION['access_level'] = $user->access_level;
        //$_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES,'UTF-08');
        $_SESSION['firstname'] = $user->firstname;
        $_SESSION['lastname'] = $user->lastname;

        //if access-level ==admin than redirest to admin
        if($user->access_level =='Admin'){
            header("Location : {$home_url}admin/index.php?action = login_success");
        }
        //redirect to user section
        else{
            header("Location : {$home_url}indexx.php?action = login_success");
        }
    }
    //if username doesnot exist or password is wrong
    else{
        $access_denied =true;
    }
}
include_once "layout_header.php";
?>
 <!--##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-post-slides owl-carousel">

            <!-- Single Hero Post -->
            <div class="single-hero-post bg-overlay">
                <!-- Post Image -->
                <div class="slide-img bg-img" style="background-image: url(img/bgsignup.jpg);"></div>
                <div class="container">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                             <!--when user tries to access a page where login is required ,it will generate a "please login" action that will used to show "please login to access this page" message-->
   
                            <?php 
                                //get ction value in url parameter to display corresponding prompt messages
                                $action =isset($_GET['action']) ? $_GET['action'] : "";

                                //tell the user he is not yet logged in
                                if($action == 'not_yet_logged_in'){
                                    echo "<div class='alert alert_danger margin-top-40' role='alert'>Please Login.</div>";
                                 }
                                 //tell user to be login
                                 else if($action =='please_login'){
                                    echo "<div class='alert alert-info'>
                                            <strong>Please login to access that page.</strong>
                                         </div>";
                                     }
                                     //tell the user if denied
                                     if($access_denied){
                                        echo "<div class='alert alert_danger margin-top-40' role='alert'>
                                                    Access Denied.<br/><br/>
                                                    Your username or password maybe incorrect
                                              </div>";
                                          }
                            ?>
                            <!-- Post Content -->
                            <div class="hero-slides-content font-cursive">
                                <h2>Log In Form!</h2>
                                <div class="row mt-30">
                                    <div class='col-md-8 col-sm-12'>
                                        <form action="login.php" method="post">
                                            <div class='form-group'>
                                                <label for='name'><div class='font-clr'>Email:</div></label>
                                                <input type='text' class='form-control'  placeholder='Enter email' name='email' required autofocus>
                                            </div>
                                            <div class='form-group'>
                                                <label for='password'><div class='font-clr'>Password:</div></label>
                                                <input type='password' class='form-control'  placeholder='Enter Password' name='password' required>
                                            </div>
                                            <br>
                                            <button type='submit' class='btn btn-default' value='Log In'>Log In</button>
                                        </form>
                                        <br>
                                        <h4 class='font-clr'>Don't have an account yet. <a href='SignUp.php'><h4 class='font-clr'>Sign Up!</h4></a></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->
<?php
 include_once "layout_footer.php";  
?>
        