<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/industry/img/icon.png" sizes="128x128" />
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
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="index.html"><img src="<?php echo base_url();?>assets/concept/images/newlogo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">

                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </li>
                        
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url();?>assets/industry/img/icon.png" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $this->session->userdata('name')?></h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
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
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                    <nav class="navbar navbar-expand-lg navbar-light">
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
                                    <a class="nav-link" href="<?php echo base_url();?>user" data-target="#submenu-3" aria-controls="submenu-3"><i class="fab fa-first-order"></i>Orders</a>      
                                </li>   

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>shop" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-shopping-cart"></i>Shop Now</a>      
                                </li>  

                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url();?>settings" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-shopping-cart"></i>Settings</a>      
                                </li>   
                            <ul>
                        </div>
                    </nav>
                </div>
            </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->