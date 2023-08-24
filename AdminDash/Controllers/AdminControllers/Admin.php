<?php
require_once '../../Model/ConnectionController.php'; 

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "rental";

// Establish database connection
$conn = getConnection($servername, $username, $password, $database);

// Function to add an admin
function AddAdmin($firstName, $lastName, $email, $phoneNumber, $cin, $username, $password) {
    global $conn;
    
    try {

        // Prepare and execute the query
        $stmt = $conn->prepare("INSERT INTO Admin (FirstName, LastName, Email, PhoneNumber, CIN, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstName, $lastName, $email, $phoneNumber, $cin, $username, $password);
        
        if ($stmt->execute()) {
            echo "Admin added successfully.";
        } else {
            throw new Exception("Error adding admin: " . $stmt->error);
        }
        
        $stmt->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

// Function to delete an admin
function DeleteAdmin($adminID) {
    global $conn;
    
    try {
        // Validate and sanitize input data
        // ...

        // Prepare and execute the query
        $stmt = $conn->prepare("DELETE FROM Admin WHERE AdminID = ?");
        $stmt->bind_param("i", $adminID);
        
        if ($stmt->execute()) {
            echo "Admin deleted successfully.";
        } else {
            throw new Exception("Error deleting admin: " . $stmt->error);
        }
        
        $stmt->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

// Function to update admin information
function UpdateAdminInfo($adminID, $newFirstName, $newLastName, $newEmail, $newPhoneNumber, $newCIN, $newUsername, $newPassword) {
    global $conn;
    
    try {
        // Validate and sanitize input data
        // ...

        // Prepare and execute the query
        $stmt = $conn->prepare("UPDATE Admin SET FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ?, CIN = ?, Username = ?, Password = ? WHERE AdminID = ?");
        $stmt->bind_param("sssssssi", $newFirstName, $newLastName, $newEmail, $newPhoneNumber, $newCIN, $newUsername, $newPassword, $adminID);
        
        if ($stmt->execute()) {
            echo "Admin information updated successfully.";
        } else {
            throw new Exception("Error updating admin information: " . $stmt->error);
        }
        
        $stmt->close();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

//AddAdmin("Soufian", "Amrous", "amrsfn26@gmail.com", "0679419165", "R369142", "Ss26", "Admin123");

?>
