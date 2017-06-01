<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
Class InsertApi extends CI_Model
{
    function insertData($paramID)
    {
        $file = scandir(APPPATH.'uploads/');
        $ctr = 0;
        $arrHNOTA = [];
        $arrDNOTA = [];
        $arrBARANG = [];

        print_r($file);
        for($i=2;$i < count($file); $i++){
            if(substr($file[$i], 5, 13) == $paramID){
                $array[$ctr] = file_get_contents(APPPATH . 'uploads/'.$file[$i]);
                $ctr++;
            }
        }

        for($j=0; $j < count($array); $j++){


            $encArr = json_decode($array[$j], true);
            print_r($encArr);
        }

        for($k=0; $k < count($encArr); $k++){
            if(isset($encArr[$k]['subtotal'])){
                array_push($arrDNOTA, $encArr[$k]);
            }elseif (isset($encArr[$k]['iddpenjualan'])){
                array_push($arrHNOTA, $encArr[$k]);
            }elseif (isset($encArr[$k]['idbarang'])){
                array_push($arrBARANG, $encArr[$k]);
            }
        }
//
//        echo "Barang";
//        print_r($arrBARANG);
//        echo "Hnota";
//        print_r($arrHNOTA);
//        echo "Dnota";
//        print_r($arrDNOTA);

        $this->db->trans_start();
        // barang
        for($l = 0; $l < count($arrBARANG); $l++){
            $this -> db -> from('barang');
            $this -> db -> where('ID_BARANG', $arrBARANG[$l]['idbarang']);
            $this -> db -> where('ID_user',$paramID);
            $query = $this -> db -> get();

            if($query && $query->num_rows() > 0){

                // query update
                    $where = array(
                            'ID_BARANG ' => $arrBARANG[$l]['idbarang'],
                            'ID_user '   => $paramID
                    );
                    $dataUpdate = array(
                        'NAMA_BARANG' => $arrBARANG[$l]['namabarang'],
                        'JENIS_BARANG' => $arrBARANG[$l]['jenis'],
                        'QUANTITY_BARANG' => $arrBARANG[$l]['quantity'],
                        'HARGA_PER_SATUAN_BARANG' => $arrBARANG[$l]['hargasatuan']
                    );
                    $this->db->where($where);
                    $this->db->update('barang', $dataUpdate);
//                echo $this->db->last_query();
            }else{

                // query insert
                $dataInsert = array(
                        'ID_BARANG'                 => $arrBARANG[$l]['idbarang'],
                        'ID_user'                   => $paramID,
                        'NAMA_BARANG'               => $arrBARANG[$l]['namabarang'],
                        'JENIS_BARANG'              => $arrBARANG[$l]['jenis'],
                        'QUANTITY_BARANG'           => $arrBARANG[$l]['quantity'],
                        'HARGA_PER_SATUAN_BARANG'   => $arrBARANG[$l]['hargasatuan']
                );

                $this->db->insert('barang', $dataInsert);
//                echo $this->db->last_query();
            }
        }
        //end of barang

        // header nota
        for($m = 0; $m < count($arrHNOTA); $m++) {
            $this->db->from('data_penjualan');
            $this->db->where('ID_DPENJUALAN', $arrHNOTA[$m]['iddpenjualan']);
            $this->db->where('ID_user', $paramID);
            $query = $this->db->get();

            if ($query && $query->num_rows() > 0) {
//
//            // query update
                $where = array(
                    'ID_DPENJUALAN ' =>  $arrHNOTA[$m]['iddpenjualan'],
                    'ID_user '       => $paramID
                );
                $dataUpdate = array(
                    'NAMA_TOKO'          => $arrHNOTA[$m]['namatoko'],
                    'TGL_BELI'           => $arrHNOTA[$m]['tanggal'],
                    'TOTAL_PENJUALAN'    => $arrHNOTA[$m]['totalpenjualan'],
                );

                $this->db->where($where);
                $this->db->update('data_penjualan', $dataUpdate);
//            echo $this->db->last_query();
            } else {

//            // query insert
//            print_r($dataInsert);
                $dataInsert = array(
                    'ID_DPENJUALAN' => $arrHNOTA[$m]['iddpenjualan'],
                    'ID_user' => $paramID,
                    'NAMA_TOKO' => $arrHNOTA[$m]['namatoko'],
                    'TGL_BELI' => $arrHNOTA[$m]['tanggal'],
                    'TOTAL_PENJUALAN' => $arrHNOTA[$m]['totalpenjualan'],
                    'ENABLE' => 1
                );
                $this->db->insert('data_penjualan', $dataInsert);
////            echo $this->db->last_query();

            }
        }
        // end of header nota

        // detail nota
        for ($n = 0; $n < count($arrDNOTA); $n++) {
            $this->db->from('d_data_penjualan');
            $this->db->where('ID_DPENJUALAN', $arrDNOTA[$n]['iddpenjualan']);
            $query = $this->db->get();

            if($query && $query->num_rows() > 0){

                // query update
                $where = array(
                    'ID_DPENJUALAN ' =>  $arrDNOTA[$n]['iddpenjualan']
                );
                $dataUpdate = array(
                    'NAMA_BARANG'               => $arrDNOTA[$n]['namabarang'],
                    'JENIS_BARANG'              => $arrDNOTA[$n]['jenis'],
                    'QUANTITY_BARANG'           => $arrDNOTA[$n]['quantity'],
                    'HARGA_PER_SATUAN_BARANG'   => $arrDNOTA[$n]['hargasatuan'],
                    'SUBTOTAL_PER_BARANG'       => $arrDNOTA[$n]['subtotal']
                );
                $this->db->where($where);
                $this->db->update('d_data_penjualan', $dataUpdate);
        //            echo $this->db->last_query();
            }else{

                // query insert
                $dataInsert = array(
                    'ID_DPENJUALAN'             => $arrDNOTA[$n]['iddpenjualan'],
                    'ID_BARANG'                 => $arrDNOTA[$n]['idbarang'],
                    'NAMA_BARANG'               => $arrDNOTA[$n]['namabarang'],
                    'JENIS_BARANG'              => $arrDNOTA[$n]['jenis'],
                    'QUANTITY_BARANG'           => $arrDNOTA[$n]['quantity'],
                    'HARGA_PER_SATUAN_BARANG'   => $arrDNOTA[$n]['hargasatuan'],
                    'SUBTOTAL_PER_BARANG'       => $arrDNOTA[$n]['subtotal']
                );

                $this->db->insert('d_data_penjualan', $dataInsert);
//                echo $this->db->last_query();
            }
        }
        // end of detail nota
        $this->db->trans_complete();

//        for($j=0; $j < count($array); $j++){
//            $encArr = json_decode($array[$j], true);
//
//
//            for($k=0; $k < count($encArr); $k++){
////                $this -> db -> from('data_penjualan');
////                $this -> db -> where('ID_user',$paramID);
////                $this -> db -> where('ID_DPENJUALAN', $encArr[$k]['id']);
////                $this -> db -> where('NAMA_TOKO', $encArr[$k]['nama toko']);
////                $query = $this -> db -> get();
//
////                $sql = "  SELECT * FROM `data_penjualan` WHERE `ID_user` = '".$paramID."' AND `ID_DPENJUALAN` = '".$encArr[$k]['id']."' AND `NAMA_TOKO` = '".$encArr[$k]['nama toko']."'; ";
////                $query = $this->db->query($sql);
////                echo $this->db->last_query();
//
//
////                if($query && $query->num_rows() > 0){
////                    // query update
////                    $where = array(
////                            'ID_DPENJUALAN ' => $encArr[$k]['id'] ,
////                            'NAMA_TOKO ' => $encArr[$k]['nama toko']
////                    );
////                    $dataUpdate = array(
////                        'TGL_BELI' => $encArr[$k]['tanggal'],
////                        'TOTAL_PENJUALAN' => $encArr[$k]['total penjualan']
////                    );
//////                    $this->db->where($where);
//////                    $this->db->update('data_penjualan', $dataUpdate);
////                }else{
////
//////                    echo $this->db->last_query();
////                    // query insert
////                    $originalDate = $encArr[$k]['tanggal'];
////                    $newDate = date("Y-m-d", strtotime($originalDate));
////
////                    $dataInsert = array(
////                            'ID_DPENJUALAN'     => $encArr[$k]['id'],
////                            'ID_user'           => $encArr[$k]['id user'],
////                            'NAMA_TOKO'         => $encArr[$k]['nama toko'],
////                            'TGL_BELI'          => $newDate,
////                            'TOTAL_PENJUALAN'   => $encArr[$k]['total penjualan'],
////                            'ENABLE'            => 1
////                    );
//
////                    echo "<pre>";
////                    var_dump($dataInsert);
////                    echo "</pre>";
////                    $this->db->insert('data_penjualan', $dataInsert);
////                }
//
//            }
//
//
//
//        }
    }
}