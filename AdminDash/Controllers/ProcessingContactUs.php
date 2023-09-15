<script src="../js/popup.js"></script>
<?php
require_once 'AdminControllers/Admin.php';
require_once 'AdminControllers/Notifications.php';

try {
    // Retrieve Data
    $name = $_POST["name"];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $admObj = new Admin();
    $notifObj = new Notifications();
    $admObj->ReceiveClientMessage($name, $email, $subject, $message);
    $notifObj->createNotification("Complaint Received", "You have received an email from a client. Check your inbox.");
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage(); // Provide feedback to the user
}
?>
