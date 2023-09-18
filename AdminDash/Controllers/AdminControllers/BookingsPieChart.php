<?php
if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}
class BookingsPieChart {
    private $conn;
    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }
    function countBookingStatus() {
        // SQL query to count the number of bookings for each status
        $sql = "SELECT BookingStatus, COUNT(*) AS count FROM booking GROUP BY BookingStatus";
    
        $result = $this->conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $statusCounts = [];
            while ($row = $result->fetch_assoc()) {
                $statusCounts[] = [
                    'name' => $row['BookingStatus'],
                    'y' => (int) $row['count']
                ];
            }
            // Return JSON data directly here
            echo json_encode(['statusCounts' => $statusCounts]);
        } else {
            // Handle the database query error here
            echo json_encode(['statusCounts' => []]);
        }
    }
    
    
}
$pie = new BookingsPieChart();
$data = $pie->countBookingStatus(); // Store the returned data in $data
?>