<?php
session_start();

include ('connection.php');



$name = "";
$brand = "";
$capacity = "";
$color = "";
$transmission = "";
$license = "";
$price = "";
$file = "";
$errorMessage = "";
$successMessage = "";
$seller = $_SESSION['com_id'];


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
	$name = $_POST["1name"];
    $brand = $_POST["1brand"];
    $capacity = $_POST["1capacity"];
    $transmission = $_POST["1transmission"];
	$color = $_POST["1color"];
	$license = $_POST["1license"];
	$price = $_POST["1price"];
    

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

				$result = mysqli_query($con,"INSERT INTO product (seller_id, item_name, item_brand, item_capacity, item_color, item_transmission, item_license_plate, item_price, item_image) " .
                "VALUES ('$seller', '$name', '$brand', '$capacity', '$color', '$transmission', '$license', '$price', '$new_image_name')");
			}

			
       

        if($result){
			//$_SESSION['status'] = "Your profile has been updated";
			$successMessage = "Vehicle added successfully";
			 header("location:_manage-cars2.php");
		 }else {
			$error[]='Something went wrong';
	   }

		$name = "";
		$brand = "";
		$capacity = "";
		$color = "";
		$transmission = "";
		$license = "";
		$price = "";
		$file = "";
  

    } 
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>Cars</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="css/custom.css">
		
		
		<!--google fonts -->
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


	   <!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  


<div class="wrapper">
     
	  <div class="body-overlay"></div>
	 
	 <!-------sidebar--design------------>
	 
	 <div id="sidebar">
	    <div class="sidebar-header">
		   <h3><img src="img/temp.webp" class="img-fluid"/><span>RentaCar</span></h3>
		</div>
		<ul class="list-unstyled component m-0">
		  <li class="dash">
		  <a href=".dashboardCompany.php" class="dashboard"><i class="material-icons">dashboard</i>dashboard </a>
		  </li>
		  
		  <li class="active">
		  <a  href="_manage-cars2.php">
		  <i class="material-icons">directions_car</i>Car Management
		  </a>
		  </li>

		  <li class="reserve">
		  <a  href="_manage-reservations2.php">
		  <i class="material-icons">book_online</i>Car Reservation
		  </a>
		  </li>

		  <li class="drivers">
		  <a  href="_manage-drivers2.php">
		  <i class="material-icons">person</i>Drivers
		  </a>
		  </li>
		</ul>
	 </div>
	 
   <!-------sidebar--design- close----------->
   
   
   
      <!-------page-content start----------->
   
      <div id="content">
	     
		  <!------top-navbar-start-----------> 
		     
		  <div class="top-navbar">
		     <div class="xd-topbar">
			     <div class="row">
				     <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
					    <div class="xp-menubar">
						    <span class="material-icons text-white">signal_cellular_alt</span>
						</div>
					 </div>
					 
					 <div class="col-md-5 col-lg-3 order-3 order-md-2">
					     <div class="xp-searchbar">
						     <form>
							    <div class="input-group">
								  <input type="search" class="form-control"
								  placeholder="Search">
								  <div class="input-group-append">
								     <button class="btn" type="submit" id="button-addon2">Go
									 </button>
								  </div>
								</div>
							 </form>
						 </div>
					 </div>
					 
					 
					 <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
					     <div class="xp-profilebar text-right">
						    <nav class="navbar p-0">
							   <ul class="nav navbar-nav flex-row ml-auto">
							   <li class="dropdown nav-item active">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <span class="material-icons">notifications</span>
								  <span class="notification">4</span>
								 </a>
								  <ul class="dropdown-menu">
								     <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
									 <li><a href="#">You Have 4 New Messages</a></li>
								  </ul>
							   </li>
							   
							   <li class="nav-item">
							     <a class="nav-link" href="#">
								   <span class="material-icons">question_answer</span>
								 </a>
							   </li>

							   <i class="fas"></i><?php echo $_SESSION['shopname'] ?>
							   <li class="dropdown nav-item">
							     <a class="nav-link" href="#" data-toggle="dropdown">
								  <img src="img/white.png" style="width:60px; border-radius:50%;"/>
								  <span class="xp-user-live"></span>
								 </a>
								  <ul class="dropdown-menu small-menu">
								     <li><a href="#">
									 <span class="material-icons">person_outline</span>
									 Profile
									 </a></li>
									 <li><a href="#">
									 <span class="material-icons">settings</span>
									 Settings
									 </a></li>
									 <li><a href="#">
									 <span class="material-icons">logout</span>
									 Logout
									 </a></li>
									 
								  </ul>
							   </li>
							   
							   
							   </ul>
							</nav>
						 </div>
					 </div>
					 
				 </div>
				 
				 <div class="xp-breadcrumbbar text-center">
				    <h4 class="page-title">Cars</h4>
					<!--<ol class="breadcrumb">
					  <li class="breadcrumb-item"><a href="#">Vishweb</a></li>
					  <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
					</ol>-->
				 </div>
				 
				 
			 </div>
		  </div>
		  <!------top-navbar-end-----------> 

		  

		   <!------main-content-start-----------> 
		   
<div class="main-content">
	<div class="row">
		<div class="col-md-12">
			<section class="container my-5 bg-dark w-60 text-light p-2" id="ReserveContainer">
                <form method="post" class="row g-3 p-3" enctype="multipart/form-data">

				<div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Model</label>
                            <input type="text" class="form-control" autocomplete="off" name="1name" value="<?php echo $name; ?>" required>
                    </div>

                    <div class="col-md-6" id="label1">
                        <label for="validationDefault01" class="form-label">Brand</label>
                            <input type="text" class="form-control" autocomplete="off" name="1brand" value="<?php echo $brand; ?>" required>
                    </div>

                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Seat Capacity</label>
                            <input type="text" class="form-control" autocomplete="off" name="1capacity" value="<?php echo $capacity; ?>" required>
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">Transmission Type</label>
                            <input type="text" class="form-control" autocomplete="off" name="1transmission" value="<?php echo $transmission; ?>" required>
                    </div>


                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Color</label>
                            <input type="text" class="form-control" autocomplete="off" name="1color" value="<?php echo $color; ?>" required>
                    </div>

                    <div class="col-md-6" id="label2">
                        <label for="validationDefault02" class="form-label">License Plate</label>
                            <input type="text" class="form-control" autocomplete="off" name="1license" <?php echo $license; ?>" required>
                    </div>
                 
                    <div class="col-md-6 mb-4" id="label2">
                        <label for="validationDefault02" class="form-label">Price</label>
                            <input type="text" class="form-control" autocomplete="off" name="1price" value="<?php echo $price; ?>" required>
                    </div>
					
					<div class="col-md-6 mb-5" id="label2">
                        
                    </div>
                    
                    <div class="form-group mb-5 border-bottom-0 col-6 ">
                        <label for="pic_CAR" style="font-size:20px; font-weight:bold;">Upload Car Image</label><br>
						<input class="form-control" type="file" name="pic_CAR" id="pic_CAR" style="width:100%;" value="<?php echo $file; ?>">
                        <!--<input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_ID">-->
						<br>
							<label>File size: maximum 10 MB</label>
							<label>File extension: .JPEG, .PNG, .JPG</label>
                    </div>

                    <!-- <div class="form-group1 border-bottom-0 col-md-6">
                        <label for="pic_CAR" style="font-size:20px; font-weight:bold;">Upload Car Image</label><br>
                        <input type="file" class="form-control-file " id="pic_CAR" name="pic_CAR">
                    </div>
					
                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Model</label>
                            <input type="text" class="form-control" name="item_name">
                    </div>

                    <div class="col-md-6 mb-3" id="label1">
                        <label for="validationDefault01" class="form-label">Brand</label>
                            <input type="text" class="form-control" name="item_brand">
                    </div>

                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Seat Capacity</label>
                            <input type="text" class="form-control" name="item_capacity">
                    </div>

                    <div class="col-md-6 mb-3" id="label2">
                        <label for="transmission" class="form-label">Transmission Type</label>
                            <div class="row ml-0">
                            <select id="transmission">
                                <option value="Transmission Type">Select Type</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                            </select>
                            </div>

                    </div>


                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Color</label>
                            <input type="text" class="form-control" name="item_color">
                    </div>

                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">License Plate</label>
                            <input type="text" class="form-control" name="item_license_plate">
                    </div>
                    
                    <div class="col-md-6 mb-5" id="label2">
                        <label for="validationDefault02" class="form-label">Price</label>
                            <input type="text" class="form-control" name="item_price">
                    </div> -->

                    
      
                    <div class="col-12">
                        <!-- <input type="submit" value="Update" name="update_car"> -->
						<button type="submit" class="btn btn-primary font-size-20 px-4">Confirm</button>
                        <a class="btn btn-danger font-size-20 px-4" href="_manage-cars2.php">Cancel</a>
                    </div>				

						
                </form>
            </section>
		</div>			 
	</div>
</div>
		  
		    <!------main-content-end-----------> 
		  
		 
		 
		 <!----footer-design------------->
		 
		 <!--<footer class="footer">
		    <div class="container-fluid">
			   <div class="footer-in">
			      <p class="mb-0">© RentaCar 2023 . All Rights Reserved.</p>
			   </div>
			</div>
		 </footer>-->
		 
		 
		 
		 
	  </div>
   
</div>



<!-------complete html----------->





  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>
  
  
  <script type="text/javascript">
       $(document).ready(function(){
	      $(".xp-menubar").on('click',function(){
		    $("#sidebar").toggleClass('active');
			$("#content").toggleClass('active');
		  });
		  
		  $('.xp-menubar,.body-overlay').on('click',function(){
		     $("#sidebar,.body-overlay").toggleClass('show-nav');
		  });
		  
	   });
  </script>
  
  



  </body>
  
  </html>


