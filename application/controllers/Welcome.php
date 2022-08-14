<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('Common_model');
    }

	public function index()
	{
		$this->load->view('welcome_message');
	} 

    public function login()
    {	
    	$this->load->view('login');
    }

    public function verify_email()
    {	
    	$this->load->view('verify_email');
    }

    public function adminpanel()
    {	
    	$data['products_data'] = $this->Common_model->get_run("SELECT * FROM products WHERE enabled = 1 ORDER BY id DESC");
    	$this->load->view('adminpanel',$data);
    }

    public function userpanel()
    {	
    	$data['products_data'] = $this->Common_model->get_run("SELECT * FROM products WHERE enabled = 1 ORDER BY id DESC");
    	$this->load->view('userpanel',$data);
    }

    public function verify_email_code()
    {	

    	$users   = 'users';
        $user_email_address 		= $this->input->post('user_email_address');
        $verify_code     			= $this->input->post('verify_code');
    	
    	$data = $this->Common_model->get_run("SELECT COUNT(*) as total_records, id FROM users WHERE email_address = '$user_email_address' AND verification_code = '$verify_code' ");
		
		$count_users = $data[0]['total_records'];
		$id 		 = $data[0]['id'];

		if($count_users > 0){

			$update_email_verified_email = array(
	            'is_email_verified'  => "1"
	        );

	        $result=$this->Common_model->update_data($update_email_verified_email,$users,$id);

	        header("Location: verify_email?is_verified=1");
		}else{
			header("Location: verify_email?is_verified=0");
		}

    }

    public function login_check(){
        
        $table='tbl_admin';
        $email_address  = $this->input->post('email_address');
        $passwords 		= $this->input->post('password');
        $password  		= md5($passwords);
        $result    		= $this->Common_model->login_check($email_address,$password,$table);
        
        if($result > 0)
        { 
          $_session['email'] = $email_address;
          $is_admin = $_SESSION['is_admin'];
          if($is_admin == 1){
          	header("Location: adminpanel");
          }else{
          	header("Location: userpanel");
          }
        }
        else
        {
          	header("Location: login?not_login=1");
        }
    }

    public function registration()
    {	
    	$this->load->view('registration');
    }

    public function save_registration(){

        $users   = 'users';
        $name     			= $this->input->post('name');
        $fname      		= $this->input->post('fname');
        $email_address      = $this->input->post('email_address');
        $backup_password    = $this->input->post('password');
        $password 			= md5($backup_password);

        $verification_code = rand ( 10000 , 99999 );

        $save_users      = array(
            'name'    			=> $name,
            'fname'     		=> $fname,
            'email_address'     => $email_address,
            'backup_password'   => $backup_password,
            'password'     		=> $password,
            'verification_code' => $verification_code
        );

        $data = $this->Common_model->get_run("SELECT COUNT(*) as total_records FROM users WHERE email_address = '$email_address' ");
		
		$count_users = $data[0]['total_records'];
		
		if($count_users == 0){
	        $result=$this->Common_model->save_data($save_users,$users);
	        
	        if($result > 0){
	            $this->session->set_flashdata('msg','User Added Successfully');
	            header("Location: verify_email?email_address=$email_address");
	        }
	        else{
	            $this->session->set_flashdata('error_msg','Something Went Wrong!!! Try Again');
	            header("Location: registration?email_address=$email_address");
	        }
	    }else{
	        header("Location: registration?success=3");
	    }
    }

    public function add_new_product(){

        $products   	= 'products';
        $title     		= $this->input->post('title');
        $description    = $this->input->post('description');
        $image      	= $this->input->post('image');
        $status    		= $this->input->post('status');

        $date_time = date('m-d-Y h:i:s');

        $file_tmp  = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_name = $_FILES['image']['name'];   //title_image
        $file_size = $_FILES['image']['size'];

        $uploadDir = "images";
        $filename  = $uploadDir.'/'.time().'-'. $file_name;

        move_uploaded_file($file_tmp,$filename);

        $save_products      = array(
            'title'    		=> $title,
            'description'   => $description,
            'image'     	=> $filename,
            'status'   		=> $status,
            'date_time'    	=> $date_time,
            'enabled' 		=> "1"
        );
		
        $result=$this->Common_model->save_data($save_products,$products);
        
        if($result > 0){
            header("Location: adminpanel?is_addedd=1");
        }
        else{
            header("Location: adminpanel?is_addedd=0");
        }
	    
    }


    public function delete_product(){
        $id=$this->uri->segment(3);
       
        $products='products';
        if (!empty($id)) {
            $result=$this->Common_model->do_delete($products,$id);
        }
        if($result>0){
         	header("Location: ../adminpanel?is_record_delete=1");
        }
        else{
          	header("Location: adminpanel?is_addedd=1");
        }
    }


    public function get_product_data(){
        
        $record_id                 = $this->input->post('record_id');
       	
        $data = $this->Common_model->get_run("SELECT * FROM products WHERE id = '$record_id' ");
        echo json_encode($data);
        
    }

    public function edit_new_product(){

        $products   	= 'products';
        $title     		= $this->input->post('title');
        $description    = $this->input->post('description');
        $image      	= $this->input->post('image');
        $status    		= $this->input->post('status');
        $image_hidden   = $this->input->post('image_hidden');
        $record_id_edit = $this->input->post('record_id_edit');

        $date_time = date('m-d-Y h:i:s');

        $file_tmp  = $_FILES['image']['tmp_name'];

        if($file_tmp != ""){

	        $file_type = $_FILES['image']['type'];
	        $file_name = $_FILES['image']['name'];   //title_image
	        $file_size = $_FILES['image']['size'];

	        $uploadDir = "images";
	        $filename  = $uploadDir.'/'.time().'-'. $file_name;

	        move_uploaded_file($file_tmp,$filename);
	    }else{
	    	$filename = $image_hidden;
	    }

        $edit_products      = array(
            'title'    		=> $title,
            'description'   => $description,
            'image'     	=> $filename,
            'status'   		=> $status,
            'date_time'    	=> $date_time,
            'enabled' 		=> "1"
        );
		
        $result=$this->Common_model->update_data($edit_products,$products, $record_id_edit);
        
        if($result > 0){
            header("Location: adminpanel?is_edit=1");
        }
        else{
            header("Location: adminpanel?is_edit=0");
        }
	    
    }

}
