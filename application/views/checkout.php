<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
?>
<html>
<head>
    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url("assets/js/jquery-3.2.1.js"); ?>"></script>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("assets/css/ext/bs4/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("assets/css/agency.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">

    <!-- Temporary navbar container fix -->
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
    </style>

    <script type="text/javascript">
        $( document ).ready(function() {
            $( "#reviewBrd" ).click(function() {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });
            $( "#confirmationBrd" ).click(function() {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });
            $( "#paymentBrd" ).click(function() {
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
            });

            $('#toLogin').click(function(){
                $.ajax({
                    url: 'Checkout/extFrom',
                    type: 'post',
                    success: function(result) {
                        window.location.href = 'Login';
                    }
                });
            });
            $('#toRegister').click(function(){
                $.ajax({
                    url: 'Checkout/extFrom',
                    type: 'post',
                    success: function(result) {
                        window.location.href = 'Login';
                    }
                });
            });
        });
    </script>
</head>
<body id="page-top">
<!-- Navigation -->
<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse" id="mainNav" style="background-color: #0f0f0f">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand" href="Landing">MECO</a>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" id="reviewBrd" href="#review">Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="paymentBrd" href="#payment">Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="confirmationBrd" href="#confirmation">Confirmation</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Team -->
<section id="review">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id="extFrom">
                <h2 class="section-heading">Review</h2>

                <?php
                    if(!$data){
                        ?>
                        <h3 class="section-subheading text-muted">Login required. Have an account? Login <a id="toLogin" href="Login">here</a> or Register <a id="toRegister" href="Register">here</a></h3>
                        <?php
                    }else{
                        ?>
                        <h3 class="section-subheading text-muted">You have logged in as <?php echo $data['firstname']." ".$data['lastname']; ?></h3>
                        <?php
                    }
                ?>

            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="team-member">
<!--                    <img class="mx-auto rounded-circle" src="img/team/Untitled-1.jpg" alt="">-->

                   <?php
                        if(!$package){
                            ?>
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                            </span>
                            <?php

                            echo "<h4>Free</h4>";
                        }else{
                            ?>
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                            </span>
                            <?php
                            echo "<h4>".$package['Nama Paket']."</h4>";
                        }
                   ?>

                    <p class="text-muted">IDR <?php echo number_format($package['Harga'],2,',','.'); ?> /month</p>
                    <div class="control-group">
                        <div class='input-group'>
                            <input type='text' class='form-control' placeholder='Jumlah Bulan' id='inputBanyakBulan' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <p class="large text-muted"><i class="fa fa-quote-left" aria-hidden="true"></i> Please kindly to check the subscription you've chose. <i class="fa fa-quote-right" aria-hidden="true"></i> </p>
                <p> - Admin</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-info-circle fa-fw"></i> Detail</h3>
                    </div>
                    <div class="control-group col-lg-6">
                        <p><label class="control-label">Berlanganan Paket <?php echo $package['Nama Paket']; ?></label></p>
                        <p><label class="control-label">IDR <?php echo number_format($package['Harga'],2,',','.'); ?> x 3 Bulan = <b>IDR <?php echo number_format($package['Harga']*3,2,',','.'); ?></b></p>
                        <div class='input-group'>
                            <input type='text' class='form-control' placeholder='Alamat Tujuan' id='inputAlamat' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="<?php echo base_url("assets/js/ext/tether.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo base_url("assets/js/ext/jquery.easing.min.js"); ?>"></script>

<!-- Contact form JavaScript -->
<script src="<?php echo base_url("assets/js/ext/jqBootstrapValidation.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/ext/contact_me.js"); ?>"></script>

<!-- Custom scripts for this template -->
<script src="<?php echo base_url("assets/js/ext/agency.min.js"); ?>"></script>
</body>
</html>