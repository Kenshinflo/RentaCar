<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$id=$_GET['updateDriver'];

$sql="SELECT * FROM drivers WHERE driver_id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$id=$row['driver_id'];
$name=$row['driver_name'];
$age=$row['driver_age'];
$contact=$row['driver_contact'];
$address=$row['driver_address'];

if(isset($_POST['update'])){
    $name=$_POST['driver_name'];
    $age=$_POST['driver_age'];
    $contact=$_POST['driver_contact'];
    $address=$_POST['driver_address'];

    $img_name = $_FILES['pic_ID']['name'];
    $img_size = $_FILES['pic_ID']['size'];
    $tmp_name = $_FILES['pic_ID']['tmp_name'];
    $error = $_FILES['pic_ID']['error'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $img_name1 = $_FILES['pic_PROFILE']['name'];
    $img_size1 = $_FILES['pic_PROFILE']['size'];
    $tmp_name1 = $_FILES['pic_PROFILE']['tmp_name'];
    $error1 = $_FILES['pic_PROFILE']['error'];

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $img_ex_lc1 = strtolower($img_ex1);

    $allowed_exs = array("jpg", "jpeg", "png"); 

    if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'assets/driver_pic/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_upload_path);

        if (in_array($img_ex_lc1, $allowed_exs)) {
            $new_img_name1 = uniqid("IMG-", true).'.'.$img_ex_lc1;
            $img_upload_path1 = 'assets/driver_pic/'.$new_img_name1;
            move_uploaded_file($tmp_name1, $img_upload_path1);

    $sql = "UPDATE drivers SET driver_name='$name', driver_age='$age', driver_contact='$contact', 
    driver_address='$address', driver_license='$new_img_name', driver_image='$new_img_name1' WHERE driver_id=$id";

        $result=$con->query($sql);

    if($result){
            echo "updated successfully";
            header('location:_manage-drivers.php');
    }else{
        echo "Connection failed: " ;    
        die("Invalid Query: " . $con->error);
    }
}
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 text-dark fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas me-2"></i>RentaCar</div>
            <div class="list-group list-group-flush my-3">
                <a href=".headerCompany.php" class="list-group-item list-group-item-action bg-transparent text-dark active"><i
                        class="fas me-2"></i>Dashboard</a>
                <a href="_manage-cars.php" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i
                        class="fas me-2"></i>Car Management</a>
                <a href="_manage-reservations.php" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i
                        class="fas me-2"></i>Car Reservations</a>
       
                <a href="_manage-users.php" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i
                        class="fas me-2"></i>Drivers</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white">Driver Management</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['shopname'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="_company-login.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4 py-5">
            <h3 class="fs-4 mb-0 text-white">Update Driver Information</h3>

            <section class="container my-5 bg-dark w-60 text-light p-2" id="ReserveContainer">
                <form method="post" class="row g-3 p-3" enctype="multipart/form-data">

                <div class="col-md-6" id="label2">
                        <label  class="form-label">Name</label>
                            <input type="text" class="form-control" name="driver_name" value="<?php echo $name; ?>">
                    </div>

                    <div class="col-md-6" id="label1">
                        <label class="form-label">Age</label>
                            <input type="text" class="form-control" name="driver_age" value="<?php echo $age; ?>">
                    </div>

                    <div class="col-md-6" id="label2">
                        <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control" name="driver_contact" value="<?php echo $contact; ?>">
                    </div>

                    <div class="col-md-6" id="label2">
                        <label  class="form-label">Address</label>
                            <input type="text" class="form-control" name="driver_address" value="<?php echo $address; ?>">
                    </div>

                    <div class="row">
                    <div class="form-group mb-5 border-bottom-0 col-6 mt-5">
                        <label for="pic_ID" style="font-size:20px; font-weight:bold;">Please upload Driver's License</label><br>
                        <input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_ID">
                    </div>
                    
                    
                    <div class="form-group mb-5 border-bottom-0 col-6 mt-5">
                        <label for="pic_ID" style="font-size:20px; font-weight:bold;">Please upload Profile Picture</label><br>
                        <input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_PROFILE">
                    </div>
                    </div>
                    
      
                    <div class="col-12">
                        <button type="submit" name="update" class="btn btn-primary font-size-20 px-4">Confirm</button>
                        <a class="btn btn-danger font-size-20 px-4" href="_manage-drivers.php">Cancel</a>
                    </div>
                    
        
      </form>
   </section>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>