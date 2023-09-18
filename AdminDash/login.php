<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style>
    .custom-form {
        width: 100%;
        padding: 0px; /* Adjust the padding to increase stretching */
       }
</style>
<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <!-- Include the login form here -->
                                    <div class="container-fluid mt-5 custom-form"> <!-- Use 'container-fluid' for horizontal stretching -->
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="card-header">Login</div>
                                                    <div class="card-body">
                                                        <form action="Controllers/ProessingLogin.php" method="post">
                                                            <div class="form-group">
                                                                <label for="Username">Username</label>
                                                                <input type="text" class="form-control form-control-lg" id="Username" name="Username" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Password">Password</label>
                                                                <input type="password" class="form-control form-control-lg" id="Password" name="Password" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
                                                        </form>
                                                        <div class="text-center mt-3">
                                                            <a href="#">Forgot Password?</a> <br>
                                                            <a href="../index.php">Back</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of login form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Check if the URL parameter 'error' exists
        const urlParams = new URLSearchParams(window.location.search);
        const errorParam = urlParams.get('error');

        // Check if the error parameter is not null or empty
        if (errorParam) {
            // Display the error message as a JavaScript alert
            alert(errorParam);
        }
    </script>
</body>
</html>
  
</body>

 
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>