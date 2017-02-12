<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Tables
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="Home">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-table"></i> Tables
            </li>
        </ol>
<!--        <pre>-->
<!--            --><?php //print_r($data); ?>
<!--        </pre>-->
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-table"></i> Data Tables</h3>
            </div>
            <div class="panel-body">
                <?php for ($i = 0; $i < count($toko); $i++) { ?>
                    <div class="col-lg-6">
                        <h2>Data Penjualan <?php echo ucwords(strtolower($toko[$i]['NamaToko'])); ?></h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <!--                    <th>Toko</th>-->
                                    <th class='text-center'>Tanggal</th>
                                    <th>Nominal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ($j = 0; $j < count($data); $j++){
                                    echo "<tr>";
                                    if ($data[$j]['NamaToko'] == $toko[$i]['NamaToko']){
                                        echo "<td>".$data[$j]['ID']."</td>";
                                        echo "<td class='text-center'>".$data[$j]['Tanggal']."</td>";
                                        echo "<td class='text-right' style='white-space:pre;width: 20px'>".$data[$j]['Nominal']."</td>";
                                    }
                                    echo "</tr>";
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


</div>
<!-- /.row -->