<?php   

function getConnection($servername, $username, $password, $database) {
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn; // Return the connection object
}



//Call the function with the appropriate values
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "rental";

// getfunction($servername, $username, $password, $database);

?>
