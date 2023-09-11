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
        $query = "SELECT * FROM maintenancetasks  ";
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
   
   public function insertMaintenanceLog($carID, $taskType, $dueDate) {
    $completed = 0; // Set Completed to 0 by default
    $completionDate = null; // Set CompletionDate to null by default
    $sql = "INSERT INTO maintenancetasks (CarID, TaskType, DueDate, Completed, CompletionDate) 
            VALUES ('$carID', '$taskType', '$dueDate', '$completed', NULL)";

    if (mysqli_query($this->conn, $sql)) {
        return true;
    } else {
        // Handle database errors here or log the error
        return false;
    }
}

public function UpdateTaskCompletion($taskID) {
    $currentDate = date('Y-m-d'); // Get the current date
    $sql = "UPDATE maintenancetasks SET Completed = 1, CompletionDate = '$currentDate' WHERE TaskID = '$taskID'";
    
    if (mysqli_query($this->conn, $sql)) {
        return true;
    } else {
        // Handle database errors here or log the error
        return false;
    }
}

public function DeleteTask($taskID) {
    $sql = "DELETE FROM maintenancetasks WHERE TaskID = '$taskID'";
    
    if (mysqli_query($this->conn, $sql)) {
        return true;
    } else {
        // Handle database errors here or log the error
        return false;
    }
}
public function countIncompleteTasks() {
    // SQL query to count tasks where "Completed" is set to 0
    $sql = "SELECT COUNT(*) AS incomplete_task_count
            FROM maintenancetasks
            WHERE Completed = 0";

    $result = $this->conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['incomplete_task_count'];
    } else {
        return 0; // No incomplete tasks found
    }
}


public function viewUncompletedTasks(){
    try {
        $query = "SELECT * FROM maintenancetasks where Completed=0";
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