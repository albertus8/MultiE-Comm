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
<div class="middlePage">
<div class="page-header">
  <h1 class="logo">MECO <small>Welcome to our place!</small></h1>
</div>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Please Sign In</h3>
    </div>
    <div class="panel-body">
  
      <div class="row">

        <div class="col-md-5" >
            <a href="#"><img src="http://techulus.com/buttons/fb.png" /></a><br/>
            <a href="#"><img src="http://techulus.com/buttons/tw.png" /></a><br/>
            <a href="#"><img src="http://techulus.com/buttons/gplus.png" /></a>
        </div>

        <div class="col-md-7" style="border-left:1px solid #ccc;height:140px">
        <?php
            echo form_open('login');
                echo form_input("username",$username,"placeholder='Enter User Name' class='form-control input-md'");
                echo '<div class="spacing"></div>';
                echo form_password("password",$password,"placeholder='Enter Password' class='form-control input-md'");
                echo '<div class="spacing"></div>';
                echo form_checkbox("rememberChk", "Remember me", FALSE); echo "<small>Remember me</small>";
                echo '<a href="#"><small style="float:right;"> Forgot Password?</small></a><br>';
                echo form_submit('loginBtn', 'Sign In', 'class="btn btn-info btn-sm pull-right"');

            echo form_close();
        ?>
        </div>
          <label style="width: 100%;float: inherit;text-align: center;">OR</label>
          <div class="col-md-12" style="margin 0 auto;position: relative;">
              <?php
              echo form_open('login');
              echo form_submit('registerPage', 'Register Here', 'class="btn btn-info btn-sm" style="width: 100%;');
              echo form_close();
              ?>
          </div>
      </div>
    </div>

</div>
<p><a href="#">About</a> &copy; MECO</p>

</div>

</body>