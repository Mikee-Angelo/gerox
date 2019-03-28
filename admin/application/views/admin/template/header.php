<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="cache-control" content="max-age=0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="-1">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 11:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/concept/libs/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/vector-map/jqvmap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/jvectormap/jquery-jvectormap-2.0.2.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/datatables/css/select.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/datatables/css/fixedHeader.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/charts/morris-bundle/morris.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendors/concept/charts/c3charts/c3.css">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/industry/img/icon.png" sizes="128x128" />
    <title><?php echo $data['title']?></title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-info fixed-top">
                <a class="navbar-brand text-light" href="index.php">Gerox</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fas fa-ellipsis-v mr-2"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url();?>assets/industry/img/icon.png" class="user-avatar-md rounded-circle" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <a class="dropdown-item" href="<?php echo base_url();?>logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-light">
            <div class="menu-list">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-column">
                                <li class="nav-divider">
                                    Menu
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>admin" data-target="#submenu-3" aria-controls="submenu-3"><i class="fab fa-first-order text-info"></i>Transaction </a> 
                                </li>   

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>clients" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-user-circle text-info"></i>Clients</a> 
                                </li>  

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>reports" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-chart-line text-info"></i>Reports</a> 
                                </li> 

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>logs" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-newspaper text-info"></i>Logs</a> 
                                </li>   

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>logout" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-sign-out-alt text-info"></i>Logout</a> 
                                </li>  
                            <ul>
                        </div>
                    </nav>
                </div>
            </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->