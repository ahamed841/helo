

<?php
// Initialize the session

session_start();
require_once './db.php';
$db = new DB();
$users = $db->getResults("SELECT * FROM `users`");

// If session variable is not set it will redirect to login page

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {

    header("location: login.php");

    exit;
}
?>



<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <title>Welcome</title>

        <link rel="stylesheet" href="bootstrap-3.3.7/dist/css/bootstrap.min.css">

        <style type="text/css">

            body{ font: 14px sans-serif; text-align: center; }

        </style>

    </head>

    <body>
        			<div>
				
			</div>
        <div class="col-md-2">  <a><img src="images4.png" width="100%" ></a></div>

        <div class="col-md-8">
            <div class="page-header ">
                <a><img src="hallam1.png" width="70%" ></a>


            </div>
        </div>
        <div class="col-md-2"> <div > 
                <a><img src="images5.png" width="100%" ></a>
            </div>

        </div>

        <div class="col-md-2">

        </div>
        <div class="col-md-10" >



            <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to our site.</h1>



            <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>
        </div>
        <div class="col-md-1">
            <div class="links">
                <ul>

                    <h2>Site Links</h2>

                    <li><a href="">Web Design</a></li>
                    <li><a href="">Web Programming</a></li>
                    <li><a href="">Search Engine Optimization</a></li>
                    <li><a href="">Portfolio</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Contact</a></li>
                    <li><a href="">More links here</a></li>


                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <table class="table table-responsive">
                <thead>
                    <tr>


                        <th>PEOPLE</th>

                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>

                            <td><?= $user["username"]; ?></td>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>

    </body>



</html>

