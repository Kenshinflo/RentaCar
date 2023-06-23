<?php

$con = mysqli_connect("localhost","root","","rentacar");

//NOTE: TEST For Notification System
if(isset($_POST['comment_pass'])){
    // include("connection.php");

    $subject = mysqli_real_escape_string($con, $_POST["subject"]);
    $comment = mysqli_real_escape_string($con, $_POST["comment"]);
    $query_ins = "INSERT INTO notification_user(notif_subject, notif_message)VALUES ('$subject', '$comment')";
    $query_runs= mysqli_query($con, $query_ins);

    // if ($query_runs){
    //     header("Location: ../index.php");
    // } else{
    //     $em = "Sorry, yours.";
    //     header("Location: ../product.php?error=$em");
    // }
}

if(isset($_POST['remove'])){
    $product = $_POST['remove'];

    $query = "DELETE FROM reservation WHERE id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: userreservation.php");
    }
    else {
        header("location: userreservation.php");
    }
}

if(isset($_POST['removeRes'])){
    $product = $_POST['removeRes'];

    $query = "DELETE FROM reservation WHERE id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-reservations.php");
    }
    else {
        header("location: _manage-reservations.php");
    }
}

if(isset($_POST['removeUser'])){
    $product = $_POST['removeUser'];

    $query = "DELETE FROM user WHERE user_id='$product'";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-users.php");
    }
    else {
        header("location: _manage-users.php");
    }
}

if(isset($_POST['removeChau'])){
    $product = $_POST['removeChau'];

    $query = "DELETE FROM chauffeur WHERE res_id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-reservations-chauffeur.php");
    }
    else {
        header("location: _manage-reservations-chauffeur.php");
    }
}

if(isset($_POST['removeCar'])){
    $product = $_POST['removeCar'];

    $query = "DELETE FROM product WHERE item_id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-cars.php");
    }
    else {
        header("location: _manage-cars.php");
    }
}

if(isset($_POST['removeDriver'])){
    $product = $_POST['removeDriver'];

    $query = "DELETE FROM drivers WHERE driver_id='$product' ";
    $query = mysqli_query($con, $query);

    if($query_run){
        header("location: _manage-drivers.php");
    }
    else {
        header("location: _manage-drivers.php");
    }
}

?>


