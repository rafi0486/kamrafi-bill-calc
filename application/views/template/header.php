<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="EXAM AWAY">
    <meta name="author" content="Creative Tim">
    <title><?=$this->config->item('app_name')?></title>
    <!-- Favicon -->
    <link rel="icon" href="<?=base_url("assets/admin/")?>img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="<?=base_url("assets/admin/")?>fonts/open-sans.css">
    <!-- Icons -->
    <link rel="stylesheet" href="<?=base_url("assets/admin/")?>vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?=base_url("assets/admin/")?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <link rel="stylesheet" href="<?=base_url("assets/admin/")?>css/theme.css?v=1.2.0" type="text/css">


    <!-- Core -->
    <script>
        HOST_URL="<?=base_url()?>";
    </script>
    <style>
        @media print {
            #sidenav-main,.header{
                visibility: collapse;
            }
            .no-print{
                visibility: collapse;
                height:0px;
            }
        }

    </style>


</head>

<body>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="<?=base_url("assets/admin/")?>img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("billing")?>">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("billing/activities")?>">
                            <i class="ni ni-planet text-orange"></i>
                            <span class="nav-link-text">Activities</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("billing/rates")?>">
                            <i class="ni ni-bullet-list-67 text-primary"></i>
                            <span class="nav-link-text">Rates</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("billing/client_rates")?>">
                            <i class="ni ni-app text-primary"></i>
                            <span class="nav-link-text">Client Rates</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("billing/invoice")?>">
                            <i class="ni ni-app text-primary"></i>
                            <span class="nav-link-text">Billing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url("admin/qadmin/students")?>">
                            <i class="ni ni-single-02 text-yellow"></i>
                            <span class="nav-link-text">..</span>
                        </a>
                    </li>

                </ul>
                <!-- Divider -->

            </div>
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                <ul class="navbar-nav align-items-center  ml-md-auto ">
                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>

                </ul>
                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="<?=base_url("assets/admin/")?>img/theme/user.png">
                  </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?=$this->session->userdata('examnr_alias')?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <?php
                            if(1==2){
                                ?>
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>My profile</span>
                                </a>
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Settings</span>
                                </a>
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-calendar-grid-58"></i>
                                    <span>Activity</span>
                                </a>
                                <a href="#!" class="dropdown-item">
                                    <i class="ni ni-support-16"></i>
                                    <span>Support</span>
                                </a>
                                <?php
                            }
                            ?>

                            <div class="dropdown-divider"></div>
                            <a href="<?=base_url("examinerlogin/logout")?>" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header -->
