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

        .col-centered{
            float: none;
            margin: 0 auto;
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

            // Set the date we're counting down to
            var current = new Date();
            var from = "<?php echo gmdate('D F d Y H:i:s TP', strtotime($dataTime['endTimer']."-5 hours")); ?>" ;
//            var followingDay = new Date(current.getTime() + 86400000); // + 1 day in ms
            var followingDay = new Date(from); // + 1 day in ms
            followingDay.toLocaleDateString();

//            console.log(from);
            console.log(followingDay);

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get todays date and time
                var now = new Date().getTime();

                // Find the distance between now an the count down date
                var distance = followingDay - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("demo").innerHTML = hours + "h "
                    + minutes + "m " + seconds + "s ";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
            var catchFile="";
            var formData = new FormData();
            $('input[type="file"]').change(function(){
                catchFile = $('#targetText').val($(this).val().replace(/.*(\/|\\)/, ''));
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
                    <a class="nav-link" id="reviewBrd" href="">Review</a>
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
                <li class="nav-item"">
                    <a class="nav-link active" id="confirmationBrd" href="#confirmation">Confirmation</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Team -->
<section id="confirmation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center" id="extFrom">
                <h2 class="section-heading">Konfirmasi Pembayaran</h2>

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
            <div class="col-lg-12" style="">
                <p class="text-center"><b>Mohon Segera Selesaikan Pembayaran</b></p>
                <p class="text-center">Transfer dana anda sebelum tanggal <b><?php echo $dataTime['endTimer']; ?></b></p>
                <h3><p id="demo" class="text-center"></h3>

                <div class="col-md-6 col-centered">
                    <div class="alert alert-warning">
                        <p class="text-center">Jumlah yang harus dibayar</p>
                        <p class="text-center"><?php echo "IDR".str_pad(number_format($checkoutDB['totalBayar'],2,',','.'),20 ," ",STR_PAD_LEFT);; ?></p>
                    </div>
                    <i>Jika jumlah yang ditransfer tidak sesuai, proses verifikasi pembayaran Anda dapat terhambat.</i>
                    <hr />
                </div>

                <div class="col-md-6 col-centered">
                    <h5>Informasi Rekening Tujuan</h5>

                    <br />
                    <div class="col-md-4 pull-left"><img src="img/bank/bank-bca-logo-2.JPG" alt="Bank BCA" width="100%" /></div>
                    <div class="col-md-8 pull-right">
                        BCA <br />
                        Nomor Rekening: <b>614 014 9941</b> <br />
                        Nama Pemilik Rekening: Adhi Subagya <br />
                    </div>
                </div>
                <div class="col-md-6 col-centered" style="padding-top: 150px">
                    <h5><i class="fa fa-upload" aria-hidden="true"></i> Unggah Bukti / Cek Status Pembayaran</h5>
<!--                    <button type="button" class="btn btn-xl" id="uploadBuktiPembayaran" data-toggle="modal" data-target="#exampleModal" style="cursor: pointer;"><i class="fa fa-upload" aria-hidden="true"></i> Unggah Bukti / Cek Status Pembayaran </button>-->
                    <div class="input-group">
                        <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Browse&hellip; <input type="file" id="selectFile" accept="image/*" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" style="display: none;">
                                </span>
                        </label>
                        <input type="text" id="targetText" class="form-control text-right" readonly>
                    </div>
                    <img id="blah" width="525"/>
                    <div class="form-group">
                        <button type="button" class="btn btn-xl" id="submitBuktiPembayaran" style="cursor: pointer; width: 100%"><i class="fa fa-upload" aria-hidden="true"></i> Unggah Bukti / Cek Status Pembayaran </button>
                    </div>

                </div>
            </div>

        </div>
        <br />
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <p class="large text-muted"><i class="fa fa-quote-left" aria-hidden="true"></i> Mohon untuk selalu mengunggah bukti transfer untuk mempercepat <br />proses konfirmasi pembayaran Anda. <i class="fa fa-quote-right" aria-hidden="true"></i> </p>
                <p> - Admin</p>
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