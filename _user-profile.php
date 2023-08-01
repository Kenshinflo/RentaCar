<?php

  ob_start();

  include ('connection.php');

$id=$_SESSION["user_id"];
  $findresult = mysqli_query($con, "SELECT * FROM user WHERE user_id= '$id'");
	if($res = mysqli_fetch_array($findresult))
{
$id = $res['user_id'];
$fullname = $res['fullname'];
$username =$res['user_name'];
$oldusername =$res['user_name'];
$email = $res['email'];   
$phonenumber = $res['contact_num'];  
$image= $res['pic_ID'];
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="style1.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
   -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style1.css">

</head>
<body>
<form action="" method="post" enctype='multipart/form-data'>
	<?php
	if(isset($_SESSION['status']))
	{
		?>
		<div class="alert alert-warning alert-dismissible fade show center-block" role="alert">
  			<strong class>Success! </strong> <?php echo $_SESSION['status']; ?>
  				<button type="button" id="closebtn" class="close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
  			</button>
		</div>
		<?php
		
		unset($_SESSION['status']);
	}
	?>
	<div class="mt-6 mb-6">
		
	<?php
	if(isset($_POST['update_prof'])){
		$fullname=$_POST['fullname'];
		$username=$_POST['user_name'];  
		$email=$_POST['email'];
		$phonenumber=$_POST['contact_num'];


		$folder='images/';
		$file = $_FILES['image']['tmp_name'];  
		$file_name = $_FILES['image']['name']; 

		$file_name_array = explode(".", $file_name); 
		$extension = end($file_name_array);

		$new_image_name ='profile_'.rand() . '.' . $extension;
		if ($_FILES["image"]["size"] >10000000) {
		$error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';
		}

		if($file != ""){
			if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
			&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG"){
				$error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
			}
		}

		$sql="SELECT * from user where user_id='$id'";
			$res=mysqli_query($con,$sql);
		if (mysqli_num_rows($res) > 0) {
			$row = mysqli_fetch_assoc($res);

			if($oldusername!=$username){
				if($username==$row['user_name']){
					$error[] ='User_name alredy Exists. Create Unique user_name';
				} 
			}
		}

		if(!isset($error)){ 
			if($file!= ""){
			  	$stmt = mysqli_query($con,"SELECT pic_ID FROM  user WHERE user_id='$id'");
			  	$row = mysqli_fetch_array($stmt); 
			  	$deleteimage=$row['pic_ID'];
				unlink($folder.$deleteimage);
				move_uploaded_file($file, $folder . $new_image_name); 
				mysqli_query($con,"UPDATE user SET pic_ID='$new_image_name' WHERE user_id='$id'");
			}
			 $result = mysqli_query($con,"UPDATE user SET fullname='$fullname', user_name='$username', email='$email', contact_num='$phonenumber' WHERE user_id='$id'");
			 if($result){
				$_SESSION['status'] = "Your profile has been updated";
		 		header("location:profile.php");
			 } else {
			  	$error[]='Something went wrong';
			 }
  
	  }
	}
	if(isset($error)){ 

		foreach($error as $error){ 
		  echo '<p class="errmsg">'.$error.'</p>'; 
		}
	}
	?>
		<div class="row">
			<div class="col-3 color_left">
				
				<div class="d-flex flex-column align-items-center text-center p-3 py-1">
						<?php if($image==NULL){
							echo '<img src="assets/user_profile/profile.png" style="height:150px; width: 150px;" class="rounded-circle mt-5">';
						} else { 
							echo '<img src="images/'.$image.'" style="height:150px; width: 150px;" class="rounded-circle mt-5">';
						}
						?>
					<div class="row mt-1"></div>
				<div class="row mt-2"></div>	
					<span class="font-weight-bold"><?php echo $fullname;?></span><span class=><?php echo $email;?></span><span> </span></div>
					<nav class="side-nav navbar">
						<ul style="list-style: none;">
						  <li><a href="index.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-house"></i> <span>Home</span></a></li>
						  <li><a href="profile.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-user"></i> <span>Profile</span></a></li>
						  <li><a href="userreservation.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-calendar-check"></i> <span>My Reservation</span></a></li>
						  <li><a href="in_use.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-key"></i> <span style="padding-left:5px">My Rented Cars</span></a></li>
						  <li><a href="password.php" class="nav-link scrollto ml-4"><i class="fa-solid fa-user"></i> <span>Change Password</span></a></li>
						</ul>
					</nav>
				</div>
			
				<div class="row col-6 color_right">
					<div class="p-5 py-5">
						<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
							<h4 class="text-right">User Profile</h4>
						</div>
						<div class="row mt-2 border-top">
							<input type="hidden" name="user_id" value="<?php echo $fetch_user['user_id'];?>">

							<div class="mt-3 col-md-6"><label class="labels">full Name</label>
								<input type="text" name="fullname" placeholder="Enter your full name" autocomplete="off" class="form-control" value="<?php echo $fullname;?>">
							</div>

							<div class="mt-3 col-md-6"><label class="labels">Username</label>
								<input type="text" name="user_name" placeholder="Enter your username" autocomplete="off" class="form-control" value="<?php echo $username;?>">
							</div>

							<div class="mt-2 col-md-6"><label class="labels">Email Address</label>
								<input type="text" name="email" placeholder="Enter your email address" autocomplete="off" class="form-control" value="<?php echo $email;?>">
							</div>

							<div class="mt-2 mb-4 col-md-6"><label class="labels">Mobile Number</label>
								<input type="text" name="contact_num" placeholder="Enter your mobile number" autocomplete="off" class="form-control" value="<?php echo $phonenumber;?>">
							</div>

						
						<div class="container border-top" id="buttonUp">
						<br>
						<label for="update">
							<div class="btn col-md-2 text-center profile-button">
								<input id="update" type="submit" value="Update" name="update_prof">
							</div>
						</label>
						</div>
						
						
						
					</div>
					
				</div>
			</form>
			
		</div>
				<div class="row col-3">
					<div class="p-5 py-5">
						<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
							<h4 class="text-right"></h4>
						</div>

						<div class="d-flex flex-column align-items-center text-center p-1 py-6">
							<?php if($image==NULL){
								echo '<img src="user_profile/profile.png">';
							} else { 
								echo '<img src="images/'.$image.'" style="height:80px; width: 80px; " class="rounded-circle mt-5>';
							}
							?>
							
						<div class="form-group">
							<br>
							<label>Change Image &#8595;</label>
							<input class="form-control" type="file" name="image" style="width:100%;" >
							<br>
							<label>File size: maximum 10 MB</label>
							<label>File extension: .JPEG, .PNG, .JPG</label>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
</div>
</div>
</body>
</html>

