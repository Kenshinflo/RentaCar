<?php
session_start();
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
                    <h2 class="fs-2 m-0 text-white">Car Management</h2>
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
                <button onclick="window.location='_car-register.php';" id="seller-login account" type="submit" class="btnadd btn-primary" name="submit">Add Vehicle</button>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3 text-white">Manage Cars</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Vehicle Name</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Transimission Type</th>
                                    <th scope="col">Seating Capacity</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">License Plate</th>
                                    <th scope="col">Car Picture</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $servername = "localhost";
                            $user = "root";
                            $password = "";
                            $database = "rentacar";

                            $connection = new mysqli($servername, $user, $password, $database);

                            if ($connection->connect_error){
                                die("Connection Failed: " . $connection->connect_error);
                            }
                            $com_id = $_SESSION['com_id'];
                            // echo $com_id;
                            $sql = "SELECT * FROM product WHERE seller_id={$com_id}";
                            $result =$connection->query($sql);

                            if (!$result){
                                die("Invalid Query: " . $connection->error);
                            }

                            while($row = $result->fetch_assoc()) {
                                $id=$row["item_id"];
                                $name=$row["item_name"];
                                $brand=$row["item_brand"];
                                $transmission=$row["item_transmission"];
                                $capacity=$row["item_capacity"];
                                $color=$row["item_color"];
                                $license=$row["item_license_plate"];
                                $price=$row["item_price"];
                                $car_pic=$row["item_image"];
                            ?>
                                <tr>
                                    <td> <?php echo $id ?> </td>
                                    <td> <?php echo $name ?> </td>
                                    <td> <?php echo $brand ?> </td>
                                    <td> <?php echo $transmission ?> </td>
                                    <td> <?php echo $capacity ?> </td>
                                    <td> <?php echo $color ?> </td>
                                    <td> <?php echo $license ?> </td>
                                    <td> <img height="250" width="250" src=".<?php echo $car_pic ?>"> </td>
                                    <td> <?php echo $price ?> </td>
                                    <td>
                                        <form action="_update-car.php" class="d-inline">
                                            <button type="submit" name="updateCar" value="<?=$row['item_id'];?>" class="btn btn-primary btn-sm">Update</button>
                                         </form>

                                         <form action="insert.php" method="POST" class="d-inline">
                                            <button type="submit" name="removeCar" value="<?=$row['item_id'];?>" class="btn btn-danger btn-sm" onclick= 'return checkDelete()'>Delete</button>
                                         </form>
                                    </td>
                                </tr>
                            <?php
                            ;}
                               
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
 

    <script>
        function checkDelete(){
            return confirm('Are you sure you want to delete this record?');
        }
        
    </script>
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