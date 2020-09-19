<?php
//must appear BEFORE the <html> tag
session_start();
include_once('include/config.php');

if (isset($_SESSION['valid_user'])) {
    header("location: member_only.php");
}
//make the database connection
$conn  = db_connect();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $p_email = $conn -> real_escape_string($_POST['p_email']);
    $p_password = $conn -> real_escape_string($_POST['p_password']);

    //make a query to check if patient login successfully
    $sql = "select * from patient_details where p_email='$p_email' and p_password='$p_password'";
    $result = $conn -> query($sql);
	//echo "test";
	//echo $result;
    $numOfRows = $result -> num_rows;
    $row = $result -> fetch_assoc();
    if ($numOfRows == 1) {
        $_SESSION['valid_user'] = $row['p_id'];
        $_SESSION['user_type'] = 'patient';
		header("location: member_only.php");
    }else {
        $error = 'Your Login Name or Password is invalid';
    }
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
    <link rel="stylesheet" href="css/member.css">
     <link rel="stylesheet" href="css/styles.css">
    <title>helloDoc</title>
</head>
<body onLoad="run_first()">
   <?php include("include/banner.inc") ?>
    <?php include("include/nav.inc") ?>
    <div class="container">
    	<form action="login.php" method="post">
		<div class="bg-light mt-3 px-5 pt-4 member_frm">
        	<h2>Login</h2>
            <h6>Please enter your email and password</h6>
            <div class="row">
            	<div class="col">
                	<label for="p_email">Email:</label>
                	<input type="email" id="p_email" name="p_email" size="35" maxlength="50" required />
                </div>
            </div>
            <div class="row">
            	<div class="col">
                	<label for="p_password">Password:</label>
                    <input type="password" id="p_password" name="p_password"
                           size="20" maxlength="20" required />
                </div>
           	</div>
                <div class="row">
            	<div class="col mt-3 mb-3">
                    <label>&nbsp;</label>
                    <input type="submit" class="btn btn-primary" id="submit" value="Submit" />
                    <input type="reset" class="btn btn-default" id="reset" value="Clear" />
                    <?php
                    if(isset($error)) {
                        echo "<p style=\"color: red;\">$error</p>";
                        unset($error);
                    }
                    ?>
                </div>
            </div>            
        </div>
        </form>
    </div>
	<?php include("include/footer.inc") ?>
</body>
</html>