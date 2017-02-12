<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Des 2016.
 */
require(APPPATH.'libraries/REST_Controller.php');

class Example_api extends REST_Controller {
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

    function user_get()
    {
//        $data = array('returned: '. $this->post('id'));
//        $this->response($data);
//        print_r($data);
//        echo "Ryu no baka :(";
//        $fp = fopen(APPPATH.'results.json', 'r');
        $json = file_get_contents(APPPATH.'results.json');
        $parameters = (array) json_decode($json, true);
//        echo '<pre>'; print_r($parameters); echo '</pre>';

        $this->insertApi->insertData($parameters);


//        $file = APPPATH . 'testFile.json';
//        $json = file_get_contents($file);
//        $input_data = json_decode(trim($json), true);
//
//        var_dump($input_data);

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