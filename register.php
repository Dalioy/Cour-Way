<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "courway"; 
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit"])){
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_num = $_POST['phone_num'];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST['role'];
    $date = date("Y-m-d H:i:s"); 
    // $encrypted_password = md5($password);

//CREATE DATABASE courway 
// CREATE TABLE users(
//
//
//
//
//);

    $duplicate = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
       echo "<script> alert('Try another Email');</script>";
    }
    else{

        $query = "INSERT INTO users VALUES('', '$first_name', '$last_name', '$phone_num', '$email', '$password', '$role', '$date')";
        mysqli_query($conn, $query);
        echo "<script> alert('Registration Successful');</script>";
    }
    header("Location: login.html");
}
?>