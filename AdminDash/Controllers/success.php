<?php
session_start();
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Updated</title>
</head>
<body>
    <h1>Vehicle Updated</h1>
    <p><?php echo $message; ?></p>
</body>
</html>