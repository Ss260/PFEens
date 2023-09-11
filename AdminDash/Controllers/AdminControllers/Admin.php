<?php
if (file_exists(__DIR__ . '/../../Model/ConnectionController.php')) {
    require_once __DIR__ . '/../../Model/ConnectionController.php';
} else {
    echo "ConnectionController.php not found!";
}


class Admin
{
    private $conn;

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }

    public function AddAdmin($firstName, $lastName, $email, $phoneNumber, $cin, $username, $password)
    {
        try {
            // Prepare and execute the query
            $stmt = $this->conn->prepare("INSERT INTO Admin (FirstName, LastName, Email, PhoneNumber, CIN, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?)");
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

    public function DeleteAdmin($adminID)
    {
        try {
            // Validate and sanitize input data
            // ...

            // Prepare and execute the query
            $stmt = $this->conn->prepare("DELETE FROM Admin WHERE AdminID = ?");
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

    public function UpdateAdminInfo($adminID, $newFirstName, $newLastName, $newEmail, $newPhoneNumber, $newCIN, $newUsername, $newPassword)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE Admin SET FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ?, CIN = ?, Username = ?, Password = ? WHERE AdminID = ?");
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

    public function login($username, $password)
    {
        try {
            // Sanitize input
            $username = mysqli_real_escape_string($this->conn, $username);
    
            // Prepare and execute the query
            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE Username = ?");
            $stmt->bind_param("s", $username);
    
            if ($stmt->execute()) {
                $result = $stmt->get_result();
    
                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
    
                    // Compare the provided password with the stored plain text password
                    if ($password === $row['Password']) {
                        // Passwords match, login successful
                        return true;
                    }
                }
            } else {
                throw new Exception("Error executing login query: " . $stmt->error);
            }
    
            return false; // Login failed
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
            return false;
        }
    }
    public function ViewAdmins() {
 
    try {
        // Prepare and execute the query to fetch admin accounts
        $stmt = $this->conn->prepare("SELECT AdminID, FirstName, LastName FROM admin");
        $stmt->execute();
        $result = $stmt->get_result();

        $adminAccounts = array();

        // Check if there are any admin accounts
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $adminAccounts[] = $row;
            }
        }

        return $adminAccounts;
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}
public function GetAdminData($adminID)
{
    try {
        // Prepare and execute the query to fetch admin data by AdminID
        $stmt = $this->conn->prepare("SELECT * FROM admin WHERE AdminID = ?");
        $stmt->bind_param("i", $adminID);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there is admin data
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            throw new Exception("Admin not found with ID: " . $adminID);
        }
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        return array(); // Return an empty array in case of an error
    }
}
public function getAdminName($username) {
    $query = "SELECT FirstName, LastName FROM admin WHERE Username = ?";
    
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $username);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['FirstName'] . ' ' . $row['LastName'];
        }
    }
    
    return false; // Return false if the admin's name is not found
}
}

?>
