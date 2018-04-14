

<?php
// Include config file

require_once './config.php';



// Define variables and initialize with empty values

$username = $password =$hashed_password = "";

$username_err = $password_err = "";

  $con = mysqli_connect("localhost","root","","hallam");
                        
$query = "SELECT * FROM `users` WHERE username='$username' and password='$hashed_password'";
            $result = mysqli_query($con, $query) or die(mysql_error());
            $rows = mysqli_num_rows($result);
            



// Processing form data when form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    // Check if username is empty

    if (empty(trim($_POST["username"]))) {

        $username_err = 'Please enter username.';
    } else {

        $username = trim($_POST["username"]);
    }



    // Check if password is empty

    if (empty(trim($_POST['password']))) {

        $password_err = 'Please enter your password.';
    } else {

        $password = trim($_POST['password']);
    }



    // Validate credentials

    if (empty($username_err) && empty($password_err)) {

        // Prepare a select statement

        $sql = "SELECT username, password FROM users WHERE username = ?";



        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "s", $param_username);



            // Set parameters

            $param_username = $username;



            // Attempt to execute the prepared statement

            if (mysqli_stmt_execute($stmt)) {

                // Store result

                mysqli_stmt_store_result($stmt);



                // Check if username exists, if yes then verify password

                if (mysqli_stmt_num_rows($stmt) == 1) {

                    // Bind result variables

                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {

                        if (password_verify($password, $hashed_password)) {

                          
                            session_start();
                            
                            
                            
                            $_SESSION['username'] = $username;

                                
                                    
                if($logged_in_user['user_type'] == 'admin') {
           $logged_in_user = mysqli_fetch_assoc($result);
      
            $_SESSION['user'] = $logged_in_user;
            $_SESSION['success'] = "You are now login";
            header('location:welcome.php');
        }else{
           
            $_SESSION['user'] = $logged_in_user;
            $_SESSION['success']= "You are now login";
            
            header('location:index.php');
            
    }
                                 
                            } else {
                                array_push($errors, "Wrong username/password combination");
                            }
                        }
                    } else {

                        // Display an error message if password is not valid

                        $password_err = 'The password you entered was not valid.';
                    }
                }
            } else {

                // Display an error message if username doesn't exist

                $username_err = 'No account found with that username.';
            }
        } else {

            echo "Oops! Something went wrong. Please try again later.";
        }
    



    // Close statement

    mysqli_stmt_close($stmt);
}





// Close connection

mysqli_close($link);
?>



<!DOCTYPE html>

<html lang="en">

    <head>


        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta charset="UTF-8">

        <title>Sign In</title>
        <link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">


    </head>

    <body>
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-md-12 ">
                            <a href="www.hallamcitycollege.com"><img src="hallam1.png" width="50%"></a>
                            <h1><strong>Login</strong></h1>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h2>Login</h2>

                                        <p>Please fill in your credentials to login.</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-key"></i>
                                    </div>



                                </div><br>
                                <div class="col-md-3"></div>
                                <div class="col-md-5">
                                    <a>  

                                        <img class="animated bounce infinite" src="images3.png" width="100%">


                                    </a>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-box">

                                <div class="form-bottom">


                                    <form class="control" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">

                                            <label>Username</label>

                                            <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">

                                            <span class="help-block"><?php echo $username_err; ?></span>

                                        </div>    

                                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                                            <label>Password</label>

                                            <input type="password" name="password" class="form-control">

                                            <span class="help-block"><?php echo $password_err; ?></span>

                                        </div>

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" value="Login">

                                        </div>

                                        <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>

                                    </form>
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>  

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

        <script src="assets/js/placeholder.js"></script>


    </body>

</html>

