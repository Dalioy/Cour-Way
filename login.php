<?php

require 'connection.php';

if(!empty($_SESSION["id"])){
    header("Location: login.html");
   }
   if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
        if($password == $row["password"]){
           $_SESSION["login"] = true;
           $_SESSION["id"] = $row["id"];
           
           if ($row['role'] == 'Teacher') {
            header("Location: ModifierCourses.html");
        } else {
            header("Location: Courses.html");
        }
        }
        else{
            echo
            "<script> alert('wrong password');</script>";
        }
    }
    else{
        echo
        "<script> alert('User Not Registered'); </script>";
    }
   }
?>