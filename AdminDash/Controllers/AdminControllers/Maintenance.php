<?php
if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}
class Maintenance{
    private $conn;

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }
   public function viewMaintenanceLog(){
    try {
        $query = "SELECT * FROM maintenancetasks";
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

}