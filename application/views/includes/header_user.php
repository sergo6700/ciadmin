<?php
    $user = $this->session->userdata('user_info');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/member/global.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo base_url(); ?>member/product"><h3>My Site</h3></a>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="<?php echo base_url(); ?>member/product"">Products</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>member/manufacturers"">Manufactures</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>member/categories"">Categories</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Filter</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <form>
                        <li>
                            <div class="form-group">
                                <select class="custom-select">
                                    <option selected>Brand</option>
                                    <?php foreach ($manufactures as $row){?>
                                         <option value="<?= $row['name']?>"><?= $row['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <select class="custom-select">
                                    <option selected>Model</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <input type="submit" class="btn btn-primary w-100" value="Search">
                        </li>
                    </form>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left m-2"></i>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify m-2"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav  ml-auto">

                        <li class="nav-item dropdown bg-info rounded ">
                            <a class="nav-link float-right m-2 row" href="#" id="navbardrop" data-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-user text-white "></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right bg-light no-border">
                                <a class="dropdown-item" href="<?= base_url(); ?>member/profiles">Profile</a>
                                <a class="dropdown-item" href="<?= base_url(); ?>member/products/list">Card</a>
                                <a class="dropdown-item" href="<?= base_url(); ?>admin/logout">Logout</a>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
