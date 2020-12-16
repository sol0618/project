<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller
{
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->model('service/member_service');
    }

//    아이디 중복확인
    public function id_check(){
        $id = $_POST['id'];
        $data = $this->member_service->id_check($id);
        $data = json_encode($data);
        echo $data;
    }

//    비밀번호 정규식 확인
    public function password_check(){
        $password = $_POST['password'];
        $data = $this->member_service->password_check($password);
        $data = json_encode($data);
        echo $data;
    }

//    비밀번호 일치 확인
    public function password2_check(){
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        $data = $this->member_service->password2_check($password, $password2);
        $data = json_encode($data);
        echo $data;
    }

//    핸드폰번호 확인
    public function phone_check(){
        $phone = $_POST['phone'];
        $data = $this->member_service->phone_check($phone);
        $data = json_encode($data);
        echo $data;
    }


}