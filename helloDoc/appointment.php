<?php
//must appear BEFORE the <html> tag
session_start();
include_once('include/config.php');

if ($_SESSION['user_type'] !=='patient') {
    header("location: login.php");
}
//make the database connection
$conn  = db_connect();
$p_id = $_SESSION['valid_user'];
$app_date = '';
//array to store the available docs data
$availablie_docs = [];
$doc_search_response = '';
//flag if atleast 1 doc is available
$doc_search_result = 0;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['app_date'] !== ''){
        // date sent from form
        $app_date = $conn -> real_escape_string($_POST['app_date']);
        $dayOfweek = '';
        // function returns a number
        $dayNumber  = getWeekday($app_date);
        // assign day for each number
        if($dayNumber == 1){
            $dayOfweek = 'mon';
        }else if($dayNumber == 2){
            $dayOfweek = 'tue';
        }else if($dayNumber == 3){
            $dayOfweek = 'wed';
        }else if($dayNumber == 4){
            $dayOfweek = 'thur';
        }else if($dayNumber == 5){
            $dayOfweek = 'fri';
        }else if($dayNumber == 6){
            $dayOfweek = 'sat';
        }else if($dayNumber == 7){
            $dayOfweek = 'sun';
        }
        
       // make a query to check get the doc_table data
        $sql = "select * from doctor_details ";
        $doc_result = $conn -> query($sql);
        $doc_rows = resultToArray($doc_result);
         //loop through all doctor rows
         foreach($doc_rows as $doc){    
             $availibility = json_decode($doc['availability']);
//             echo $availibility->$dayOfweek;
             // check if doctor is available on the selected day
             if($availibility->$dayOfweek == 1){
                 //push that doctor data to a global array - $availablie_docs
                 array_push($availablie_docs,$doc);
             }
         }
         
         //check if the available docs array is empty or not
         if (!empty($availablie_docs)) {
              $doc_search_result = 1;
              $doc_search_response = 'The following doctors are available on '.$app_date;
         }else{
             $doc_search_result = 0;
              $doc_search_response = 'Doctors not available on '.$app_date.'. Please select another date';
         }
    }
}
// function to return day of week - returns a number
function getWeekday($date) {
    return date('w', strtotime($date));
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/member.css">
     <link rel="stylesheet" href="css/styles.css">
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
      //initialize datepicker and prevent selecting past dates
    $( "#app_date").datepicker({ minDate: 0});
  } );
  


    // Initialzes when page is loaded.
    $( document ).ready(function() {
        $(".book_appoinment").click(function(){
//            get the id of the doctor
            var avalable_dr_id =  $(this).attr('data-id');
            var p_id = <?php echo $p_id; ?> ;
            var date = $('#app_date').val().toString();
            
            //ajax call to server to make insertion in appointment table
            // data sent are patient_id, doctor id and appointment date
            $.ajax({
              url: "ajax/book_appointment.php",
              type: "POST",
              data: {dr_id : avalable_dr_id , p_id : p_id , book_date : date},
              success: function(data){
                  console.log(data);
                if(data == 1){
                    alert("Appoinment made on "+ date);
                 }else{
                      alert("Booking failed");
                 }
             }
            });
         });
    });
  
  </script>
    <title>helloDoc</title>
</head>
<body onLoad="run_first()">
	<?php include("include/banner.inc") ?>
    <?php include("include/nav.inc") ?>
    <div class="container">
            <div class="bg-light mt-3 px-5 pt-4" style="border-radius: 5px; border: #0000ff solid thick">
            <h1>Make An Appointment</h1>
            <h6>Search for doctors on a date</h6>
            <form action="appointment.php" method="post">
                <div class="form-group">
                    <label for="app_date">Date:</label>
                    <input class="form-control" type="text" value="<?php echo $app_date ?>" id="app_date" name="app_date">
                </div>
                <div class=" mt-3 mb-3">
                    <button type="submit" id="submit" class="btn btn-primary">Search</button>
               </div>
             </form>
            <div class="container">
                <?php if($doc_search_response !== '' ){ ?>
                <h6> <?php echo $doc_search_response ?> </h6>
                <?php } ?>
                
<!--                show table on if atleast 1 result is there-->
                <?php if($doc_search_result == 1 ){ ?>
                <table class="mt-3 mb-3 doc_table">
                    <thead>
                        <th><p>Name<p></th>
                        <th><p>Phone<p></th>
                        <th><p>E-mail<p></th>
                        <th><p>Department<p></th>
                        <th><p>Hospital<p></th>
                        <th><p>Actions<p></th>
                    </thead>
                    <tbody>
                         <?php foreach($availablie_docs as $element){ ?>
                        <tr>
                            <td><p><?php echo $element['dr_name'] ?><p></td>
                            <td><p><?php echo $element['dr_phone'] ?><p></td>
                            <td><p><?php echo $element['dr_email'] ?><p></td>
                            <td><p><?php echo $element['department'] ?><p></td>
                            <td><p><?php echo $element['hospital'] ?><p></td>
                            <td><button data-id="<?php echo $element['dr_id'] ?>" class="btn btn-sm btn-primary book_appoinment"> Book appointment </button></td>
                       </tr>
                         <?php } ?>
                    </tbody>    
                </table>
                <?php } ?>
            </div>
            </div>
        </div>
     </div>            
        

  <?php include("include/footer.inc") ?>
</body>
</html>