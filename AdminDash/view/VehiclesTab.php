<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Vehicles Table</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap CSS and JavaScript -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Scrollable Column -->
        <style>
 /* Add this CSS to your existing stylesheet or style tag */
.popup-trigger {
    position: relative;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.popup-trigger:hover::before {
    content: attr(data-content);
    display: block;
    position: absolute;
    background-color: white;
    border: 1px solid #ccc;
    padding: 10px;
    max-width: 500px; /* Adjust the max width as needed */
    max-height: 300px; /* Adjust the max height as needed */
    overflow-y: auto;
    z-index: 1000;
    top: 100%; /* Position below the cell */
    left: 0;
    white-space: normal; /* Allow line breaks in the popup */
}

/* Hide the tooltip text in the normal state */
.popup-trigger::before {
    display: none;
}


</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <?php include '../includes/SideBar-TopBar.php'?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
    include_once '../Model/ConnectionController.php';
    include_once '../Controllers/AdminControllers/Vehicle.php';
      $vehObj = new Vehicle;
      $vehicles = $vehObj->viewVehicles();
      ?>
      <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vehicles Table</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Model</th>
                        <th>Car Type</th>
                        <th>Year</th>
                        <th>Color</th>
                        <th>Mileage</th>
                        <th>License Plate</th>
                        <th>Fuel Type</th>
                        <th>Transmission</th>
                        <th>Seating Capacity</th>
                        <th>Daily Rate</th>
                        <th>Availability</th>
                        <th>Location</th>
                        <th>Legal Documents</th>
                        <th>Admin Notes</th>
                        <!-- Add more headers for other columns -->
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Model</th>
                        <th>Car Type</th>
                        <th>Year</th>
                        <th>Color</th>
                        <th>Mileage</th>
                        <th>License Plate</th>
                        <th>Fuel Type</th>
                        <th>Transmission</th>
                        <th>Seating Capacity</th>
                        <th>Daily Rate</th>
                        <th>Availability</th>
                        <th>Location</th>
                        <th>Legal Documents</th>
                        <th>Admin Notes</th>
                        <!-- Add more headers for other columns -->
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <tr>
                            <td><?php echo $vehicle['CarID']; ?></td>
                            <td><?php echo $vehicle['CarModel']; ?></td>
                            <td><?php echo $vehicle['CarType']; ?></td>
                            <td><?php echo $vehicle['Year']; ?></td>
                            <td><?php echo $vehicle['Color']; ?></td>
                            <td><?php echo $vehicle['Mileage']; ?></td>
                            <td><?php echo $vehicle['LicensePlate']; ?></td>
                            <td><?php echo $vehicle['FuelType']; ?></td>
                            <td><?php echo $vehicle['Transmission']; ?></td>
                            <td><?php echo $vehicle['SeatingCapacity']; ?></td>
                            <td><?php echo $vehicle['DailyRate']; ?></td>
                            <td><?php echo $vehicle['Availability']; ?></td>
                            <td><?php echo $vehicle['Location']; ?></td>
                            <td><?php echo $vehicle['LegalDocuments']; ?></td>
                            <td class="popup-trigger"><?php echo $vehicle['AdminNotes']; ?></td>

                            <!-- Add more cells for other columns -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
</div>
 
                     
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
 