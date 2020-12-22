<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->database();
        $this->load->model('service/member_service');
        $this->load->model('service/board_service');
        session_start();
    }

    public function index(){
        $this->load->view('project');
        $this->load->view('home');
        $this->load->view('footer');
    }

//    회원가입 페이지로 이동
    public function join_form(){
        $this->load->view('project');
        $this->load->view('join');
        $this->load->view('footer');
    }

//    회원가입 폼 가입
    public function join(){
        $data = array(
            'id' => $_POST['id'],
            'kid' => $_POST['kid'],
            'password' => $_POST['password'],
            'name' => $_POST['name'],
            'birth' => $_POST['birth'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'rank' => "general"
        );
        $result = $this->member_service->join($data);
        if($result){
            redirect("/project");
        } else {
            redirect("/project/join_form");
        }
    }

//    로그인 페이지로 이동
    public function login_form(){
        $this->load->view('project');
        $this->load->view('login');
        $this->load->view('footer');
    }

//    로그인
    public function login(){
        $id = $_POST['id'];
        $password = $_POST['password'];
        $result = $this->member_service->login($id, $password);
        if($result){
            redirect("/project");
        } else {
            redirect("/project/login_form");
        }
    }

//    카카오 로그인
    public function kakaoLogin(){
        //사용자 토큰 받기
        $code = $_GET["code"];
        $app_key = "26965564b7dccc230e5c0ce1979a7f51";
        $redirect_uri = "http://dmsthf590.com/project/kakaoLogin";
        $api_url = "https://kauth.kakao.com/oauth/token";
        $params = sprintf( 'grant_type=authorization_code&client_id=%s&redirect_uri=%s&code=%s', $app_key, $redirect_uri, $code);

        $opts = array(
            CURLOPT_URL => $api_url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 1,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false
        );

        $curlSession = curl_init();
        curl_setopt_array($curlSession, $opts);
        $accessTokenJson = curl_exec($curlSession);
        curl_close($curlSession);

        $responseArr = json_decode($accessTokenJson, true);
        $_SESSION['kakao_access_token'] = $responseArr['access_token'];
        $_SESSION['kakao_refresh_token'] = $responseArr['refresh_token'];
        $_SESSION['kakao_refresh_token_expires_in'] = $responseArr['refresh_token_expires_in'];

        //사용자 정보 가저오기
        $USER_API_URL= "https://kapi.kakao.com/v2/user/me";
        $opts = array(
            CURLOPT_URL => $USER_API_URL,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 1,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $responseArr['access_token']
            )
        );

        $curlSession = curl_init();
        curl_setopt_array($curlSession, $opts);
        $accessUserJson = curl_exec($curlSession);
        curl_close($curlSession);

        $me_responseArr = json_decode($accessUserJson, true);

        if ($me_responseArr['id']) {
            $kid = 'kakao_' . $me_responseArr['id'];
            $token = $responseArr['access_token'];

            $result = $this->member_service->kidCheck($kid, $token);

            if ($result) {
//                $this->index();
                redirect("/project");
            } else {
                // 회원정보가 없다면 회원가입
                $param['kid'] = $kid;
                $this->load->view('project');
                $this->load->view('join', $param);
                $this->load->view('footer');
            }
        }
    }

//    로그아웃
    public function logout(){

        $access_token = $_SESSION['token'];
        $UNLINK_API_URL = "https://kapi.kakao.com/v1/user/unlink";
        $opts = array(
            CURLOPT_URL => $UNLINK_API_URL,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 1,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $access_token
            )
        );

        $curlSession = curl_init();
        curl_setopt_array($curlSession, $opts);
        $accessUnlinkJson = curl_exec($curlSession);
        curl_close($curlSession);
        $unlink_responseArr = json_decode($accessUnlinkJson, true);


        session_destroy();
        redirect('/project');
    }

//    게시판 페이지로 이동
    public function board(){
        if(!isset($_SESSION['login'])) {
            redirect('/project/login_form');
        }
        //페이지
        $page = $this->input->get("page");
        if(empty($page)){ $page = 1; }

        //카테고리
        $category = $this->input->get("category");
        //조건검색
        $select = $this->input->get("select");
        $keyword = $this->input->get("keyword");

        //페이지네이션
        $paging = $this->board_service->paging($page, $category, $select, $keyword);
        //한페이지에 출력될 게시글 목록
        $paginglist = $this->board_service->pagingList($paging, $category, $select, $keyword);

        $param['paging'] = $paging;
        $param['list'] = $paginglist;
        $param['category'] = $category;
        $param['select'] = $select;
        $param['keyword'] = $keyword;

        $this->load->view('project');
        $this->load->view('board', $param);
        $this->load->view('footer');
    }

//    게시글 작성페이지로 이동
    public function boardWrite_form(){
        //카테고리
        $category = $this->input->get("category");
        $param['category'] = $category;

        $this->load->view('project');
        $this->load->view('boardWrite', $param);
//        $this->load->view('footer');
    }

//    게시글 상세보기
    public function boardView(){
        $bnum = $_GET['bnum'];

        //조회수 올리기
        $this->board_service->boardCount($bnum);
        //게시글 상세보기
        $boardView = $this->board_service->boardView($bnum);
        $param['list'] = $boardView;

        //댓글
        $cList = $this->board_service->cList($bnum);
        $param['cList'] = $cList;

        //re댓글
        $reList = $this->board_service->reList($bnum);
        $param['reList'] = $reList;

        $this->load->view('project');
        $this->load->view('boardView', $param);
        $this->load->view('footer');
    }

//    게시글 작성
    public function boardWrite(){
        $data = array(
            'category' => $_POST['category'],
            'id' => $_SESSION['login_id'],
            'title' => $_POST['title'],
            'contents' => $_POST['contents'],
            'img' => $_FILES["img"]["name"],
            'count' => "0"
        );
        $category = $this->input->post("category");

        $result = $this->board_service->boardWrite($data);

        if($result){
            redirect('/project/board?category='.$category);
        } else {
            redirect('/project/boardWrite_form?category='.$category);
        }
    }

//    게시글 삭제
    public function boardDelete(){
        $bnum = $_GET['bnum'];
        $this->board_service->boardDelete($bnum);
        redirect('/project/board');
    }

//    게시글 수정페이지로 이동
    public function boardUpdate_form(){
        $bnum = $_GET['bnum'];
        $boardView = $this->board_service->boardView($bnum);
        $param['list'] = $boardView;

        $this->load->view('project');
        $this->load->view('boardUpdate', $param);
//        $this->load->view('footer');
    }

//    게시글 수정
    public function boardUpdate(){
        $data = array(
            'bnum' => $_POST['bnum'],
            'category' => $_POST['category'],
            'title' => $_POST['title'],
            'contents' => $_POST['contents'],
            'img' => $_FILES["img"]["name"]
        );
        $result = $this->board_service->boardUpdate($data);
        $bnum = $data['bnum'];

        if($result){
            redirect('/project/boardView?bnum='.$bnum);
        } else {
            redirect('/project/boardUpdate_form?bnum='.$bnum);
        }
    }

//    form 댓글 입력
     public function cInsert(){
         $data = array(
             'bnum' => $_POST['bnum'],
             'id' => $_SESSION['login_id'],
             'contents' => $_POST['contents']
         );
         $bnum = $data['bnum'];

         $this->board_service->c_insert($data);
         redirect('/project/boardView?bnum='.$bnum);
     }

//     댓글 삭제
    public function cDelete(){
        $bnum = $_GET['bnum'];
        $cnum = $_GET['cnum'];

        $this->board_service->c_delete($cnum);
        redirect('/project/boardView?bnum='.$bnum);
    }

//    form re댓글 입력
    public function reInsert(){
        $data = array(
          'cnum' => $_POST['cnum'],
          'bnum' => $_POST['bnum'],
          'id' => $_SESSION['login_id'],
          'contents' => $_POST['contents']
        );
        $bnum = $data['bnum'];

        $this->board_service->re_insert($data);
        redirect('/project/boardView?bnum='.$bnum);
    }

//    form re댓글 삭제
    public function redelete(){
        $renum = $_GET['renum'];
        $bnum = $_GET['bnum'];

        $this->board_service->re_delete($renum);
        redirect('/project/boardView?bnum='.$bnum);
    }






}