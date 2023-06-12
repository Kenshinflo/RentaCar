<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

$id=$_GET['updateCar'];

$sql="SELECT * FROM product WHERE item_id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$id=$row['item_id'];
$name=$row['item_name'];
$brand=$row['item_brand'];
$capacity=$row['item_capacity'];
$transmission=$row['item_transmission'];
$color=$row['item_color'];
$license=$row['item_license_plate'];
$price=$row['item_price'];

if(isset($_POST['update'])){
    $name=$_POST['item_name'];
    $brand=$_POST['item_brand'];
    $capacity=$_POST['item_capacity'];
    $transmission=$_POST['item_transmission'];
    $color=$_POST['item_color'];
    $license=$_POST['item_license_plate'];
    $price=$_POST['item_price'];


    $sql = "UPDATE product SET item_name='$name', item_brand='$brand', item_capacity='$capacity', item_transmission='$transmission', 
    item_color='$color', item_license_plate='$license', item_price='$price' WHERE item_id=$id";
        $result=$con->query($sql);
        
        if($result){
             echo "updated successfully";
             header('location:_manage-cars.php');
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
   
                <a href="_manage-drivers.php" class="list-group-item list-group-item-action bg-transparent text-dark fw-bold"><i
                        class="fas me-2"></i>Drivers</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left text-white fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 text-white">Car Information</h2>
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

            <div class="container-fluid px-4">
            <h3 class="fs-4 mb-3 my-3 text-white">Update Car Information</h3>

            <section class="container my-5 bg-dark w-60 text-light p-2" id="ReserveContainer">
                <form method="post" class="row g-3 p-3">

                <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Model</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo $name; ?>">
                    </div>

                    <div class="col-md-6" id="label1">
                        <label for="validationDefault01" class="form-label">Brand</label>
                            <input type="text" class="form-control" name="item_brand" value="<?php echo $brand; ?>">
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Seat Capacity</label>
                            <input type="text" class="form-control" name="item_capacity" value="<?php echo $capacity; ?>">
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Transmission Type</label>
                            <input type="text" class="form-control" name="item_transmission" value="<?php echo $transmission; ?>">
                    </div>


                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Color</label>
                            <input type="text" class="form-control" name="item_color" value="<?php echo $color; ?>">
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">License Plate</label>
                            <input type="text" class="form-control" name="item_license_plate" value="<?php echo $license; ?>">
                    </div>
                    
                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Price</label>
                            <input type="text" class="form-control" name="item_price" value="<?php echo $price; ?>">
                    </div>

                    
      
                    <div class="col-12">
                        <button type="submit" name="update" class="btn btn-primary font-size-20 px-4">Update</button>
                        <a class="btn btn-danger font-size-20 px-4" href="_manage-cars.php">Cancel</a>
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