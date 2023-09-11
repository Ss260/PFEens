<?php
if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}


class Notifications
{
    private $conn;

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }

        // Method to create and store notifications
        public function createNotification($notificationType, $message) {
            // Sanitize and escape user input
            $notificationType = mysqli_real_escape_string($this->conn, $notificationType);
            $message = mysqli_real_escape_string($this->conn, $message);

            // Create a prepared statement
            $stmt = mysqli_prepare($this->conn, "INSERT INTO notifications (NotificationType, Message) VALUES (?, ?)");

            if ($stmt) {
                // Bind the parameters
                mysqli_stmt_bind_param($stmt, "ss", $notificationType, $message);

                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_close($stmt);
                    return true; // Notification creation successful
                } else {
                    echo "Error: " . mysqli_error($this->conn);
                    mysqli_stmt_close($stmt);
                    return false; // Notification creation failed
                }
            } else {
                echo "Error: " . mysqli_error($this->conn);
                return false; // Statement preparation failed
            }
        }
        public function getNotifications() {
            $query = "SELECT * FROM notifications ORDER BY Timestamp DESC LIMIT 5"; // Change the query as needed
        
            $result = mysqli_query($this->conn, $query);
        
            if ($result) {
                $notifications = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $notifications[] = $row;
                }
                return $notifications;
            } else {
                echo "Error: " . mysqli_error($this->conn);
                return [];
            }
        }
}