<?php
//must appear BEFORE the <html> tag
session_start();
include_once('include/config.php');
//make the database connection
$conn = db_connect();
$dr_id = $_SESSION['valid_user'];
$response = '';

//get the days checked from db and show in page
 $get_sql = "select availability from doctor_details where dr_id='$dr_id'";
 $result_data = $conn->query($get_sql);
 $row = $result_data->fetch_assoc();
 if($row !== 0){
     $show_days = json_decode($row['availability']);
 }

// on submit
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $days = array('mon' => 0, 'tue' => 0, 'wed' => 0, 'thur' => 0, 'fri' => 0 , 'sat' => 0 , 'sun' => 0);
    foreach($_POST['days'] as $day){
         $days[$day] = 1;
    }
    $jsonSting = json_encode($days);
     echo json_encode($days); 
     
     $sql = "UPDATE doctor_details set availability = '$jsonSting' where dr_id='$dr_id'";
     $update_response = $conn->query($sql);
     if($update_response > 0){
        $response = "Updation successfull";
        header("location: updateAvailability.php");
     }else{
         $response = "Updation failed";
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
    <link rel="stylesheet" href="css/styles.css">
    <title>helloDoc</title>
</head>
<body onLoad="run_first()">
    <?php include("include/banner.inc") ?>
    <?php include("include/nav.inc") ?>
    <div class="container">
    	<form action="updateAvailability.php" method="post">
            <div class="bg-light mt-3 px-5 pt-4 member_frm" style="border-radius: 5px; border: #0000ff solid thick">
                <h2>Update Your Availability</h2>
                <h6>Please check the days in which you are available</h6>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="days[]" value="mon" class="custom-control-input" id="mon" 
                    <?php if($show_days->mon ==1){ ?>
                      checked
                    <?php } ?> >
                    <label class="custom-control-label" for="mon">Monday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="days[]" value="tue" class="custom-control-input" id="tue" 
                    <?php if($show_days->tue ==1){ ?>
                      checked
                    <?php } ?> >
                    <label class="custom-control-label" for="tue">Tuesday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="days[]" value="wed" class="custom-control-input" id="wed" 
                     <?php if($show_days->wed ==1){ ?>
                      checked
                    <?php } ?> >
                    <label class="custom-control-label" for="wed">Wednesday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="days[]" value="thur" class="custom-control-input" id="thur" 
                    <?php if($show_days->thur ==1 ){ ?>
                      checked
                    <?php } ?> >
                    <label class="custom-control-label" for="thu">Thursday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="days[]" value="fri" class="custom-control-input" id="fri" 
                    <?php if($show_days->fri ==1){ ?>
                      checked
                    <?php } ?> >
                    <label class="custom-control-label" for="fri">Friday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="days[]" value="sat" class="custom-control-input" id="sat" 
                     <?php if($show_days->sat ==1){ ?>
                      checked
                    <?php } ?> >
                    <label class="custom-control-label" for="sat">Saturday</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="days[]" value="sun" class="custom-control-input" id="sun" 
                     <?php if($show_days->sun ==1){ ?>
                      checked
                    <?php } ?> >
                    <label class="custom-control-label" for="sun">Sunday</label>
                </div>
                 <div class=" mt-3 mb-3">
                    <input  class="form-control btn btn-primary submit_btns" type="submit" id="submit" value="Submit" />
                </div>
                 <div class=" mt-3 mb-3">
                   <?php   if($response !== ''){ ?>
                     <p style="color:red" > <?php echo $response  ?>  </p>   
                   <?php } ?>
                </div>
            </div>
    	</form>
    </div>
	
	<?php include("include/footer.inc") ?>
</body>
</html>