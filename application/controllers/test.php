<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        // 파일에 내용을 읽어서 그냥 화면에 뿌려준다.
        $this->load->model('test_model');
        $readData = $this->test_model->gets();
        $param['data'] = $readData;
        $this->load->view('test', $param);
    }

    public function insert(){
        $number = $_POST['number'];
        $title = $_POST['title'];
        $count = $_POST['count'];
        $date = $_POST['date'];

        if($number==null || $title==null){
            redirect('/test');
        } else {
            // 받은 데이터를 파일에 쓰기
            $this->load->model('test_model');
            $this->test_model->insert($number, $title, $count, $date);
            redirect('/test');
        }
    }

    public function select(){
        $selectOption = $_POST['select'];
        $keyword = $_POST['keyword'];

        if($selectOption == 't'){
            $this->load->model('test_model');
            $readData = $this->test_model->select($keyword);

            $param['data'] = $readData;
            $this->load->view('test', $param);
        }
    }

    public function update(){
        $number = $_POST['number'];
        $title = $_POST['title'];

        if($number==null || $title==null){
            redirect('/test');
        } else {
            $this->load->model('test_model');
            $this->test_model->update($number, $title);

            redirect('/test');
        }
    }

    public function delete(){
        $date = $_POST['date'];
        $this->load->model('test_model');
        $this->test_model->delete($date);

        redirect('/test');
    }

//    번호 중복확인
    public function a_check(){
        $json = $_POST['data'];
        $json = json_decode($json, true);
//        print_r($json);

        $number = $json["number"];
//        print_r($number);

        $this->load->model('test_model');
        $msg = $this->test_model->check($number);

        $result = json_encode($msg);
        echo $result;
    }

//    출력
    public function view(){
        $this->load->model('test_model');

        $readData = $this->test_model->gets();
        $data = json_encode($readData);

        return $data;
    }

//    입력
    public function a_insert(){
        //$json = $this->input->post("data");
        $json = $_POST['data'];
        $json = json_decode($json, true);
//        print_r($json); exit;

        $number = $json["number"];
        $title = $json["title"];
        $count = $json["count"];
//        $date =  $json["date"];

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d,H:i:s');

        if($number==null || $title==null){

        } else {
            $this->load->model('test_model');
            $this->test_model->insert($number, $title, $count, $date);

            $result = $this->view();
            echo $result;
        }
    }

//    제목검색
    public function a_select(){
        $json = $_POST['data'];
        $json = json_decode($json, true);
//        print_r($json); exit;

        $selectOption = $json["select"];
        $keyword = $json["keyword"];

        if($selectOption == 't'){
            $this->load->model('test_model');
            $readData = $this->test_model->select($keyword);

            $result = json_encode($readData);
            echo $result;
        }
    }

//    수정
    public function a_update(){
        $json = $_POST['data'];
        $json = json_decode($json, true);

        $number = $json["number"];
        $title = $json["title"];

        if($number==null || $title==null){

        } else {
            $this->load->model('test_model');
            $this->test_model->update($number, $title);

            $result = $this->view();
            echo $result;
        }
    }

//    삭제
    public function a_delete(){
        $json = $_POST['data'];
        $json = json_decode($json, true);
        $date =  $json["date"];

        $this->load->model('test_model');
        $this->test_model->delete($date);

        $result = $this->view();
        echo $result;
    }


}