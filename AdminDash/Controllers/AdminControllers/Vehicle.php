<?php
if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}

class Vehicle {
    private $conn;

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }
    public function updateImageURLs($carID, $imageURLs) {
        // Delete existing image URLs for the car
        $this->deleteImageURLs($carID);
        
        // Insert new image URLs
        $this->addImageURLs($carID, $imageURLs);
    }
    
    public function deleteImageURLs($carID) {
        try {
            $stmt = $this->conn->prepare("DELETE FROM carImages WHERE vehicle_id = ?");
            $stmt->bind_param("i", $carID);
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function addImageURLs($vehicleID, $imageURLs) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO carimages (vehicle_id, image_url) VALUES (?, ?)");
            foreach ($imageURLs as $url) {
                $stmt->bind_param("is", $vehicleID, $url);
                if (!$stmt->execute()) {
                    throw new Exception("Error adding image URL: " . $stmt->error);
                }
            }
            $stmt->close();
        } catch (Exception $e) {
            throw $e;
        }
    }
    

    public function addVehicle($carModel, $carType, $year, $color, $mileage, $licensePlate, $fuelType, $transmission, $seatingCapacity, $dailyRate, $availability, $location, $adminNotes, $legalDocuments, $imageURLs) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO cars (CarModel, CarType, Year, Color, Mileage, LicensePlate, FuelType, Transmission, SeatingCapacity, DailyRate, Availability, Location, AdminNotes, LegalDocuments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssssss", $carModel, $carType, $year, $color, $mileage, $licensePlate, $fuelType, $transmission, $seatingCapacity, $dailyRate, $availability, $location, $adminNotes, $legalDocuments);
            
            if ($stmt->execute()) {
                $vehicleID = $stmt->insert_id;
                $this->addImageURLs($vehicleID, $imageURLs); // Call to addImageURLs method
                return true;
            } else {
                throw new Exception("Error adding vehicle: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            $stmt->close();
        }
    }
    public function updateVehicle($carID, $carModel, $carType, $year, $color, $mileage, $licensePlate, $fuelType, $transmission, $seatingCapacity, $dailyRate, $availability, $location, $adminNotes, $legalDocuments, $imageURLs) {
        try {
            $stmt = $this->conn->prepare("UPDATE cars SET CarModel = ?, CarType = ?, Year = ?, Color = ?, Mileage = ?, LicensePlate = ?, FuelType = ?, Transmission = ?, SeatingCapacity = ?, DailyRate = ?, Availability = ?, Location = ?, AdminNotes = ?, LegalDocuments = ? WHERE CarID = ?");
            $stmt->bind_param("ssssssssssssssi", $carModel, $carType, $year, $color, $mileage, $licensePlate, $fuelType, $transmission, $seatingCapacity, $dailyRate, $availability, $location, $adminNotes, $legalDocuments, $carID);
            
            if ($stmt->execute()) {
                
                $this->updateImageURLs($carID, $imageURLs); // Call to updateImageURLs method
                return true;
            } else {
                throw new Exception("Error updating vehicle: " . $stmt->error);
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            $stmt->close();
        }
    }

    
    public function getVehicleData($carID) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM cars WHERE CarID = ?");
            $stmt->bind_param("i", $carID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return false; // No data found for the given CarID
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            $stmt->close();
        }
    }
    
    public function deleteVehicle($carID) {
        try {
            // Check if the car exists before proceeding with deletion
            $checkStmt = $this->conn->prepare("SELECT CarID FROM cars WHERE CarID = ?");
            $checkStmt->bind_param("i", $carID);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            
            if ($checkResult->num_rows === 0) {
                $checkStmt->close();
                throw new Exception("Car with ID $carID does not exist.");
            }
            
            $checkStmt->close();
    
            // First, delete associated image URLs
            $this->deleteImageURLs($carID);
    
            $stmt = $this->conn->prepare("DELETE FROM cars WHERE CarID = ?");
            $stmt->bind_param("i", $carID);
    
            $success = $stmt->execute();
            $stmt->close();
    
            return $success;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function viewVehicles() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM cars");
            $stmt->execute();
            $result = $stmt->get_result();
            $vehicles = array();
            while ($row = $result->fetch_assoc()) {
                $vehicles[] = $row;
            }
            return $vehicles;
        } catch (Exception $e) {
            throw $e;
        } finally {
            $stmt->close();
        }
    }
    
   
}
?>
