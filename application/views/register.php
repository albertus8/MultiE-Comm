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
</head>
<body>
    <div class="middlePage">
        <div class="page-header">
            <h1 class="logo">MECO <small>Register</small></h1>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Register here</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12" style="border-left:1px solid #ccc;height:200px">
                        <?php
                            echo form_open('register');
                            echo form_input('username', $username, "placeholder='Enter User Name' class='form-control input-md'");
                            echo form_password('password', $password, "placeholder='Enter Password' class='form-control input-md'");
                            echo form_input('firstname', $firstname, "placeholder='Enter First Name' class='form-control input-md'");
                            echo form_input('lastname', $lastname, "placeholder='Enter Last Name' class='form-control input-md'");
                            echo timezone_menu('UP7');

                            echo "<br><br>";

                            echo form_submit('registerBtn', 'Register', 'class="btn btn-info btn-sm pull-right"');

//                        $format = 'DATE_RFC822';
//                        $time = time();
//                        echo standard_date($format, $time);
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
