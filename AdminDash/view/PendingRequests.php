<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>
    <style>
    h1 {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    th {
        background-color: #3498db; /* Blue */
        color: white;
    }

    td .accept-button {
        background-color: #3498db; /* Blue */
        border: none;
        color: white;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        border-radius: 4px;
        margin-bottom: 5px;
    }

    td .accept-button:hover {
        background-color: #2980b9; /* Darker Blue */
    }

    td .refuse-button {
        background-color: #e74c3c; /* Red */
        border: none;
        color: white;
        padding: 6px 12px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        border-radius: 4px;
    }

    td .refuse-button:hover {
        background-color: #c0392b; /* Darker Red */
    }
</style>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap CSS and JavaScript -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <?php include '../includes/SideBar-TopBar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1>Pending Booking Requests</h1>
                   

                    <?php
                    // Call the getPendingBookings method to retrieve pending bookings
                    require_once '../Controllers/AdminControllers/Booking.php'; 
                    $bookingObj = new Booking();
                    $pendingBookings = $bookingObj->getPendingBookings();
                    ?>
                   <?php if (!empty($pendingBookings)) : ?>
                    <table class="styled-table">
    <thead>
        <tr>
            <th class="blue-text">Booking ID</th>
            <th class="blue-text">Car ID</th>
            <th class="blue-text">Client ID</th>
            <th class="blue-text">Pickup Date and Time</th>
            <th class="blue-text">Return Date and Time</th>
            <th class="blue-text">Total Amount</th>
            <th class="blue-text">Pickup Location</th>
            <th class="blue-text">Return Location</th>
            <th class="blue-text">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pendingBookings as $booking) : ?>
            <tr>
                <td><?php echo $booking['BookingID']; ?></td>
                <td><?php echo $booking['CarID']; ?></td>
                <td><?php echo $booking['ClientID']; ?></td>
                <td><?php echo $booking['PickupDateTime']; ?></td>
                <td><?php echo $booking['ReturnDateTime']; ?></td>
                <td><?php echo $booking['TotalAmount']; ?></td>
                <td><?php echo $booking['PickupLocation']; ?></td>
                <td><?php echo $booking['ReturnLocation']; ?></td>
                <td>
                    <!-- Form for Accept -->
                    <form action="../Controllers/ProcessingRequests.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="booking_id" value="<?php echo $booking['BookingID']; ?>">
                        <input type="hidden" name="operation" value="Accept">
                        <!-- //Sending necessary Data for email method : -->
                         <input type="hidden" name="ClientID" value="<?php echo $booking['ClientID']; ?>">

                        <button type="submit" class="accept-button blue-button">Accept</button>
                    </form>
                    
                    <!-- Form for Refuse -->
                    <form action="../Controllers/ProcessingRequests.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="booking_id" value="<?php echo $booking['BookingID']; ?>">
                        <input type="hidden" name="operation" value="Refuse">
                         <!-- Sending necessary Data for email method : -->
                         <input type="hidden" name="ClientID" value="<?php echo $booking['ClientID']; ?>">

                        <button type="submit" class="refuse-button red-button">Refuse</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php else : ?>
    <p>No pending bookings found.</p>
<?php endif; ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>