<?php 
$servername = "localhost";
$user = "root";
$password = "";
$database = "rentacar";

$con = new mysqli($servername, $user, $password, $database);

   
$row = $_POST['row'];
$rowperpage = 3;
$item_id = $_POST['i_id'];

// $query = 'SELECT * FROM posts limit '.$row.','.$rowperpage;


$result = mysqli_query($con,"SELECT * FROM rating WHERE item_id = '$item_id' limit $row , $rowperpage");
$html = '';

while ($rows = mysqli_fetch_array($result)) {
    // $notifications[] = $rows;
    $get_name = $rows['user_name'];
    $time = $rows['datetime'];
    $u_id = $rows['user_id'];
    $rating= $rows['user_rating'];
    $review= $rows['user_review'];


// $dateTime = new DateTime($time);
// $formattedDate = $dateTime->format('d M Y');


// print_r($notifications);
    // Close the database connection

// $t=0;
// print_r($notifications);
// foreach($notifications as $rows1){
//     $time = mysqli_real_escape_string($con, $rows1['datetime']);
//     $u_id = mysqli_real_escape_string($con, $rows1['user_id']);

//     $dateTime = new DateTime($time);
//     $get_userss = mysqli_query($con, "SELECT * FROM user WHERE user_id='$u_id'"); 
//     $pic = mysqli_fetch_array($get_userss);
// $time = mysqli_real_escape_string($con, $row['datetime']);
//                         $dateTime = new DateTime($time);
//                         $formattedDate = $dateTime->format('d M Y');

    // Format the date as you desire
    // $formattedDate = $dateTime->format('d M Y');

     $html .= '<div class="posts" id="post_1">';
     $html .=              '<div class="d-flex mb-3">';
     $html .=                 ' <div class = "flex-shrink-0">';
                
                // if($pic["pic_ID"]==NULL){
                //     $html .=           '<img src="assets/user_profile/profile.png" style="height:45px; width: 45px; display:inline;" class="rounded-circle">';
                // } else { 
                                       
                //     $html .=         '<img src="images/shop/'.$pic["pic_ID"].'" style="height:45px; width: 45px; display:inline;" class="rounded-circle"> ';
                // }
               
            
    $html .=        '</div>';
    $html .=                 '<div class="">';
    $html .=                     ' <p class="mb-0"><b>'.$get_name.'</b></p>';
                    
    $html .=                 '</div>';
    $html .=              '</div>';
    $html .=              '<div class="mb-5"> ';
    $html .=               '   <h5 class=" " style="color:gold;">'.$rating.'<span><small class="" style="color:#FFC107; font-size:13px;">/5</small></span></h5>';
    $html .=               '    <p class="text-break lh-base me-3 " align="justify">'.$review.'</p>';
    $html .=              '</div>';
    $html .=             '<hr>';
    $html .=             '</div>';
}
    echo $html;
?>