<?php
// Include the Admin.php file
include_once '../Controllers/AdminControllers/Admin.php';
include_once '../Controllers/AdminControllers/Notifications.php';

  
// Create an instance of the Admin class
$adminObj = new Admin();

// Initialize variables to store fetched data
$adminID = $newFirstName = $newLastName = $newEmail = $newPhoneNumber = $newCIN = $newUsername = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["showData"])) {
        // Handle the "Show Data" button click
        if (isset($_POST["adminID"])) {
            $adminID = $_POST["adminID"];

            // Retrieve admin data
            $adminData = $adminObj->GetAdminData($adminID);

            // Check if data was retrieved successfully
            if ($adminData) {
                $newFirstName = $adminData['FirstName'];
                $newLastName = $adminData['LastName'];
                $newEmail = $adminData['Email'];
                $newPhoneNumber = $adminData['PhoneNumber'];
                $newCIN = $adminData['CIN'];
                $newUsername = $adminData['Username'];
                 // Include the HTML form again to display the retrieved data
                require_once '../view/AdminSettings.php';
            } else {
                // Handle the case when data is not found (e.g., display an error message)
                echo "Admin data not found for ID: $adminID";
            }
        } else {
            echo "Error: Admin ID not set.";
        }
    } else {
        // Handle other button actions (update, delete, addAdmin) here
        if (isset($_POST["update"])) {
            // Handle the "Update" button click
            $adminID = $_POST["adminID"];
            $newFirstName = $_POST["firstName"];
            $newLastName = $_POST["lastName"];
            $newEmail = $_POST["email"];
            $newPhoneNumber = $_POST["phoneNumber"];
            $newCIN = $_POST["CIN"];
            $newUsername = $_POST["username"];
            $newPassword = $_POST["password"];

            if($adminObj->UpdateAdminInfo($adminID, $newFirstName, $newLastName, $newEmail, $newPhoneNumber, $newCIN, $newUsername, $newPassword)){
                $notif = new Notifications();
                $notif->createNotification("Updating an Admin","An admin Data has been added");
            }

            // Set a success message
         } elseif (isset($_POST["delete"])) {
            // Handle the "Delete" button click
            $adminID = $_POST["adminID"];

            if($adminObj->DeleteAdmin($adminID)){
    
                $notif = new Notifications();
                $notif->createNotification("Deleting an admin","An Admin Account has been Deleted");
            }

            // Set a success message
         } elseif (isset($_POST["addAdmin"])) {
            // Handle the "Add Admin" button click
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $phoneNumber = $_POST["phoneNumber"];
            $cin = $_POST["CIN"];
            $username = $_POST["username"];
            $password = $_POST["password"];

            if($adminObj->AddAdmin($firstName, $lastName, $email, $phoneNumber, $cin, $username, $password)){
                $notif = new Notifications();
                $notif->createNotification("Adding an admin","An admin account has been Added");
            }

          }
    }

 
}
?>
 