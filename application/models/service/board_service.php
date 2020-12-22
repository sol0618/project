<?php
class Board_service extends CI_Model
{
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->model('dao/board_model');
    }

//    게시글 등록
    public function boardWrite($data){
        $this->form_validation->set_rules('category', '카테고리', 'required');
        $this->form_validation->set_rules('title', '제목', 'required');
        $this->form_validation->set_rules('contents', '내용', 'required');

        if($this->form_validation->run() == FALSE) {
            return false;
        } else {
            if($data['img']== ""){
                return $this->board_model->boardWrite($data);
            }

            //파일 업로드
            $target_dir = 'C:\workspace\CodeIgniter-3.0.6\application\controllers\uploads\\';
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            // 500kb 제한
            if ($_FILES["img"]["size"]>500000){
                $uploadOk = 0;
            }
            // 파일 종류
            if($imageFileType!="jpg"&&$imageFileType!="png"&&$imageFileType!="jpeg"&&$imageFileType!="gif"){
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                return false;
            } else {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                    return $this->board_model->boardWrite($data);
                } else {
                    return false;
                }
            }
        }
    }

    public function boardList(){
        $boardList = $this->board_model->boardList();
        return $boardList;
    }

//    조회수 올리기
    public function boardCount($bnum){
        $this->board_model->boardCount($bnum);
    }

//    게시글 상세보기
    public function boardView($bnum){
        $boardView = $this->board_model->boardView($bnum);
        return $boardView;
    }

//    게시글 삭제
    public function boardDelete($bnum){
        $this->board_model->boardDelete($bnum);
    }

//    게시글 수정
    public function boardUpdate($data){

        $this->form_validation->set_rules('category', '카테고리', 'required');
        $this->form_validation->set_rules('title', '제목', 'required');
        $this->form_validation->set_rules('contents', '내용', 'required');

        if($this->form_validation->run() == FALSE) {
            return false;
        } else {
            if($data['img']== ""){
                $data = array_filter($data);
                return $this->board_model->boardUpdate($data);
            }

            //파일 업로드
            $target_dir = 'C:\workspace\CodeIgniter-3.0.6\application\controllers\uploads\\';
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            // 500kb 제한
            if ($_FILES["img"]["size"]>500000){
                $uploadOk = 0;
            }
            // 파일 종류
            if($imageFileType!="jpg"&&$imageFileType!="png"&&$imageFileType!="jpeg"&&$imageFileType!="gif"){
                $uploadOk = 0;
            }

            if ($uploadOk == 0){
                return false;
            } else {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)){
                    return $this->board_model->boardUpdate($data);
                } else {
                    return false;
                }
            }
        }
    }

//    페이지네이션
    public function paging($page, $category, $select, $keyword){

        // 게시글 총 갯수 = $listcount
        if(empty($category)) {
            $listcount = $this->board_model->ListCount(); //17
        } else {
            //카테고리 구분
            $listcount = $this->board_model->ListCount_category($category); //7
        }
        //조건검색
        if(!empty($select)){
            $listcount = $this->board_model->ListCount_select($select, $keyword);
        }
        //카테고리 + 조건검색
        if(!empty($category) && !empty($select)){
            $listcount = $this->board_model->ListCount_category_select($category, $select, $keyword);
        }

        $page_limit = 5; // 한화면에 보일 게시글 수
        $block_limit = 3; // 한화면에 보일 페이지 수

        $startRow = ($page - 1) * $page_limit; //0 4 가져올 게시글 시작row
        $endRow = $page_limit; //4 가져올 게시글 수
        $maxpage = ceil($listcount / $page_limit); //5 총페이지수
        $startpage = $page - (($page - 1) % $block_limit); //1 1 1 4 현재 화면에 보일 시작 페이지 번호
        $endpage = $startpage + $block_limit - 1; //3 3 3 6 현재 화면에 보일 마지막 페이지 번호

        if ($startpage <= 1) { $startpage = 1; }
        if ($endpage > $maxpage) { $endpage = $maxpage; } //6>5 → 5

        $paging = array(
            'page' => $page,
            'startrow' => $startRow,
            'endrow' => $endRow,
            'maxpage' => $maxpage,
            'startpage' => $startpage,
            'endpage' => $endpage
        );
        return $paging;
    }

//    페이징처리 - 게시글 조회
    public function pagingList($paging, $category, $select, $keyword){
//        print_r($paging);
//        Array ( [page] => 1 [startrow] => 0 [endrow] => 4 [maxpage] => 5 [startpage] => 1 [endpage] => 3 )

        // 한페이지에 출력될 게시글 목록 = $paginglist
        if(empty($category)) {
            //전체페이지
            $paginglist = $this->board_model->pagingList($paging);
        } else {
            //카테고리 구분
            $paginglist = $this->board_model->pagingList_category($paging, $category);
        }
        //조건검색
        if(!empty($select)){
            $paginglist = $this->board_model->pagingList_select($paging, $select, $keyword);
        }
        //카테고리 + 조건검색
        if(!empty($category) && !empty($select)){
            $paginglist = $this->board_model->pagingList_category_select($paging, $category, $select, $keyword);
        }

        return $paginglist;
    }

//    댓글 작성
    public function c_insert($data){
        $this->board_model->c_insert($data);
    }

//    댓글 목록
    public function c_list($bnum){
        return $this->board_model->c_list($bnum);
    }

//    댓글 삭제
    public function c_delete($cnum){
        $this->board_model->c_delete($cnum);
    }

//    re댓글 작성
    public function re_insert($data){
        $this->board_model->re_insert($data);
    }

//    re댓글 조회
    public function re_select($cnum){
        return $this->board_model->re_select($cnum);
    }

//    re댓글 삭제
    public function re_delete($renum){
        $this->board_model->re_delete($renum);
    }

//    상세페이지-댓글 목록
    public function cList($bnum){
        return $this->board_model->cList($bnum);
    }

//    상세페이지-re댓글 목록
    public function reList($bnum){
        return $this->board_model->reList($bnum);
    }

}