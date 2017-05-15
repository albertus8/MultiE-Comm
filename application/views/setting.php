<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
?>
<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
    var catchFile="";
    var formData = new FormData();
    $('input[type="file"]').change(function(){
        catchFile = $('#targetText').val($(this).val().replace(/.*(\/|\\)/, ''));
    });

    $('#submitFile').on('click', function(){
        if(!catchFile){
            // error empty data here
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
                        $('.modal-body').find('#targetView').html(result);
                    }
                    else {

                        $(".alert.alert-danger").fadeIn("slow");
                    }
                    console.log(result);
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
                    <div class="col-lg-6 pull-left">
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> Ada langkah yang dibutuhkan untuk upload data, yakni: <br />
                            &nbsp; &nbsp; &nbsp; 1. Tipe file hanya diperbolehkan .json atau .xml <br />
                            &nbsp; &nbsp; &nbsp; 2. Penulisan isi file harus sesuai dengan format <br />
                            &nbsp; &nbsp; &nbsp; 3. Perhatikan tipe data yang digunakan <br />
                            &nbsp; &nbsp; &nbsp; 4. Hanya dapat upload satu data dalam satu waktu
                        </div>
                    </div>
                    <div class="col-lg-6 pull-right">
                        <div class="alert alert-warning">
                            <strong>Tipe Data</strong>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nama Field</th>
                                        <th>Tipe Data (Chr.)</th>
                                        <th class="text-center">Null</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ID_BARANG</td>
                                        <td>varchar(14)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>NAMA_BARANG</td>
                                        <td>varchar(64)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>JENIS_BARANG</td>
                                        <td>varchar(64)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>QUANTITY_BARANG</td>
                                        <td>int(4)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>HARGA_PER_SATUAN_BARANG</td>
                                        <td>int(9)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nama Field</th>
                                        <th>Tipe Data (Chr.)</th>
                                        <th class="text-center">Null</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ID_DPENJUALAN</td>
                                        <td>varchar(14)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>NAMA_TOKO</td>
                                        <td>varchar(64)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>TGL_BELI</td>
                                        <td>date</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL_PENJUALAN</td>
                                        <td>int(9)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nama Field</th>
                                        <th>Tipe Data (Chr.)</th>
                                        <th class="text-center">Null</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ID_DPENJUALAN</td>
                                        <td>varchar(14)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>ID_BARANG</td>
                                        <td>varchar(14)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>NAMA_BARANG</td>
                                        <td>varchar(64)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>JENIS_BARANG</td>
                                        <td>varchar(64)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>QUANTITY_BARANG</td>
                                        <td>int(4)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>HARGA_PER_SATUAN_BARANG</td>
                                        <td>int(9)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    <tr>
                                        <td>SUBTOTAL_PER_BARANG</td>
                                        <td>int(9)</td>
                                        <td class="text-center">No</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pull-left">
                        <strong>Contoh Penulisan Json</strong>
        <pre>
            [
                {
                    "idbarang":"BC270417000002",
                    "namabarang":"GTX 1050 ZOTAC",
                    "jenis":"GPU",
                    "quantity":"19",
                    "harga satuan":"2100000"
                },
                {
                    "idbarang":"BC270417000004",
                    "namabarang":"Mi Gamepad",
                    "jenis":"Accesories",
                    "quantity":"21",
                    "harga satuan":"250000"
                }
            ]
        </pre>
                    </div>
                    <div class="col-lg-6 pull-left">
                        <strong>Contoh Penulisan Xml</strong>
                        <pre>
                            <xmp>
            <root>
                <data>
                    <idbarang>BC270417000002</idbarang>
                    <namabarang>GTX 1050 ZOTAC</namabarang>
                    <jenis>GPU</jenis>
                    <quantity>19</quantity>
                    <hargasatuan>2100000</hargasatuan>
                </data>
                <data>
                    <idbarang>BC270417000004</idbarang>
                    <namabarang>Mi Gamepad</namabarang>
                    <jenis>Accesories</jenis>
                    <quantity>19</quantity>
                    <hargasatuan>250000</hargasatuan>
                </data>
            </root>
                            </xmp>
                        </pre>
                    </div>



                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> Select Data : </label>
                        </div>
                        <div class="input-group">
                            <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Browse&hellip; <input type="file" id="selectFile" accept=".json, .xml" style="display: none;">
                                </span>
                            </label>
                            <input type="text" id="targetText" class="form-control text-right" readonly>
                        </div>
                        <hr>
                        <button type="button" class="btn btn-primary btn-block" id="submitFile">Submit Data</button>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label> File History : </label>
                        </div>
                        <ul>
                            <?php
                            for($i=0;$i<count($data);$i++){
                                echo "<li>".$data[$i]. "</li>";
                            }
                            ?>
                        </ul>

                    </div>
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



