<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller
{
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->model('service/board_service');
        session_start();
    }

//    댓글 목록
    public function comment(){
        $bnum = $_POST['bnum'];
        $commentlist = $this->board_service->c_list($bnum);
        $data = json_encode($commentlist);
        echo $data;
    }

//    댓글 목록
    public function c_list($bnum){
        $commentlist = $this->board_service->c_list($bnum);
        $data = json_encode($commentlist);
        return $data;
    }

//    댓글 작성
    public function c_insert(){
        $json = $_POST['data'];
        $json = json_decode($json, true);

        $bnum = $json["bnum"];
        $contents = $json["contents"];
        $id = $_SESSION['login_id'];

        $data = array(
            'bnum' => $bnum,
            'id' => $id,
            'contents' => $contents
        );

        $this->board_service->c_insert($data);
        $result = $this->c_list($bnum);
        echo $result;
    }

//    댓글 삭제
    public function c_delete(){
        $cnum = $_POST['cnum'];
        $bnum = $_POST['bnum'];

        echo $this->board_service->c_delete($cnum);
//        $result = $this->c_list($bnum);
//        echo $result;
    }

//    re댓글 작성
    public function re_insert(){
        $json = $_POST['data'];
        $json = json_decode($json, true);

        $id = $_SESSION['login_id'];

        $data = array(
            'cnum' => $json["cnum"],
            'bnum' => $json["bnum"],
            'id' => $id,
            'contents' => $json["contents"]
        );

        $this->board_service->re_insert($data);
    }

//    re댓글 조회
    public function re_select(){
        $cnum = $_POST['cnum'];
        $recommentlist = $this->board_service->re_select($cnum);
        $data = json_encode($recommentlist);
        echo $data;
    }

//    re댓글 조회2
    public function re_list($cnum){
        $recommentlist = $this->board_service->re_select($cnum);
        $data = json_encode($recommentlist);
        return $data;
    }

//    re댓글 삭제
    public function re_delete(){
        $renum = $_POST['renum'];
        $cnum = $_POST['cnum'];
        echo $this->board_service->re_delete($renum);

//        $this->board_service->re_delete($renum);
//        $data = $this->re_list($cnum);
//        echo $data;
    }

}