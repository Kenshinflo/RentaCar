<?php
session_start();
$con = mysqli_connect("localhost","root","","rentacar");


if(isset($_POST['addDriver'])){
    
    $name = $_POST['driver_name2'];
    $age = $_POST['driver_age2'];
    $contact = $_POST['driver_contact2'];
    $address = $_POST['driver_address2'];

    $sql = "INSERT INTO drivers (driver_name, driver_age, driver_contact, driver_address) 
    VALUES ('$name', '$age', '$contact', '$address')";
    $result = $con->query($sql);

    if($result){
        echo '<script> alert("Data Saved Successfully!"); </script>';
        header("location: _manage-drivers2.php");
    }
    else {
        echo '<script> alert("Data Was Not Successfully Saved!"); </script>';
        
    }
}

$seller = $_SESSION['com_id'];

if(isset($_POST['addCar'])){
    
    $name2 = $_POST['item_name2'];
    $brand2 = $_POST['item_brand2'];
    $transmission2 = $_POST['item_transmission2'];
    $capacity2 = $_POST['item_capacity2'];
    $color2 = $_POST['item_color2'];
    $license2 = $_POST['item_license_plate2'];
    $price2 = $_POST['item_price2'];

    $folder='images/cars/';
	$file = $_FILES['pic_CAR']['tmp_name'];
    $file_name = $_FILES['pic_CAR']['name'];
    $file_name_array = explode(".", $file_name); 
		$extension = end($file_name_array);

    $new_image_name ='Car_'.rand() . '.' . $extension;
	    if ($_FILES["pic_CAR"]["size"] >10000000) {
	        $error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
	}

        if($file != ""){
            if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
            && $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG"){
                    $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
        }
    }

    if(!isset($error)){ 
        if($file!= ""){
        move_uploaded_file($file, $folder . $new_image_name); 
        $sql = "INSERT INTO product (seller_id, item_name, item_brand, item_transmission, item_capacity, item_color, item_license_plate, item_price, item_image) 
        VALUES ('$seller', '$name2', '$brand2', '$transmission2', '$capacity2', '$color2', '$license2', '$price2', '$new_image_name')";
        $result = $con->query($sql);

    if($result){
        echo '<script> alert("Data Saved Successfully!"); </script>';
        header("location: _manage-cars2.php");
    }
    else {
        echo '<script> alert("Data Was Not Successfully Saved!"); </script>';
        
    }
}
}
}

?>