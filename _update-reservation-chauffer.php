<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$id=$_GET['updateReserve'];

$sql="SELECT * FROM reservation WHERE id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$id=$row['id'];
$item=$row['item_id'];
$name=$row['user_name'];
$number=$row['number'];
$brand=$row['brand'];
$pickup=$row['pickupdate'];
$return=$row['returndate'];
$driver=$row['driver_id'];

$sql="SELECT * FROM product WHERE item_id=$item";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$model=$row['item_name'];


if(isset($_POST['update'])){
    $sql2="SELECT * FROM product WHERE item_id=$item";
    $result=mysqli_query($con,$sql2);
    $row=mysqli_fetch_assoc($result);
    $model=$row['item_name'];

    $name=$_POST['user_name'];
    $number=$_POST['number'];
    $brand=$_POST['brand'];
    $pickup=$_POST['pickupdate'];
    $return=$_POST['returndate'];
    $driver=$_POST['driver_id'];
    $item=$_POST['item'];


    $sql = "UPDATE reservation SET user_name='$name', number='$number', brand='$model', pickupdate='$pickup', 
    returndate='$return', driver_id='$driver', item_id='$item' WHERE id=$id";

        $result=$con->query($sql);
        
        if($result){
             echo "updated successfully";
             header('location:_manage-reservations-chauffeur.php');
        }else{
             die("Invalid Query: " . $con->error);

}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentaCar</title>
    
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

<section class="container-fluid background-radial-gradient overflow-hidden " id = "background"> 
    
        <div class="forms-container2">
        <button onclick="window.location='_manage-reservations.php';" id="seller-login account" type="submit" class="btnadd btn-primary mx-5 mt-5 py-1 px-5" style="border-radius: 20px; font-size:20px;" name="submit">Back</button>
        <div class="signupform2 container-sm p-4">
            <h2 id="createaccount-title" class="font-weight-bold" style="color: #444">Update Reservation</h2>
            <p class="mb-4"></p>
            
            

            <form id="create-account" method="post" action="" enctype="multipart/form-data">

                <!-- First name -->
                <div class="input-field mb-3">
                    <input type="text" class="form-control" style="border-radius:30px" name="user_name" placeholder="First name" autocomplete="off" value=<?php echo $name;?> required/> 
                </div>

                

                <!-- Last name -->
                <div class="input-field mb-3">
                        <input type="text" class="form-control" style="border-radius:30px" name="number" placeholder="Last name" autocomplete="off" value=<?php echo $number;?> required/>
                    </div>
                
                <!-- Username -->            
                <div class="input-field mb-3">
                    <input type="text" style="border-radius:30px"class="form-control" name="brand" placeholder="Username" autocomplete="off" value=<?php echo $model;?> readonly/>
                </div>

                <div class="input-field mb-3">
                        <input type="text" class="form-control" style="border-radius:30px" name="item" placeholder="Last name" autocomplete="off" value=<?php echo $item;?> required/>
                    </div>

                <!-- Password -->      
                <div class="row">   
                <div class="mb-3 col-6" style="margin-left: -5px;">
                    <input type="date" class="form-control" style="border-radius:30px" placeholder="Password" name="pickupdate" autocomplete="off" value=<?php echo $pickup;?> required/>
                </div>

                <!-- Email -->
                <div class="mb-3 col-6" style="margin-left: -5px;">
                    <input type="date" class="form-control" style="border-radius:30px" placeholder="Email" name="returndate" autocomplete="off" value=<?php echo $return;?> required/>
                </div>
                </div>  
                <!-- Contact Number -->
                <div class="input-field mb-3">
                            <input type="text" name="driver_id" style="border-radius:30px" class="form-control" placeholder="Contact Number" value=<?php echo $driver;?>> 
                </div>

                

            
                
                <div class="d-grid col-md-12 text-center mt-4">
                    <button id="user-create account" type="submit" class="btn btn-primary mb-3 btn-block" style="background-color: #3b5998; border-radius:30px" name="update">Update Information</button>
                </div>

            </form>
        </div>
    </div>
    
</section>
</body>

</html>
