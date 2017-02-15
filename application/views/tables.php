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
                    $(".popuppanel").html(result);
                }
            });
        });
        $('#close-icon').on('click',function(){
            unloadPopupBox();
        });

//        $('.table tr').on('click',function(){
//
//        });


        function loadPopupBox()
        {
            $('body').css('overflow','hidden');
            $("#popupbackground").fadeIn("slow");
            $("#popupbox").fadeIn("slow");
        }
        function unloadPopupBox()
        {
            $('body').css('overflow','auto');
            $("#popupbackground").fadeOut("normal");
            $("#popupbox").fadeOut("normal");
        }
        $("#popupbackground").hide();
        $("#popupbox").hide();
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
                <div id="popupbackground"> </div>
                <div id="popupbox">
                    <img id="close-icon" src="<?php echo base_url("assets/images/close-icon.png"); ?>" />
                    <div class="popuppanel"></div>
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

    #popupbox {
        position:fixed; _position:absolute; /*hack for IE6*/
        background:#FFF;
        color: #000;
        width: 500px;
        min-height: 500px;
        left:472px;
        top:100px;
        border:2px solid lightgray;
        padding:15px;
        z-index:100px;
        font-size:15px;
        -moz-box-shadow: 0px 0px 5px lightgray;
        -webkit-box-shadow:0px 0px 5px lightgray;
        box-shadow:0px 0px 5px lightgray;
    }

    #popupclose {
        border:0px solid lightgray;
        color:#6FA5E2;
        font-family:sans-serif;
        font-weight:bold;
        line-height:15px;
        float:right;
        cursor:pointer;
        text-decoration:none;
    }

    #popupbackground{
        position:fixed; _position:absolute; /*hack for IE6*/
        background:#000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /*background-color: #000;*/
        opacity: 0.5;
        z-index: 50px;
    }
    
    #close-icon{
        /*position: fixed;*/
        width: 20px;
        float: right;
        margin-top:-25px;
        margin-right:-25px;
        cursor: pointer;
    }

</style>