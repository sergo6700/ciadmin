<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Member extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }

    public function profiles(){
        $data['main_content'] = 'member/profile/profiles';
        $this->load->view('includes/tamplate_user', $data);

    }

}