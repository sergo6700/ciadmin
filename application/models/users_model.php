<?php

class Users_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{

	    $this->db->where('user_name', $user_name);

	    $this->db->where('pass_word', $password);

	    $query = $this->db->get('users');
		
	    if($query->num_rows == 1) {

			return $query->row();

		}
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{

	    $query = $this->db->select('user_data')->get('ci_sessions');

	    $user = array(); /* array to store the user data we fetch */

        foreach ($query->result() as $row)
        {

            $udata = unserialize($row->user_data);

            /* put data in array using username as key */
            $user['user_name'] = $udata['user_name'];

            $user['is_logged_in'] = $udata['is_logged_in'];
		}

        return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_user($image)
	{

		$this->db->where('user_name', $this->input->post('username'));

		$query = $this->db->get('users');

        if($query->num_rows > 0){

        	$this->session->set_userdata('usernaem', 'Username already taken');

        	$this->load->view('admin/login');
        }else{

			$new_member_insert_data = array(

				'first_name' => $this->input->post('first_name'),

				'last_name' => $this->input->post('last_name'),

				'email_addres' => $this->input->post('email_address'),

				'user_name' => $this->input->post('username'),

				'roll' => $this->input->post('roll'),

				'pass_word' => md5($this->input->post('password')),

                'image' => $image
			);

			$insert = $this->db->insert('users', $new_member_insert_data);

			return $insert;
		}
	      
	}//create_member

    public function get_user_info($id = null, $first_name = null, $last_name = null, $email = null, $username = null, $roll = null, $image = null, $pass = null)
    {

        $this->db->select($first_name);

        $this->db->select($last_name);

        $this->db->select($email);

        $this->db->select($username);

        $this->db->select($pass);

        $this->db->select($roll);

        $this->db->select($image);

	    //from
        $this->db->from('users');

        //if isset $id get only one user
        if ($id != null && isset($id)){

            $this->db->where('id', $id);

        }

        $query = $this->db->get();

        return $query->row();

    }

    public function updateUser($id, $data){

	    $this->db->where('id', $id);

	    $this->db->update('users', $data);
    }

    function delete_user($id){

	    $this->db->where('id', $id)->delete('users');
    }


}

