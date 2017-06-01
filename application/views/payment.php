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

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>



    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>


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

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <script type="text/javascript">
        $( document ).ready(function() {
            $( "#fail-alert" ).hide();

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
                        window.location.href = 'Register';
                    }
                });
            });


            $('#inputNomorRekening').change(function() {
                var numRek = $(this).val().toString();
                numRek = numRek.replace(/-/g, "");

                $(this).val(numRek);
//                console.log(numRek);
            });

            $('#toConfirmation').click(function(){
                var checkIsian1 = $("#inputNamaRekening").val();
                var checkIsian2 = $("#inputNomorRekening").val();
                var namaBank = $("#inputBank :selected").text();

//                console.log(checkIsian1+ " " +checkIsian2);
                if(checkIsian1 != "" &&  checkIsian2 != ""){
                    $.ajax({
                        url: 'Checkout/checkToConfirmation',
                        data: {"dataNama" : checkIsian1, "dataNomor" : checkIsian2, "dataBank" : namaBank},
                        type: 'post',
                        success: function(result) {
//                            console.log(result);
                            window.location.href = 'Confirmation';
                        }
                    });
                }else{
                    $("#fail-alert").slideDown(500).fadeIn('slow', function () {
                        $(this).delay(2000).slideUp(500);
                    });
                }
            });


            var intInput = 0;
//            $(':input[type="number"]').change(function() {
//                intInput = $("#inputJumlahItem").val();
////                $.post("Checkout/jumlahInput", {intInput: intInput});
//                $.ajax({
//                    url: 'Checkout/jumlahInput',
//                    data: {"data" : intInput},
//                    type: 'post',
//                    success: function(result) {
////                        console.log(result);
//                        $("#targetSubtotal").html(result);
//                        $("#targetTotal").html("<b>"+result+"</b>");
//                    }
//                });
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
                    <a class="nav-link" id="reviewBrd" href="">Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="paymentBrd" href="#payment">Payment</a>
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
<section id="payment" class="bg-faded">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id="extFrom">
                <h2 class="section-heading">Metode Pembayaran</h2>

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
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="alert alert-warning">
                    <strong>Warning!</strong> Demi keamanan transaksi Anda, pastikan untuk "TIDAK" memberikan <br />"BUKTI DAN DATA PEMBAYARAN" kepada pihak manapun kecuali MECO.
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-info-circle fa-fw"></i> Detail Informasi</h3>
                        <div id='fail-alert' class="alert alert-danger">
                            <strong>Oops!</strong> It seems like something wrong happened with your input. Please re-input.
                        </div>
                    </div>

                    <div class="control-group col-lg-12">
                        <div class='form-group'>
<!--                            <label for='inputNama'>Bank Tujuan :</label>-->
<!--                            <input type='text' class='form-control' name='inputNama' id='inputNama' placeholder='Isikan Nama Lengkap dengan benar eg. Bambang Susanto'/>-->

                            <div class="form-group">
                                <label for="inputBank">Bank Tujuan :</label>
                                <select class="form-control" id="inputBank">
                                    <option><img src="img/bank/bank-bca-logo.JPG" />Bank BCA</option>
                                    <option>Bank Mandiri</option>
                                    <option>Bank BRI</option>
                                    <option>Bank BNI</option>
                                    <option>Bank CIMB</option>
                                </select>
                            </div>


                        </div>
                        <div class='form-group'>
                            <label for='inputNamaRekening'>Nama Pemilik Rekening Pengirim :</label>
                            <input type='text' class='form-control' name='inputNamaRekening' id='inputNamaRekening' placeholder='Nama Pemilik'/>
                        </div>
                        <div class='form-group'>
                            <label for='inputNomorRekening'>No. Rekening Pengirim :</label>
                            <input type='text' class='form-control' name='inputNomorRekening' id='inputNomorRekening' placeholder='No. Rekening Pemilik' pattern="[0-9.]+" maxlength=15 />
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ringkasan Tagihan</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(!$checkoutData){
                            ?>
                        <p>Paket <?php echo $paket['Nama Paket']; ?></p>
                                <div class="col-lg-12"><?php echo (int)$dataDariDB['totalBayar']/(int)$dataDariDB['hargaPaket']; ?> bulan x <?php echo "IDR".str_pad(number_format((int)$dataDariDB['hargaPaket'],2,',','.'),20 ," ",STR_PAD_LEFT); ?><hr /></div>
                                <div class="col-md-6 pull-left"><b>Total Transaksi</b></div>
                                <div class="col-md-6 pull-right text-right"><b> <?php echo "IDR".str_pad(number_format($dataDariDB['totalBayar'],2,',','.'),20 ," ",STR_PAD_LEFT); ?></b></div>
                                <?php
                            }else{
                                ?>
                                <div class="col-lg-12"><?php echo $checkoutData/(int)$paket['Harga']; ?> bulan x <?php echo "IDR".str_pad(number_format($paket['Harga'],2,',','.'),20 ," ",STR_PAD_LEFT); ?><hr /></div>
                                <div class="col-md-6 pull-left"><b>Total Transaksi</b></div>
                                <div class="col-md-6 pull-right text-right"><b> <?php echo "IDR".str_pad(number_format($checkoutData,2,',','.'),20 ," ",STR_PAD_LEFT); ?></b></div>
                                <?php
                            }
                        ?>
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
            <button type="button" class="btn btn-xl" name="toConfirmation" id="toConfirmation" style="cursor: pointer;">Konfirmasi Pembayaran <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            <!--            <input type="button" class="btn btn-xl" value="ke Pembayaran" name="toPayment" id="selectBtn" style="cursor: pointer;" />-->
        </div>

    </div>
</section>


<script type="text/javascript" src="<?php echo base_url("assets/js/ext/tether.min.js"); ?>"></script>
<!--<script type="text/javascript" src="--><?php //echo base_url("assets/js/bootstrap.min.js"); ?><!--"></script>-->

<!-- Plugin JavaScript -->
<script type="text/javascript" src="<?php echo base_url("assets/js/ext/jquery.easing.min.js"); ?>"></script>

<!-- Contact form JavaScript -->
<script type="text/javascript" src="<?php echo base_url("assets/js/ext/jqBootstrapValidation.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/ext/contact_me.js"); ?>"></script>

<!-- Custom scripts for this template -->
<script type="text/javascript" src="<?php echo base_url("assets/js/ext/agency.min.js"); ?>"></script>
</body>
</html>