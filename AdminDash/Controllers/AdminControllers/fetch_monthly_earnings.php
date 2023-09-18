<?php
if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}
class FetchMonthlyEarnings {
    private $conn;

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }

    function fetchMonthlyEarnings() {
        // Create an array for all months with initial values of 0
        $monthlyEarnings = array_fill(1, 12, 0); // Months are indexed from 1 to 12
    
        // SQL query to calculate earnings for each month with "reserved" status
        $sql = "SELECT MONTH(PickupDateTime) AS month, SUM(TotalAmount) AS monthly_earnings
            FROM booking
            WHERE BookingStatus = 'reserved'
              AND PickupDateTime >= '2023-01-01' -- Start of the year
              AND PickupDateTime <= '2023-12-31' -- End of the year
            GROUP BY month
            ORDER BY month;
        ";
    
        $result = $this->conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $monthlyEarnings[$row['month']] = (float) $row['monthly_earnings'];
            }
    
            // Encode the array as JSON and return it
            echo json_encode(['monthlyEarnings' => $monthlyEarnings]);
        } else {
            // Handle the database query error here
            echo json_encode(['monthlyEarnings' => $monthlyEarnings]);
        }
    }
}

// Create an instance of the Booking class
$booking = new fetchMonthlyEarnings();

// Call the fetchMonthlyEarnings method to fetch and return the data
$booking->fetchMonthlyEarnings();
?>
