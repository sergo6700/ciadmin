<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Controller {
    const USER_ROLL = 'users';
    const ADMIN_ROLL = 'admin';
    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */
    public function __construct()
    {

        parent::__construct();

        $this->load->library('form_validation');

        $this->load->model('users_model');

    }
	function index()
	{

	    if($this->session->userdata('is_logged_in')){

			redirect('admin/index');

	    }else{

        	$this->load->view('admin/login');

	    }
	}

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {

        return md5($password);

    }

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{

		$user_name = $this->input->post('user_name');

		$password = $this->__encrip_password($this->input->post('password'));

		$user = $this->users_model->validate($user_name, $password);
		if(!empty($user))
		{
            $user_id = $user->id;

            $data = array(

				'user_name' => $user_name,

				'is_logged_in' => true,

                'roll' => $user->roll,

                'user_info' => $user_id
			);

            $this->session->set_userdata($data);

            if ($user->roll == self::ADMIN_ROLL){

                redirect('admin/index');

            }
            else{

                redirect('member/product');

            }


		}
		else // incorrect username or password
		{

		    $data['message_error'] = TRUE;

		    $this->load->view('admin/login', $data);
		}

	}

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{

		$this->load->view('admin/signup_form');

	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */
    public function show_user(){


        $id = $this->session->userdata('user_info');

        $data['user'] = $this->users_model->get_user_info($id, 'first_name', 'last_name', 'email_addres', 'user_name', '', 'image', '');

        $data['main_content'] = '/member/profile/profiles';

        $this->load->view('includes/tamplate_user', $data);

    }


	function create_member(){

		// field name, error message, validation rules

        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');

        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');

		$this->form_validation->set_rules('roll', 'Roll', 'required|valid_roll');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');

		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		if($this->form_validation->run() == FALSE)
		{

		    $errors = $this->form_validation->error_array();

		    $this->load->view('admin/login', $errors);

		}
		else {

		    $image_path = $this->uploadfile();
			
			if($query = $this->users_model->create_user($image_path))
			{

                $this->load->view('admin/login');

            }

		}
		
	}

	public function uploadfile(){
        $config = [

            'upload_path' => './uploads/user/',

            'allowed_types' => 'gif|png|jpg|jpeg',
        ];

        $this->load->library('upload', $config);

        $this->form_validation->set_error_delimiters();

        $this->upload->do_upload('file');

        $info = $this->upload->data();

        $image_path = base_url("/uploads/user/". $info['raw_name'].$info['file_ext']);

        return $image_path;

        /*upload*/
    }

    public function updateUser(){

        $id = $this->session->userdata('user_info');

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('first_name', 'Name', 'trim');

            $this->form_validation->set_rules('last_name', 'Last Name', 'trim');

            $this->form_validation->set_rules('email_address', 'Email Address', 'trim|valid_email');

            $this->form_validation->set_rules('username', 'Username', 'trim|min_length[4]');

            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            if($this->form_validation->run() == FALSE)
            {

                $errors = $this->form_validation->error_array();

                $this->load->view('member/profiles', $errors);

            }
            //if the form has passed through the validation
            else
            {

                $data_to_store = array(

                    'first_name' => $this->input->post('first_name'),

                    'last_name' => $this->input->post('last_name'),

                    'email_addres' => $this->input->post('email'),

                    'user_name' => $this->input->post('user_name'),

                    'user_name' => $this->input->post('user_name'),

                );
                //if the insert has returned true then we show the flash message
                if($this->users_model->updateUser($id, $data_to_store ) == TRUE){

                    $this->session->set_flashdata('flash_message', 'updated');

                    $this->session->unset('user_info');

                    $data = [

                        'user_info' => $data_to_store

                    ];

                    $this->session->set_userdata($data);

                }
                else{

                    $this->session->set_flashdata('flash_message', 'not_updated');

                }

                redirect('member/profiles');

            }//validation run

        }

    }
    public function change_pass()
    {
        if($this->input->post('change_pass'))
        {
            $old_pass= md5($this->input->post('old_pass'));
            $new_pass= md5($this->input->post('new_pass'));
            $confirm_pass= md5($this->input->post('confirm_pass'));
            $id=$this->session->userdata('user_info');
            $row=$this->users_model->get_user_info($id, '','','','','','', 'pass_word');
            $pass = $row->pass_word;
            if((!strcmp($old_pass, $pass)) && (strcmp($old_pass, $new_pass)) && (!strcmp($new_pass, $confirm_pass))){
                $data = [
                   'pass_word' => $new_pass
                ];
                $this->users_model->updateUser($id,$data);
            }
        }

                redirect('member/profiles');
    }

    /*
     * this function for update user image
     * function use  $this->Users_model->updateUser and set paramer image path
     */
    public function updateUserImage(){

        $id = $this->session->userdata('user_info');

        $config = [

            'upload_path' => './uploads/user/update',

            'allowed_types' => 'gif|png|jpg|jpeg',

        ];

        $this->load->library('upload', $config);

        $this->form_validation->set_error_delimiters();

        $this->upload->do_upload('file');

        $info = $this->upload->data();

        $image_path = base_url("/uploads/user/update/". $info['raw_name'].$info['file_ext']);

        $data = [

          'image' => $image_path

        ];

        $this->users_model->updateUser($id, $data);

        redirect('member/profiles');

    }

    /*
     * this function delete user
     * if this user have a bought product this function will delete  products
     */
    public function delete_user(){
        //user id
        $id = $this->session->userdata('user_info');

        $this->users_model->delete_user($id);

        $this->session->sess_destroy();

        redirect('admin/products');

    }

	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	public function logout()
	{

		$this->session->sess_destroy();

		redirect('admin');

	}


}