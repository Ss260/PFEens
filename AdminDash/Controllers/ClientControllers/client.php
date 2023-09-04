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
class client{
    private $conn;  

    public function __construct() {
        $this->conn = getConnection("localhost", "root", "", "rental");
    }

    public function viewClients() {
        try {
            $query = "SELECT * FROM clients";
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
    public function AddClient($firstName, $lastName, $email, $phoneNumber) {
        $query = "INSERT INTO Clients (FirstName, LastName, Email, PhoneNumber)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $phoneNumber);
    
        if ($stmt->execute()) {
            // After successfully inserting the client, retrieve the last inserted ID
            $clientID = $this->conn->insert_id;
            return $clientID; // Return the ClientID
        } else {
            return false; // Error occurred
        }
    }
    
    public function getClientData($clientID){
        try {
            $stmt = $this->conn->prepare("SELECT * from clients WHERE ClientID = ?");
            $stmt->bind_param("i", $clientID);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                return $data;
            } else {
                return false;  
            }
        } catch (Exception $e) {
            throw $e;
        } finally {
            if ($stmt) {
                $stmt->close();
            }
        }
    }
    
    public function sendBookingEmailConfirmation($email, $fullName, $bookingID, $carModel, $pickupDateTime, $returnDateTime, $totalAmount, $pickupLocation, $returnLocation) {
        // Create a message
        $msg = "<html>
        <head>
          <title>Your Booking Confirmation at C-Rental</title>
        </head>
        <body>
          <p>Hello,</p>
          
          <p>We are thrilled to inform you that your booking request has been successfully received by C-Rental. </p>
          
          <ul>
            <li><strong>Booking ID:</strong> $bookingID</li>
            <li><strong>Car Model:</strong> $carModel</li>
            <li><strong>Pickup Date and Time:</strong> $pickupDateTime</li>
            <li><strong>Return Date and Time:</strong> $returnDateTime</li>
            <li><strong>Total Amount:</strong> $totalAmount</li>
            <li><strong>Pickup Location:</strong> $pickupLocation</li>
            <li><strong>Return Location:</strong> $returnLocation</li>
          </ul>
          
          <p>Our team is dedicated to providing you with exceptional service, and we want to assure you that your request is important to us. Our experts will review your booking within the next 24 hours and ensure that everything is in order.</p>
          
          <p>If you have any questions or need further assistance, please don't hesitate to contact our customer support team at <a href='mailto:support@C-rental.com'>support@C-rental.com</a> or +212 6 98 78 46 22.</p>
          
          <p>Thank you for choosing C-Rental. We look forward to serving you and making your upcoming journey memorable.</p>
          
          <p>Best regards,<br>C-Rental Customer Support Team</p>
        </body>
        </html>";
        
    
        // Send email
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
        $mail->addAddress($email, $fullName);
        $mail->isHTML(true); // Set email format to HTML
    
        $mail->Subject = 'Your Booking Status at C-Rental';
        $mail->Body    = $msg;
    
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  

            $mail->send();
         } catch (Exception $e) {
            echo 'Email sending failed: ', $e->getMessage();
        }
    }
    public function sendBookingRefusalEmail($email, $fullName, $bookingID) {
        // Create a message
        $msg = "<html>
        <head>
          <title>Your Booking Status at C-Rental</title>
        </head>
        <body>
          <p>Hello $fullName,</p>
          
          <p>We regret to inform you that your booking request (Booking ID: $bookingID) has been refused by C-Rental.</p>
          
          <p>If you have any questions or need further assistance, please don't hesitate to contact our customer support team at <a href='mailto:support@C-rental.com'>support@C-rental.com</a> or +212 6 98 78 46 22.</p>
          
          <p>Thank you for considering C-Rental, and we hope to have the opportunity to serve you in the future.</p>
          
          <p>Best regards,<br>C-Rental Customer Support Team</p>
        </body>
        </html>";
    
        // Send email
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
        $mail->addAddress($email, $fullName);
        $mail->isHTML(true); // Set email format to HTML
    
        $mail->Subject = 'Your Booking Status at C-Rental';
        $mail->Body    = $msg;
    
        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  

            $mail->send();
         } catch (Exception $e) {
            echo 'Email sending failed: ', $e->getMessage();
        }
    }
    public function sendBookingAcceptationEmail($email, $fullName, $bookingID, $carModel, $pickupDateTime, $returnDateTime, $totalAmount, $pickupLocation, $returnLocation) {
        // Create a message
        $msg = "<html>
        <head>
          <title>Your Booking Confirmation at C-Rental</title>
        </head>
        <body>
          <p>Hello $fullName,</p>
          
          <p>We are thrilled to inform you that your booking request has been accepted by C-Rental. Here are the details of your booking:</p>
          
          <ul>
            <li><strong>Booking ID:</strong> $bookingID</li>
            <li><strong>Car Model:</strong> $carModel</li>
            <li><strong>Pickup Date and Time:</strong> $pickupDateTime</li>
            <li><strong>Return Date and Time:</strong> $returnDateTime</li>
            <li><strong>Total Amount:</strong> $totalAmount</li>
            <li><strong>Pickup Location:</strong> $pickupLocation</li>
            <li><strong>Return Location:</strong> $returnLocation</li>
          </ul>
          
          <p>Your booking is now confirmed, and you can proceed with your plans. If you have any questions or need further assistance, please don't hesitate to contact our customer support team at <a href='mailto:support@C-rental.com'>support@C-rental.com</a> or +212 6 98 78 46 22.</p>
          
          <p>Thank you for choosing C-Rental. We look forward to serving you and making your upcoming journey memorable.</p>
          
          <p>Best regards,<br>C-Rental Customer Support Team</p>
        </body>
        </html>";
    
       // Send email
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
       $mail->addAddress($email, $fullName);
       $mail->isHTML(true); // Set email format to HTML
   
       $mail->Subject = 'Your Booking Status at C-Rental';
       $mail->Body    = $msg;
   
       try {
           //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  

           $mail->send();
        } catch (Exception $e) {
           echo 'Email sending failed: ', $e->getMessage();
       }
    }
        
}
