<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test1 extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->database();
        $this->load->model('test1_model');
    }

    public function index(){
        $readData = $this->test1_model->gets();
        $this->load->view('test1', array('list' => $readData));
    }

//    출력
    public function view(){
        $readData = $this->test1_model>gets();
        $data = json_encode($readData);
        return $data;
    }

    //번호 중복확인
    public function check(){
        $json = $_POST['data'];
        $json = json_decode($json, true);

        $number = $json["number"];

        $msg = $this->test1_model->check($number);
        $result = json_encode($msg);
        echo $result;
    }
    
//    입력
    public function insert(){
        $json = $_POST['data'];
        $json = json_decode($json, true);

        $number = $json["number"];
        $title = $json["title"];
        $count = $json["count"];
//        date_default_timezone_set('Asia/Seoul');
//        $date = date('Y-m-d H:i:s');

        $data = array(
            'number' => $number,
            'title' => $title,
            'count' => $count
//            'date' => $date
        );

        if($number==null || $title==null){

        } else {
            $this->test1_model->insert($data);
            $result = $this->view();
            echo $result;
        }
    }

//    제목검색
    public function select(){
        $json = $_POST['data'];
        $json = json_decode($json, true);

        $selectOption = $json["select"];
        $keyword = $json["keyword"];

        if($selectOption == 't'){
            $readData = $this->test1_model->select($keyword);
            $result = json_encode($readData);
            echo $result;
        }
    }

//    수정
    public function update(){
        $json = $_POST['data'];
        $json = json_decode($json, true);

        $number = $json["number"];
        $title = $json["title"];

        if($number==null || $title==null){

        } else {
            $this->test1_model->update($number, $title);
            $result = $this->view();
            echo $result;
        }
    }

//    삭제
    public function delete(){
        $json = $_POST['data'];
        $json = json_decode($json, true);
        $date =  $json["date"];

        $this->test1_model->delete($date);
        $result = $this->view();
        echo $result;
    }

    //ex
    function get($id){
        $readData = $this->test1_model->get($id);
        $this->load->view('test1', array('$readData' => $readData));
    }



}