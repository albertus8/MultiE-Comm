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

        textarea {
            resize: none;
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
                    data: {"data" : intInput},
                    type: 'post',
                    success: function(result) {
                        window.location.href = 'Login';
                    }
                });
            });

            $('#toPayment').click(function(){
                window.location.href = 'Payment';
            });

            var intInput = 0;
            $(':input[type="number"]').change(function() {
                intInput = $("#inputJumlahItem").val();
//                $.post("Checkout/jumlahInput", {intInput: intInput});
                $.ajax({
                    url: 'Checkout/jumlahInput',
                    data: {"data" : intInput},
                    type: 'post',
                    success: function(result) {
//                        console.log(result);
                        $("#targetSubtotal").html(result);
                        $("#targetTotal").html("<b>"+result+"</b>");
                    }
                });
                console.log();
            });

//            var inputJumlahItem = $("#inputJumlahItem").val();
//            $("#inputJumlahItem").on('keyup change click', function () {
////                if(this.inputJumlahItem !== inputJumlahItem) {
////                    inputJumlahItem = this.inputJumlahItem;
////                    //Do stuff
////
////                }
//
//            });
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
                    <a class="nav-link" id="paymentBrd" href="Payment">Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="confirmationBrd" href="Confirmation">Confirmation</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Team -->
<section id="review" class="bg-faded">
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
            <div class="col-lg-6" style="">
                <div class="table-responsive table-sm">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Item</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!$package){
                        ?>
                            <tr>
                                <td class="text-center">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-shopping-cart fa-stack fa-inverse"></i>
                                    </span>
                                    <h4>Free</h4>
                                    <?php echo "<h4>".$package['Nama Paket']."</h4>"; ?>
                                    <p class="text-muted">IDR <?php echo number_format("0",2,',','.'); ?> /month</p>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <p class="text-muted">indefinitely</p>
                                </td>
                                <td class="text-right" style="vertical-align: middle;">
                                    <p class="text-muted">IDR <?php echo number_format("0",2,',','.'); ?> </p>
                                </td>
                            </tr>
                        <?php
                        }else{
                        ?>
                            <tr>
                                <td class="text-center" style="width: 200px;vertical-align: middle;">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <?php echo "<h4>".$package['Nama Paket']."</h4>"; ?>
                                    <p class="text-muted">IDR <?php echo number_format($package['Harga'],2,',','.'); ?> /month</p>
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <input type='number' class='form-control' name='inputJumlahItem' id='inputJumlahItem' min="1" placeholder='eg. 1' style="text-align:center;" />
                                </td>
                                <td class="text-right" style="width: 200px; vertical-align: middle;" id="targetSubtotal">
                                    IDR <?php echo number_format($package['Harga'],2,',','.'); ?>
                                </td>
                            </tr>
                        <?php
//                            echo "<h4>".$package['Nama Paket']."</h4>";
                        }
                        ?>
                            <tr>
                                <td colspan="2"><b>TOTAL</b</td>
                                <td class="text-right" style="vertical-align: middle;" id="targetTotal"><b>IDR <?php echo number_format($package['Harga'],2,',','.'); ?></b</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-info-circle fa-fw"></i> Detail Informasi</h3>
                        </div>
                        <div class="control-group col-lg-12">
<!--                            <p><label class="control-label">Berlanganan Paket --><?php //echo $package['Nama Paket']; ?><!--</label></p>-->
<!--                            <p><label class="control-label">IDR --><?php //echo number_format($package['Harga'],2,',','.'); ?><!-- x 3 Bulan = <b>IDR --><?php //echo number_format($package['Harga']*3,2,',','.'); ?><!--</b></p>-->
                            <div class='form-group'>
                                 <label for='inputNama'>Nama Lengkap :</label>
                                 <input type='text' class='form-control' name='inputNama' id='inputNama' placeholder='Isikan Nama Lengkap dengan benar eg. Bambang Susanto'/>
                            </div>
                            <div class='form-group'>
                                 <label for='inputTelp'>No. Telp :</label>
                                 <input type='text' class='form-control' name='inputTelp' id='inputTelp' placeholder='Isikan No. Telp dengan benar; eg. 08574350099'/>
                            </div>
                            <div class='form-group'>
                                <label for='inputAlamat'>Alamat :</label>
                                <textarea class="form-control" rows="5" id="inputAlamat" placeholder="Isikan Alamat dengan lengkap"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <br />
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <p class="large text-muted"><i class="fa fa-quote-left" aria-hidden="true"></i> Please kindly to check the subscription you've chose. <i class="fa fa-quote-right" aria-hidden="true"></i> </p>
                <p> - Admin</p>
            </div>
        </div>
        <div class="row pull-right" style="justify-content: center;">
            <button type="button" class="btn btn-xl" name="toPayment" id="toPayment" style="cursor: pointer;">ke Pembayaran <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
<!--            <input type="button" class="btn btn-xl" value="ke Pembayaran" name="toPayment" id="selectBtn" style="cursor: pointer;" />-->
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