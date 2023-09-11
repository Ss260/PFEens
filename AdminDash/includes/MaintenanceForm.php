<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f7f7f7; /* Page background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Vertically center the form */
            margin: 0;
        }

        /* Style for the modal container */
        .modal-container {
            background-color: #ffffff; /* Form background color */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
            width: 400px; /* Adjust width as needed */
        }

        /* Style for the form elements */
        .form-group {
            margin-bottom: 20px;
        }

        /* Style for the input fields */
        .form-control {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box; /* Ensure the padding is included in the width */
        }

        /* Style for the buttons */
        .modal-footer .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff; /* Blue button color */
            color: #fff; /* Text color for buttons */
        }

        /* Style for the modal title */
        .modal-title {
            text-align: center;
            font-size: 24px;
        }
    </style>
</head>
<body>
<form id="maintenanceForm" action="../Controllers/ProcessingMaintenance.php" method="POST">
    <div class="form-group">
        <label for="carID">Select Car</label>
        <select class="form-control" id="carID" name="carID" required>
            <?php
            include_once '../Controllers/AdminControllers/Vehicle.php';
            $VehObj = new Vehicle();
            $vehicles = $VehObj->viewVehicles();
            foreach ($vehicles as $vehicle) {
                echo '<option value="' . $vehicle['CarID'] . '">' . $vehicle['CarID'] . ' - ' . $vehicle['CarModel'] . ' - ' . $vehicle['CarType'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="taskType">Task Type</label>
        <input type="text" class="form-control" id="taskType" name="taskType" required>
    </div>
    <div class="form-group">
        <label for="dueDate">Due Date</label>
        <input type="date" class="form-control" id="dueDate" name="dueDate" required>
    </div>
    <!-- Additional input fields for Completed and Completion Date if needed -->

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addTaskButton">Save Task</button>
    </div>
</form>
</body>
</html>
