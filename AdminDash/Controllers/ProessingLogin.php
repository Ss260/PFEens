    <?php
    include '../Controllers/AdminControllers/Admin.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted form data
        $username = $_POST["Username"];
        $password = $_POST["Password"];

        // Create an instance of the Admin class
        $adminObj = new Admin();

        if ($adminObj->login($username, $password)) {
            // Login successful, redirect to the dashboard or any other page
            header("Location: ../AdminIndex.php");
            exit();
        } else {
            // Login failed, set the error message as a URL parameter
            $error_message = "Wrong username or password, try again";
            header("Location: ../Login.php?error=" . urlencode($error_message));
            exit();
        }
    }
    ?>

    
        