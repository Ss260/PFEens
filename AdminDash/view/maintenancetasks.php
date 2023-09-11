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

       <?php include '../includes/SideBar-TopBar.php' ?> 

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
    include_once '../Controllers/AdminControllers/Maintenance.php';
      $MainObj = new Maintenance;
      $maintenancelog= $MainObj->viewMaintenanceLog();

      ?>
      <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Maintenance Table</h6>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Task ID</th>
            <th>Car ID</th>
            <th>Task Type</th>
            <th>Due Date</th>
            <th>Completed</th>
            <th>Completion Date</th>
            <th>Action</th> <!-- Add a new column for buttons -->
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Task ID</th>
            <th>Car ID</th>
            <th>Task Type</th>
            <th>Due Date</th>
            <th>Completed</th>
            <th>Completion Date</th>
            <th>Action</th>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($maintenancelog as $maintenance): ?>
            <tr>
                <td><?php echo $maintenance['TaskID']; ?></td>
                <td><?php echo $maintenance['CarID']; ?></td>
                <td><?php echo $maintenance['TaskType']; ?></td>
                <td><?php echo $maintenance['DueDate']; ?></td>
                <td><?php echo $maintenance['Completed']; ?></td>
                <td><?php echo $maintenance['CompletionDate']; ?></td>
                <td>
    <!-- Done Button -->
    <form action="../Controllers/ProcessingMaintenance.php" method="POST" style="display: inline;">
        <input type="hidden" name="taskID" value="<?php echo $maintenance['TaskID']; ?>">
        <button type="submit" class="btn btn-success btn-sm" name="doneButton">Done</button>
    </form>

    <!-- Delete Button -->
    <form action="../Controllers/ProcessingMaintenance.php" method="POST" style="display: inline;">
        <input type="hidden" name="taskID" value="<?php echo $maintenance['TaskID']; ?>">
        <button type="submit" class="btn btn-danger btn-sm" name="deleteButton">Delete</button>
    </form>
</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

                     
                </div>
                <!-- /.container-fluid -->
          <!-- Add Task Button -->
<div class="card-footer">
    <a class="btn btn-primary" href="../includes/MaintenanceForm.php">Add Task</a>
</div>


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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
