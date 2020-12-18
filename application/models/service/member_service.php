<?php
class Member_service extends CI_Model{
    function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->model('dao/member_model');
    }

//    아이디 중복확인
    public function id_check($id){
        $this->form_validation->set_rules('id', '아이디', 'required|min_length[5]|alpha_numeric');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'msg' => "5글자 이상 영문 또는 숫자를 입력해주세요.",
                'result' => "false"
            );
        } else {
            $msg = $this->member_model->id_check($id);
            if($msg){
                $data = array(
                    'msg' => "사용가능한 아이디입니다.",
                    'result' => "true"
                );
            } else {
                $data = array(
                    'msg' => "중복된 아이디입니다.",
                    'result' => "false"
                );
            }
        }
        return $data;
    }

//    비밀번호 정규식 확인
    public function password_check($password){
        $pattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/";
        $result = preg_match($pattern, $password);

        if($result == 0 ) {
            $data = array(
                'msg' => "8자 이상, 영문, 숫자, 특수문자를 모두 하나 이상 사용하세요.",
                'result' => "false"
            );
        } else {
            $data = array(
                'msg' => "유효한 비밀번호입니다.",
                'result' => "true"
            );
        }
        return $data;
    }

//    비밀번호 일치 확인
    public function password2_check($password, $password2){
        $this->form_validation->set_rules('password', '비밀번호', 'required|matches[password2]');
        $this->form_validation->set_rules('password2', '비밀번호 확인','required');

        if($this->form_validation->run() == FALSE) {
            $data = array(
                'msg' => "비밀번호가 일치하지 않습니다.",
                'result' => "false"
            );
        } else {
            $data = array(
                'msg' => "비밀번호 일치합니다.",
                'result' => "true"
            );
        }
        return $data;
    }

//    핸드폰번호 확인
    public function phone_check($phone){
        $pattern = "/^[[:digit:]]{3}\-[[:digit:]]{3,4}\-[[:digit:]]{4}/";
        $result = preg_match($pattern, $phone);

        if($result == 0 ) {
            $data = array(
                'msg' => "유효하지 않은 핸드폰 번호입니다.",
                'result' => "false"
            );
        } else {
            $data = array(
                'msg' => "유효한 핸드폰 번호입니다.",
                'result' => "true"
            );
        }
        return $data;
    }

//    회원가입
    public function join($data) {
        $this->form_validation->set_rules('name', '이름', 'required');
        $this->form_validation->set_rules('birth', '생년월일', 'required');
        $this->form_validation->set_rules('email', '이메일 주소', 'required');

        if($this->form_validation->run() == FALSE) {
            return false;
        } else {
//            비밀번호 암호화
            $hash = password_hash($data['password'], PASSWORD_BCRYPT);
            $data['password'] = $hash;

            $this->member_model->join($data);
            return true;
        }
    }

//    로그인
    public function login($id, $password){
        $data = $this->member_model->login($id);

        if($id == $data->id && password_verify($password, $data->password)){
            //로그인 성공
            $_SESSION['login'] = true;
            $_SESSION['login_id'] = $data->id;
            $_SESSION['login_rank'] = $data->rank;
            return true;
        } else {
            return false;
        }
    }

}