<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
?>
<script type="text/javascript">
    $(document).ready(function () {
//        $('table.display').DataTable();
        function loadPopupBox()
        {
            $('#myModal').modal('toggle');
        }
//        $('#transaction1 tbody').find("tr").css( 'cursor', 'pointer' );
        $('#transaction2 tbody').find("tr").css( 'cursor', 'pointer' );
//        $('#transaction3 tbody').find("tr").css( 'cursor', 'pointer' );

        $('#transaction2 tbody').find("tr").on('click',function(){
            loadPopupBox();
            var idTransaksi = $(this).find("td:first-child").text();
            $('#activateUser').on('click',function(){
//                console.log(idTransaksi);
                $.ajax({
                    url: 'Transaction/acceptTransaction',
                    data: {data: idTransaksi},
                    type: 'post',
                    success: function(result) {
                        console.log(result);
                        $('#myModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $(".container-fluid").load("Transaction/#transaction2");
                        $('body').css("overflow","auto");
                    }
                });
            });
//            var something = $(this).find("td:first-child").text();

//            $.ajax({
//                url: 'Transaction/postInsert',
//                data: {getData: "test"},
//                type: 'post',
//                success: function(result) {
//                    $(".modal-body").html(result);
//                    $('.userLevel li a').on('click', function(){
//                        $(".primary-userLevel").html($(this).text() + " <span class='caret'></span></button>");
//                    });
//                    $('.userStatus li a').on('click', function(){
//                        $(".primary-userStatus").html($(this).text() + " <span class='caret'></span></button>");
//                    });
//                }
//            });

        });
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Master Transaksi
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Master Transaksi
            </li>
        </ol>
        <!--        <pre>-->
        <!--            --><?php //print_r($dpenjualan); ?>
        <!--        </pre>-->
    </div>
</div>

<div class="row">
<!--    <div class='tabs-x tabs-below'>-->
<!--        <div id="myTabContent-2" class="tab-content">-->
<!--            <ul id="myTab-2" class="nav nav-tabs" role="tablist">-->
<!--                <li class="active"><a href="#home-2" role="tab" data-toggle="tab">Home</a>-->
<!---->
<!--                </li>-->
<!--                <li><a href="#profile-2" role="tab-kv" data-toggle="tab">Profile</a>-->
<!---->
<!--                </li>-->
<!--            </ul>-->
<!--            <div class="tab-pane fade in active" id="home-2">-->
<!--                <div class="row">-->
<!--                    <div class="col-xs-4">-->
<!--                        <p>The FALSE Tabs</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="tab-pane fade" id="profile-2">-->
<!--                <p>The True TaBs WORKED</p>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->




    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table"></i> Master Transaksi</h3>
            </div>
            <div class="panel-body tab-content">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#transaction1" role="tab" data-toggle="tab">All Transaction</a>

                    </li>
                    <li><a href="#transaction2" role="tab-kv" data-toggle="tab">Confirmation</a>

                    </li>
                    <li><a href="#transaction3" role="tab-kv" data-toggle="tab">Expired</a>

                    </li>
                </ul>
                <div class="col-lg-12 tab-pane fade in active" id="transaction1">
                    <h2>Data Transaksi</h2>
                    <div class="table-responsive">
                        <table class="table display table-hover" style="border: 1px solid #dddddd;">
                            <thead>
                            <tr>
                                <th style="vertical-align: middle";>ID Transaksi</th>
                                <th style="vertical-align: middle";>ID User</th>
                                <th style="vertical-align: middle";>Nama User</th>
                                <th style="vertical-align: middle";>Nama Paket</th>
                                <th class="text-center" style="vertical-align: middle";>Masa Berlangganan</th>
                                <th colspan="2" class='text-center' style="vertical-align: middle";>Harga Paket</th>
                                <th colspan="2" class='text-center' style="vertical-align: middle";>Total</th>
                                <th class='text-center' style="vertical-align: middle";>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($j = 0; $j < count($data); $j++){
                                echo "<tr>";
                                echo "<td>".$data[$j]['ID Transaksi']."</td>";
                                echo "<td>".$data[$j]['ID User']."</td>";
                                echo "<td>".$data[$j]['Username']."</td>";
                                echo "<td>".$data[$j]['Nama Paket']."</td>";
                                echo "<td class='text-center' style='width: 200px;'>".$data[$j]['DurasiBulan']."</td>";
                                echo "<td class='text-center' style='width: 10px;'>IDR</td>";
                                echo "<td class='text-right' style='white-space:pre;width: 20px;' >".str_pad(number_format($data[$j]['Harga Paket'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                echo "<td class='text-center' style='width: 10px'>IDR</td>";
                                echo "<td class='text-right' style='white-space:pre;width: 20px;' >".str_pad(number_format($data[$j]['TotalBayar'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                if($data[$j]['Status'] == '0' && date('Y-m-d H:i:s', strtotime($data[$j]['TimerBayarEnd'])) < date('Y-m-d H:i:s')){
                                    echo "<td class='text-center'><span class='label label-danger'>EXPIRED</span></td>";
                                }elseif($data[$j]['Status'] == '0' && date('Y-m-d H:i:s', strtotime($data[$j]['TimerBayarEnd'])) >= date('Y-m-d H:i:s')){
                                    echo "<td class='text-center'><span class='label label-warning'>PENDING</span></td>";
                                }elseif($data[$j]['Status'] == '1') {
                                    echo "<td class='text-center'><span class='label label-success'>ENABLED</span></td>";
                                }
                            }
                            echo "</tr>";
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 tab-pane fade" id="transaction2">
                    <h2>Data Konfirmasi Transaksi</h2>
                    <div class="table-responsive">
                        <table class="table table-hover" style="border: 1px solid #dddddd;">
                            <thead>
                            <tr>
                                <th style="vertical-align: middle";>ID Transaksi</th>
                                <th style="vertical-align: middle";>ID User</th>
                                <th style="vertical-align: middle";>Nama User</th>
                                <th style="vertical-align: middle";>Nama Paket</th>
                                <th class="text-center" style="vertical-align: middle";>Masa Berlangganan</th>
                                <th colspan="2" class='text-center' style="vertical-align: middle";>Harga Paket</th>
                                <th colspan="2" class='text-center' style="vertical-align: middle";>Total</th>
                                <th class='text-center' style="vertical-align: middle";>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($j = 0; $j < count($status); $j++){
                                if(date('Y-m-d H:i:s', strtotime($status[$j]['TimerBayarEnd'])) >= date('Y-m-d H:i:s')){
                                    echo "<tr>";
                                    echo "<td>".$status[$j]['ID Transaksi']."</td>";
                                    echo "<td>".$status[$j]['ID User']."</td>";
                                    echo "<td>".$status[$j]['Username']."</td>";
                                    echo "<td>".$status[$j]['Nama Paket']."</td>";
                                    echo "<td class='text-center' style='width: 200px;'>".$status[$j]['DurasiBulan']."</td>";
                                    echo "<td class='text-center' style='width: 10px;'>IDR</td>";
                                    echo "<td class='text-right' style='white-space:pre;width: 20px;' >".str_pad(number_format($status[$j]['Harga Paket'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                    echo "<td class='text-center' style='width: 10px'>IDR</td>";
                                    echo "<td class='text-right' style='white-space:pre;width: 20px;' >".str_pad(number_format($status[$j]['TotalBayar'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                    echo "<td class='text-center'><span class='label label-warning'>PENDING</span></td>";
                                    echo "</tr>";
                                }

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 tab-pane fade" id="transaction3">
                    <h2>Data Transaksi Expired</h2>
                    <div class="table-responsive">
                        <table class="table display table-hover" style="border: 1px solid #dddddd;">
                            <thead>
                            <tr>
                                <th style="vertical-align: middle";>ID Transaksi</th>
                                <th style="vertical-align: middle";>ID User</th>
                                <th style="vertical-align: middle";>Nama User</th>
                                <th style="vertical-align: middle";>Nama Paket</th>
                                <th class="text-center" style="vertical-align: middle";>Masa Berlangganan</th>
                                <th colspan="2" class='text-center' style="vertical-align: middle";>Harga Paket</th>
                                <th colspan="2" class='text-center' style="vertical-align: middle";>Total</th>
                                <th class='text-center' style="vertical-align: middle";>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ctrExpired = 0;
                            for ($j = 0; $j < count($status); $j++){
                                if(date('Y-m-d H:i:s', strtotime($status[$j]['TimerBayarEnd'])) < date('Y-m-d H:i:s')){
                                    echo "<tr>";
                                    echo "<td>".$status[$j]['ID Transaksi']."</td>";
                                    echo "<td>".$status[$j]['ID User']."</td>";
                                    echo "<td>".$status[$j]['Username']."</td>";
                                    echo "<td>".$status[$j]['Nama Paket']."</td>";
                                    echo "<td class='text-center' style='width: 200px;'>".$status[$j]['DurasiBulan']."</td>";
                                    echo "<td class='text-center' style='width: 10px;'>IDR</td>";
                                    echo "<td class='text-right' style='white-space:pre;width: 20px;' >".str_pad(number_format($status[$j]['Harga Paket'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                    echo "<td class='text-center' style='width: 10px'>IDR</td>";
                                    echo "<td class='text-right' style='white-space:pre;width: 20px;' >".str_pad(number_format($status[$j]['TotalBayar'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                    echo "<td class='text-center'><span class='label label-danger'>EXPIRED</span></td>";
                                    echo "</tr>";
                                }

                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content panel-warning">
                            <div class="modal-header panel-heading">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Warning!</h4>
                            </div>
                            <div class="modal-body">
                                Please kindly to check this user payment confirmation. Are you sure want to <b>activate</b> this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="activateUser" data-dismiss="modal">Activate</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
