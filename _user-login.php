<?php
    // ob_start();
    session_start();

    require_once('auth.php');

    require_once('vendor/autoload.php');
    $con = new mysqli('localhost', 'root','','rentacar');

    $error = null;
    
    $servername = "localhost";
    $dbname = "rentacar";
    $user_name = "root";
    $pass_word = "";

    // $user11 = $_SESSION['ucode']??0;
    $clientID = "452882927978-javaoiqef3natfq7505crgh8e166967r.apps.googleusercontent.com";
    $secret = "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";
    
    // Google API Client
    $gclient = new Google_Client();
    
    $gclient->setClientId($clientID);
    $gclient->setClientSecret($secret);
    $gclient->setRedirectUri('http://localhost:3000/_user-login.php');
    
    
    $gclient->addScope('email');
    $gclient->addScope('profile');
    
    if(isset($_GET['code'])){
        // Get Token
        $token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);
    
        // Check if fetching token did not return any errors
        if(!isset($token['error'])){
            // Setting Access token
            $gclient->setAccessToken($token['access_token']);
    
            // store access token
            $_SESSION['access_token'] = $token['access_token'];
    
            // Get Account Profile using Google Service
            $gservice = new Google_Service_Oauth2($gclient);
    
            // Get User Data
            $udata = $gservice->userinfo->get();
            foreach($udata as $k => $v){
                $_SESSION['login_'.$k] = $v;
            }
            // $verified = $row['verified'];
            // $user_id= $row['user_id'];
            // $user_name= $row['user_name'];
            // $email = $row['email'];
            // $date = $row['register_date'];
            // $contact = $row['contact_num'];
           
            $s_username = $_SESSION['login_givenName'];
            $s_fullname = $_SESSION['login_name'];
            $s_email = $_SESSION['login_email'];
            $_SESSION['email'] = $_SESSION['login_email'];

            $s_verified = $_SESSION['login_verifiedEmail'];

            $_SESSION['whole'] = $udata;
            $_SESSION['ucode'] = $_GET['code'];
            // $_SESSION['user_id'] = $_GET['code'];

            $checkQuery = "SELECT * FROM user WHERE email = '". $s_email ."'"; 
            $checkResult = mysqli_query($con,$checkQuery); 
             
            // Add modified time to the data array 
             
            if($checkResult->num_rows > 0){ 
                // Prepare column and value format 
                header('Location:index.php');
                exit;


            } else { 
                $insert = mysqli_query($con,"insert into user(user_name,fullname,email,verified)
                values ('$s_username','$s_fullname','$s_email','$s_verified')");
                if ($insert){
                    header('Location:index.php');
                    exit;

                }
            }
        }
    }
    
    
    if(isset($_POST['submit'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
        $password = md5($password);
         //database connection
         //$mysqli = new mysqli('localhost', 'root','','rentacar');
         try{

            
            $conn = new PDO("mysql:host=localhost;dbname=$dbname", $user_name, $pass_word);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //getting form data

            if (empty($username)){

            } else if (empty($password)){
                exit(header('Location:_user-login.php?error=Password'));
            }
            //query
            $resultSet = $conn->prepare("select * from user where user_name = :username and pass_word = :password limit 1");
            $resultSet->bindParam(':username', $username);
            $resultSet->bindParam(':password', $password);
            $resultSet->execute();
            

                $_SESSION["user_name"] = $username;
                

                //  Process Login
                $row = $resultSet->fetch(PDO::FETCH_ASSOC);


                
                $verified = $row['verified'];
                $user_id= $row['user_id'];
                $user_name= $row['user_name'];
                $email = $row['email'];
                $date = $row['register_date'];
                $contact = $row['contact_num'];
                $date = strtotime($date);
                $date = date('M d Y', $date);

                $_SESSION["user_id"]=$user_id;
                $_SESSION["cont_num"]=$contact;
                $_SESSION["user_name"]=$user_name;
                $_SESSION["email"]=$email;

                
                if($row['user_name'] === $username && $row['pass_word'] === $password){


                    exit(header("Location:index.php"));
                    
                } else {

                    exit(header("Location:_user-login.php?error=Incorrect Username or Password"));
                    
                }
                // if($verified == 1){
                    
                //     header('Location:index.php');
                //     echo "<center>Account Has been Verified, Login Successfull</center>";
                // }else{
                //     $error = "<center>Please Verify Your Account First. To verify, please click the verification that was sent to $email on $date</center>";
                //     echo "<script> alert('$error')</script";
                    
                //     header('Location:index.php');
                // }

                function checkUser($data = array()){ 
                    if(!empty($data)){ 
                        // Check whether the user already exists in the database 
                        $checkQuery = "SELECT * FROM ".$dbname." WHERE user_id = '".$data['oauth_uid']."'"; 
                        $checkResult = $this->db->query($checkQuery); 
                         
                        // Add modified time to the data array 
                        if(!array_key_exists('modified',$data)){ 
                            $data['modified'] = date("Y-m-d H:i:s"); 
                        } 
                         
                        if($checkResult->num_rows > 0){ 
                            // Prepare column and value format 
                            $colvalSet = ''; 
                            $i = 0; 
                            foreach($data as $key=>$val){ 
                                $pre = ($i > 0)?', ':''; 
                                $colvalSet .= $pre.$key."='".$this->db->real_escape_string($val)."'"; 
                                $i++; 
                            } 
                            $whereSql = " WHERE  user_id = '".$data['oauth_uid']."'"; 
                             
                            // Update user data in the database 
                            $query = "UPDATE ".$dbname." SET ".$colvalSet.$whereSql; 
                            $update = $this->db->query($query); 
                        }else{ 
                            // Add created time to the data array 
                            if(!array_key_exists('created',$data)){ 
                                $data['created'] = date("Y-m-d H:i:s"); 
                            } 
                             
                            // Prepare column and value format 
                            $columns = $values = ''; 
                            $i = 0; 
                            foreach($data as $key=>$val){ 
                                $pre = ($i > 0)?', ':''; 
                                $columns .= $pre.$key; 
                                $values  .= $pre."'".$this->db->real_escape_string($val)."'"; 
                                $i++; 
                            } 
                             
                            // Insert user data in the database 
                            $query = "INSERT INTO ".$dbname." (".$columns.") VALUES (".$values.")"; 
                            $insert = $this->db->query($query); 
                        } 
                         
                        // Get user data from the database 
                        $result = $this->db->query($checkQuery); 
                        $userData = $result->fetch_assoc(); 
                    } 
                     
                    // Return user data 
                    return !empty($userData)?$userData:false; 
                } 
        } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    
    }


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  
    <link rel="stylesheet" href="login-style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

    
    <title>Login Account</title>
   

</head>

<body>
<!-- <div class="loader">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
</div> -->
    
<section class="container-fluid background-radial-gradient overflow-hidden"> 

    <div class="container">

        <div class="forms-container">
                <div class=" div-holder">
                    <!-- <div class="signin-signup col-8 p-4"> -->
                    <div class="left-side  p-5">

                        
                        <form action="" class="sign-in-form" method="post">

                            
                            <h2 class="title mb-3">Login</h2>
                        
                            <p class="text-grey-20 text-center mb-4 text-muted">Please enter your username and password</p>
                            <div class="social-media">
                            </div>

                           
                            <!-- <div class="vertical-line">
                                <span>
                                    or
                                </span>
                                </div>
                            <div> -->

                            

                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Username" class="form-control" name="username" autocomplete="off"required/>
                            </div>
                            <div class="input-field mb-3">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" class="form-control" name="password" autocomplete="off"required/>
                            </div>
                            <hr class="hr-text" data-content="OR">

                            <a href="<?= $gclient->createAuthUrl() ?>" class="submit-a">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16" viewBox="0 0 48 48">
<path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path><path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path><path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path><path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
</svg>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <p>Continue with Google</p>
                                   
                            </a>

                            <?php if (isset($_GET['error'])) {             ?>
                                <p class="error"> <?php echo $_GET['error']; ?> </p>

                            <?php }?>

                            <button id="user-login account" type="submit" class="submit-b" name="submit">Login</button>
                            
                                <div class="footer-div pb-4">
                                    <p class="social-text text-muted">Don`t have an account? <a href="_user-create-account.php?signup=free">Register Here!</a></p>

                                </div>
                            
                        </form>

                       
                        
                       
                        
                    
                    </div>
                   
                    <div class="right-side  ps-5 pt-3 pe-5">
                        <div class="brand">
                            <h6>RentaCar &reg;</h6>
                        </div>

                        <div class="text-head">
                            <h2><b>Want to start your own shop?</b></h2>
                            <p>If you are:
                                
                            <ul>
                                <li>
                                    <span>from Region VIII (Leyte & Samar).</span>
                                </li>
                                <li>
                                    <span>has a passion to start a Car Rental business.</span>
                                </li>
                            </ul>
                            <p>RentaCar will help you! Start your business now with us.</p>
                        </div>

                        <div class="footer-div1 pb-4">
                            <button onclick="window.location='/TemplateShop/_company-login.php';" id="seller-login account" type="submit" class="btn1 btn-primary" name="submit">Start</button>
                        </div>
                    </div>
                </div>
        </div>
        <!--
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Seller Login</h3>
                    <p>
                        Got something to sell? It's time to share and earn!
                        Login now to setup your shop.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Seller
                    </button>
                </div>
                <img src="" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>User Login</h3>
                    <p>
                        Looking for something without any hassle? Shop your favorite Leyte products
                        online! Click the button now.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        User
                    </button>
                </div>
                <img src="" class="image" alt="" />
            </div>
        </div>
    -->
    </div>
    </section>
    
    <!-- <script src="app.js"></script> -->
    

    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script defer src="app.js"></script>
</body>

</html>
