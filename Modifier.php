<?php

require 'connection.php';

if(isset($_POST["submit"])){
  $file_name = $_FILES['file']['name']; // getting file name
  $tmp_name = $_FILES['file']['tmp_name']; //getting temp_name of file
  $file_up_name = time().$file_name; // making file name dynamic by adding time before file name
  //move_uploaded_file($tmp_name, "files/.$file_up_name"); // moving file to the specified folder with dynamic name 
  //$_SESSION['img'] = $file_up_name;
  $tech_id = $_SESSION["id"];
  $course_title = $_POST["course_title"];
  $course_description = $_POST["course_description"];
  $course_category = $_POST["course_category"];
  $course_price = $_POST["course_price"];
  $date = date("Y-m-d H:i:s"); 


  $query = "INSERT INTO courses VALUES('','$tech_id','$file_up_name','$course_title','$course_description','$course_category','$course_price','$date')";
  mysqli_query($conn, $query);
  echo "<script> alert('ADDED SUCC');</script>";


}

?>