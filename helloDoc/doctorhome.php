<?php
//must appear BEFORE the <html> tag
session_start();
include_once('include/config.php');

//make the database connection
$conn = db_connect();
$appointmentArray = [];
$app_flag= 0 ;
// if logged user is an doctor and has valid user set
if (isset($_SESSION['valid_user']) && $_SESSION['user_type'] == "doctor") {
 //get the dr_id from session 
 $dr_id = $_SESSION['valid_user'];
 //get the details of doc with id drom doctor_details table
    $sql = "select * from doctor_details where dr_id='$dr_id'";
    $result = $conn->query($sql);
    $numOfRows = $result->num_rows;
    $row = $result->fetch_assoc();
    if ($numOfRows == 1) {
        $dr_name = $row['dr_name'];
        $dr_department = $row['department'];
        $dr_email = $row['dr_email'];
        $dr_hospital = $row['hospital'];
        $dr_phone = $row['dr_phone'];
    } else {
        $error = 'Invalid user';
    }
    

     //get the appoinments of doc with id from appoinments table and patient details from patient_table in the ascending 
    // order  of appointment day
    $app_sql = "select * from appoinments LEFT JOIN patient_details on appoinments.p_id = patient_details.p_id "
            . "where appoinments.dr_id='$dr_id' and appoinments.status = 1 ORDER BY appoinments.app_date ASC";
    $app_result = $conn->query($app_sql);
    $app_rows = resultToArray($app_result);
    
    foreach($app_rows as $appointment){
//       echo json_encode($appointment);
        //push $appointment to a global array - $appointmentArray
       array_push($appointmentArray,$appointment);  
    }
    
        //check if the $appointmentArray array is empty or not
    if (!empty($appointmentArray)) {
        $app_flag =1;
    }else{
       $app_flag =1;
    }
}

function resultToArray($result) {
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
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
    	<div class="bg-light mt-3 px-5 pt-4 member_frm" style="border-radius: 5px; border: #0000ff solid thick">
                <h2>Hello <?php echo $dr_name ?></h2>
                <div class="container">
                    <div class="row">
                         <div class="col-2"></div>
                        <div class="col-4">
                            <h6>Email</h6>
                        </div>
                        <div class="col-4">
                            <?php echo $dr_email ?>
                        </div>
                    </div>
                     <div class="row">
                         <div class="col-2"></div>
                        <div class="col-4">
                            <h6>Phone</h6>
                        </div>
                        <div class="col-4">
                            <?php echo $dr_phone ?>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-2"></div>
                        <div class="col-4">
                            <h6>Department</h6>
                        </div>
                        <div class="col-4">
                            <?php echo $dr_department ?>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-2"></div>
                        <div class="col-4">
                            <h6>Hospital</h6>
                        </div>
                        <div class="col-4">
                            <?php echo $dr_hospital ?>
                        </div>
                    </div>
                   
                </div> 
                <h2 class="mt-3">Appoinments</h2>
                <div class="container">
                    <?php if($app_flag == 1){
                        echo "<h6> Upcoming appointments are listed below </h6>";
                     }else{ 
                         echo "<h6> No appointments.. </h6>";
                      } ?>
                    <table class="mt-3 mb-3 doc_table">
                        <thead>
                            <th><p>Date<p></th>
                            <th><p>Patient Name<p></th>
                            <th><p>Phone<p></th>
                            <th><p>E-mail<p></th>
                            <th><p>Booking time<p></th>
                        </thead>
                        <tbody>
                             <?php foreach($appointmentArray as $element){ ?>
                            <tr>
                                <td><p><?php echo date("d-m-Y", strtotime($element['app_date'])); ?><p></td>
                                <td><p><?php echo $element['p_name'] ?><p></td>
                                <td><p><?php echo $element['p_phone'] ?><p></td>
                                <td><p><?php echo $element['p_email'] ?><p></td>
                                <td><p><?php echo $element['app_created_at'] ?><p></td>
                           </tr>
                             <?php } ?>
                        </tbody>    
                    </table>
                </div>
            </div>
    </div>
	
	<?php include("include/footer.inc") ?>
</body>
</html>