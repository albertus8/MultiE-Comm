<script type="text/javascript">
    $(document).ready(function () {
        $('.editProfile').on('click',function(){
            var divHtml = "<?php echo $firstname." ".$lastname ?>";
            $('#edit-input').html("<input type='text' class='form-control' id='edit-name' placeholder='Input Name' width='50%'>");
        });
    });
</script>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            User <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-fw fa-file"></i> User Profile
            </li>
        </ol>
    </div>
</div>

<!-- Page Wrapper -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-file fa-fw"></i> User Profile</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-3">
                    <div class="thumbnail well well-sm">
                        <img src="<?php echo base_url("uploads/profile.jpg"); ?>" style="width:230px;z-index: 1;">
                    </div>
                </div>
                <div class="col-lg-4">

                    <div class="form-group">
                        <span style="float: right">
                            <button type="button" class="btn btn-warning editProfile"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
                        </span>
                        <span id="edit-input">
                            <h2><b id="nameDiv"><?php echo $firstname."&nbsp;".$lastname; ?></b></h2>
                        </span>
                    </div>
                    <div class="form-group">
                        <table>
                            <tr>
                                <td><i class="fa fa-envelope" aria-hidden="true"></i></td>
                                <td>&nbsp; <label><?php echo $email; ?></label></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-user" aria-hidden="true"></i></td>
                                <td>&nbsp; <label><?php echo $username; ?></label></td>
                            </tr>
                        </table>

                    </div>
                    <div class="form-group">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

