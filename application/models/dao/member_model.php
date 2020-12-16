<?php
class Member_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }

//    아이디중복확인
    public function id_check($id){
        $count = $this->db->get_where('member', array('id'=>$id));
        if($count->num_rows()>0){
            return $result = false;
        } else {
            return $result = true;
        }
    }

//    회원가입
    public function join($data) {
        $this->db->insert('member', $data);
    }

//    로그인
    public function login($id){
        return $this->db->get_where('member', array('id'=>$id))->row();
    }

}