<?php
class Test1_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    public function gets(){
        return $this->db->get('list')->result();
//        return $this->db->query('SELECT * FROM list')->result();
    }
//    번호 중복확인
    public function check($number){
        $count = $this->db->get_where('list', array('number'=>$number));
        if($count->num_rows()>0){
            return $msg = "false";
        } else {
            return $msg = "true";
        }
    }
//    입력
    public function insert($data) {
        $this->db->set('date', 'NOW()', false);
        return $this->db->insert('list', $data);
    }
//    검색
    public function select($keyword){
        $this->db->like('title', $keyword);
        $query = $this->db->get('list');
        return $query->result();
    }
//    수정
    public function update($number, $title){
        $this->db->where('number', $number);
        $query = $this->db->update('list', array('title'=>$title));
        return $query;
    }
//    삭제
    public function delete($date){
        return $this->db->delete('list', array('date'=>$date));
    }
}


