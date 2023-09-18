<script src="../../js/popup.js"></script>

<?php
 require '../../vendor/autoload.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP;
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
                echo "<script>showAlert('Admin Added Successfully', '../view/AdminSettings.php');</script>";
            } else {
                throw new Exception("<script>showAlert('Error Adding Admin', '../view/AdminSettings.php');</script>" . $stmt->error);
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
                echo "<script>showAlert('Admin Deleted Successfully', '../view/AdminSettings.php');</script>";
            } else {
                throw new Exception("<script>showAlert('Error Deleting Admin', '../view/AdminSettings.php');</script>". $stmt->error);
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
                echo "<script>showAlert('Admin Deleted Successfully', '../view/AdminSettings.php');</script>";
            } else {
                throw new Exception("<script>showAlert('Error Updating Admin', '../view/AdminSettings.php');</script>". $stmt->error);
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
                        // Passwords match, set a session variable to indicate authentication
                        $_SESSION['user_authenticated'] = true;
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

     
    public function logout() {
        // Destroy the session and log the user out
        session_unset();
        session_destroy();
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

public function ReceiveClientMessage($fullName, $email, $subject,$msg) {
    $emailContent = "<html>
    <head>
        <title>New Client Complaint at C-Rental</title>
    </head>
    <body>
        <p>Hello,</p>
        <p>You have received a new complaint from a client at C-Rental:</p>
        <ul>
            <li><strong>Name:</strong> $fullName</li>
            <li><strong>Email:</strong> $email</li>
            <li><strong>Subject:</strong> $subject</li>
            <li><strong>Message:</strong> $msg</li>
        </ul>
        <p>Please respond to the client's complaint as soon as possible.</p>
        <p>Best regards,<br>C-Rental Notification</p>
    </body>
    </html>";
    // Send email to client
    $mail = new PHPMailer(true);

    // Gmail SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'amrsfn26@gmail.com'; // Replace with your Gmail email
    $mail->Password   = 'ntjirwvcdobovwkl'; // Replace with your Gmail password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('amrsfn26@gmail.com', 'C-rental');
    $mail->addAddress('amrsfn26@gmail.com', $fullName); // Send a copy to the client's email address

    $mail->isHTML(true); // Set email format to HTML

    $mail->Subject = 'New Client Complaint at C-Rental';
    $mail->Body    =  $emailContent;

    // Send email to client and handle errors separately
    try {
         $mail->send();
         echo "<script>showAlert(\"Email sent to C-rental's Support Team\", '../../contact.php');</script>";
        } catch (Exception $e) {
            echo "<script>showAlert(\"Unable to send email to C-rental's Support Team\", '../../contact.php');</script>";
        }
}


}
?>
