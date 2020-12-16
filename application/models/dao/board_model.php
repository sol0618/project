<?php

class Board_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

//    글 등록
    public function boardWrite($data)
    {
        $this->db->set('bdate', 'NOW()', false);
        return $this->db->insert('board', $data);
    }

    public function boardList()
    {
        return $this->db->get('board')->result();
    }

//    조회수 올리기
    public function boardCount($bnum)
    {
        $this->db->select('count');
        $board = $this->db->get_where('board', array('bnum' => $bnum))->row();
        $count = $board->count;

        $this->db->update('board', array('count' => $count + 1), array('bnum' => $bnum));
    }

//    게시글 상세보기
    public function boardView($bnum)
    {
        return $this->db->get_where('board', array('bnum' => $bnum))->row();
    }

//    게시글 삭제
    public function boardDelete($bnum)
    {
        $this->db->delete('board', array('bnum' => $bnum));
    }

//    게시글 수정
    public function boardUpdate($data)
    {
        $this->db->where('bnum', $data['bnum']);
        return $this->db->update('board', $data);
    }

//    게시글 갯수
    public function ListCount()
    {
        $listcount = $this->db->count_all('board');
        return $listcount;
    }

//    카테고리별 게시글 갯수
    public function ListCount_category($category)
    {
        $this->db->where('category', $category);
        $this->db->from('board');
        $listcount = $this->db->count_all_results();
        return $listcount;
    }

//    검색 조건에 해당하는 게시글 갯수
    public function ListCount_select($select, $keyword)
    {
        $this->db->like($select, $keyword);
        $result = $this->db->get('board');
        $listcount = $result->num_rows();
        return $listcount;
    }

//    검색 조건 + 카테고리 해당하는 게시글 갯수
    public function ListCount_category_select($category, $select, $keyword)
    {
        $this->db->like($select, $keyword);
        $result = $this->db->get_where('board', array('category' => $category));
        $listcount = $result->num_rows();
        return $listcount;
    }

//    한페이지에 출력될 게시글 목록
    public function pagingList($paging)
    {
        $this->db->limit($paging["endrow"], $paging["startrow"]);
        $result = $this->db->get('board');
        return $result->result();
    }

//    카테고리별 한페이지에 출력될 게시글 목록
    public function pagingList_category($paging, $category)
    {
        $this->db->limit($paging["endrow"], $paging["startrow"]);
        $result = $this->db->get_where('board', array('category' => $category));
        return $result->result();
    }

//    검색 조건에 해당하는 한페이지에 출력될 게시글 목록
    public function pagingList_select($paging, $select, $keyword)
    {
        $this->db->limit($paging["endrow"], $paging["startrow"]);
        $this->db->like($select, $keyword);
        $result = $this->db->get('board');
        return $result->result();
    }

//    검색 조건 + 카테고리 해당하는 한페이지에 출력될 게시글 목록
    public function pagingList_category_select($paging, $category, $select, $keyword)
    {
        $this->db->limit($paging["endrow"], $paging["startrow"]);
        $this->db->like($select, $keyword);
        $result = $this->db->get_where('board', array('category' => $category));
        return $result->result();

//        print_r($this->db->last_query()); exit();
    }

//    댓글 작성
    public function c_insert($data)
    {
        $this->db->set('cdate', 'NOW()', false);
        return $this->db->insert('comment', $data);
    }

//    댓글 목록
    public function c_list($bnum)
    {
        return $this->db->get_where('comment', array('bnum' => $bnum))->result();
    }

//    댓글 삭제
    public function c_delete($cnum)
    {
        $this->db->delete('comment', array('cnum' => $cnum));
    }

//    re댓글 작성
    public function re_insert($data)
    {
        $this->db->set('redate', 'NOW()', false);
        $this->db->insert('re_comment', $data);
    }

//    re댓글 목록
    public function re_select($cnum)
    {
        return $this->db->get_where('re_comment', array('cnum' => $cnum))->result();
    }

//    re댓글 삭제
    public function re_delete($renum){
        $this->db->delete('re_comment', array('renum' => $renum));
    }

//    상세페이지-댓글 목록
    public function cList($bnum)
    {
        return $this->db->get_where('comment', array('bnum' => $bnum))->result_array();
    }

//    상세페이지-re댓글 목록
    public function reList($bnum)
    {
        $this->db->join('re_comment', 'comment.cnum = re_comment.cnum', 'right');
        return $this->db->get_where('comment', array('comment.bnum' => $bnum))->result_array();
    }
}