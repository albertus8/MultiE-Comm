<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
?>
<head>
    <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url("assets/css/ext/login.css"); ?>" rel="stylesheet">
    <title>MultiE-Comm</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/css/sb-admin.css"); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("assets/css/plugins/morris.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="middlePage" style="top:-150px">
        <div class="page-header">
            <h1 class="logo">MECO <small>Register</small></h1>
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
////
//
//
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
                        echo form_input("username",$username,"placeholder='Enter Username Here' class='form-control input-md'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='email'>Email :</label>";
                        //                        echo "<input type='password' class='form-control' name='inputPassword' id='inputPassword' placeholder='Enter Password here' />";
                        echo form_input("email",$email,"placeholder='Enter Email Here' class='form-control input-md'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='password'>Password :</label>";
//                        echo "<input type='password' class='form-control' name='inputPassword' id='inputPassword' placeholder='Enter Password here' />";
                        echo form_password("password",$password,"placeholder='Enter Password here' class='form-control input-md'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='password'>Confirm Password :</label>";
//                        echo "<input type='password' class='form-control' name='inputConfirmPassword' id='inputConfirmPassword' placeholder='Enter Confirm Password here' />";
                        echo form_password("confirmpassword",$confirmpassword,"placeholder='Enter Confirm Password here' class='form-control input-md'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='fName'>First Name :</label>";
//                        echo "<input type='text' class='form-control' name='inputfName' id='inputfName' placeholder='Enter First Name here' />";
                        echo form_input("firstname",$firstname,"placeholder='Enter First Name Here' class='form-control input-md'");
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo "<label for='lName'>Last Name :</label>";
//                        echo "<input type='text' class='form-control' name='inputlName' id='inputlName' placeholder='Enter Last Name here' />";
                        echo form_input("lastname",$lastname,"placeholder='Enter Last Name Here' class='form-control input-md'");
                        echo "</div>";
                        echo "<div class='form-group'>";
//                        echo "<button type='button' class='btn btn-primary btn-block' id='submitData'>Register Now!</button>";
                            echo form_submit('registerBtn', 'Register', 'class="btn btn-info btn-sm" style="width: 100%;');
                        echo "</div>";
                        echo "<div class='form-group'>";
                        echo form_submit('submitReg', 'Register Now', 'class="btn btn-info btn-sm pull-right"');
                        echo "</div>";
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
