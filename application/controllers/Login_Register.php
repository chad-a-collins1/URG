<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Register extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
	}
	
	public function index() {
		//phpinfo();
		$this->load->view('user/index');
	}
	
	public function register() {
		
		if(isset($_POST['register'])) {
			// print_r($_POST);
			$data['username'] = $_POST['user_name'];
			$data['email'] = $_POST['email'];
			// $data['service_type'] = $_POST['service_type'];
			// $data['approved_auditor'] = $_POST['approved'];
			
			$result = $this->Main_model->get_data('users',array('email'=>$_POST['email']));
			
			if(empty($result)) {
				$salt = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(50 / strlen($x)))), 1, 50);
				$salted_pass = md5($salt.$_POST['password']);
				$data['pwsalt'] = $salt;
				$data['password_md5'] = $salted_pass;
				$data['role'] = "user";
				// $data['createdate'] = date('Y-m-d h:i:s');
				$user_id = $this->Main_model->insert_data('users',$data);
				if($user_id > 0) {
					$_SESSION['user_id'] = $user_id;
					redirect(base_url().'User/view');
				}else {
					echo "error...";
				}
			}else {
				echo "already registered...";
			}
			
		}
		$this->load->view('user/register');
	}
	
	public function login() {
		if(isset($_POST['login'])) {
			
			$email = $_POST['email'];
			$password = $_POST['password'];
			$user_data = $this->Main_model->get_data('users',array('email'=>$_POST['email']));
			
			if(!empty($user_data)) {
				if($user_data[0]['password_md5'] == md5($user_data[0]['pwsalt'].$_POST['password'])) {
					$_SESSION['user_id'] = $user_data[0]['userid'];
					redirect(base_url().'User/view');
				}else {
					echo "password Not match...";
				}
			}
		}
		
		$this->load->view('user/login');
	}
	
}