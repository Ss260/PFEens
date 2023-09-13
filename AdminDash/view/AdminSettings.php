<?php
 
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Settings</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        select, input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
        }

        hr {
            margin: 20px 0;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <?php include '../includes/SideBar-TopBar.php' ?>


        <!-- Begin Page Content -->
        <form action="../Controllers/ProcessingAdmin.php" method="post">
        <div class="container-fluid">
        <label for="adminSelect">Select an Admin:</label>
    <?php
         require_once '../Controllers/AdminControllers/Admin.php'; 

        // Create an instance of the Admin class
        $adminObj = new Admin();

        // Call the ViewAdmins method to retrieve the admin accounts
        $adminAccounts = $adminObj->ViewAdmins();
        ?>

        <!-- Drop-down to select an admin account -->
         <select id="adminSelect" name="adminID">
    <?php
    // Iterate through the admin accounts
    foreach ($adminAccounts as $admin) {
        echo '<option value="' . $admin['AdminID'] . '">' . $admin['AdminID'] . ' - ' . $admin['FirstName'] . ' ' . $admin['LastName'] . '</option>';
    }
    ?>
</select>
<div>
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" value="<?php echo $newFirstName ?? ''; ?>">
</div>
<div>
    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" value="<?php echo $newLastName ?? ''; ?>">
</div>
<div>
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $newEmail ?? ''; ?>">
</div>
<div>
    <label for="phoneNumber">Phone number:</label>
    <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $newPhoneNumber ?? ''; ?>">
</div>
<div>
    <label for="CIN">CIN:</label>
    <input type="text" id="CIN" name="CIN" value="<?php echo $newCIN ?? ''; ?>">
</div>
<div>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $newUsername ?? ''; ?>">
</div>
<div>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="">
</div>


    <!-- Add more input fields for LastName, Email, etc. -->

  <!-- Buttons -->
<button type="submit" name="showData">Show Data</button>
<button type="submit" name="update">Update</button>
<button type="submit" name="delete">Delete</button>
<hr>

<!-- Add Admin button -->
<button type="submit" name="addAdmin">Add Admin</button>
 
</form>
 




                     <!-- Include the JavaScript to display pop-up messages -->
                    <script src="display_messages.js"></script>
    
                    <!-- /.container-fluid -->
    
                </div>
                <!-- End of Main Content -->

                 <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; C-rental 2023</span>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>