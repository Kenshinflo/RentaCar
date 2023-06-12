<?php
  ob_start();
  //include header.php file
  include ('connection.php');

  if(isset($_POST['change_pass'])){

    $update_id = $_POST['user_id'];
	$password=$_POST['new_pass'];

	$password = md5($password);

    mysqli_query($con, "UPDATE user SET pass_word = '$password' WHERE id= '$update_id'") or die('query failed');
    $message[] = 'quantity updated!';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<link rel="stylesheet" type="text/css" href="user_profile/css/style1.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style1.css">

</head>
<body>
<form action="" method="post">
	<div class="container mt-6 mb-6">
		<div class="row">
			<div class="col-md-4 color_left ">
				<?php
				if(isset($_SESSION['username'])){
					$stmt = $con->prepare("SELECT * FROM user WHERE username='".$_SESSION['user_name']."' ");
				}else{
					$stmt = $con->prepare('SELECT * FROM user WHERE 1 = 0');
				}
					$stmt->execute();
    				$result = $stmt->get_result();
    				while ($row = $result->fetch_assoc()):
				?>
				<div class="d-flex flex-column align-items-center text-center p-3 py-1"><img class="rounded-circle mt-5" width="150px" src="user_profile/profile.png">
					
				<div class="row mt-2"></div>	
					<span class="font-weight-bold"><?= $row['full_name'] ?></span><span class=><?= $row['email'] ?></span><span> </span></div>
					<nav id="navbar" class="nav-menu navbar">
						<ul style="list-style: none;">
						  <li><a href="index.php" class="nav-link scrollto"><i class="fa-solid fa-house"></i> <span>Home</span></a></li>
						  <div class="dropdown" li><a href="user1MyAccount.php" class="nav-link scrollto active"><i class="fa-solid fa-user "></i> My Account <span style="padding-left:5px" class=" fa fa-caret-down"></span>					
							<div class="dropdown-content">
							  <a href="user1MyAccount.php">User Profile</a>
							  <a href="user2ChangePassword.php">Change Password</a>
							</div>
						  </div> 
						  <li><a href="cart.php" class="nav-link scrollto"><i class="fa-solid fa-cart-shopping"></i> <span>My Purchase</span></a></li>
						  <li><a href="#notif" class="nav-link scrollto"><i class="fa-solid fa-bell"></i> <span>Notification</span></a></li>
						  <li><a href="#voucher" class="nav-link scrollto"><i class="fa-sharp fa-solid fa-ticket-simple"></i> <span>My Vouchers</span></a></li>
						  <li><a href="#shoppe-coins" class="nav-link scrollto"><i class="fa-sharp fa-solid fa-circle-dollar-to-slot"></i> <span>My Shopee Coins</span></a></li>
						</ul>
					</nav>
				</div>
			<div class="col-md-8 color_right border-right">
				<div class="p-5 py-5">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h4 class="text-right">Change Password</h4>
					</div>
					<div class="row mt-2">
						<input type="hidden" name="user_id" value="<?php echo $fetch_cart['id'];?>">

						<div class="col-md-8"><label class="labels">New Password</label>
							<input type="password" class="form-control" name = "new_pass" placeholder="Enter New Password">
						</div>
						
						<div class="mt-3 col-md-8"><label class="labels">Confirm New Password</label>
							<input type="password" class="form-control" placeholder="Confirm New Password">
						</div>
					</div>

					<div class="mt-5 text-center password-button color_left font-size=10px">
						<input type="submit" value="Change Password" name="change_pass">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<?php endwhile; ?>
		</div>
	</div>
	</div>
   
</body>
</html>
