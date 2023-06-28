<?php
session_start();

include ('connection.php');


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
?>



<?php
if(isset($_POST['update_car'])){
    $name=$_POST['item_name'];
    $brand=$_POST['item_brand'];
    $capacity=$_POST['item_capacity'];
    $transmission=$_POST['item_transmission'];
    $color=$_POST['item_color'];
    $license=$_POST['item_license_plate'];
    $price=$_POST['item_price'];

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
			  	$stmt = mysqli_query($con,"SELECT item_image FROM product WHERE item_id='$id'");
			  	$row = mysqli_fetch_array($stmt); 
			  	$deleteimage=$row['item_image'];
				unlink($folder.$deleteimage);
				move_uploaded_file($file, $folder . $new_image_name); 
				mysqli_query($con,"UPDATE product SET item_image='$new_image_name' WHERE item_id='$id'");
			}
		  
			 $result = mysqli_query($con,"UPDATE product SET item_name='$name', item_brand='$brand', item_capacity='$capacity', item_transmission='$transmission', item_color='$color', item_license_plate='$license', item_price='$price' WHERE item_id='$id'");
			 
			 if($result){
				//$_SESSION['status'] = "Your profile has been updated";
		 		header("location:_manage-cars2.php");
			 } else {
			  	$error[]='Something went wrong';
			 }
  
	  }
	}


/*
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
            header('location:_manage-drivers2.php');
    }else{
            die("Invalid Query: " . $con->error);
    }
}
}*/


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
                            <input type="text" class="form-control" name="item_name" value="<?php echo $name; ?>">
                    </div>

                    <div class="col-md-6 mb-3" id="label1">
                        <label for="validationDefault01" class="form-label">Brand</label>
                            <input type="text" class="form-control" name="item_brand" value="<?php echo $brand; ?>">
                    </div>

                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Seat Capacity</label>
                            <input type="text" class="form-control" name="item_capacity" value="<?php echo $capacity; ?>">
                    </div>

                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Transmission Type</label>
                            <input type="text" class="form-control" name="item_transmission" value="<?php echo $transmission; ?>">
                    </div>


                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">Color</label>
                            <input type="text" class="form-control" name="item_color" value="<?php echo $color; ?>">
                    </div>

                    <div class="col-md-6 mb-3" id="label2">
                        <label for="validationDefault02" class="form-label">License Plate</label>
                            <input type="text" class="form-control" name="item_license_plate" value="<?php echo $license; ?>">
                    </div>
                    
                    <div class="col-md-6 mb-5" id="label2">
                        <label for="validationDefault02" class="form-label">Price</label>
                            <input type="text" class="form-control" name="item_price" value="<?php echo $price; ?>">
                    </div>

                    <div class="col-md-6 mb-5" id="label2">
                        
                    </div>
                    
                    <div class="form-group mb-5 border-bottom-0 col-6 ">
                        <label for="pic_CAR" style="font-size:20px; font-weight:bold;">Please upload Car's photo</label><br>
						<input class="form-control" type="file" name="pic_CAR" style="width:100%;" >
                        <!--<input type="file" class="form-control-file mt-3" id="pic_ID" name="pic_ID">-->
						<br>
							<label>File size: maximum 10 MB</label>
							<label>File extension: .JPEG, .PNG, .JPG</label>
                    </div>

      
                    <div class="col-12">
                        <input type="submit" value="Update" name="update_car">
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


