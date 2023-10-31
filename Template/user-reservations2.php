<?php
    $item_id = $_GET['item_id'] ??1;
    $_SESSION["item_id"] = $item_id;
    $userid = $_SESSION["user_id"];
    $dated = date("Y-m-d");
    $con = mysqli_connect("localhost","root","","rentacar");

        
    $findresult = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$userid'");
    if($res = mysqli_fetch_array($findresult)) {
        
    $id = $res['user_id'];
    $fullname = $res['fullname'];
    $username =$res['user_name'];
    $oldusername =$res['user_name'];
    $email = $res['email'];   
    $phonenumber = $res['contact_num'];  
    $image= $res['pic_ID'];
    }

    
        if(!isset($_SESSION["dateFrom"],$_SESSION["dateTo"])){
            
            if(isset($_POST['submit'])){
                
                    $dF = date('Y m d', strtotime($_POST['dateFrom']));
                    $dF = strtolower($dF);
                    $dF = str_replace(" ", "-", $dF);
                
                    $dT = date('Y m d', strtotime($_POST['dateTo']));
                    $dT = strtolower($dT);
                    $dT = str_replace(" ", "-", $dT);
                
                    $_SESSION["dateFrom"]=$dF;
                    $_SESSION["dateTo"]=$dT;
            
                    $dateFrom = strtotime($dF);
                    $dateTo= strtotime($dT);
                    $datedDiff =  $dateTo - $dateFrom ;
                    
                    $days = floor($datedDiff/(60*60*24));
        
                    $_SESSION["days_rent"] = $days;
            }
            
            
        } else {
            $dF = $_SESSION["dateFrom"];
            $dT = $_SESSION["dateTo"];

           
            $dateFrom = strtotime($dF);
            $dateTo= strtotime($dT);
            $datedDiff =  $dateTo - $dateFrom ;
            
            $days = floor($datedDiff/(60*60*24));

            $_SESSION["days_rent"] = $days;
            
        }
        
        //CANCEL RESERVATION
        if(isset($_POST['removeRes'])){
            $product = $_POST['removeRes'];
        
            $query = "DELETE FROM reservation WHERE item_id='$product' ";
            $query = mysqli_query($con, $query);

            $queryupdate = "UPDATE product SET status = 0 WHERE item_id = $product";
            $query_run1 = mysqli_query($con, $queryupdate);

        
            if($query_run){
                header("location: userreservation.php");
            }
            else {
                header("location: userreservation.php");
            }
        }

        //PROCEED RESERVATION
        if(isset($_POST['pay'])){
            
            try{
                
                $products = $_POST['pay'];
                $driver_id = $_POST['driver_id'];
                $driver_stat = $_POST['driver_stat'];
                $res_stat = $_POST['res_stat'];
                // $pending = "Pending";
                
            //     $result = $con->query("SELECT * from reservation WHERE item_id = $products AND status ='Pending' AND user_id = $userid");
            //     // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            //    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            //         $item_id = $row["item_id"];
            //         $driver = $row["driver_id"];
            //         $driver_stat = $row["driver_stat"];
            //         $res_stat = $row["status"];
            //     }
               
                $query = "UPDATE reservation SET status='In Use' WHERE item_id='$products' ";
                $query1 = "UPDATE product SET status = 1 WHERE item_id='$products'";
                

                
                if ($res_stat=="Pending"){
                    header('Location: ../userreservation.php?&&error=Your reservation has not been approved yet');                    
                
                } else if ($driver_id == 0 && $driver_stat == "Yes"){
                    header('Location: ../userreservation.php?&&error=Driver not assigned yet. Please do stand by.');
                    
                } else {
                    $query = mysqli_query($con, $query);
                    $query1 = mysqli_query($con, $query1);
                    header("location: in_use.php");
                    exit();                    
                }
            
                // if($query){
                //     header("location: in_use.php");
                // }
                // else {
                //     header("location: in_use.php");
                // }
                
            } catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
    
    // $datet = strtolower($datet);
    // $datet = str_replace(" ", "-", $datet);
    
?>

<head>
    <meta charset="utf-8">


    <title>Profile settings - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="Template/user-profile2.css">
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <div class="container profile-p" >

        <!-- <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
            </ol>
        </nav> -->

        <div class="row gutters-sm">
            <div class="col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <div class="profile">
                                <div class="text-center">
                                <?php if($image==NULL){
                                        echo '<img src="assets/user_profile/profile.png" style="width: 200px; height:auto;" class="rounded-circle mt-5">';
                                    } else { 
                                        echo '<img src="images/user/'.$image.'" style=" width: 200px; height:auto;" class="avatar img-circle img-thumbnail mb-2">';
                                    }
                                ?>
                                    <div class="div d-flex justify-content-center">
                                        <div class="row">
                                            <h5><?php echo $fullname?></h5>
                                            <h6 style="color:#0096FF"><?php echo $email?></h6>
                                        </div>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #000">
                            </div>
                            <a href="../profile.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-user mr-2" style="font-size: 25px;"></i>Profile Information
                            </a>
                            <a href="#" class="nav-item nav-link has-icon nav-link-faded active">
                                <i class="fa-solid fa-calendar-check mr-2" style="font-size: 25px;"></i>My Reservations
                            </a>
                            <a href="../in_use.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-key mr-2" style="font-size: 25px;"></i>My Rented Cars
                            </a>
                            <a href="../completed_trans.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-file-invoice-dollar mr-2" style="font-size: 25px;"></i>Completed
                                Transactions
                            </a>
                            <a href="../password.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-lock mr-2" style="font-size: 25px;"></i>Security
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom mb-3 d-flex d-md-none">
                        <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                        <li class="nav-item">
                            <a href="../profile.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-user" style="font-size: 25px;"></i>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="../userreservation.php" class="nav-item nav-link has-icon nav-link-faded active">
                                <i class="fa-solid fa-calendar-check" style="font-size: 25px;"></i>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="../in_use.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-key" style="font-size: 25px;"></i>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="../completed_trans.php" class="nav-item nav-link has-icon nav-link-faded">
                            <i class="fa-solid fa-file-invoice-dollar" style="font-size: 25px;"></i>
                            </a>
                            </li>
                            <li class="nav-item">
                            <a href="../password.php" class="nav-item nav-link has-icon nav-link-faded">
                                <i class="fa-solid fa-lock mr-2" style="font-size: 25px;"></i>
                            </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body tab-content">
                        <div class="tab-pane active" id="reserve">
                            <h6 style="font-size:25px;" class="font-gab">My Reservation</h6>

                            <?php
                                $countedReserve = $product->getReserveCount();
                                foreach ($countedReserve as $value):
                                    
                                    foreach ($product->getOnProduct($value['item_id']) as $item):
                                        // $in_display = $product->getOnProduct($value['item_id']);
                                        foreach ($product->getSeller($item['seller_id']) as $shop ):
                             ?>

                            <div class="container py-3 border rounded-4 shadow-lg mb-5">
                                <div class="row">

                                    <!-- <h5 class="font-baloo font-size-25"><?php echo $dF?? "Unknown"; ?></h5> -->
                                    <!-- <h5 class="font-baloo font-size-25"><?php echo $_SESSION["days_rent"] ?? "Unknown"; ?></h5> -->
                                    <!-- <h5 class="font-baloo font-size-25"><?php echo $_SESSION["item_b"] ?? "Unknown"; ?></h5> -->


                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary float-right" id="shop_btn"
                                            name="shop_btn" data-bs-toggle="#shopModal" data-bs-target="#shopModal">
                                            <?php echo $shop['shopname']  ?? "Brand"; ?>
                                        </button>
                                        <br>
                                        <br>

                                        <div class="car d-flex justify-content-center">
                                            <img style="width:200px; height:auto;"
                                                src="../images/cars/<?php echo $item['item_image']; ?>" alt="product"
                                                class="img-fluid">
                                        </div>
                                        <br>

                                        <div class="car-name d-flex justify-content-center">
                                            <h5 class="font-baloo-bold font-size-25">
                                                <?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                                        </div>
                                        
                                        <hr class="m-0 my-2">
                                        <!-- <a class="font-baloo font-size-20 " href="vehicles.php"> <?php echo $shop['shopname']  ?? "Shop"; ?></a> -->
                                        <!-- <button type="button" class="btn btn-primary" id="shop_btn" name="shop_btn" >
                                    <?php echo $shop['shopname']  ?? "Brand"; ?>
                                    </button> -->

                                        <!-- <a href="Template/_car-rating.php?user_id=<?php echo $userid;?> &item_id=<?php echo $value['item_id'];?> &seller_id=<?php echo $item['seller_id'];?>">
                                        <button type="button" class="btn btn-danger" style="float:right;">Rate This Vehicle</button>
                                    </a> -->



                                        <!-- <div class="car-brand d-flex justify-content-center">
                                            <p class="font-baloo font-size-20">Brand:
                                            <?php echo $item['item_brand'] ?? "Brand"; ?></p>
                                        </div> -->


                                        <!-- Product price-->
                                        <table class="my-3">
                                            <tr class="font-rale font-size-16">
                                                <td>Seating Capacity: </td>
                                                <td class="font-size-20 text-danger">
                                                    <span><?php echo $item['item_capacity'] ?? 0; ?></span><small
                                                        class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                </td>
                                            </tr>
                                            <tr class="font-rale font-size-16">
                                                <td>Transmission Type: </td>
                                                <td class="font-size-20 text-danger">
                                                    <span><?php echo $item['item_transmission'] ?? 0; ?></span><small
                                                        class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                </td>
                                            </tr>
                                            <tr class="font-rale font-size-16">
                                                <td>Deal Price: </td>
                                                <td class="font-size-20 text-danger">
                                                    ₱<span><?php echo $item['item_price'] ?? 0; ?></span><small
                                                        class="text-dark font-size-12">&nbsp;&nbsp;/day</small></td>
                                            </tr>
                                            <!-- <tr class="font-rale font-size-16">
                                <td>Units Available:</td>
                                <td><span class="font-size-16 text-danger"><?php echo $item['item_stock'] ?? 0; ?></span></td>
                                </tr> -->
                                            <tr class="font-rale font-size-16">
                                                <td>License Plate:</td>
                                                <td><span
                                                        class="font-size-16 text-danger"><?php echo $item['item_license_plate'] ?? 0; ?></span>
                                                </td>
                                            </tr>
                                            <tr class="font-rale font-size-16">
                                                <td>Color:</td>
                                                <td><span
                                                        class="font-size-16 text-danger"><?php echo $item['item_color'] ?? 0; ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- !Product price-->

                                        <!-- #Policy-->

                                        <!-- !#Policy-->
                                        <hr>

                                        <!-- Order Details -->
                                        <!--<div id="order-details" class="font-rale d-flex flex-column text-dark">
                    
                                    <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
                                </div>
                                -->


                                        <form action="#" method="POST" class="row g-3 ">

                                            <div class="input-box">
                                                <span>Pickup Date</span>
                                                <!-- <input type="datetime-local" value="<?php echo date('m/d/Y\ H:i:s', strtotime($value['pickupdate'])) ?? $dated ;?>"
                                readonly> -->
                                                <p class="fw-bold  ml-3 p-1 border rounded">
                                                    <?php echo date('m/d/Y\ H:i a', strtotime($value['pickupdate']))?? 0; ?>
                                                </p>

                                            </div>

                                            <div class="input-box">
                                                <span>Return Date</span>
                                                <!-- <input type="datetime-local" name="dateTo" id="dateTo" value="<?php echo $dT ?? $dated;?>"
                                readonly> -->
                                                <p class="fw-bold  ml-3 p-1 border rounded">
                                                    <?php echo date('m/d/Y\ H:i a', strtotime($value['returndate']))?? 0; ?>
                                                </p>

                                            </div>

                                            <div class="form-group mt-2 align-self-start">
                                                <p class="fw-bold  ml-3"> With Driver:
                                                    <?php echo $value['driver_stat'] ?? 0; ?></p>

                                                <p class="text-muted ml-3"> Note: You can only cancel a reservation
                                                    within 24
                                                    hours. Further
                                                    cancellation above timeframe will ensue a cancellation fee per
                                                    vehicle/s. </p>

                                                <p class="fw-bold fs-5 ml-3" style="display: inline;"> Status:</p>
                                                <p class="status fw-bold text-success text-decoration-underline fs-5"
                                                    style="display: inline;" name="status">
                                                    <?php echo $value['status'] ?? 0; ?></p>
                                            </div>
                                            <hr>

                                            <div class="total ml-3 float-right">
                                                <h5 class="fw-bold"> Total: </h5>

                                                <h5 class=" text-danger fw-bold inline"> ₱
                                                    <?php echo $value['overall_price'] ?? 0; ?>.00</h5>


                                                <form action="#" method="POST" class="d-inline">
                                                    <input type="hidden" id="driver_stat" name="driver_stat"
                                                        value="<?=$value['driver_stat'];?>">
                                                    <input type="hidden" id="driver_id" name="driver_id"
                                                        value="<?=$value['driver_id'];?>">
                                                    <input type="hidden" id="res_stat" name="res_stat"
                                                        value="<?=$value['status'];?>">

                                                    <button type="submit" name="pay"
                                                        class="pay btn btn-danger btn-sm mb-2"
                                                        value="<?=$value['item_id'];?>">Pay</button>
                                                    <button type="submit" name="removeRes"
                                                        class="btn btn-danger btn-sm mb-2"
                                                        onclick='return checkReserve()'
                                                        value="<?=$value['item_id'];?>">Cancel</button>
                                                </form>
                                                <!-- <?php 
                                        if ($value['driver_stat'] == "Yes" && $value['driver_id'] != 0) {
                                        echo '<button type="button" class="btn userinfo btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Driver details
                                            </button>';

                                
                            } 
                                        ?> -->
                                            </div>
                                            <!-- <?php echo $value['driver_id'];?> -->

                                            <?php if (isset($_GET['error'])) {             ?>
                                            <p class="error"> <?php echo $_GET['error']; ?> </p>

                                            <?php }?>
                                            <!-- <?php 
                            $signupCheck = $_GET['error'];
                            if ($signupCheck == 'fnameerr') {             ?>
                                    <p class="error"> <?php echo $_GET['error']; ?> </p>

                            <?php }?> -->

                                            <!-- !size -->

                                    </div>
                                </div>
                            </div>
                            <?php
        // }, $product->getProdCount($value['item_id']));
                    
                
        foreach ($product->getDriver($value['driver_id']??0) as $driver):
            $driverid = $value['driver_id'];
        ?>

                            <div class="modal fade" id="shopModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Shop Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container ">


                                                <table class="my-3 d-flex align-items-center justify-content-center">
                                                    <tr class="font-rale font-size-16">
                                                        <td>Shop Name: </td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $shop['shopname'] ?? 0; ?></span><small
                                                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                        </td>
                                                    </tr>
                                                    <tr class="font-rale font-size-16">
                                                        <td>Email: </td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $shop['email'] ?? 0; ?></span><small
                                                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                        </td>
                                                    </tr>
                                                    <tr class="font-rale font-size-16">
                                                        <td>Contact Number: </td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $shop['contact_num'] ?? 0; ?></span><small
                                                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                        </td>
                                                    </tr>
                                                    <tr class="font-rale font-size-16">
                                                        <td>Address:</td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $shop['address'] ?? 0; ?></span>
                                                        </td>
                                                    </tr>

                                                </table>


                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Driver Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container ">
                                                <div class="d-flex align-items-center justify-content-center">

                                                    <?php
                        $sql1 = "SELECT driver_image from drivers where driver_id='$driverid'";
                        $result1 = mysqli_query($con,$sql1);
                        $row1 = mysqli_fetch_array($result1);

                        $image = $row1['driver_image'];
                        $image_src = "/images/drivers/".$image;
                    ?>

                                                    <img height="170" width="250" src='<?php echo $image_src;?>'>

                                                </div>
                                                <hr>
                                                <table class="my-3 d-flex align-items-center justify-content-center">
                                                    <tr class="font-rale font-size-16">
                                                        <td>Name: </td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $driver['driver_name'] ?? 0; ?></span><small
                                                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                        </td>
                                                    </tr>
                                                    <tr class="font-rale font-size-16">
                                                        <td>Age: </td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $driver['driver_age'] ?? 0; ?></span><small
                                                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                        </td>
                                                    </tr>
                                                    <tr class="font-rale font-size-16">
                                                        <td>Address: </td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $driver['driver_address'] ?? 0; ?></span><small
                                                                class="text-dark font-size-12">&nbsp;&nbsp;</small>
                                                        </td>
                                                    </tr>
                                                    <tr class="font-rale font-size-16">
                                                        <td>Contact Number:</td>
                                                        <td class="font-size-20 text-dark">
                                                            <span><?php echo $driver['driver_contact'] ?? 0; ?></span>
                                                        </td>
                                                    </tr>

                                                </table>
                                                <div class="d-flex me-auto">
                                                    <div class="me-auto">
                                                        <button type="submit" name="downloaddr" id="downloaddr"
                                                            class="btn btn-primary">Download</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                endforeach;
                                endforeach;
                                endforeach;
                            endforeach;
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <script type="text/javascript">

    </script>

    <script>
    $(document).ready(function() {
        $("#shop_btn").click(function() {
                $("#shopModal").modal();
        });

        // const myModal = document.getElementById('shop_btn');
        // const myInput = document.getElementById('shopModal');

        // myModal.addEventListener('shown.bs.modal', () => {
        //     myInput.focus()
        // });
        // import { Modal } from 'bootstrap';
        // export default {
        //     name: 'MyModal',
        //     mounted() { <-- Just right
        //         const myModal = new Modal(document.getElementById('shop_btn'), {})
        //         myModal.show()
        //     }
        // };
        // let modal = null;

        // function getModal() {
        //     if (!modal) {
        //         modal = new $bootstrap.Modal('#shopModal');
        //     }
        //     return modal
        // }

        // function toggleModal() {
        //     // modal.toggle();
        //     getModal().show()
        // }
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        // var btn = document.getElementById("myBtn");
        var showModalBtn = document.getElementById("shop_btn");
        var shopModal = document.getElementById("shopModal");

        // Get the <span> element that closes the modal
        var closeModalBtn = document.getElementsByClassName("close")[0];

        // showModalBtn.addEventListener("click", function () {
        document.getElementById("shop_btn").addEventListener("click",  function () {

            shopModal.style.display = "block";
        });

        // document.getElementsByClassName("close").addEventListener("click",  function () {
        //     shopModal.style.display = "none";
        // });
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            shopModal.style.display = "none";
        }
        }

        $('.conf_button').click(function(e) {
            // $('#editEmployeeModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#id1').val(data[0]);
            $('#name1').val(data[1]);
            $('#number1').val(data[2]);
            $('#vehicle1').val(data[3]);
            $('#license1').val(data[4]);
            $('#pickup1').val(data[5]);
            $('#return1').val(data[6]);
            $('#price1').val(data[7]);

        });

        let button = document.querySelector('pay');
        let input = document.querySelector('status');
        if (input === "Pending") {
            button.disabled = true;
        }
    });
    </script>
    <!----------------------------------------------PRODUCTS-------------------------------------------------------->


