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
                    var startDate = new Date();
                    var getData={};

                    $('.actionSearch').css( 'cursor', 'pointer' );

                    $('#datetimepicker10').datepicker({
                        autoclose: true,
                        minViewMode: 1,
                        format: 'mm-yyyy'
                    }).on('changeDate', function(selected){
                        startDate = new Date(selected.date.valueOf());
                        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                        $('#inputCalendar').datepicker('setStartDate', startDate);
                    });

                    $('.searchModal').css( 'cursor', 'pointer' );
                    $(".searchModal").on('click',function(){
                        $('#searchModal').modal('show');
                        dataCtr=0;
                        dataName=[];
                        $('input:checkbox:checked.chBox').each(function () {
                            $(this).attr('checked', false);
                        });
                    });

//                    $(".modal-body thead tr").find("input[type='checkbox']").attr('checked', true);

                    $(".modal-body thead").find("tr").css( 'cursor', 'pointer' );
                    $(".modal-body thead").find("tr").on('click',function(){
                        if(!$(this).find("input[type='checkbox']").is(':checked')){
                            $(this).find("input[type='checkbox']").attr('checked', true);
                            $(".modal-body tbody").find("input[type='checkbox']").each(function () {
                                $(this).attr('checked', true);
                            });
                        }else{
                            $(this).find("input[type='checkbox']").attr('checked', false);
                            $('.modal-body tbody input:checkbox:checked.chBox').each(function () {
                                $(this).attr('checked', false);
                            });
                        }
                    });

                    $(".modal-body tbody").find("tr").css( 'cursor', 'pointer' );
                    $(".modal-body tbody").find("tr").on('click',function(){

                        checkbox = $(this).find("input[type='checkbox']").attr('id');

                        if(!$(this).find("input[type='checkbox']").is(':checked')){
                            $(this).find("input[type='checkbox']").attr('checked', true);
                        }else{
                            $(this).find("input[type='checkbox']").attr('checked', false);
                        }
                    });

                    $("#submitSearch").on('click',function(){
                        $('input:checkbox:checked.chBox').each(function () {
                            dataName.push($(this).val());
                        });
                        $('#searchModal').modal('hide');
                        $("#inputData").val(dataName);
                        getData = {};
                        getData.selectToko = [];

                        for (i = 0; i < dataName.length; i++) {
                            getData.selectToko[i] = dataName[i];
                        }


                    });

                    $("#showWeb").on('click',function(){
                        getData.selectMonth = [];
                        getData.selectMonth = $("#inputDate").val();

                        $.ajax({
                            url: 'Report/searchReport',
                            data: {getData: getData},
                            type: 'post',
                            success: function(result) {
                                $("#targetTab").html(result);
                            }
                        });
                    });
                });
            });
        </script>
    </head>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Reports
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-file"></i> Report
                </li>
            </ol>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Report</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="control-group">
                                <div class="col-sm-4">
                                    <label class="control-label" for="inputIcon">Select Month :</label>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker10'>
                                            <input type='text' class="form-control" id="inputDate" readonly />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar">
                                                </span>
                                            </span>
                                        </div>
                                    </div>

    <!--                                -->
    <!--                                <label class="control-label" for="inputIcon">Select Month :</label>-->
    <!--                                <div class='input-group'>-->
    <!--                                    <input type='text' class='form-control' placeholder='Search' id='inputCalendar' readonly /> <span class='input-group-addon actionSearch'> <i class='fa fa-times'></i></span><span class='input-group-addon actionSearch pickMonth'> <i class='fa fa-calendar'></i></span>-->
    <!--                                </div>-->
                                </div>

                            <div class="col-lg-8">
                                <label class="control-label" for="inputIcon">Select Data :</label>
                                <div class='input-group'>
                                    <input type='text' class='form-control' placeholder='Search' id='inputData' /> <span class='input-group-addon searchModal'> <i class='fa fa-search'></i>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class='control-group'>
                                    <br>
                                    <button type='button' class='btn btn-primary pull-right' id='showWeb' style="margin-left: 5px">Show on Website</button>
                                    <button type='button' class='btn btn-primary pull-right' id='convertPDF'>Convert to PDF</button>
                                </div>
                            </div>
                        </div>
<!--                        <div id="targetView">-->
<!--                            <pre>-->
<!---->
<!--                            </pre>-->
<!--                        </div>-->
<!--                        <div class="col-lg-12" id="tableTarget">-->
<!--                            <h2 class="text-center">Laporan Omset</h2>-->
<!--                            --><?php //for ($i = 0; $i < count($toko); $i++) { ?>
<!---->
<!--                                    <h4 class="text-center">--><?php //echo ucwords(strtolower($toko[$i]['NamaToko'])); ?><!--</h4>-->
<!--                                    <div class="table-responsive">-->
<!--                                        <table class="table table-bordered table-hover">-->
<!--                                            <thead>-->
<!--                                            <tr>-->
<!--                                                <th>ID</th>-->
<!--                                                <th class='text-center'>Tanggal</th>-->
<!--                                                <th>Nominal</th>-->
<!--                                            </tr>-->
<!--                                            </thead>-->
<!--                                            <tbody>-->
<!--                                            --><?php
//                                            for ($j = 0; $j < count($dpenjualan); $j++){
//                                                echo "<tr>";
//                                                if ($dpenjualan[$j]['NamaToko'] == $toko[$i]['NamaToko']){
//                                                    echo "<td>".$dpenjualan[$j]['ID']."</td>";
//                                                    echo "<td class='text-center'>".$dpenjualan[$j]['Tanggal']."</td>";
//                                                    echo "<td class='text-right' style='white-space:pre;width: 20px'>".$dpenjualan[$j]['Nominal']."</td>";
//                                                }
//                                                echo "</tr>";
//                                            }
//                                            ?>
<!--                                            </tbody>-->
<!--                                        </table>-->
<!--                                    </div>-->
<!--                            --><?php //} ?>
<!--                        </div>-->
                        <div class="panel-body tab-content" id="targetTab">
                             <!--- target jQuery --->
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
                            <div class='panel-body'>
                                <div class='col-lg-12'>
                                    <div class='table-responsive'>
                                        <table class='table table-bordered table-hover'>
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="chBoxAll" id="selectAll" value=""> &nbsp; Nama Toko</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($l = 0; $l < count($toko); $l++) { ?>
                                                    <tr class="clickable">
                                                        <td><input type="checkbox" class="chBox" id="<?php echo $l; ?>" value="<?php echo ucwords(strtolower($toko[$l]['NamaToko'])); ?>"> &nbsp; <?php echo ucwords(strtolower($toko[$l]['NamaToko'])); ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type='button' class='btn btn-primary btn-block' id='submitSearch'>Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

