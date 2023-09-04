<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Form</title>
  
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Updated background color */
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            margin: auto; /* Center the form vertically */
            margin-top: 20px; /* Add top margin */
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .form-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button {
            background-color: #ccc;
            color: #333;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
                    $fromDate = $_POST['fromDate'];
                    $toDate = $_POST['toDate'];
                    $totalAmount = $_POST['totalAmount'];
                    $carID = $_POST['carID'];
                    
            ?>
    <div class="form-container">
        <form action="../Controllers/ProcessingBooking.php" method="post">
            <div class="form-group">
                <label class="form-label" for="first-name">First Name</label>
                <input class="form-input" type="text" id="first-name" name="first-name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="last-name">Last Name</label>
                <input class="form-input" type="text" id="last-name" name="last-name" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="phone-number">Phone Number</label>
                <input class="form-input" type="tel" id="phone-number" name="phone-number" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="pickup-location">Pickup Location</label>
                <input class="form-input" type="text" id="pickup-location" name="pickup-location" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="return-location">Return Location</label>
                <input class="form-input" type="text" id="return-location" name="return-location" required>
            </div>
              <!-- Include the values using hidden input fields -->
        <input type="hidden" name="fromDate" value="<?php echo $fromDate; ?>">
        <input type="hidden" name="toDate" value="<?php echo $toDate; ?>">
        <input type="hidden" name="totalAmount" value="<?php echo $totalAmount; ?>">
        <input type="hidden" name="carID" value="<?php echo $carID; ?>">

            <button type="submit" class="form-button">Book Now</button>
        </form>
    </div>


    <!-- Back button -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="javascript:history.back()" class="back-button">Back</a>
    </div>
    
</body>
</html>
 