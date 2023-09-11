<?php
include_once '../Controllers/AdminControllers/Maintenance.php';
include_once '../Controllers/AdminControllers/Notifications.php';
$MainObj = new Maintenance;
$notif = new Notifications();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addTaskButton"])) {
        $carID = $_POST["carID"];
        $taskType = $_POST["taskType"];
        $dueDate = $_POST["dueDate"];

        if ($MainObj->insertMaintenanceLog($carID, $taskType, $dueDate)) {
            // Task added successfully
            echo '<script>alert("Success: Maintenance task added.");</script>';
                $notif->createNotification("Adding A task","A new task has been Added");
        } else {
            // Handle the case where insertion failed
            echo '<script>alert("Error: Failed to add the maintenance task.");</script>';
        }
    }

    if (isset($_POST["doneButton"])) {
        $taskID = $_POST["taskID"];

        if ($MainObj->UpdateTaskCompletion($taskID)) {
            // Task completion updated successfully
            echo '<script>alert("Success: Maintenance task marked as done.");</script>';
                 $notif->createNotification("Finishing A task","Task Number : ".$taskID." is finished");
        } else {
            // Handle the case where update failed
            echo '<script>alert("Error: Failed to update task completion.");</script>';
        }
    }

    if (isset($_POST["deleteButton"])) {
        $taskID = $_POST["taskID"];

        if ($MainObj->DeleteTask($taskID)) {
            // Task deleted successfully
            echo '<script>alert("Success: Maintenance task deleted.");</script>';
                 $notif->createNotification("Deleting A task","Task number : ".$taskID." has been deleted");
        } else {
            // Handle the case where deletion failed
            echo '<script>alert("Error: Failed to delete maintenance task.");</script>';
        }
    }
}
?>
<script>
    // Redirect to maintenancetasks.php after showing the alert
    window.location.href = "../view/maintenancetasks.php";
</script>
