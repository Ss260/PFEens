<?php
require_once '../Controllers/AdminControllers/Booking.php';
require_once '../Controllers/AdminControllers/Notifications.php';

// Create an instance of the BookingController
$booking = new Booking();
$notif = new Notifications();
// Call the updateBookingStatus method
if ($bookingController->updateBookingStatusToDONE()) {
    $notif->createNotification("Booking Done","Booking Updated Successfully");
} else {
    $notif->createNotification("Booking Done","Failed to update BookingStatus");
}
?>
