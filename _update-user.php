<?php
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$id=$_GET['updateUser'];

$sql="SELECT * FROM user WHERE user_id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$id=$row['user_id'];
$firstname=$row['first_name'];
$lastname=$row['last_name'];
$username=$row['user_name'];
$password=$row['pass_word'];
$email=$row['email'];
$contact=$row['contact_num'];
$verified=$row['verified'];


if(isset($_POST['update'])){
    $firstname=$_POST['first_name'];
    $lastname=$_POST['last_name'];
    $username=$_POST['user_name'];
    $password=$_POST['pass_word'];
    $email=$_POST['email'];
    $contact=$_POST['contact_num'];
    $verified=$_POST['verified'];

    $sql = "UPDATE user SET first_name='$firstname', last_name='$lastname',
     user_name='$username', pass_word='$password', email='$email', contact_num='$contact', verified='$verified' WHERE user_id=$id";
     $result=$con->query($sql);
     if($result){
        echo "updated successfully";
        header('location:_manage-users.php');
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
    
        <div class="forms-container1">
        <button onclick="window.location='_manage-users.php';" id="seller-login account" type="submit" class="btnadd btn-primary mx-5 mt-5 py-1 px-5" style="border-radius: 20px; font-size:20px;" name="submit">Back</button>
        <div class="signupform1 container-sm p-4">
            <h2 id="createaccount-title" class="font-weight-bold" style="color: #444">Update User Information</h2>
            <p class="mb-4"></p>
            
            

            <form id="create-account" method="post" action="" enctype="multipart/form-data">

                <!-- First name -->
                <div class="input-field mb-3">
                    <input type="text" class="form-control" style="border-radius:30px" name="first_name" placeholder="First name" autocomplete="off" value=<?php echo $firstname;?> required/> 
                </div>

                

                <!-- Last name -->
                <div class="input-field mb-3">
                        <input type="text" class="form-control" style="border-radius:30px" name="last_name" placeholder="Last name" autocomplete="off" value=<?php echo $lastname;?> required/>
                    </div>
                
                <!-- Username -->            
                <div class="input-field mb-3">
                    <input type="text" style="border-radius:30px"class="form-control" name="user_name" placeholder="Username" autocomplete="off" value=<?php echo $username;?> required/>
                </div>

                <!-- Password -->           
                <div class="input-field mb-3">
                    <input type="password" class="form-control" style="border-radius:30px" placeholder="Password" name="pass_word" autocomplete="off" value=<?php echo $password;?> required/>
                </div>

                <!-- Email -->
                <div class="input-field mb-3">
                    <input type="email" class="form-control" style="border-radius:30px" placeholder="Email" name="email" autocomplete="off" value=<?php echo $email;?> required/>
                </div>

                <!-- Contact Number -->
                <div class="input-field mb-3">
                            <input type="text" name="contact_num" style="border-radius:30px" class="form-control" placeholder="Contact Number" value=<?php echo $contact;?>> 
                </div>

                <!-- Verification -->
                <div class="input-field mb-3">
                            <input type="text" name="verified" style="border-radius:30px" class="form-control" placeholder="Verification" value=<?php echo $verified;?>> 
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
