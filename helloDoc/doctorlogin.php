<?php
//must appear BEFORE the <html> tag
session_start();
include_once('include/config.php');

// redirect to doctohome page if any doc details are there in session and user type is doc 
if (isset($_SESSION['valid_user']) && $_SESSION['user_type'] == "doctor") {
    header("location: doctorhome.php");
}
//make the database connection
$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    $dr_email = $conn->real_escape_string($_POST['dr_email']);
    $dr_password = $conn->real_escape_string($_POST['dr_password']);

    //make a query to check if doctor login successfully
    $sql = "select * from doctor_details where dr_email='$dr_email' and dr_password='$dr_password'";
    $result = $conn->query($sql);
    $numOfRows = $result->num_rows;
    $row = $result->fetch_assoc();
    if ($numOfRows == 1) {
        $_SESSION['valid_user'] = $row['dr_id'];
        $_SESSION['user_type'] = "doctor";
        header("location: doctorhome.php");
    } else {
        $error = 'Your Login email or Password is invalid';
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
            <div class="bg-light mt-3 px-5 pt-4" style="border-radius: 5px; border: #0000ff solid thick">
                <h2>Doctor Login</h2>
                <h6>Please enter your email and password</h6>
                <form action="doctorlogin.php" method="post">
                    <div class="form-group">
                        <label for="dr_email">Email address:</label>
                        <input type="email" class="form-control" id="dr_email" name="dr_email" size="35" maxlength="50" required >
                    </div>
                    <div class="form-group">
                        <label for="dr_password">Password:</label>
                        <input type="password" class="form-control" id="dr_password" name="dr_password"
                               size="20" maxlength="20" required>
                    </div>
                    <div class=" mt-3 mb-3">
                      <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                      <input type="reset" id="reset" value="Clear" class="btn btn-default"/>
                     </div>
                  
                    <?php
                    if (isset($error)) {
                        echo "<p style=\"color: red;\">$error</p>";
                        unset($error);
                    }
                    ?>
                </form>

            </div>
        </div>            
    </div>
</div>
<?php include("include/footer.inc") ?>
</body>
</html>