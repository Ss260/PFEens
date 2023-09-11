<?php

if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}
class Booking{
    private $conn;

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }

    public function getBookingData() {
        try {
            $query = "SELECT * FROM booking";
            $result = $this->conn->query($query);

            $bookingData = array(); 

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bookingData[] = $row;
                }
            }

            return $bookingData;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function AddBooking($carID, $clientID, $pickupDateTime, $returnDateTime, $totalAmount, $bookingStatus, $pickupLocation, $returnLocation) {
        $query = "INSERT INTO Booking (CarID, ClientID, PickupDateTime, ReturnDateTime, TotalAmount, BookingStatus, PickupLocation, ReturnLocation)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iissdsss", $carID, $clientID, $pickupDateTime, $returnDateTime, $totalAmount, $bookingStatus, $pickupLocation, $returnLocation);
    
        if ($stmt->execute()) {
            // After successfully inserting the booking, retrieve the last inserted ID
            $bookingID = $this->conn->insert_id;
            return $bookingID;
        } else {
            return false; // Error occurred
        }
    }
    
    // public function getClientBookingData($carID){
    //     try {
    //         $query = "SELECT * FROM booking WHERE CarID = ?";
    //         $stmt = $this->conn->prepare($query);
    //         $stmt->bind_param("i", $carID);
            
    //         if ($stmt->execute()) {
    //             $result = $stmt->get_result();
                
    //             $bookingData = array(); 
    
    //             if ($result->num_rows > 0) {
    //                 while ($row = $result->fetch_assoc()) {
    //                     $bookingData[] = $row;
    //                 }
    //             }
    
    //             return $bookingData;
    //         } else {
    //             throw new Exception("Error executing query: " . $stmt->error);
    //         }
    //     } catch (Exception $e) {
    //         throw $e;
    //     }
    // }
    public function getPendingBookings() {
        try {
            $query = "SELECT * FROM Booking WHERE BookingStatus = 'Pending'";
            $result = $this->conn->query($query);
    
            $bookingData = array(); 
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bookingData[] = $row;
                }
            }
    
            return $bookingData;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function updateBookingStatus($bookingID, $status) {
        try {
            $query = "UPDATE booking SET BookingStatus = ? WHERE BookingID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $status, $bookingID);

            if ($stmt->execute()) {
                return true; // Update successful
            } else {
                return false; // Error occurred during update
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function getCarID($bookingID) {
        try {
            $query = "SELECT CarID FROM booking WHERE BookingID = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $bookingID);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return $row['CarID'];
                } else {
                    // Handle the case where no booking with the given ID was found
                    return null;
                }
            } else {
                // Handle the case where the query execution failed
                return null;
            }
        } catch (Exception $e) {
            // Handle any exceptions that may occur during the process
            return null;
        }
    }
    public function getBookingInfo($bookingID){
        try {
            $stmt = $this->conn->prepare("SELECT * FROM booking WHERE BookingID = ?");
            $stmt->bind_param("i", $bookingID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                return $data;
            } else {
                return false;  
            }
        } catch (mysqli_sql_exception $e) {
            throw $e;
        } finally {
            if ($stmt) {
                $stmt->close();
            }
        }
    }

    public function calculateMonthlyEarnings() {
        // Calculate the first day of the current month
        $firstDayOfMonth = date("Y-m-01");

        // Calculate the last day of the current month
        $lastDayOfMonth = date("Y-m-t");

        // SQL query to calculate earnings for the current month with "reserved" status
        $sql = "SELECT SUM(TotalAmount) AS monthly_earnings
                FROM booking
                WHERE BookingStatus = 'reserved'
                AND PickupDateTime BETWEEN '$firstDayOfMonth' AND '$lastDayOfMonth'";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['monthly_earnings'];
        } else {
            return 0; // No earnings for the current month
        }
    }
    public function calculateAnnualEarnings() {
        // Calculate the first day of the current year
        $firstDayOfYear = date("Y-01-01");

        // Calculate the last day of the current year
        $lastDayOfYear = date("Y-12-31");

        // SQL query to calculate earnings for the current year with "reserved" status
        $sql = "SELECT SUM(TotalAmount) AS annual_earnings
                FROM booking
                WHERE BookingStatus = 'reserved'
                AND PickupDateTime BETWEEN '$firstDayOfYear' AND '$lastDayOfYear'";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['annual_earnings'];
        } else {
            return 0; // No earnings for the current year
        }
    }
    public function countPendingBookings() {
        // SQL query to count bookings where "BookingStatus" is set to "Pending"
        $sql = "SELECT COUNT(*) AS pending_booking_count
                FROM booking
                WHERE BookingStatus = 'Pending'";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['pending_booking_count'];
        } else {
            return 0; // No pending bookings found
        }
    }
    
}
?>