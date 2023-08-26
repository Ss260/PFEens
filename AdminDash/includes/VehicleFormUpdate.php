  <!-- Form Css Start -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
                        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
                        <style>
                          h1 {
                        position: absolute;
                        margin: 0;
                        font-size: 36px;
                        color: #fff;
                        z-index: 2;
                        }
                        span.required {
                        color: red;
                        }
                        .testbox {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: inherit;
                        padding: 20px;
                        }
                        form {
                        width: 100%;
                        padding: 20px;
                        border-radius: 6px;
                        background: #fff;
                        box-shadow: 0 0 30px 0 #095484; 
                        }
                        .banner {
                        position: relative;
                        height: 180px;
                        background-image: url("/uploads/media/default/0001/01/9e07ce3a601795a5ac09a66a0c1fc8978e0ee51a.jpeg");  
                        background-size: cover;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                        }
                        .banner::after {
                        content: "";
                        background-color: rgba(0, 0, 0, 0.4); 
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        }
                        p.top-info {
                        margin: 10px 0;
                        }
                        input, select {
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 3px;
                        }
                        input {
                        width: calc(100% - 10px);
                        padding: 5px;
                        }
                        select {
                        width: 100%;
                        padding: 7px 0;
                        background: transparent;
                        }
                        .item:hover p, .question:hover p, .question label:hover, input:hover::placeholder {
                        color: #095484;
                        }
                        .item input:hover, .item select:hover {
                        border: 1px solid transparent;
                        box-shadow: 0 0 5px 0 #095484;
                        color: #095484;
                        }
                        .item {
                        position: relative;
                        margin: 10px 0;
                        }
                        .question input {
                        width: auto;
                        margin: 0;
                        border-radius: 50%;
                        }
                        .question input, .question span {
                        vertical-align: middle;
                        }
                        .question label {
                        display: inline-block;
                        margin: 5px 20px 15px 0;
                        }
                        .btn-block {
                        margin-top: 10px;
                        text-align: center;
                        }
                        button {
                        width: 150px;
                        padding: 10px;
                        border: none;
                        border-radius: 5px; 
                        background: #095484;
                        font-size: 16px;
                        color: #fff;
                        cursor: pointer;
                        }
                        button:hover {
                        background: #0666a3;
                        }
                        @media (min-width: 568px) {
                        .name-item, .city-item {
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between;
                        }
                        .name-item input, .city-item input {
                        width: calc(50% - 20px);
                        }
                        .city-item select {
                        width: calc(50% - 8px);
                        }
                        }
                        </style>
          
                        <!-- Form Css End -->
                        <div class="testbox">
    <form action="../Controllers/Update.php" method="post" enctype="multipart/form-data">
        <div class="banner">
            <h1>Update a Vehicle</h1>
        </div>
        <div class="item">
            <p>Car ID<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="CarID" />
            </div>
            <button type="submit" name="operation" value="ShowData">Show Data</button>
        </div>
        <input type="hidden" name="RetrievedCarID" value="<?php echo $retrievedCarID ?? ''; ?>">
        <div class="item">
            <p>Car Model<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="CarModel"  value="<?php echo $carModel ?? ''; ?>"/>
            </div>
            <p>Car Type<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="CarType"   value="<?php echo $carType ?? ''; ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Year<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="Year" value="<?php echo $year ?? ''; ?>"/>
            </div>
            <p>Color<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="Color"  value="<?php echo $color ?? ''; ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Mileage<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="Mileage"  value="<?php echo $mileage ?? ''; ?>"/>
            </div>
            <div class="question">
                <p>Fuel Type<span class="required">*</span></p>
                <div class="question-answer">
                    <label><input type="radio" value="Gasoline" name="FuelType"  <?php echo isset($fuelType) && $fuelType === 'Gasoline' ? 'checked' : ''; ?>/> <span>Gasoline</span></label>
                    <label><input type="radio" value="Diesel" name="FuelType"  <?php echo isset($fuelType) && $fuelType === 'Diesel' ? 'checked' : ''; ?>/> <span>Diesel</span></label>
                </div>
            </div>
            <p>License Plate<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="LicensePlate"  value="<?php echo $licensePlate ?? ''; ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Seating Capacity<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="SeatingCapacity"  value="<?php echo $seatingCapacity ?? ''; ?>"/>
            </div>
            <p>Daily Rate<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="DailyRate"  value="<?php echo $dailyRate ?? ''; ?>"/>
            </div>
        </div>
        <div class="item">
            <p>Location<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="Location"  value="<?php echo $location ?? ''; ?>"/>
            </div>
            <p>Admin Notes<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="AdminNotes"  value="<?php echo $adminNotes ?? ''; ?>"/>
            </div>
            <p>Legal Documents<span class="required">*</span></p>
            <div class="name-item">
                <input type="text" name="LegalDocuments"  value="<?php echo $legalDocuments ?? ''; ?>"/>
            </div>
        </div>
        <div class="mb-3">
            <!-- File input for images -->
            <label for="images" class="form-label">Add images</label>
            <input class="form-control" type="file" name="images[]" multiple>
        </div>
        <div class="question">
            <p>Transmission<span class="required">*</span></p>
            <div class="question-answer">
                <label><input type="radio" value="Automatic" name="Transmission"  <?php echo isset($transmission) && $transmission === 'Automatic' ? 'checked' : ''; ?>/> <span>Automatic</span></label>
                <label><input type="radio" value="Manual" name="Transmission"  <?php echo isset($transmission) && $transmission === 'Manual' ? 'checked' : ''; ?>/> <span>Manual</span></label>
            </div>
        </div>
        <div class="question">
    <p>Availability<span class="required">*</span></p>
    <div class="question-answer">
    <label><input type="radio" value="1" name="Availability" <?php echo $availability == "1" ? 'checked' : ''; ?> /> <span>Yes</span></label>
    <label><input type="radio" value="0" name="Availability"  <?php echo $availability == "0" ? 'checked' : ''; ?>/> <span>No</span></label>
        </div>
</div>
        <div class="btn-block">
            <button type="submit" name="operation" value="UpdVehicle">Update</button>
        </div>
    </form>
</div>