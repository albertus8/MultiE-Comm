<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
?>
<script type="text/javascript">
    var catchFile="";
    var formData = new FormData();
    $('input[type="file"]').change(function(){
        catchFile = $('#targetText').val($(this).val().replace(/.*(\/|\\)/, ''));

//        formData.append('file', catchFile);
//        alert("A file has been selected.");
    });

    $('#submitFile').on('click', function(){
        if(!catchFile){
            console.log("empty");
        }else{
            formData.append('file', $('input[type=file]')[0].files[0]);
            formData.append("idUser", '<?php echo $ID_user; ?>')
            console.log(formData);
            $.ajax({
                url             : 'api/fileUpload/',  //server script to process data
                type            : 'POST',
                fileElementId	: 'userfile',
                data            : formData,
                contentType     : false,       // The content type used when sending data to the server.
                cache           : false,             // To unable request pages to be cached
                processData     : false,        // To send DOMDocument or non processed data file it is set to false
                xhr: function() {  // custom xhr
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with upload progress
                            console.log(percentComplete);
                        }
                    }, false);
                    xhr.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with download progress
                            console.log(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function(result){
                    //Do something success-ish
                    if(result){
                        $('#myModal').modal('toggle');
                    }
                    else {

                        $(".alert.alert-danger").fadeIn("slow");
                    }
//                    console.log(result);
                }
            });
        }


    });

//    $("#selectFile").fileinput({
//        uploadUrl: "http://localhost/file-upload-batch/1", // server upload action
//        uploadAsync: false,
//        showPreview: false,
//        allowedFileExtensions: ['json', 'xml'],
//        maxFileCount: 1,
//        elErrorContainer: '#input-error-2'
//    });
</script>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Settings <small>Database Configurations</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-cogs"></i> Settings
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-fw fa-cogs"></i> Data Upload</h3>
                </div>
                <div class="alert alert-danger alert-dismissable" hidden="hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <center><i class="fa fa-info-circle"></i>  <strong>Oops!</strong> It seems you caught an error. Try it again!</center>
                </div>
                <div class="panel-body">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-primary">
                                            Browse&hellip; <input type="file" id="selectFile" accept=".json, .xml" style="display: none;" multiple>
                                        </span>
                                    </label>
                                    <input type="text" id="targetText" class="form-control text-right" readonly>
                                </div>
                                <button type="button" class="btn btn-primary btn-block" id="submitFile">Submit Data</button>
                            </div>
                            <div class="col-lg-6"></div>
                        </div>
                    <div class="col-lg-12">
                        <div class="col-lg-6 target">

                        </div>
                    </div>
<!--                    <div class="col-lg-6">-->
<!--                        <input id="inputFile" name="inputFile[]" type="file" multiple class="file-loading">-->
<!--                        <div id="input-error-2" style="margin-top:10px;display:none"></div>-->
<!--                        <div id="input-success-2" class="alert alert-success fade in" style="margin-top:10px;display:none"></div>-->
<!--                    </div>-->
                </div>

            </div>
        </div>
    </div>
<div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Actions</h4>
            </div>
            <div class="modal-body" id="targetView">
                File uploaded successfully!
            </div>
        </div>
    </div>
</div>

</body>
</html>



