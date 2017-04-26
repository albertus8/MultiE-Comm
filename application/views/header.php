<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MultiE-Comm</title>

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.1.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/ext/moment.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/ext/transition.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/ext/bootstrap-collapse.js"); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <script type="text/javascript" src="<?php echo base_url("assets/js/plugins/morris/raphael.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/plugins/morris/morris.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/js/plugins/morris/morris-data.js"); ?>"></script>

    <!-- External DatePicker JavaScript -->
    <script src="<?php echo base_url("assets/js/ext/bootstrap-datepicker.js"); ?>"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/sb-admin.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/ext/bootstrap-datetimepicker.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/ext/bootstrap-datetimepicker.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("assets/css/ext/datepicker.css"); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets/css/plugins/morris.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdxz4UYsbPHqdXW4syGL29cDvsuD19Gs0&callback="
            type="text/javascript"></script>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
    <!-- Bootstrap Core JavaScript -->

    <script type="text/javascript">
        $( document ).ready(function() {
            $(".container-fluid").hide().fadeIn('slow');

            // Data Tables
            $( "#datatables" ).click(function() {
                $(".collapse .active").removeClass("active");
                $(this).addClass("active");
                $(".container-fluid").load("Tables",function(){}).hide().fadeIn('slow');
            });
            // Charts
            $( "#charts" ).click(function() {
                $(".collapse .active").removeClass("active");
                $(this).addClass("active");
                $(".container-fluid").load("Charts",function(){}).hide().fadeIn('slow');
            });
            // Database Setting
            $( "#dbsetting" ).click(function() {
                $(".collapse .active").removeClass("active");
                $(this).addClass("active");
                $(".container-fluid").load("Setting",function(){}).hide().fadeIn('slow');
            });
            // Monthly Reports
            $( "#monthly" ).click(function() {
                $(".collapse .active").removeClass("active");
                $(this).addClass("active");
                $(".container-fluid").load("Report/Monthly",function(){}).hide().fadeIn('slow');
            });
            // Weekly Reports
            $( "#weekly" ).click(function() {
                $(".collapse .active").removeClass("active");
                $(this).addClass("active");
//                $(".container-fluid").fadeOut{'slow'};
                $(".container-fluid").load("Report/Weekly",function(){}).hide().fadeIn('slow');
            });
            // Contact Developer
            $( "#contactdev" ).click(function() {
                $(".collapse .active").removeClass("active");
                $(this).addClass("active");
                $(".container-fluid").load("Contact",function(){}).hide().fadeIn('slow');
            });

            // profile page
            $( "#userprofile" ).click(function() {
                $(".container-fluid").load("UserProfile",function(){}).hide().fadeIn('slow');
            });
        });
    </script>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="Home">Multi E-Commerce Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong><?php echo $firstname ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong><?php echo $firstname ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong><?php echo $firstname ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
                <li>
                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">View All</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo "&nbsp;".$firstname ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li id="userprofile" style="cursor: pointer;">
                    <a><i class="fa fa-fw fa-user"></i> User Profile</a>
                </li>
                <!--                        <li>-->
                <!--                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>-->
                <!--                        </li>-->
<!--                <li>-->
<!--                    <a href="#"><i class="fa fa-fw fa-gear"></i> User Settings</a>-->
<!--                </li>-->
                <li class="divider"></li>
                <li>
                    <a href="Logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="Home"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li id="charts">
                <a><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
            </li>
            <li id="datatables" style="cursor: pointer;">
                <a><i class="fa fa-fw fa-table"></i> Data Tables</a>
            </li>
            <!--                    <li>-->
            <!--                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>-->
            <!--                    </li>-->
            <!--                    <li>-->
            <!--                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>-->
            <!--                    </li>-->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-file"></i> Analytic Reports <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li id="weekly" style="cursor: pointer;">
                        <a>Weekly Report</a>
                    </li>
                    <li id="monthly" style="cursor: pointer;">
                        <a>Monthly Report</a>
                    </li>
                </ul>
            </li>

<!--                --><?php
//                echo form_open('setting');
//                    echo "<li>";
//                    echo "<a href='Setting'><i class='fa fa-fw fa-cogs'></i> DB Connection Setting </a>";
//                    echo "</li>";
//                echo form_close();
//                ?>
            <li id="dbsetting" style="cursor: pointer;">
                <a><i class='fa fa-fw fa-cogs'></i> DB Connection Setting </a>
            </li>

            <li id="contactdev" style="cursor: pointer;">
                <a><i class="fa fa-fw fa-envelope-o"></i> Contact Developer </a>
            </li>
            <!--                    <li>-->
            <!--                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>-->
            <!--                    </li>-->
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>


