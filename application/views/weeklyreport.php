<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
?>
    <head>
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
            });
        </script>
    </head>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Reports <small>Weekly</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-file"></i> Weekly Reports
                </li>
            </ol>
        </div>
    </div>
    <!-- Page Wrapper -->
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
</body>
</html>
