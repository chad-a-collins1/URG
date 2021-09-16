<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller { 

	public function __construct(){
		parent::__construct();
		$this->load->model('Main_model');
		
	}
	
	public function index() {
		$this->load->view('admin/login');
	}
	
	public function checklogin() {
		if(!isset($_SESSION['admin_id'])) {
			redirect(base_url('Admin/login'));
		}
	}
	
	public function login() {
		if(isset($_POST['login'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];
			$admin_data = $this->Main_model->get_data('users',array('email'=>$_POST['email'], 'role'=>'admin'));
			
			if(!empty($admin_data)) {
				if($admin_data[0]['password_md5'] == md5($admin_data[0]['pwsalt'].$_POST['password'])) {
					$_SESSION['admin_id'] = $admin_data[0]['userid'];
					redirect(base_url().'Admin/dashbord');
				}else {
					echo "password Not match...";
				}
			}
		}
		$this->load->view('admin/login');
	}
	public function logout()
	{
		session_destroy();
		redirect(base_url()."Admin/login");
	}
	
	public function dashbord() {
		$this->checklogin();
		$this->load->view('admin/header');
		$this->load->view('admin/dashbord');
		$this->load->view('admin/footer');
	}
	
	public function question_categories() {
		$this->checklogin();
		
		if(isset($_POST['add_category'])) {
			$category_data['categorytext'] =$_POST['category_text'];
			$category_id = $this->Main_model->insert_data('questioncategories',$category_data);
		}
		
		// $categories = $this->Main_model->get_data('questioncategories');
		$this->load->view('admin/header');
		$this->load->view('admin/question_categories');
		$this->load->view('admin/footer');
	}
	public function view_question_categories_api() {
		$services = $this->Main_model->get_data('questioncategories');
		print_r(json_encode($services));
	}
	
	public function questions() {
		
		$this->checklogin();
		// print_r($_POST);
		$tier_data = $this->Main_model->get_data('tiers');
		$questiontype = $this->Main_model->get_data('question_type');
		$categories = $this->Main_model->get_data('questioncategories');
		
		if(isset($_GET['categoryBtn']) || isset($_GET['id'])) {
			$tier_id = $_GET['id'];
			if(isset($_GET['category'])) {
				$categoryId = $_GET['category'];
				if($categoryId == "all") {
					$question_data = $this->Main_model->get_data('questions',array('tierid'=>$tier_id));
				}else {
					$question_data = $this->Main_model->get_data('questions',array('tierid'=>$tier_id, 'questioncategoryid'=>$categoryId));
				}
				
			}else {
				$question_data = $this->Main_model->get_data('questions',array('tierid'=>$tier_id));
			}
			$question_data = json_encode($question_data);
		}else {
			$question_data = $this->Main_model->get_data('questions',array('tierid'=>$tier_data[0]['tierid']));
			$question_data = json_encode($question_data);
		}
		
		$this->load->view('admin/header');
		$this->load->view('admin/questions', array('tier_data'=>$tier_data, 'question_data'=>$question_data, 'questiontype'=>$questiontype, 'categories'=>$categories));
		$this->load->view('admin/footer');
	}
	
	public function editquestion_API() {
		print_r($_POST);
		$update = $this->Main_model->update_data('questions',array('question_order'=>$_POST['question_order']),array('questionid'=>$_POST['questionid']));
		// echo $update;
	}
	
	public function UpdateQuestion(){
		// print_r($_POST);
		// print_r($_FILES);
		if($_FILES['instructionlink']['name'] != "" || $_FILES['instructionlink']['name'] != null){
			$config['upload_path']  = './upload/questioninstruction/';
			$config['allowed_types'] = '*';
			$filename = $_POST['questionid']."_".time().".".pathinfo($_FILES['instructionlink']['name'],PATHINFO_EXTENSION);
			echo $filename;
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('instructionlink'))
			{
				echo "Error";
				$error = $this->upload->display_errors();
				print_r($error);
			}
			else
			{
				echo "Success";
				$_POST['instructionlink'] = $filename;
			}
		}
		if(!isset($_POST['required'])) {
			$_POST['required'] = 0;
		}
		$updatedata = $this->Main_model->update_data('questions',$_POST,array('questionid'=>$_POST['questionid']));
		// echo $updatedata;
		// exit;
		redirect(base_url('Admin/questions'));
	}
	
	public function view_questionbytier_api() {
		$data = $this->Main_model->get_data('questions',array('tierid'=>$_GET['id']));
		print_r(json_encode($data));
	}
	
	public function add_question() {
		$this->checklogin();
		
		if(isset($_POST['add_question'])) {
			if(isset($_GET['tier_id'])) {
				$insert_data['tierid'] = $_GET['tier_id'];
				$insert_data['question'] = $_POST['question_text'];
				$insert_data['questioncategoryid'] = $_POST['question_category'];
				$insert_data['servicetype'] = $_POST['service_type'];
				$insert_data['questiontype']=$_POST['question_type'];
				$question_id = $this->Main_model->insert_data('questions',$insert_data);
			}else {
				$insert_data['tierid'] = $_POST['tier'];
				$insert_data['question'] = $_POST['question_text'];
				$insert_data['questioncategoryid'] = $_POST['question_category'];
				$insert_data['servicetype'] = $_POST['service_type'];
				$insert_data['questiontype']=$_POST['question_type'];
				$question_id = $this->Main_model->insert_data('questions',$insert_data);
				
			}
			
			
		}
		
		$tier_data = $this->Main_model->get_data('tiers');
		$question_categories = $this->Main_model->get_data('questioncategories');
		$services = $this->Main_model->get_data('service_types');
		$questiontype=$this->Main_model->get_data('question_type');
		$this->load->view('admin/header');
		$this->load->view('admin/add_question', array('tier_data'=>$tier_data, 'question_categories'=>$question_categories, 'services'=>$services,'questiontype'=>$questiontype));
		$this->load->view('admin/footer');
	}
	
	
	public function tire() {
		$this->checklogin();
		
		if(isset($_POST['add_tier'])) {
			$tier_data['description	'] = $_POST['tier_text'];
			$tier_id = $this->Main_model->insert_data('tiers',$tier_data);			
		}
		
		// $services = $this->Main_model->get_data('service_types');
		$this->load->view('admin/header');
		$this->load->view('admin/tier_page');
		$this->load->view('admin/footer');
	}
	public function view_tier_api() {
		$data = $this->Main_model->get_data('tiers');
		print_r(json_encode($data));
	}
	
	public function service() {
		$this->checklogin();
		
		if(isset($_POST['add_service'])) {
			$service_data['servicetype'] = $_POST['service_type'];
			$service_id = $this->Main_model->insert_data('service_types',$service_data);			
		}
		
		$services = $this->Main_model->get_data('service_types');
		$this->load->view('admin/header');
		$this->load->view('admin/service_type', array('services'=>$services));
		$this->load->view('admin/footer');
	}
	public function view_servicetype_api() {
		$services = $this->Main_model->get_data('service_types');
		print_r(json_encode($services));
	}
	public function view_servicetype_api2() {
		$services = $this->Main_model->get_data('service_types');
		print_r(json_encode($services));
	}
	public function question_type()
	{ 
		$this->checklogin();
		if(isset($_POST['add_questiontype']))
		{
			$insertdata['qtype']=$_POST['question_type'];
			$insertdata['fieldname']=$_POST['field_name'];
			$questiontype_id=$this->Main_model->insert_data('question_type',$insertdata);
		}
			$this->load->view('admin/header');
			$this->load->view('admin/questiontype');
			$this->load->view('admin/footer');
	}
	public function view_questiontype_api()
	{
		$questiontype=$this->Main_model->get_data('question_type');
		print_r(json_encode($questiontype));
	}
	public function viewquestiontype()
	{
		$this->checklogin();
		$viewquestiontype=$this->Main_model->viewquestiontype();
		$this->load->view('admin/header');
		$this->load->view('admin/view_questiontype',array('viewquestiontype'=>$viewquestiontype));
		$this->load->view('admin/footer');
	}
	/*public function viewquestiontype_api()
	{
		$viewquestiontype=$this->Main_model->viewquestiontype('questions');
		print_r(json_encode($viewquestiontype));
	}*/
	public function user()
	{
		$user = $this->Main_model->get_data('users',array('role'=>'user'));
		$this->load->view('admin/header');
		$this->load->view('admin/user',array('user'=>$user));
		$this->load->view('admin/footer');
	}
	public function viewuser()
	{  
		if(isset($_GET['userid'])) 
		{
			$getfacility = $_GET['userid'];
			$viewuser = $this->Main_model->get_data('facilities',array('userid'=>$getfacility));
		}
		$this->load->view('admin/header');
		$this->load->view('admin/viewuser',array('viewuser'=>$viewuser));
		$this->load->view('admin/footer');
	}
	public function updatestatus()
	{
		if(isset($_GET['facilityid'])) 
	    {
			 $id=$_GET['facilityid'];
			// print_r($id);
			$data = array("status"=>$this->input->post('status'));
			//print_r($data);
			$update = $this->Main_model->updatedata($id,$data);
			//print_r($update);
			 print_r(json_encode($update));
		}
	
	}
	public function profile()
	{//print_r($_SESSION['user_id']);
	//print_r($_SESSION['admin_id']);
	//exit;
		if(isset($_SESSION['admin_id']))
		{
			
			$userdata = $this->Main_model->get_data('users',array('userid'=>$_SESSION['admin_id']));
			//print_r($userdata);
			if(isset($_POST['submit']))
			{
				$data=array("username"=>$this->input->post('uname'),
			            "email"=>$this->input->post('email'),
						 "password_md5"=>$this->input->post('password_md5'));
				$update = $this->Main_model->update_data('users',$data,array('userid'=>$_SESSION['admin_id']));		 
			}
		}
		$this->load->view('admin/header');
	    $this->load->view('admin/profile',array('user'=>$userdata));
		$this->load->view('admin/footer'); 
	}
    public function add_facility() 
	{
	//	print_r($_SESSION['user_id']);
     //exit;
		if(isset($_SESSION['user_id']))
		{
			if(isset($_GET['id'])) 
			{
				//print_r($_GET['id']);
				//exit;
			$facilitydata = $this->Main_model->get_data('facilities',array('facilityid'=>$_GET['id']));
			//print_r($facilitydata);
			//exit;
		    }
		}
		$this->load->view('admin/header');
		$this->load->view('admin/addfacility',array('facility'=>$facilitydata));
		$this->load->view('admin/footer');
	}
	
	public function tierform() {
		//print_r($_SESSION['user_id']);
		//exit;
		if(isset($_GET['id']))
		{
			// print_r($_GET['id']);
			// exit;
			$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
			// print_r($userfacilities_data);
			// exit;
			$viewquestion = $this->Main_model->viewquestiontype($userfacilities_data['0']['tierid']);
			// print_r($question_data);
			// exit;
		}
		$this->load->view('admin/header');
	    $this->load->view('admin/tierform',array('viewquestion'=>$viewquestion));
		$this->load->view('admin/footer'); 
		
	/*if(isset($_GET['id'])) {
			$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
			// print_r($userfacilities_data);
			$question_data = $this->Main_model->viewquestiontype($userfacilities_data['0']['tierid']);
		}
		
		if(isset($_POST['add'])) {
		 	// print_r($_FILES);
			$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
			for($i=1;$i<$_POST['totaltext'];$i++)
			{
				$insert_data['questionid'] = $_POST['qid_'.$i];
				$insert_data['answer']=$_POST['answer_'.$i];
				$insert_data['userid']=$_SESSION['user_id'];
				$insert_data['facilityid'] = $userfacilities_data[0]['facility_id'];
				$insert_data['tierid'] = $userfacilities_data[0]['tierid'];
				$questionid=$this->Main_model->insert_data('answers',$insert_data);
			}

			for($i=1;$i<$_POST['totalfile'];$i++)
			{
				$insert_data['questionid'] = $_POST['qfid_'.$i];
				$config['upload_path'] = './upload/questionfileupload/';
				$config['allowed_types'] = 'pdf';
				// $new_file_name = date('Y-m-d_h:i:s');
				// $config['file_name'] = $new_file_name;
				$this->load->library('upload', $config);
				$this->upload->do_upload('file_'.$i);
				$insert_data['documentpath']=$_FILES['file_'.$i]['name'];
				$insert_data['userid']=$_SESSION['user_id'];
				$insert_data['facilityid'] = $userfacilities_data[0]['facility_id'];
				$insert_data['tierid'] = $userfacilities_data[0]['tierid'];
				$questionid=$this->Main_model->insert_data('answers',$insert_data);
			}
			$q=1;
			for($i=1;$i<$_POST['totaldp'];$i++)
			{
				$insert_data['questionid'] = $_POST['qdid_'.$i];
				$insert_data['answer']=$_POST['drpdwn_'.$i];
				$insert_data['userid']=$_SESSION['user_id'];
				$insert_data['facilityid'] = $userfacilities_data[0]['facility_id'];
				$insert_data['tierid'] = $userfacilities_data[0]['tierid'];
				$questionid=$this->Main_model->insert_data('answers',$insert_data);
			}

			$this->Main_model->update_data('userfacilities',array('status'=>"Submited"),array('id'=>$_GET['id']));
			
			if(isset($_GET['id'])) {
				$userfacilities_row = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
				if($userfacilities_row[0]['tier_description'] == 'Tier 1') {
					$_SESSION['userfacility_id'] = $userfacilities_row[0]['id'];
					redirect(base_url()."User/payment");
				}
				else {
					redirect(base_url()."User/view");
				}
			}
			
		}	
		*/
		
	}
	
	public function paymenthistory() {
		
		$historydata = $this->Main_model->getPaymentHistory();
		$this->load->view('admin/header');
	    $this->load->view('admin/viewpaymenthistory', array('historydata'=>$historydata));
		$this->load->view('admin/footer'); 
	}
}