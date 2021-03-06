<?php
//must appear BEFORE the <html> tag
session_start();
include_once('include/config.php');
// check session variable
		if (isset($_SESSION['valid_user']))
        {
            //make the database connection
            $conn  = db_connect();
            $user_check = $_SESSION['valid_user'];

            //make a query to check if a valid user
            $ses_sql = "select * from patient_details where p_id='$user_check'";
            $result = $conn -> query($ses_sql);
            if ($result -> num_rows == 1) {
                $row = $result -> fetch_assoc();
                $name = $row['p_name'];
				$email = $row['p_email'];
				$phone = $row['p_phone'];
                //echo "<p>Welcome <b>$name!</b></p>";
                //echo "<p><a href=\"logout.php\">Logout</a></p>";
            }
            else {
                echo "<p>Something is wrong.</p>";
                //echo "<p><a href=\"login.php\" id=\"4\" 
				//onClick=\"nav_item_selected(4)\">Login</a></p>";
            }
        }
        else
        {
            echo "<p>You are not logged in.</p>";
            echo "<p><a href=\"login.php\" id=\"4\" 
			onClick=\"nav_item_selected(4)\">Login</a></p>";
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/read_more.js"></script>
     <link rel="stylesheet" href="css/styles.css">
    <title>helloDoc</title>
</head>
<body onLoad="run_first()">
	<?php include("include/banner.inc") ?>
    <?php include("include/nav.inc") ?>
    <div class="container">
       <div class="bg-light mt-3 px-5 pt-4 member_frm">
                <h2>Hello <?php echo $name ?></h2>
                <div class="container">
                    <div class="row">
                         <div class="col-2"></div>
                        <div class="col-4">
                            <h6>Email</h6>
                        </div>
                        <div class="col-4">
                            <?php echo $email ?>
                        </div>
                    </div>
                     <div class="row">
                         <div class="col-2"></div>
                        <div class="col-4">
                            <h6>Phone</h6>
                        </div>
                        <div class="col-4">
                            <?php echo $phone ?>
                        </div>
                    </div>
                </div> 
         </div> 
    </div>
	<?php include("include/footer.inc") ?>
</body>
</html>