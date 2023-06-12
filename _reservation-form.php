
<section class="container my-5 bg-dark w-60 text-light p-4" id="ReserveContainer">
<?php
    $datef = $_SESSION["dateFrom"];
    $datet = $_SESSION["dateTo"];
?>
<form action="insert.php" method="POST" class="row g-3 p-3">
        <div class="col-md-6" id="label1">
            <label for="validationDefault01" class="form-label">Name</label>
            <input type="text" class="form-control" name="uname">
        </div>

        <div class="col-md-6" id="label2">
            <label for="validationDefault02" class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact">
        </div>
<!--
        <div class="col-md-6" id="selection">
        <div class="form-group">
          <label form="">Car Brand</label>
          <select brand="" class="form-control">
            <option value="">--Select Brand--</option>
            <option value="toyota">Toyota</option>
            <option value="mitsubishi">Mitsubishi</option>
            <option value="hyundai">Hyundai</option>
            <option value="chevrolet">Chevrolet</option>
            <option value="honda">Honda</option>
            <option value="suzuki">Suzuki</option>
            <option value="nissan">Nissan</option>
</select>
</div>
</div>-->

        <div class="col-md-12" id="label3">
            <label for="validationDefault02" class="form-label">Vehicle Brand and Name</label>
            <input type="text" class="form-control" name="vhname">
        </div>

        <div class="col-sm-4" id="col1">
            <div class="input-box" id="res1">
                <span>Pick-up Date</span>
                <!-- <input type="date" name="eventret" id="pick"> -->
                <input type="date" name="dateFrom" id="dateFrom">
                 <h5 class="font-baloo font-size-25"><?php echo $_SESSION["dateFrom"]?? 0; ?></h5>
                
            </div> 
        </div>

        <div class="col-sm-4" id="col2">
            <div class="input-box" id="res2">
                <span>Return Date</span>
                <input type="date" name="dateTo" id="dateTo">
                
            </div>
        </div>
    
      
        <div class="col-12">
          <button type="submit" name="confirmreserve" class="btn btn-primary font-size-20 px-4">Reserve</button>
          <a class="btn btn-danger font-size-20 px-4" href="reservation.php">Cancel</a>
        </div>
        </form>
   </section>