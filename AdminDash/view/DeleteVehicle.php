<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .table-responsive {
            overflow-x: auto;
        }

    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <?php include '../includes/SideBar-TopBar.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                        <!-- Form Css Start -->
                        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
                        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
                        <style>
                          h1 {
                        position: absolute;
                        margin: 0;
                        font-size: 36px;
                        color: #fff;
                        z-index: 2;
                        }
                        span.required {
                        color: red;
                        }
                        .testbox {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: inherit;
                        padding: 20px;
                        }
                        form {
                        width: 100%;
                        padding: 20px;
                        border-radius: 6px;
                        background: #fff;
                        box-shadow: 0 0 30px 0 #095484; 
                        }
                        .banner {
                        position: relative;
                        height: 180px;
                        background-image: url("/uploads/media/default/0001/01/9e07ce3a601795a5ac09a66a0c1fc8978e0ee51a.jpeg");  
                        background-size: cover;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        text-align: center;
                        }
                        .banner::after {
                        content: "";
                        background-color: rgba(0, 0, 0, 0.4); 
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        }
                        p.top-info {
                        margin: 10px 0;
                        }
                        input, select {
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 3px;
                        }
                        input {
                        width: calc(100% - 10px);
                        padding: 5px;
                        }
                        select {
                        width: 100%;
                        padding: 7px 0;
                        background: transparent;
                        }
                        .item:hover p, .question:hover p, .question label:hover, input:hover::placeholder {
                        color: #095484;
                        }
                        .item input:hover, .item select:hover {
                        border: 1px solid transparent;
                        box-shadow: 0 0 5px 0 #095484;
                        color: #095484;
                        }
                        .item {
                        position: relative;
                        margin: 10px 0;
                        }
                        .question input {
                        width: auto;
                        margin: 0;
                        border-radius: 50%;
                        }
                        .question input, .question span {
                        vertical-align: middle;
                        }
                        .question label {
                        display: inline-block;
                        margin: 5px 20px 15px 0;
                        }
                        .btn-block {
                        margin-top: 10px;
                        text-align: center;
                        }
                        button {
                        width: 150px;
                        padding: 10px;
                        border: none;
                        border-radius: 5px; 
                        background: #095484;
                        font-size: 16px;
                        color: #fff;
                        cursor: pointer;
                        }
                        button:hover {
                        background: #0666a3;
                        }
                        @media (min-width: 568px) {
                        .name-item, .city-item {
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between;
                        }
                        .name-item input, .city-item input {
                        width: calc(50% - 20px);
                        }
                        .city-item select {
                        width: calc(50% - 8px);
                        }
                        }
                        </style>
                        <!-- Form Css End -->

                        <?php
                        require_once '../Controllers/AdminControllers/Vehicle.php';
                            $vehicleObj = new Vehicle();
                            $vehicles = $vehicleObj->viewVehicles();
                            ?>
                            <!-- Display the table of vehicles -->
                         
                    <!-- Form Example-->
                    <div class="testbox" class="table-responsive">
                        <form action="../Controllers/Processing.php"  method="post" enctype="multipart/form-data">
                          <div class="banner">
                            <h1>Delete Vehicle</h1>
                          </div>
                          <div class="item">
                          <style>
                                    table {
                                        border-collapse: collapse;
                                        width: 100%;
                                        border: 1px solid #dddddd;
                                        font-family: Arial, sans-serif;
                                    }

                                    th, td {
                                        border: 1px solid #dddddd;
                                        text-align: left;
                                        padding: 8px;
                                    }

                                    th {
                                        background-color: #f2f2f2;
                                    }

                                    tr:nth-child(even) {
                                        background-color: #f2f2f2;
                                    }

                                    tr:hover {
                                        background-color: #ddd;
                                    }
                                    
                                </style>
                            <table border="1">
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
                                  <th>Location</th>
                                <th>Admin Notes</th>
                                <th>Legal Documents</th>
                            </tr>
                            
                            <?php foreach ($vehicles as $vehicle) : ?>
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
                                  <td><?php echo $vehicle['Location']; ?></td>
                                <td><?php echo $vehicle['AdminNotes']; ?></td>
                                <td><?php echo $vehicle['LegalDocuments']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                            <p>Car ID : <span class="required">*</span></p>
                            <div class="name-item">
                              <input type="text" name="CarId" required/>
                            </div>
                          
                          <div class="btn-block">
                          <button type="submit" name="operation" value="DeleteVehicle">Delete</button>
                          </div>
                        </form>
                      </div>
                </div>
                <!-- Include the JavaScript to display pop-up messages -->

                <script src="display_messages.js"></script>

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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>