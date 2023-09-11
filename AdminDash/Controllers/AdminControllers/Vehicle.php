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

    //to ShowData
    public function getVehicleData($carID) {
        try {
            $stmt = $this->conn->prepare("SELECT c.*, ci.image_url AS ImageURL FROM cars c LEFT JOIN carimages ci ON c.CarID = ci.vehicle_id WHERE c.CarID = ?");
            $stmt->bind_param("i", $carID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                return $data;
            } else {
                return false;  
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            if ($stmt) {
                $stmt->close();
            }
        }
    }
    public function getAllRecentVehicles() {
        $query = "SELECT c.*, GROUP_CONCAT(ci.image_url) AS image_urls
                  FROM cars c
                  LEFT JOIN carimages ci ON c.CarID = ci.vehicle_id
                  GROUP BY c.CarID
                  LIMIT 6";
    
        $result = mysqli_query($this->conn, $query);
    
        if ($result) {
            $vehicles = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Extract the image URLs and add them to the vehicle data
                $row['image_urls'] = explode(',', $row['image_urls']);
                $vehicles[] = $row;
            }
            return $vehicles;
        } else {
            echo "Error: " . mysqli_error($this->conn);
            return [];
        }
    }
    
    
    
    public function getVehicleImages($vehicleID) {
        try {
            $stmt = $this->conn->prepare("SELECT image_url FROM carimages WHERE vehicle_id = ?");
            $stmt->bind_param("i", $vehicleID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $imageURLs = array();
            while ($row = $result->fetch_assoc()) {
                $imageURLs[] = $row['image_url'];
            }
            
            return $imageURLs;
        } catch (Exception $e) {
            throw $e;
        } finally {
            if ($stmt) {
                $stmt->close();
            }
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
    public function countVehicles() {
        $sql = "SELECT COUNT(*) as vehicleCount FROM cars";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $vehicleCount = $row['vehicleCount'];
            return $vehicleCount;
        } else {
            return 0;
        }
    }
    public function filterVehicles($minPrice, $maxPrice, $availability) {
        $query = "SELECT * FROM cars
                  WHERE DailyRate >= $minPrice
                  AND DailyRate <= $maxPrice
                  AND Availability = $availability";

        $result = mysqli_query($this->conn, $query);

        $vehicles = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $vehicles[] = $row;
        }

        return $vehicles;
    }

    public function getRecentlyAddedVehicles($limit) {
        $query = "SELECT * FROM cars
                  ORDER BY CreatedAt DESC
                  LIMIT $limit";

        $result = mysqli_query($this->conn, $query);

        $vehicles = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $vehicles[] = $row;
        }

        return $vehicles;
    }
    public function updateAvailability($carID, $availability) {
        try {
            $query = "UPDATE cars SET Availability = ? WHERE CarID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $availability, $carID);

            if ($stmt->execute()) {
                return true; // Update successful
            } else {
                return false; // Error occurred during update
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>
