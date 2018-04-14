

<?php
// Include config file

require_once 'config.php';



// Define variables and initialize with empty values

$username = $password = $confirm_password = "";

$username_err = $password_err = $confirm_password_err = "";



// Processing form data when form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    // Validate username

    if (empty(trim($_POST["username"]))) {

        $username_err = "Please enter a username.";
    } else {

        // Prepare a select statement

        $sql = "SELECT id FROM users WHERE username = ?";



        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "s", $param_username);



            // Set parameters

            $param_username = trim($_POST["username"]);



            // Attempt to execute the prepared statement

            if (mysqli_stmt_execute($stmt)) {

                /* store result */

                mysqli_stmt_store_result($stmt);



                if (mysqli_stmt_num_rows($stmt) == 1) {

                    $username_err = "This username is already taken.";
                } else {

                    $username = trim($_POST["username"]);
                }
            } else {

                echo "Oops! Something went wrong. Please try again later.";
            }
        }



        // Close statement

        mysqli_stmt_close($stmt);
    }



    // Validate password

    if (empty(trim($_POST['password']))) {

        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST['password'])) < 6) {

        $password_err = "Password must have atleast 6 characters.";
    } else {

        $password = trim($_POST['password']);
    }



    // Validate confirm password

    if (empty(trim($_POST["confirm_password"]))) {

        $confirm_password_err = 'Please confirm password.';
    } else {

        $confirm_password = trim($_POST['confirm_password']);

        if ($password != $confirm_password) {

            $confirm_password_err = 'Password did not match.';
        }
    }



    // Check input errors before inserting in database

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {



        // Prepare an insert statement

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";



        if ($stmt = mysqli_prepare($link, $sql)) {

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);



            // Set parameters

            $param_username = $username;

            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement

            if (mysqli_stmt_execute($stmt)) {

                // Redirect to login page

                header("location: login.php");
            } else {

                echo "Something went wrong. Please try again later.";
            }
        }



        // Close statement

        mysqli_stmt_close($stmt);
    }



    // Close connection

    mysqli_close($link);
}
?>



<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta charset="UTF-8">

        <title>Sign Up</title>
        <link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">




    </head>

    <body>
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">

                    <div class="row">
                        <div class="col-md-12 ">
                            <a href="http://www.hallamcitycollege.com/"><img src="images1.jpg" width="50%"></a>
                            <h1><strong>Sign In</strong></h1>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign up now</h3>
                                        <p>Fill in the form below to get instant access:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>



                                </div><br>
                                <div class="col-md-3"></div>
                                <div class="col-md-5">
                                    <a>  

                                        <img class="animated bounce infinite" src="images2.png">


                                    </a>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-box">

                                <div class="form-bottom">

                                    <form class="control" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form"  >

                                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" >

                                            <label>Username</label>

                                            <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">

                                            <span class="help-block"><?php echo $username_err; ?></span>

                                        </div>    

                                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">

                                            <label>Password</label>

                                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">

                                            <span class="help-block"><?php echo $password_err; ?></span>

                                        </div>

                                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">

                                            <label>Confirm Password</label>

                                            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">

                                            <span class="help-block"><?php echo $confirm_password_err; ?></span>

                                        </div>

                                        <div class="form-group">

                                            <input type="submit" class="btn btn-primary" value="Submit">

                                            <input type="reset" class="btn btn-default" value="Reset">

                                        </div>

                                        <p>Already have an account? <a href="login.php">Login here</a>.</p>

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

