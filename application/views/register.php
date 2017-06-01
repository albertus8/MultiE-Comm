<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
?>
<head>
    <script src="<?php echo base_url("assets/js/jquery-3.2.1.js"); ?>"></script>
    <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url("assets/css/ext/login.css"); ?>" rel="stylesheet">
    <title>MultiE-Comm</title>

    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/sb-admin.css"); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets/css/plugins/morris.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        $(document).ready(function() {
            $("#submitReg").on('click',function(){
//                alert("klik");
                getData = [];
                getData[0] = $("#username").val();
                getData[1] = $("#email").val();
                getData[2] = $("#curPass").val();
                getData[3] = $("#confPass").val();
                getData[4] = $("#fName").val();
                getData[5] = $("#lName").val();
                $.ajax({
                    url: 'Register/validateUser',
                    data: {getData: getData},
                    type: 'post',
                    success: function(result) {
                        console.log(result);
                        if(result != ""){
                            $("#TargetError").html(result);
                            $("#ErrorMessages").show();
                        }else{
                            $("#ErrorMessages").hide();
//                            window.location.href = 'Login';
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="middlePage" style="top:-150px">
        <div class="page-header">
            <h1 class="logo">MECO <small>Register</small></h1>
        </div>
        <div id="ErrorMessages" style="display: none">
            <div class="alert alert-danger">
                <strong>Oops! Please check the following errors:</strong> <br>
                <span id="TargetError">Error Messages goes here</span>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Register here</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12" style="border-left:1px solid #ccc;height:auto">

                        <?php
//                        form_open('register');
////                        $format = 'DATE_RFC822';
////                        $time = time();
////                        echo standard_date($format, $time);
//                        echo form_close();
                        ?>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        echo form_open('Register');
                        echo "<div class='form-group'>";
                        echo "<label for='username'>Username :</label>";
//                        echo "<input type='text' class='form-control' name='inputUsername' id='inputUsername' placeholder='Enter Username here' />";
                        echo form_input("username",$username,"placeholder='Enter Username Here' class='form-control input-md' id='username'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='email'>Email :</label>";
                        //                        echo "<input type='password' class='form-control' name='inputPassword' id='inputPassword' placeholder='Enter Password here' />";
                        echo form_input("email",$email,"placeholder='Enter Email Here' class='form-control input-md' id='email'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='password'>Password :</label>";
//                        echo "<input type='password' class='form-control' name='inputPassword' id='inputPassword' placeholder='Enter Password here' />";
                        echo form_password("password",$password,"placeholder='Enter Password here' class='form-control input-md' id='curPass'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='confirmpassword'>Confirm Password :</label>";
//                        echo "<input type='password' class='form-control' name='inputConfirmPassword' id='inputConfirmPassword' placeholder='Enter Confirm Password here' />";
                        echo form_password("confirmpassword",$confirmpassword,"placeholder='Enter Confirm Password here' class='form-control input-md' id='confPass'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='fName'>First Name :</label>";
//                        echo "<input type='text' class='form-control' name='inputfName' id='inputfName' placeholder='Enter First Name here' />";
                        echo form_input("firstname",$firstname,"placeholder='Enter First Name Here' class='form-control input-md' id='fName'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='lName'>Last Name :</label>";
//                        echo "<input type='text' class='form-control' name='inputlName' id='inputlName' placeholder='Enter Last Name here' />";
                        echo form_input("lastname",$lastname,"placeholder='Enter Last Name Here' class='form-control input-md' id='lName'");
                        echo "</div>";
                        echo "<div class='form-group'>";
//                        echo "<button type='button' class='btn btn-primary btn-block' id='submitData'>Register Now!</button>";
                            echo form_button('registerBtn', 'Register', 'class="btn btn-info btn-block btn-sm" id="submitReg"');
                        echo "</div>";
//                        echo "<div class='form-group'>";
//                        echo form_submit('submitReg', 'Register Now', 'class="btn btn-info btn-sm pull-right" id="submitReg"');
//                        echo "</div>";
                        echo form_close();
//                        ?>
<!--                        <div class='form-group'>-->
<!--                            <button type='button' class='btn btn-primary btn-block' id='submitReg'>Register Now!</button>-->
<!--                         </div>-->
                        <div class='form-group'>
<!--                            <input type="button" class="btn btn-primary btn-block btn-lg" value="Insert Data" name="insertButton" id="insertButton"/>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
