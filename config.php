<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "portal_db";

$conn = mysqli_connect($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection Failed: .$conn->connect_error");
}
echo "";
session_start();
if (isset($_POST['Submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "INSERT INTO `user`(`email`, `name`, `phone_no`, `password`) VALUES('$email','$name','$number','$password')";
    if (mysqli_query($conn, $sql)) {
        echo "Records inserted successfully";
    } else {
        echo "ERROR: Could not able to execute $sql." . mysqli_error($conn);
    }
}

if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE `email`='$email' AND `password`='$password'";
    $result = mysqli_query($conn, $query)or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (mysqli_num_rows($result) == 1) {
        header("location: index.php");
    } else {
        $error = "Incorrect Email Id or Password";
    }
}
if (isset($_POST['job'])) {
    $cname = mysqli_real_escape_string($conn, $_POST['cname']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $JDesc = mysqli_real_escape_string($conn, $_POST['JDesc']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $CTC = mysqli_real_escape_string($conn, $_POST['CTC']);

    $job = "INSERT INTO `jobs`(`cname`, `position`, `JDesc`, `skills`, `CTC`) VALUES('$cname','$position','$JDesc','$skills','$CTC')";
    if(mysqli_query($conn, $job)){
        echo "New Job Posted";
    }else{
        echo "ERROR: Failed to Post the Job $sql.". mysqli_error($conn);
    }
}

if (isset($_POST['sub'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $qual = mysqli_real_escape_string($conn, $_POST['qual']);
    $apply = mysqli_real_escape_string($conn, $_POST['apply']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    $app = "INSERT INTO `candidates`(`name`, `apply`, `qual`, `year`) VALUES ('$name','$apply','$qual','$year')";
    // var_dump($app);
    // die();
    mysqli_query($conn, $app);
}

