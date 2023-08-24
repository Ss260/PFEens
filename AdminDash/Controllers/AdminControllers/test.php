<?php
require_once 'Vehicle.php'; // Include the Vehicle class
require_once '../../Model/ConnectionController.php'; // Include the getConnection function

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "rental";

// Establish database connection
$conn = getConnection($servername, $username, $password, $database);

// Create an instance of the Vehicle class
$vehicle = new Vehicle();



// Test the addVehicle method
$added = $vehicle->addVehicle(
    "Toyota Camry",
    "Sedan",
    2023,
    "Blue",
    15000,
    "ABC123",
    "Gasoline",
    "Automatic",
    5,
    50,
    1,
    "New York",
    "No notes",
    "Insurance info",
    "url1,url2"
);

if ($added) {
    echo "Vehicle added successfully.";
} else {
    echo "Failed to add vehicle.";
}

// Test the deleteVehicle method
$deleted = $vehicle->deleteVehicle(1);

if ($deleted) {
    echo "Vehicle deleted successfully.";
} else {
    echo "Failed to delete vehicle.";
}

// Test the updateVehicle method
$updated = $vehicle->updateVehicle(
    2,
    "Honda Civic",
    "Sedan",
    2022,
    "Red",
    20000,
    "XYZ456",
    "Gasoline",
    "Automatic",
    5,
    55,
    1,
    "Los Angeles",
    "Updated notes",
    "Updated info",
    "new-url1,new-url2"
);

if ($updated) {
    echo "Vehicle updated successfully.";
} else {
    echo "Failed to update vehicle.";
}

// Test the viewVehicles method
$vehicles = $vehicle->viewVehicles();
foreach ($vehicles as $veh) {
    echo "<pre>";
    print_r($veh);
    echo "</pre>";
}
?>
