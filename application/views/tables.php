<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
?>
<script type="text/javascript">
    var getData = <?php echo json_encode( $dpenjualan ) ?>;

    $(document).ready(function () {
        $('.table tr').on('click',function(){
            loadPopupBox();
            var something = $(this).find("td:first-child").text();
            $.ajax({
                url: 'Tables/detailProduk',
                data: {getData: something},
                type: 'post',
                success: function(result) {
                    $(".modal-body pre").html(result);
                }
            });
        });
        function loadPopupBox()
        {
            $('#myModal').modal('toggle');
        }
        $("#searchBox").on('keyup', function (e) {
            if (e.keyCode == 13) {
                // Do something
                var something = $(this).val();
                $(".modal-body pre").html(something);
//                $.ajax({
////                    url: 'Tables/searchData',
////                    data: {searchData: $(this).val()},
////                    type: 'post',
//                    success: function(result) {
//                        $(".modal-body pre").html(result);
//                    }
//                });
            }
        });
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Tables
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Tables
            </li>
        </ol>
<!--        <pre>-->
<!--            --><?php //print_r($dpenjualan); ?>
<!--        </pre>-->
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table"></i> Data Tables</h3>
            </div>
            <div class="panel-body">
                <?php for ($i = 0; $i < count($toko); $i++) { ?>
                    <div class="col-lg-6">
                        <h2>Data Penjualan <?php echo ucwords(strtolower($toko[$i]['NamaToko'])); ?></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class='text-center'>Tanggal</th>
                                    <th>Nominal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ($j = 0; $j < count($data); $j++){
                                    echo "<tr>";
                                    if ($data[$j]['NamaToko'] == $toko[$i]['NamaToko']){
                                        echo "<td>".$data[$j]['ID']."</td>";
                                        echo "<td class='text-center'>".$data[$j]['Tanggal']."</td>";
                                        echo "<td class='text-right' style='white-space:pre;width: 20px'>".$data[$j]['Nominal']."</td>";
                                    }
                                    echo "</tr>";
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
<!--                <div id="popupbackground"> </div>-->
<!--                <div id="popupbox">-->
<!--                    <img id="close-icon" src="--><?php //echo base_url("assets/images/close-icon.png"); ?><!--" />-->
<!--                    <div class="popuppanel">-->
<!--                        <div style="position: relative;float: left">Search : <input type='text' name='searchBox' id='searchBox' /></div>-->
<!--                        <pre>-->
<!---->
<!--                        </pre>-->
<!--                    </div>-->
<!--                </div>-->

                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Detail Nota Penjualan</h4>
                            </div>
                            <div class="modal-body">
                                <div style="float: left">
                                    <table>
                                        <tr>
                                            <td>
                                                Search
                                            </td>
                                            <td>
                                                : <input type='text' name='searchBox' id='searchBox' />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br />
                                <hr />
                                <pre>

                                 </pre>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
<!-- /.row -->

<style>
    .table tr td{
        cursor: pointer;
    }

    /*#popupbox {*/
        /*position:fixed; _position:absolute; !*hack for IE6*!*/
        /*background:#FFF;*/
        /*color: #000;*/
        /*width: 500px;*/
        /*max-height: 500px;*/
        /*!*left:472px;*!*/
        /*!*top:100px;*!*/
        /*margin: -200px 200px auto;*/
        /*border:2px solid lightgray;*/
        /*padding:15px;*/
        /*z-index:100px;*/
        /*font-size:15px;*/
        /*-moz-box-shadow: 0px 0px 5px lightgray;*/
        /*-webkit-box-shadow:0px 0px 5px lightgray;*/
        /*box-shadow:0px 0px 5px lightgray;*/
    /*}*/

    .modal-body pre{
        /*position:relative; _position:absolute; !*hack for IE6*!*/
        float: right;
        width: 100%;
        /*max-height: 445px;*/
        /*border: 1px solid red;*/
    }

    .modal-content{
        min-height: 635px;
    }

    /*#popupclose {*/
        /*border:0px solid lightgray;*/
        /*color:#6FA5E2;*/
        /*font-family:sans-serif;*/
        /*font-weight:bold;*/
        /*line-height:15px;*/
        /*float:right;*/
        /*cursor:pointer;*/
        /*text-decoration:none;*/
    /*}*/

    /*#popupbackground{*/
        /*position:fixed; _position:absolute; !*hack for IE6*!*/
        /*background:#000;*/
        /*top: 0;*/
        /*left: 0;*/
        /*width: 100%;*/
        /*height: 100%;*/
        /*!*background-color: #000;*!*/
        /*opacity: 0.5;*/
        /*z-index: 50px;*/
    /*}*/
    
    /*#close-icon{*/
        /*!*position: fixed;*!*/
        /*width: 20px;*/
        /*float: right;*/
        /*margin-top:-25px;*/
        /*margin-right:-25px;*/
        /*cursor: pointer;*/
    /*}*/

</style>