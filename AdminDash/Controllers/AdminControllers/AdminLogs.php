<?php
if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}
class AdminLogs{
    private $conn;

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }
    public function ViewLogs() {
        try {
            $query = "SELECT * FROM adminactionslog";
            $result = $this->conn->query($query);

            $logsData = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $logsData[] = $row;
                }
            }

            return $logsData;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>