<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
require(APPPATH.'libraries/REST_Controller.php');

class Api extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('InsertApi','',TRUE);
    }
    function data_get()
    {
//        $data = array($this->get('id'));
//        $this->response($data);
//        $file = APPPATH . 'testFile.json';
//        $json = file_get_contents($file);
//        var_dump(json_decode($json, true));

//        print_r($data);

//        var_dump($users);


    }

    function fileUpload_post()
    {
        $session_id = $this->session->userdata('loginData');

        $data = $_FILES['file'];
        $ctr = 0;
        $hashedID = 'data-'.$session_id['ID_user'].'-';
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
        $config['allowed_types'] = 'json|xml';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;


        $this->load->library('upload', $config);

        $file = scandir(APPPATH.'uploads/');
        $dataGet = file_get_contents($data["tmp_name"]);

        for($i=2;$i < count($file); $i++){
            if(substr($file[$i], 0, 19) == $hashedID){
                $ctr++;
            }
        }

        $padStr = str_pad($ctr+1,5,"0",STR_PAD_LEFT);
        $hashedID .= $padStr;

        if (file_exists(APPPATH.'uploads/'.$hashedID.'.json')) {

        }
        else
        {
            $fp = fopen(APPPATH.'uploads/'.$hashedID.'.json', 'wb');
            if($data["type"] == "text/xml"){
                $xml = simplexml_load_string($dataGet);
                $json = json_encode($xml);

                $lenght = strlen($json);
                $pos1 = strpos($json, '[', 0);
                $anotherVar = substr($json, $pos1, $lenght-$pos1-1);

                $array = json_decode(trim($anotherVar),TRUE);
                fwrite($fp, json_encode($array));
            }
            else
            {
                $input_data = json_decode(trim($dataGet), true);
                fwrite($fp, json_encode($input_data));
            }
            fclose($fp);
        }

        $this->InsertApi->insertData($session_id['ID_user']);
        return true;
    }

    function json_get()
    {
        // GET DATA FROM DB THEN WRITE TO JSON FILE
        // get data from db
        $query = $this->db->get("data_penjualan");
        // insert data to array
        foreach ($query->result() as $row)
        {
            $post[] = array(
                "id"         => $row->ID_DPENJUALAN,
                "iduser"    => $row->ID_user,
                "namatoko"  => $row->NAMA_TOKO,
                "tanggal"          => $row->TGL_BELI,
                "totalpenjualan"  => $row->TOTAL_PENJUALAN
            );
        }
        // encode json
        $response['post'] = $post;
        //echo json_encode($response, true);

        //write to disk
        $fp = fopen(APPPATH.'data.json', 'w');
        fwrite($fp, json_encode($post));
        fclose($fp);
        echo "<pre>";
        echo "file written to ".APPPATH.'data.json';
        print_r($post);
        // END OF SYNTAX
    }

    function coba_get(){
        $this->response("berhasil");
    }
//
//    function user_put()
//    {
//        $data = array('returned: '. $this->put('id'));
//        $this->response($data);
//    }
//
//    function user_delete()
//    {
//        $data = array('returned: '. $this->delete('id'));
//        $this->response($data);
//    }
}