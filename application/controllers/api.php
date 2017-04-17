<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
require(APPPATH.'libraries/REST_Controller.php');

class api extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('insertApi','',TRUE);
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
        $data = $_FILES['file'];
        $dataID = $this->input->post('idUser');
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
        $config['allowed_types'] = 'json|xml';
        $config['max_size'] = 1024 * 8;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
//
//        echo "<pre>";
//        print_r($data["type"]);
//        echo "</pre>";

        $dataGet = file_get_contents($data["tmp_name"]);
        $hashedID = hash('sha256', 'data-'.$dataID);
        if (file_exists(APPPATH.'uploads/'.$hashedID.'.json')) {
//            echo "<pre>";
//            echo "exist";
//            echo "</pre>";
        }
        else
        {
            $fp = fopen(APPPATH.'uploads/'.$hashedID.'.json', 'wb');
            if($data["type"] == "text/xml"){
                $xml = simplexml_load_string($dataGet);
                $json = json_encode($xml);
                $array = json_decode(trim($json),TRUE);
                fwrite($fp, json_encode($array));
    //            echo "<pre>";
    //            print_r(json_encode($array));
    //            echo "</pre>";
            }
            else
            {
                $input_data = json_decode(trim($dataGet), true);
                fwrite($fp, json_encode($input_data));
    //            echo "<pre>";
    //            print_r($input_data);
    //            echo "</pre>";
            }
            fclose($fp);
            echo "1";
            return true;
        }
    }

    function json_get()
    {
        // GET DATA FROM DB THEN WRITE TO JSON FILE
        // get data from db
        $query = $this->db->get("userlist");
        // insert data to array
        foreach ($query->result() as $row)
        {
            $post[] = array(
                "id"         => $row->ID_user,
                "username"   => $row->username,
                "password"   => $row->password,
                "firstname"  => $row->firstname,
                "joindate"   => $row->joindate
            );
        }
        // encode json
        $response['post'] = $post;
        //echo json_encode($response, true);

        //write to disk
        $fp = fopen(APPPATH.'data.json', 'w');
        fwrite($fp, json_encode($response));
        fclose($fp);
        echo "<pre>";
        echo "file written to ".APPPATH.'data.json';
        print_r($post);
        // END OF SYNTAX
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