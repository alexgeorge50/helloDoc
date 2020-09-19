<?php

include_once('../include/config.php');
$conn  = db_connect();
$status =0;

if(isset($_POST)){
    $dr_id = $_POST['dr_id'];
    $book_date = date("Y-m-d",strtotime($_POST['book_date']));
    $p_id = $_POST['p_id'];
    
    $sql = "insert into appoinments (app_date,p_id,dr_id,status) values ('$book_date','$p_id','$dr_id',1)";
     $insert_result = $conn -> query($sql);
     //$insert_result will contain the id of appointment if insertion is successfull
     if($insert_result > 0){
          $status = 1;
     }else{
          $status = 0;
     }
     echo json_encode($status);
}     