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

        $('#insertButton').on('click',function(){
            loadPopupBox();
            $.ajax({
                url: 'Fitur/postInsert',
                success: function(result) {
                    $(".modal-body").html(result);
                        var getData = [];
                        $("#submitData").on('click',function(){
                            getData[0] = $("#inputID").val();
                            getData[1] = $("#namaPaket").val();
                            getData[2] = $("#hargaPaket").val();
                            getData[3] = $("#detailPaket").val();

                            $.ajax({
                                url: 'Fitur/insertFitur',
                                data: {getData: getData},
                                type: 'post',
                                success: function(result) {
                                    $('#myModal').modal('hide');
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                    $(".container-fluid").load("Fitur");
                                }
                            });
                        });
                }
            });
        });

        $('#updateButton').on('click',function(){
            loadPopupBox();
            $.ajax({
                url: 'Fitur/updateFitur',
                success: function(result) {
                    $(".modal-body").html(result);
                    var something = [];
//
//                    $('input[name="hargaPaket"]').keyup(function(){
//                        $(this).val($(this).val().replace(/[^0-9\.]/g,''));
//                    });


                    $('.searchFiturData').css( 'cursor', 'pointer' );
                    $(".searchFiturData").on('click',function(){
                        $('#myModal').modal('hide');
                        $('#searchModal').modal('show');
                        $(".searchModalBody").load("Fitur/searchFormFitur");
                    });
                    $('#searchModal').on('shown.bs.modal', function (e) {
                        $(this).find("tr.clickable").css( 'cursor', 'pointer' );
                        $(this).find("tr.clickable").on('click',function(){
                            something[0] = $(this).find("td:first-child").text();
                            something[1] = $(this).find("td:nth-child(2)").text();
//                            something[2] = $(this).find("td:nth-child(3)").text();
//                            something[3] = "<?php //echo $amount; ?>//";
                            something[2] = $(this).find("#amount").val();
                            something[3] = $(this).find("td:nth-child(4)").text();
                            console.log(something);
                            $('#searchModal').modal('hide');
                            $('#myModal').modal('show');
                        });
                    });
                    $('#searchModal').on('hidden.bs.modal', function (e) {
                        $(this).modal('hide');
                        $('#myModal').modal('show');
                        $('#inputGroup').val(something[0]);
                        $('#namaPaket').val(something[1]);
                        $('#hargaPaket').val(something[2]);
                        $('#detailPaket').val(something[3]);
                    });

                    $('#submitData').on('click',function(){
                        something[1] = $('#namaPaket').val();
                        something[2] = $("#hargaPaket").val();
                        something[3] = $("#detailPaket").val();
                        console.log(something);
                        $.ajax({
                            url: 'Fitur/updateFiturPost',
                            data: {getData: something},
                            type: 'post',
                            success: function(result) {
                    //                                alert("click");
                    //                                console.log(result);
                                $('#myModal').modal('hide');
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                $(".container-fluid").load("Fitur");
                            }
                        });
                    });
                }
            });
        });

        $('#deleteButton').on('click',function(){
            $('#myModal').modal('show');
            $('#myModal').on('shown.bs.modal', function () {
                $('#warningModal').on('hidden.bs.modal', function () {
                    $('body').css("overflow","hidden");
                });
                $('body').css("overflow","hidden");
                $(this).find(".modal-body").css("overflow-y","auto");
            });
            $('#myModal').on('hidden.bs.modal', function () {
                $('#warningModal').on('shown.bs.modal', function () {
                    $('body').css("overflow","hidden");
                });
            });
            $('#myModal').on('hidden.bs.modal', function () {
                $('#warningModal').on('hidden.bs.modal', function () {
                    $('body').css("overflow","auto");
                });
                $('body').css("overflow","auto");
            });
            $.ajax({
                url: 'Fitur/deleteAction',
                success: function(result) {
//                    console.log(result);
                    $('body').css("overflow","hidden");
                    $('#myModal').find("#targetView").html(result);

                    $(".modal-body tbody").find("tr").css( 'cursor', 'pointer' );
                    $(".modal-body tbody").find("tr").on('click',function(){
                        dataID = $(this).find("td:first-child").text();
                        console.log(dataID);
                        $('#myModal').modal('hide');
                        $('#warningModal').modal('show');
                        $("#warningModal .modal-body").html("Are you sure?");
                    });
                    $("#noOption").on('click',function(){
                        $('#warningModal').modal('hide');
                        $('#myModal').modal('show');
                    });
                    $("#yesOption").on('click',function(){
                        $.ajax({
                            url: 'Fitur/deleteFiturPost',
                            data: {getData: dataID},
                            type: 'post',
                            success: function() {
                                $('body').css("overflow","auto");
                                $('#myModal').modal('hide');
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                $(".container-fluid").load("Fitur");
                            }
                        });
                    });
                }
            });


//            $.ajax({
//                url: 'Fitur/deleteAction',
//                success: function(result) {
//                    $(".modal-body").html(result);
//                    var dataID = "";
//                    $(".modal-body tbody").find("tr").css( 'cursor', 'pointer' );
//                    $(".modal-body tbody").find("tr").on('click',function(){
//                        dataID = $(this).find("td:first-child").text();
//                        console.log(dataID);
//                        $('#myModal').modal('hide');
//                        $('#warningModal').modal('show');
//                        $(".modal-body").html("Are you sure?");
//                    });
//                    $('#myModal').on('shown.bs.modal', function () {
//                        $('body').css("overflow","hidden");
//                    });
//                    $('#warningModal').on('hidden.bs.modal', function () {
//                        $(".modal-body").html(result);
//                        $(".modal-body tbody").find("tr").css( 'cursor', 'pointer' );
//                        $('#myModal').modal('show');
//                    });
////                    $("#yesOption").on('click',function(){
////                        $('body').css("overflow","auto");
////                        $.ajax({
////                            url: 'Fitur/deleteFiturPost',
////                            data: {getData: dataID},
////                            type: 'post',
////                            success: function() {
////                                $(".container-fluid").load("Fitur");
////                                $('#myModal').modal('hide');
////                                $('body').removeClass('modal-open');
////                                $('.modal-backdrop').remove();
////                            }
////                        });
////                    });
////
////                    $("#noOption").on('click',function(){
////                        $('#warningModal').modal("hide");
////                        $('#myModal2').modal("show");
////                    });
//                }
//            });
        });
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Master Fitur
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Master Fitur
            </li>
        </ol>
        <!--        <pre>-->
        <!--            --><?php //print_r($dpenjualan); ?>
        <!--        </pre>-->
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table"></i> Master Paket Fitur</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                    <h2>Data Fitur Paket Berlangganan</h2>
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Paket</th>
                            <th class='text-center'>Harga</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        for ($j = 0; $j < count($data); $j++){
                            if($data[$j]['Enable'] == "1"){
                                echo "<tr>";
                                echo "<td>".$data[$j]['ID']."</td>";
                                echo "<td>".$data[$j]['Nama Paket']."</td>";
                                echo "<td class='text-right' style='white-space:pre;width: 20px'>IDR".str_pad(number_format($data[$j]['Harga'],2,',','.'),20 ," ",STR_PAD_LEFT)."</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-lg-3 well">
                    <h2>Actions</h2>
                    <div class='form-group'>
                        <input type="button" class="btn btn-primary btn-block btn-lg" value="Insert Data" name="insertButton" id="insertButton"/>
                    </div>
                    <div class='form-group'>
                        <input type="button" class="btn btn-primary btn-block btn-lg" value="Update Data" name="updateButton" id="updateButton"/>
                    </div>
                    <div class='form-group'>
                        <input type="button" class="btn btn-primary btn-block btn-lg" value="Delete Data" name="deleteButton" id="deleteButton"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Actions</h4>
                </div>
                <div class="modal-body" id="targetView">

                </div>
            </div>
        </div>
    </div>

    <div id="searchModal" class="modal fade" data-backdrop-limit="1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Search Data</h4>
                </div>
                <div class="modal-body searchModalBody">

                </div>
            </div>
        </div>
    </div>

    <div id="warningModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary btn-block" id="yesOption" data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-danger btn-block" id="noOption" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

