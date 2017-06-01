<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Feb 2017.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('DbActions','',TRUE);
    }

    public function index()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $data = $this->DbActions->getTableUser();

        $response['data'] = $data;
        $this->load->view('subscriber', $response);
    }
    function postInsert(){
//        echo "<div class='form-group'>";
//            echo "<label for='userID'>ID :</label>";
//            echo "<input type='text' class='form-control' name='inputID' id='inputID' placeholder='ID User'/>";
//        echo "</div>";
        echo "<div class='form-group'>";
            echo "<label for='username'>Username :</label>";
            echo "<input type='text' class='form-control' name='inputUsername' id='inputUsername' placeholder='Enter Username here' />";
        echo "</div>";
        echo "<div class='form-group'>";
            echo "<label for='username'>Email :</label>";
            echo "<input type='text' class='form-control' name='inputEmail' id='inputEmail' placeholder='Enter Email here' />";
        echo "</div>";
        echo "<div class='form-group'>";
            echo "<label for='password'>Password :</label>";
            echo "<input type='password' class='form-control' name='inputPassword' id='inputPassword' placeholder='Enter Password here' />";
        echo "</div>";
        echo "<div class='form-group'>";
            echo "<label for='password'>Confirm Password :</label>";
            echo "<input type='password' class='form-control' name='inputConfirmPassword' id='inputConfirmPassword' placeholder='Enter Confirm Password here' />";
        echo "</div>";
        echo "<div class='form-group'>";
            echo "<label for='fName'>First Name :</label>";
            echo "<input type='text' class='form-control' name='inputfName' id='inputfName' placeholder='Enter First Name here' />";
        echo "</div>";
        echo "<div class='form-group'>";
            echo "<label for='lName'>Last Name :</label>";
            echo "<input type='text' class='form-control' name='inputlName' id='inputlName' placeholder='Enter Last Name here' />";
        echo "</div>";

        echo "<div class='form-group col-lg-6'>";
            echo "<label for='levelUser'>Level User :</label>";
            echo "<div class='dropdown'>";
                echo "<button class='btn btn-primary dropdown-toggle primary-userLevel' type='button' data-toggle='dropdown'>Select Level User ";
                    echo "<span class='caret'></span></button>";
                echo "<ul class='dropdown-menu' id='userLevel'>";
                    echo "<li value='1'><a>1: Super Admin</a></li>";
                    echo "<li value='2'><a>2: Paid User</a></li>";
                    echo "<li value='3'><a>3: Free User</a></li>";
                echo "</ul>";
            echo "</div>";
        echo "</div>";
        echo "<div class='form-group col-lg-6'>";
            echo "<label for='status'>Status :</label>";
            echo "<div class='dropdown'>";
                echo "<button class='btn btn-primary dropdown-toggle primary-userStatus' type='button' data-toggle='dropdown'>Select Status User";
                    echo " <span class='caret'></span></button>";
                echo "<ul class='dropdown-menu' id='userStatus'>";
                    echo "<li value='1'><a>Enable</a></li>";
                    echo "<li value='0'><a>Disable</a></li>";
                echo "</ul>";
            echo "</div>";
        echo "</div>";
        echo "<div class='form-group'>";
            echo "<button type='button' class='btn btn-primary btn-block' id='submitData'>Submit User Data</button>";
        echo "</div>";
    }

    function searchUserPost(){
        $dataString = $this->input->post('getData');
        $this->DbActions->searchUser($dataString);
//        echo "hasilnya ". $dataString;

        $hasilresult = $this->DbActions->searchUser($dataString);
        echo "<div class='panel-body'>";
        echo "<div class='col-lg-12'>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Username</th>";
        echo "<th>Nama Depan</th>";
        echo "<th>Nama Belakang</th>";
        echo "<th class='text-center'>User Level</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        for ($j = 0; $j < count($hasilresult); $j++){
            echo "<tr class='clickable'>";
            echo "<td style='width:70px'>".$hasilresult[$j]['ID']."</td>";
            echo "<td>".$hasilresult[$j]['Username']."</td>";
            echo "<td>".$hasilresult[$j]['Nama Depan']."</td>";
            echo "<td>".$hasilresult[$j]['Nama Belakang']."</td>";
            echo "<td class='text-center'>".$hasilresult[$j]['Level User']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function insertUser(){
        $getData = $this->input->post('getData');
        $getDataArray = array(
            array(
                'ID_user' => "",
                'username' => $getData[0],
                'email' => $getData[1],
                'password' => $getData[2],
                'firstname' => $getData[4],
                'lastname' => $getData[5],
                'joindate' => date("Y-m-d H:i:s"),
                'remember_toogle' => 0,
                'userLevel' => $getData[6],
                'enabledToggle' => $getData[7],
                'deletedRecord' => 0,
                'deleteDate' => "0000-00-00 00:00:00"
            )
        );
        $this->DbActions->insertUser($getDataArray);
    }
    function deleteUser(){
        $data = $this->DbActions->getTableUser();

        echo "<div class='panel-body'>";
        echo "<div class='col-lg-12'>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-hover'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Username</th>";
        echo "<th>Nama Depan</th>";
        echo "<th>Nama Belakang</th>";
        echo "<th class='text-center'>User Level</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        for ($j = 0; $j < count($data); $j++){
            echo "<tr class='clickable'>";
            echo "<td style='width:70px'>".$data[$j]['ID']."</td>";
            echo "<td>".$data[$j]['Username']."</td>";
            echo "<td>".$data[$j]['Nama Depan']."</td>";
            echo "<td>".$data[$j]['Nama Belakang']."</td>";
            echo "<td class='text-center'>".$data[$j]['Level User']."</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

function deleteUserPost(){
    $data = $this->input->post('getData');
    $this->DbActions->deleteUser($data);
}
}
