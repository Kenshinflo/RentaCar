<?php
   
    shuffle($product_shuffle);


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['top_products_submit'])){

            $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
        }
    }
    
    $countedSeller = $product->getAllSellers();
      
    // $get_rating = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id'");
    // $rating = mysqli_num_rows($get_rating);
    
    // $rate5 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 5");
    // $r5 = mysqli_num_rows($rate5);
    
    // $rate4 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 4");
    // $r4 = mysqli_num_rows($rate4);
    
    // $rate3 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 3");
    // $r3 = mysqli_num_rows($rate3);
    
    // $rate2 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 2");
    // $r2 = mysqli_num_rows($rate2);
    
    // $rate1 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= '$item_id' AND user_rating = 1");
    // $r1 = mysqli_num_rows($rate1);
    
    // if($rating!=0){
    //     $total1=( $r5 + $r4 + $r3 + $r2 + $r1);
    //     $ave = round((5* $r5 + 4*$r4 + 3*$r3 + 2*$r2 + 1*$r1) / ($total1)); 
    // } else{
    //     $ave = 0;
    // }
    
    $count = 0;
    // <?php foreach ($product_shop as $item){
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid search-bar" style="width:100%;">
    <div class="row head-row">
        <div class="col-md-6 row1 ">

        </div>
        
      
        <div class="col-md-6 row3 d-flex align-items-center justify-content-center search">
            <!-- <h5 class="font-rubik text-light "><b>Shops</b></h5> -->

            <input type="search" name="search" id="searchInput" class="form-control search-field ms-4" placeholder="Search"
                autocomplete="off" style="border: 2px solid #36454F"/>
        </div>
    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<section class="py-2" id="top-products">
    <div class="container px-4 px-lg-5">
        <div class="d-flex flex-wrap grid-container">

            <?php 
                $countedSeller = array_unique($countedSeller, SORT_REGULAR);
                foreach ($countedSeller as $value):             
            ?>


            <div class="container py-4 mb-4">
                <div class="borderss">
                <div class="shop-name-banner border-hover d-flex justify-content-center align-items-center">
                    <h4 class="font-gab text-white"><?php echo $value['shopname'] ?? "Unknown"; ?></h4>
                </div>
                </div>
                <hr>
                <div class="owl-carousel owl-theme shop-container">

                    <?php 
                    foreach ($product->getSeller($value['seller_id']) as $item):
                             $in_display = $product->getProdCount($value['seller_id']);
                            

                    ?>

                    <?php array_map(function ($item) use($in_display){
                        // $get_rating = $in_display->getRating($item['item_id']);

                        // $itemid = $item['item_id'];
                        // $con = mysqli_connect("localhost","root","","rentacar");

                        // $get_rating = mysqli_query($con,"SELECT * FROM rating WHERE item_id = ".$item["item_id"]."");
                        // $rating = mysqli_num_rows($get_rating);
                        
                        // $rate5 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 5");
                        // $r5 = mysqli_num_rows($rate5);
                        
                        // $rate4 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 4");
                        // $r4 = mysqli_num_rows($rate4);
                        
                        // $rate3 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 3");
                        // $r3 = mysqli_num_rows($rate3);
                        
                        // $rate2 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 2");
                        // $r2 = mysqli_num_rows($rate2);
                        
                        // $rate1 = mysqli_query($con, "SELECT * FROM rating WHERE item_id= ".$item["item_id"]." AND user_rating = 1");
                        // $r1 = mysqli_num_rows($rate1);
                        
                        // if($rating!=0){
                        //     $total1=( $r5 + $r4 + $r3 + $r2 + $r1);
                        //     $ave = round((5* $r5 + 4*$r4 + 3*$r3 + 2*$r2 + 1*$r1) / ($total1)); 
                        // } else{
                        //     $ave = 0;
                        // }
                        
                        ?>

                    <div class="grid-item <?php echo $item['item_brand'] ?? "Brand"; ?> border mb-4">

                        <div class="item py-2">
                            <h5 class="margin-left-10 text-blue center-text car-name"><?php echo $item['item_brand'] ?? "Unknown"; ?></h5>
                            <div class="product font-rale">
                                <h6 class="margin-left-10 center-text car-name"><b><?php echo $item['item_name'] ?? "Unknown"; ?></b></h6>
                                <a href="<?php printf('%s?item_id=%s', 'product.php', $item['item_id']); ?>">
                                    <img src="../images/cars/<?php echo $item['item_image']; ?>" alt="product1"
                                        class="img-fluid padding mx-auto d-block"></a>
                                <div class="margin-left-10 price py-2 d-flex justify-content-between margin-right-10">
                                    <span
                                        class="center-text item-text">₱<?php echo $item['item_price'] ?? 0?>/day
                                    </span>
                                    <!-- <span
                                        class="center-text item-text"><?php echo $get_rating?>
                                    </span> -->
                                </div>
                            </div>
                        </div>


                    </div>
                    <?php }, $product->getProdCount($value['seller_id']));
                    endforeach; ?>
                </div>
                <hr>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>


<script>
$(document).ready(function() {
    $('#searchInput').on('input', function() {
        var searchText = $(this).val().toLowerCase();

        $('.grid-item').each(function() {
            var itemText = $(this).text().toLowerCase();
            if (itemText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // After filtering, trigger layout update
        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: 20, // Adjust this to your item width
            gutter: 2
        });
    });

    // Initialize Masonry layout
    $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: 20, // Adjust this to your item width
        gutter: 2
    });
});
</script>