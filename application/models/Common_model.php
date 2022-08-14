<?php

class Common_model extends CI_Model {

	function __construct()

	{

		parent::__construct();
		$this->load->database();

		$this->load->library('upload');

		$this->load->library('session'); 

	}

	public function save_data($insert_data,$table)
	{

		$this->db->insert($table,$insert_data);

		$insert_id = $this->db->insert_id();

		return $insert_id;

	}

	public function get_run($run)
	{

		$query = $this->db->query($run);
		return $query->result_array();	

	}

	public function login_check($email,$password)

	{

		$this->db->where('email_address',$email);
		$this->db->where('password',$password);
		$this->db->where('is_email_verified',1);
		
		$query = $this->db->get('users');

		
		


		if($query->num_rows() == 1){

			$result=$query->result();

			$sessiondata = array(
				'id'  =>$result[0]->id,
				'email_address'  =>$result[0]->email_address,
				'is_admin'  =>$result[0]->is_admin 
	        );

			$this->session->set_userdata($sessiondata);

			return $result[0]->id;

		} 

		else

		{		

     		return -1;

		}

	}

	public function update_data($save,$table,$id) 

	{

	    $this->db->where('id', $id);

	    $data=$this->db->update($table, $save);

		if($data)

		   return true;

		else

		    return false;

	}

	public function do_delete($table,$id){
        
		$this->db->where('id',$id);

	    $this->db->delete($table);

		return ($this->db->affected_rows()!=1)? 0 : 1;

	}


}

?>