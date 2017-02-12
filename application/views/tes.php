<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */

?>

<html>
<head>
    <title>MultiE-Comm</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/sb-admin.css"); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets/css/plugins/morris.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">

    <script src="<?php echo base_url("assets/js/jquery.js"); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url("assets/js/plugins/morris/raphael.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/plugins/morris/morris.min.js"); ?>"></script>
<!--    <script src="--><?php //echo base_url("assets/js/plugins/morris/morris-data.js"); ?><!--"></script>-->

    <script type="text/javascript">
        $( document ).ready(function() {
            // Handler for .ready() called.
            $(function() {
                Morris.Area({
                    element: 'morris-area-chart',
                    data: <?php echo json_encode($data, true); ?>,
                    xkey: 'Tanggal',
                    ykeys: ['Penjualan'],
                    labels: ['Penjualan'],
                    pointSize: 2,
                    parseTime: false,
                    hideHover: 'auto',
                    resize: true
                });
            });

//            $.get( "chart-data.json", function( json ) {
//                Morris.Area({
//                    element: 'morris-area-chart',
//                    data: json,
//                    xkey: 'period',
//                    ykeys: ['Date', 'Value'],
//                    labels: ['Date', 'Value'],
//                    pointSize: 2,
//                    hideHover: 'auto',
//                    resize: true
//                });
//            });
        });

    </script>
</head>
<pre>
    Halaman test.
    <?php echo json_encode($data, true); ?>
<!--    --><?php //print_r($data); ?>
</pre>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
            </div>
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
        </div>
    </div>
</div>
</html>
