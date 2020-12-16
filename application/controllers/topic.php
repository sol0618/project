<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topic extends CI_Controller {

    function index(){
//        $this->load->view('head');
//        $this->load->view('topic');
//        $this->load->view('footer');

//        $data['title'] = "My Real Title";
//        $data['heading'] = "My Real Heading";
//        $this->load->view('topic', $data);

        $data['todo_list'] = array('Clean House', 'Call Mom', 'Run Errands');

        $data['title'] = "My Real Title";
        $data['heading'] = "My Real Heading";

        $this->load->view('topic', $data);
    }

    function get($id){
        $this->load->view('head');
        $data =  array('id'=>$id);
        $this->load->view('main', $data);
        $this->load->view('footer');
    }
}
?>
