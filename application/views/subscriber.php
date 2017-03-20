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
            $('#myModal2').modal('show');
//            var something = $(this).find("td:first-child").text();
            $('#myModal2').on('shown.bs.modal', function () {
                $('body').css("overflow","hidden");
            });
            $('#myModal2').on('hidden.bs.modal', function () {
                $('body').css("overflow","auto");
            });
            $.ajax({
                url: 'Subscriber/postInsert',
                data: {getData: "test"},
                type: 'post',
                success: function(result) {
                    $("#myModal2").find('.modal-body').html(result);
                    $('.userLevel li a').css( 'cursor', 'pointer' );
                    $('.userLevel li a').on('click', function(){
                        $(this).css( 'cursor', 'pointer' );
                        $(".primary-userLevel").html($(this).text() + " <span class='caret'></span></button>");
                    });
                    $('.userStatus li a').css( 'cursor', 'pointer' );
                    $('.userStatus li a').on('click', function(){
                        $(".primary-userStatus").html($(this).text() + " <span class='caret'></span></button>");
                    });

                    var getData = [];
                    $("#submitData").on('click',function(){
                        getData[0] = $("#inputUsername").val();
                        getData[1] = $("#inputPassword").val();
                        getData[2] = $("#inputConfirmPassword").val();
                        getData[3] = $("#inputfName").val();
                        getData[4] = $("#inputlName").val();
                        getData[5] = $(".primary-userLevel").text();
                        getData[6] = $(".primary-userStatus").text();

                        $.ajax({
                            url: 'Subscriber/insertUser',
                            data: {getData: getData},
                            type: 'post',
                            success: function(result) {
                                $('#myModal2').modal('hide');
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();

                                $(".container-fluid").load("Subscriber");
                                $('body').css("overflow","auto");
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
//            $('#warningModal').on('hidden.bs.modal', function () {
//                $('body').css("overflow","hidden");
//            });
            $.ajax({
                url: 'Subscriber/deleteUser',
                success: function(result) {
                    $('body').css("overflow","hidden");
                    $(".modal-body #targetView").html(result);
                    var dataID = "";

                    $("#searchGo").on('click',function(){
                        dataID = $("#searchUser").val();
//                        console.log(dataID);
                        $.ajax({
                            url: 'Subscriber/searchUserPost',
                            data: {getData: dataID},
                            type: 'post',
//                            dataType:'json',
                            success: function(result) {
                                console.log(result);
                                $(".modal-body #targetView").html(result);
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
                                        url: 'Subscriber/deleteUserPost',
                                        data: {getData: dataID},
                                        type: 'post',
                                        success: function() {
                                            $(".container-fluid").load("Subscriber");
                                            $('body').css("overflow","auto");
                                        }
                                    });
                                });
                            }
                        });
                    });
//                    $('body').css("overflow","auto");

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

//                        $('body').css("overflow","hidden");
                    });
                    $("#yesOption").on('click',function(){
                        $.ajax({
                            url: 'Subscriber/deleteUserPost',
                            data: {getData: dataID},
                            type: 'post',
                            success: function() {
                                $(".container-fluid").load("Subscriber");
                            }
                        });
                    });
                }
            });
        });


    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Master Subscriber
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Master Subscriber
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
                <h3 class="panel-title"><i class="fa fa-table"></i> Master Subscriber</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-9">
                    <h2>Data Subscriber</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
<!--                                    <th>Password</th>-->
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th class='text-center'>Tanggal Join</th>
                                <th class='text-center'>Remember Me</th>
                                <th class='text-center'>Level User</th>
                                <th class='text-center'>Enabled</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($j = 0; $j < count($data); $j++){
                                echo "<tr>";
                                    echo "<td style='width: 10%'>".$data[$j]['ID']."</td>";
                                    echo "<td style='width: 10%'>".$data[$j]['Username']."</td>";
//                                        echo "<td>".$data[$j]['Password']."</td>";
                                    echo "<td>".$data[$j]['Nama Depan']."</td>";
                                    echo "<td>".$data[$j]['Nama Belakang']."</td>";
                                    echo "<td class='text-center'>".$data[$j]['Tanggal Join']."</td>";
                                    echo "<td class='text-center'>".$data[$j]['Remember Me']."</td>";
                                    echo "<td class='text-center'>".$data[$j]['Level User']."</td>";
                                    echo "<td class='text-center'>".$data[$j]['Enabled']."</td>";
//                                        echo "<td class='text-right' style='white-space:pre;width: 20px'>".$data[$j]['Nominal']."</td>";
                                echo "</tr>";
                            }
//
//                                ?>
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
                            <input type="button" class="btn btn-primary btn-block btn-lg" value="Delete Data" name="deleteButton" id="deleteButton"/>
                        </div>
                </div>

                <!-- Modal Bootstrap -->
                <div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">

                                <div class="col-lg-6" style="float: left"><h4 class="modal-title">Actions</h4></div>
                                <div class="col-lg-6" style="float: right"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
                                <div class="col-xs-12">
                                    <div class="input-group">
                                        <input type="text" id="searchUser" class="form-control" placeholder="Search for...">
                                        <span class="input-group-btn">
                                        <button class="btn btn-secondary" id="searchGo" type="button">Go!</button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Modal Header -->

                            <!-- Modal Body -->
                            <div class="modal-body">

                                <div id="targetView">

                                </div>
<!--                                 <div class='form-group'>-->
<!--                                     <label for='userID'>ID :</label>-->
<!--                                     <input type='text' class='form-control' name='inputID' id='inputID' placeholder='ID User'/>-->
<!--                                 </div>-->
<!--                                 <div class='form-group'>-->
<!--                                     <label for='username'>Username :</label>-->
<!--                                     <input type='text' class='form-control' name='inputUsername' id='inputUsername' placeholder='Enter Username here' />-->
<!--                                 </div>-->
<!--                                 <div class='form-group'>-->
<!--                                     <label for='password'>Password :</label>-->
<!--                                     <input type='password' class='form-control' name='inputPassword' id='inputPassword' placeholder='Enter Password here' />-->
<!--                                 </div>-->
<!--                                 <div class='form-group'>-->
<!--                                     <label for='fName'>First Name :</label>-->
<!--                                     <input type='text' class='form-control' name='inputfName' id='inputfName' placeholder='Enter First Name here' />-->
<!--                                 </div>-->
<!--                                 <div class='form-group'>-->
<!--                                     <label for='lName'>Last Name :</label>-->
<!--                                     <input type='text' class='form-control' name='inputlName' id='inputlName' placeholder='Enter Last Name here' />-->
<!--                                 </div>-->
<!--                                 <div class='form-group col-lg-6'>-->
<!--                                     <label for='levelUser'>Level User :</label>-->
<!--                                     <div class="dropdown">-->
<!--                                         <button class="btn btn-primary dropdown-toggle primary-userLevel" type="button" data-toggle="dropdown">Select Level User-->
<!--                                            <span class="caret"></span></button>-->
<!--                                         <ul class='dropdown-menu userLevel'>-->
<!--                                             <li><a>1: Super Admin</a></li>-->
<!--                                             <li><a>2: Paid User</a></li>-->
<!--                                             <li><a>3: Free User</a></li>-->
<!--                                         </ul>-->
<!--                                     </div>-->
<!--                                 </div>-->
<!--                                 <div class='form-group col-lg-6'>-->
<!--                                     <label for='status'>Status :</label>-->
<!--                                     <div class="dropdown">-->
<!--                                         <button class="btn btn-primary dropdown-toggle primary-userStatus" type="button" data-toggle="dropdown">Select Status User-->
<!--                                            <span class="caret"></span></button>-->
<!--                                         <ul class='dropdown-menu userStatus'>-->
<!--                                             <li><a>Enable</a></li>-->
<!--                                             <li><a>Disable</a></li>-->
<!--                                         </ul>-->
<!--                                     </div>-->
<!--                                 </div>-->
<!--                                <div class='form-group'>-->
<!--                                    <button type="button" class="btn btn-primary btn-block" id="submitData">Submit User Data</button>-->
<!--                                </div>-->
                            </div>
                            <!-- End of Modal Body -->
                        </div>
                        <!-- End of Modal content-->
                    </div>
                </div>
                <!-- End of Modal Bootstrap -->

                <div id="myModal2" class="modal fade" data-backdrop-limit="1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Insert Data Form</h4>
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
        </div>
    </div>
</div>

<style>
    .modal-body{
       max-height:700px;
    }
</style>
