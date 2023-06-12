<?php
session_start();
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$connection = new mysqli($servername, $user, $password, $database);

$brand = "";
$name = "";
$price = "";
$transmission = "";
$color = "";
$capacity = "";
$license = "";
$seller = $_SESSION['com_id'];
$errorMessage = "";
$successMessage = "";
$seller = $_SESSION['com_id'];


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
    $brand = $_POST["1brand"];
    $name = $_POST["1name"];
    $price = $_POST["1price"];
    $transmission = $_POST["1transmission"];
    $color = $_POST["1color"];
    $capacity = $_POST["1capacity"];
    $license = $_POST["1license"];

    $img_name = $_FILES['pic_CAR']['name'];
    $img_size = $_FILES['pic_CAR']['size'];
    $tmp_name = $_FILES['pic_CAR']['tmp_name'];
    $error = $_FILES['pic_CAR']['error'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $allowed_exs = array("jpg", "jpeg", "png"); 
}

    do {
        if ( empty($brand) || empty($name) || empty($price)){
            //$errorMessage = "All fields are required";
            break;
        }

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = "./assets/SampleProd/".$img_name;
            $img_upload_path = '../assets/SampleProd/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

        $sql = "INSERT INTO product (seller_id, item_brand, item_name, item_price, item_transmission, item_capacity, item_color, item_license_plate, item_image) " .
                "VALUES ('$seller', '$brand', '$name', '$price', '$transmission', '$capacity', '$color', '$license', '$new_img_name')";
        $result = $connection->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $brand = "";
        $name = "";
        $price = "";
        $transmission = "";
        $color = "";
        $capacity = "";
        $license = "";

        $successMessage = "Vehicle added successfully";

        header("location:_manage-cars.php");
        exit;
    }
    } while (false);
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
                    <h2 class="fs-2 m-0 text-white">Car Registration</h2>
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
            <h3 class="fs-4 mb-3 text-white">Add a Vehicle</h3>

            <section class="container my-5 bg-dark w-60 text-light p-2" id="ReserveContainer">
                <form method="post" class="row g-3 p-3" enctype="multipart/form-data">

                <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Model</label>
                            <input type="text" class="form-control" name="1name" value="<?php echo $name; ?>" required>
                    </div>

                    <div class="col-md-6" id="label1">
                        <label for="validationDefault01" class="form-label">Brand</label>
                            <input type="text" class="form-control" name="1brand" value="<?php echo $brand; ?>" required>
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Seat Capacity</label>
                            <input type="text" class="form-control" name="1capacity" value="<?php echo $capacity; ?>" required>
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Transmission Type</label>
                            <input type="text" class="form-control" name="1transmission" value="<?php echo $transmission; ?>" required>
                    </div>


                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Color</label>
                            <input type="text" class="form-control" name="1color" value="<?php echo $color; ?>" required>
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">License Plate</label>
                            <input type="text" class="form-control" name="1license" value="<?php echo $license; ?>" required>
                    </div>
                 
                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Price</label>
                            <input type="text" class="form-control" name="1price" value="<?php echo $price; ?>" required>
                    </div>

                    <div class="form-group1 border-bottom-0 col-md-6">
                        <label for="pic_CAR" style="font-size:20px; font-weight:bold;">Upload Car Image</label><br>
                        <input type="file" class="form-control-file " id="pic_CAR" name="pic_CAR">
                    </div>
                    
      
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary font-size-20 px-4">Confirm</button>
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