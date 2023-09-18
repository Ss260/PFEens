<?php
session_start();
require_once '../Controllers/AdminControllers/Booking.php';
require_once '../Controllers/AdminControllers/Notifications.php';

require_once '../Controllers/AdminControllers/Admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create an instance of the Admin class
    $adminObj = new Admin();

    if (isset($_POST['logout'])) {
        // Call the logout method to destroy the session
        $adminObj->logout();

        // Redirect to the login page after logout
        header("Location: ../Login.php");
        exit();
    }

    // If not logging out, proceed with login logic
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    if ($adminObj->login($username, $password)) {
        // Login successful, retrieve the admin's name
        $adminName = $adminObj->getAdminName($username);

        // Start a session and store the admin's username
        $_SESSION['admin_username'] = $adminName;
        // Create an instance of the BookingController
                $booking = new Booking();
                $notif = new Notifications();
                // Call the updateBookingStatus method
                if ($booking->updateBookingStatusToDONE()) {
                    $notif->createNotification("Booking Done","Booking Updated Successfully");
                } else {
                    $notif->createNotification("Booking Done","Failed to update BookingStatus");
                }
        // Redirect to the admin dashboard or any other page
        header("Location: ../AdminIndex.php");
        exit();
    } else {
        // Login failed, set an error message as a URL parameter
        $error_message = "Wrong username or password, try again";
        header("Location: ../Login.php?error=" . urlencode($error_message));
        exit();
    }
}
?>
