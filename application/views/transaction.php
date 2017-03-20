<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
?>
<script type="text/javascript">
    $(document).ready(function () {
        function loadPopupBox()
        {
            $('#myModal').modal('toggle');
        }
        $('#transaction2 tbody').find("tr").css( 'cursor', 'pointer' );
        $('#transaction2 tbody').find("tr").on('click',function(){
            loadPopupBox();
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
                </ul>
                <div class="col-lg-12 tab-pane fade in active" id="transaction1">
                    <h2>Data Transaksi</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Paket</th>
                                <th class='text-center'>Tanggal</th>
                                <th>ID User</th>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th class='text-center'>Confirmed</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($j = 0; $j < count($data); $j++){
                                echo "<tr>";
                                echo "<td>".$data[$j]['ID']."</td>";
                                echo "<td>".$data[$j]['ID Paket']."</td>";
                                echo "<td class='text-center'>".$data[$j]['Tanggal']."</td>";
                                echo "<td>".$data[$j]['ID User']."</td>";
                                echo "<td>".$data[$j]['Nama Paket']."</td>";
                                echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR".str_pad(number_format($data[$j]['Harga'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                echo "<td class='text-center'>".$data[$j]['Confirmed']."</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 tab-pane fade" id="transaction2">
                    <h2>Dara Konfirmasi Transaksi</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Nama User</th>
                                <th>Nama Paket</th>
                                <th>Harga Paket</th>
                                <th class='text-center'>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($j = 0; $j < count($status); $j++){
                                echo "<tr>";
                                echo "<td>".$status[$j]['ID User']."</td>";
                                echo "<td>".$status[$j]['Username']."</td>";
                                echo "<td>".$status[$j]['Nama Paket']."</td>";
                                echo "<td class='text-right' style='white-space:pre;width: 20px'>".$status[$j]['Harga Paket']."</td>";
                                echo "<td class='text-center'>".$status[$j]['Status']."</td>";
                                echo "</tr>";
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
                                <h4 class="modal-title">Caution!</h4>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
