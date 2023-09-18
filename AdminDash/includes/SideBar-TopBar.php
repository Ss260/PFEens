 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/C-rental/AdminDash/AdminIndex.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">C-rental  </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="/C-rental/AdminDash/AdminIndex.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Vehicle:</h6>
            <a class="collapse-item" href="/C-rental/AdminDash/view/AddVehicle.php">Add Vehicule</a>
            <a class="collapse-item" href="/C-rental/AdminDash/view/DeleteVehicle.php">Delete Vehicule</a>
            <a class="collapse-item" href="/C-rental/AdminDash/view/UpdateVehicle.php">Update Vehicule</a>
        </div>
    </div>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTables" aria-expanded="true" aria-controls="collapseTables">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span>
    </a>
    <div id="collapseTables" class="collapse" aria-labelledby="headingTables" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tables:</h6>
            <a class="collapse-item" href="/C-rental/AdminDash/view/VehiclesTab.php">Vehicles</a>
            <a class="collapse-item" href="/C-rental/AdminDash/view/BookingsTab.php">Bookings</a>
            <!-- <a class="collapse-item" href="/C-rental/AdminDash/view/LogsTab.php">Logs</a> -->
            <a class="collapse-item" href="/C-rental/AdminDash/view/maintenancetasks.php">Maintenance</a>
            <a class="collapse-item" href="/C-rental/AdminDash/view/ClientsTab.php">Clients</a>
        </div>
    </div>
</li>


<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="/C-rental/AdminDash/view/AdminSettings.php">Admin Management</a>
            <!-- <a class="collapse-item" href="utilities-border.html">Profile</a> -->
            <a class="collapse-item" href="utilities-animation.html">Chart Settings</a>
            <!-- <a class="collapse-item" href="utilities-other.html">Other</a> -->
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Client Side
</div>

 

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="/C-rental/AdminDash/view/PendingRequests.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Pending Requests</span></a>
</li>
<!-- Heading -->
<div class="sidebar-heading">
   Managing Tasks
</div>
<li class="nav-item">
    <a class="nav-link" href="/C-rental/AdminDash/view/ManagingTasks.php">
        <i class="fas fa-fw fa-cog"></i>
        <span>Live Tasks</span></a>
</li>
 
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul>
<!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

         <!-- Nav Item - Alerts -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdownToggle" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">5+</span>
    </a>
    <!-- Dropdown - Alerts -->
    <script>
    $(document).ready(function() {
        // Initially hide the notification container
        $("#notificationsContainer").hide();

        // Click event to toggle the visibility of the notification container
        $("#alertsDropdownToggle").on("click", function(e) {
            e.preventDefault();
            $("#notificationsContainer").toggle();
        });

        // Close the notification container when clicking outside of it
        $(document).on("click", function(e) {
            if (
                !$("#alertsDropdownToggle").is(e.target) &&
                !$("#notificationsContainer").is(e.target) &&
                $("#notificationsContainer").has(e.target).length === 0
            ) {
                $("#notificationsContainer").hide();
            }
        });
    });
    console.log("JavaScript code executed");

    </script>

     

    <!-- Notification container -->
    <div id="notificationsContainer" class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
        <?php 
            include_once __DIR__ . '/../Controllers/AdminControllers/Notifications.php';
            $notificationsObj = new Notifications();
            $notifications = $notificationsObj->getNotifications();
            
            foreach ($notifications as $notification) {
                echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                echo '<div class="mr-3">';
                echo '<div class="icon-circle bg-primary">';
                // Add an icon based on the notification type, if needed
                echo '<i class="fas fa-file-alt text-white"></i>';
                echo '</div>';
                echo '</div>';
                echo '<div>';
                echo '<div class="small text-gray-500">' . $notification['Timestamp'] . '</div>';
                echo '<span class="font-weight-bold">' . $notification['Message'] . '</span>';
                echo '</div>';
                echo '</a>';
            }
        ?>
    </div>
</li>
            
            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php
                    if (isset($_SESSION['admin_username'])) {
                        $adminName = $_SESSION['admin_username'];
                        echo $adminName; // Display the admin's name
                    }
                  ?>
                    </span>
                    <img class="img-profile rounded-circle"
                        src="/AdminDash/img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <!-- <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a> -->
                    <a class="dropdown-item" href="/C-rental/AdminDash/view/AdminSettings.php">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <!-- <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->
 

</body>
</html>