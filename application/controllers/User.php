<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		
		// if(!isset($_SESSION['user_id'])) {
			// redirect(base_url());
		// }
		$this->load->model('Main_model');
		$this->load->library('session');
	}
	
	
	public function authorized_facilities() 
	{ $this->checklogin();
		if(isset($_POST['add'])) {
			redirect(base_url().'User/view');
		}
		
		$this->load->view('user/header');
		$this->load->view('user/authorized_facilities');
		$this->load->view('user/footer');
	}
	
	public function checklogin()
	{
		if(!isset($_SESSION['user_id']))
		{
			redirect(base_url('Login_Register/login'));
		}
	}
	
	public function add_facility() 
	{
		$this->checklogin();
		$facilitydata = "";
		if(isset($_GET['id'])) {
			$facilitydata = $this->Main_model->get_data('facilities',array('facilityid'=>$_GET['id']));
		}
		
		if(isset($_POST['add']))
		{
			if(isset($_GET['id'])) {
				$updatedata['facilityname']=$_POST['facility_name'];
				$updatedata['facilitystate']=$_POST['facility_state'];
				$updatedata['permitnumber']=$_POST['facility_permit_number'];
				
				if(!empty($_FILES['file_page']['name']) || $_FILES['file_page']['name']!="" ) {
					$config['upload_path'] = './upload/';
					$config['allowed_types'] = 'pdf';
					$new_file_name = date('Y-m-d_h:i:s');
					$config['file_name'] = $new_file_name;
					$this->load->library('upload', $config);
					$this->upload->do_upload('file_page');
					$updatedata['authorizationform']=$new_file_name.'.pdf';
				}
				$this->Main_model->update_data('facilities',$updatedata,array('facilityid'=>$_GET['id']));
				redirect(base_url().'User/view');
			}else {
				$insertdata['userid']=$_SESSION['user_id'];
				$insertdata['facilityname']=$_POST['facility_name'];
				$insertdata['facilitystate']=$_POST['facility_state'];
				$insertdata['permitnumber']=$_POST['facility_permit_number'];
				
				$config['upload_path'] = './upload/';
				$config['allowed_types'] = 'pdf';
				$new_file_name = date('Y-m-d_h:i:s');
				$config['file_name'] = $new_file_name;
				$this->load->library('upload', $config);
				$this->upload->do_upload('file_page');
				
				$insertdata['authorizationform']=$new_file_name.'.pdf';
				$insertdata['authorization']= 'Authorization';	
				$insertdata['submition_date']= date('Y-m-d h:i:s');
				$insertdata['expiration_date']= date('Y-m-d h:i:s');
				$insertdata['status']= "Submitted";
				$insertdata['createdate']= date('Y-m-d h:i:s');
				$facilityid=$this->Main_model->insert_data('facilities',$insertdata);
				
				$userfac_data['facility_id'] = $facilityid;
				$userfac_data['userid'] = $_SESSION['user_id'];
				$userfac_data['submition_date'] = date('Y-m-d h:i:s');
				$userfac_data['expiration_date'] = date('Y-m-d h:i:s');
				$userfac_data['createdat'] = date('Y-m-d h:i:s');
				$userfac_data['status'] = "In Progress";
				$tier_data = $this->Main_model->get_data('tiers');
				foreach($tier_data as $tier_row) {
					$userfac_data['tier_description'] = $tier_row['description'];
					$userfac_data['tierid'] = $tier_row['tierid'];
					$this->Main_model->insert_data('userfacilities',$userfac_data);
				}
				
				redirect(base_url().'User/view');
			}
			
			
		}
		$this->load->view('user/header');
		$this->load->view('user/add_facility',array('facilitydata'=>$facilitydata));
		$this->load->view('user/footer');
	}
	
	
	
	public function tier1()
	{  
	    $this->checklogin();
	    $getquestion=$this->Main_model->viewquestiontype(1);
		if(isset($_GET['id'])) {
			$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
		}
		
		if(isset($_POST['add']) && ($userfacilities_data[0]['userid'] == $_SESSION['user_id']))
		{
		 	// print_r($_FILES);

			for($i=1;$i<$_POST['totaltext'];$i++)
			{
			$insert_data['questionid'] = $_POST['qid_'.$i];
			$insert_data['answer']=$_POST['answer_'.$i];
			$insert_data['userid']=$_SESSION['user_id'];
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
			$questionid=$this->Main_model->insert_data('answers',$insert_data);

			}
			$q=1;
			for($i=1;$i<$_POST['totaldp'];$i++)
			{
			$insert_data['questionid'] = $_POST['qdid_'.$i];
			$insert_data['answer']=$_POST['drpdwn_'.$i];
			$insert_data['userid']=$_SESSION['user_id'];
			$questionid=$this->Main_model->insert_data('answers',$insert_data);
			}

			// $id= $this->input->post('facilityid');
			/*$id=26;
			$data = array(
			'status' => $this->input->post('status'),
			);
			$insertdata['status']= "in progress";
			$this->update_model->update_data($id,$data);
			$facilityid=$this->Main_model->insert_data('facilities',$insertdata);*/
			$this->Main_model->update_data('userfacilities',array('status'=>"Submitted"),array('id'=>$_GET['id']));
			redirect(base_url()."User/payment");
		}			 
          //print_r($_POST);
		$this->load->view('user/header');
	    $this->load->view('user/view_tier1',array('viewquestion'=>$getquestion));
		$this->load->view('user/footer'); 
	}

	public function tier2()
	{
		$this->checklogin();
	     $getquestion=$this->Main_model->viewquestiontype(2);
	  
	     if(isset($_POST['add']))
		 {
			 //  	print_r($_FILES);
			 for($i=1;$i<$_POST['totaltext'];$i++)
			 {
				 $insert_data['questionid'] = $_POST['qid_'.$i];
				
				
				  $insert_data['answer']=$_POST['answer_'.$i];
				 
				  
				  $insert_data['userid']=$_SESSION['user_id'];
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
				 $questionid=$this->Main_model->insert_data('answers',$insert_data);
				 
			 }
			 $q=1;
			 for($i=1;$i<$_POST['totaldp'];$i++)
             {
				$insert_data['questionid'] = $_POST['qdid_'.$i];
				
				$insert_data['answer']=$_POST['drpdwn_'.$i];
				  
			     $insert_data['userid']=$_SESSION['user_id'];
				 $questionid=$this->Main_model->insert_data('answers',$insert_data);
				
			 }
		}		
		$this->load->view('user/header');
	    $this->load->view('user/view_tier2',array('viewquestion'=>$getquestion));
		$this->load->view('user/footer'); 
	}
	
	public function tier3()
	{  
	    $this->checklogin();
	     $getquestion=$this->Main_model->viewquestiontype(3);
	  
	     if(isset($_POST['add']))
		 {
			 //  	print_r($_FILES);
			 for($i=1;$i<$_POST['totaltext'];$i++)
			 {
				 $insert_data['questionid'] = $_POST['qid_'.$i];
				
				
				  $insert_data['answer']=$_POST['answer_'.$i];
				 
				  
				  $insert_data['userid']=$_SESSION['user_id'];
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
				 $questionid=$this->Main_model->insert_data('answers',$insert_data);
				 
			 }
			 $q=1;
			 for($i=1;$i<$_POST['totaldp'];$i++)
             {
				$insert_data['questionid'] = $_POST['qdid_'.$i];
				
				$insert_data['answer']=$_POST['drpdwn_'.$i];
				  
			     $insert_data['userid']=$_SESSION['user_id'];
				 $questionid=$this->Main_model->insert_data('answers',$insert_data);
				
			 }
		}			 
          //print_r($_POST);
		$this->load->view('user/header');
	    $this->load->view('user/view_tier3',array('viewquestion'=>$getquestion));
		$this->load->view('user/footer'); 
	}

	public function payment() {
		
		
		if(isset($_POST['payment'])) {
			// Authorize.net lib
			
			$this->load->library('Authorize_net');
			
			$card_no = $_POST['card_no'];
			$exp_date = $_POST['month'].'/'.$_POST['year'];
			$cvv_no = $_POST['cvv_no'];
			$name = $_POST['name'];
			$zip_code = $_POST['zip_code'];
			$amount = $_POST['amount'];
			
			$auth_net = array(
				'x_card_num'			=> $card_no, // Visa
				'x_exp_date'			=> $exp_date,
				'x_card_code'			=> $cvv_no,
				// 'x_description'			=> 'A test transaction',
				'x_amount'				=> $amount,
				'x_first_name'			=> $name,
				// 'x_last_name'			=> 'Doe',
				// 'x_address'				=> '123 Green St.',
				// 'x_city'				=> 'Lexington',
				// 'x_state'				=> 'KY',
				'x_zip'					=> $zip_code,
				// 'x_country'				=> 'US',
				// 'x_phone'				=> '555-123-4567',
				// 'x_email'				=> 'test@example.com',
				// 'x_customer_ip'			=> $this->input->ip_address(),
				);
			$this->authorize_net->setData($auth_net);
			// print_r($_SESSION);
			$facility_data = $this->Main_model->get_data('userfacilities',array('id'=>$_SESSION['userfacility_id']));
			// print_r($facility_data);
			//exit;
			// Try to AUTH_CAPTURE
			if( $this->authorize_net->authorizeAndCapture() )
			{
				$payment_data['transaction_id'] = $this->authorize_net->getTransactionId();
				$payment_data['auth_code'] = $this->authorize_net->getApprovalCode();;
				$payment_data['response_code'] = $this->authorize_net->getresponsecode(); 
				$payment_data['payment_status'] = $this->authorize_net->getpayment_status();
				$payment_data['payment_response'] = $this->authorize_net->getpayment_responce();
				$payment_data['name'] = $name;
				$payment_data['userid'] = $facility_data[0]['userid'];
				$payment_data['facilityid'] = $facility_data[0]['facility_id'];
				$payment_data['tierid'] = $facility_data[0]['tierid'];
				$payment_data['zipcode'] = $zip_code;
				$payment_data['amount'] = $_POST['amount'];
				$payment_data['create_at'] = date('Y-m-d h:i:s');
				$facilityid=$this->Main_model->insert_data('facility_payment',$payment_data);
				$this->session->set_flashdata('payment_msg','success'); 
				redirect(base_url()."User/view");
			}
			else
			{
				$payment_data['transaction_id'] = $this->authorize_net->getTransactionId();
				$payment_data['auth_code'] = 0;
				$payment_data['response_code'] = $this->authorize_net->getresponsecode(); 
				$payment_data['payment_status'] = $this->authorize_net->getpayment_status();
				$payment_data['payment_response'] = $this->authorize_net->getpayment_responce();
				$payment_data['name'] = $name;
				$payment_data['userid'] = $facility_data[0]['userid'];
				$payment_data['facilityid'] = $facility_data[0]['facility_id'];
				$payment_data['tierid'] = $facility_data[0]['tierid'];
				$payment_data['zipcode'] = $zip_code;
				$payment_data['amount'] = $_POST['amount'];
				$payment_data['create_at'] = date('Y-m-d h:i:s');
				$facilityid=$this->Main_model->insert_data('facility_payment',$payment_data);
				$this->session->set_flashdata('payment_msg','fail'); 
				redirect(base_url()."User/view");
				// Show debug data
				// $this->authorize_net->debug();
			}
		}
		//echo 'sanjay';
		//exit;
		$this->load->view('user/header');
	    $this->load->view('user/payment');
		$this->load->view('user/footer');
	}
	
	public function view() {
		$this->checklogin();
		if(isset($_SESSION['user_id']))
		{
			$facilityid=$_SESSION['user_id'];
			$getfacility=$this->Main_model->getfacility($facilityid);
			//print_r($getfacility);
			//print_r($getfacility);
			$this->load->view('user/header');
			$this->load->view('user/view',array('viewfacility'=>$getfacility));
			$this->load->view('user/footer');
		}
	 
	}
	
	public function logout() {
		
		unset($_SESSION['user_id']);
		session_destroy();	
		redirect(base_url()."Login_Register/login");		
	}
	
	/*public function tier1()
	{
		$viewquestiontype=$this->Main_model->viewquestiontype();
		$this->load->view('user/header');
		$this->load->view('user/tier1',array('viewquestiontype'=>$viewquestiontype));
		$this->load->view('user/footer');
	}*/
	
	public function tierform() {
		
		if(isset($_GET['id'])) {
			$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
			// print_r($userfacilities_data);
			//$question_data = $this->Main_model->viewquestiontype($userfacilities_data['0']['tierid']);
			$question_data = $this->Main_model->viewanswer($userfacilities_data['0']['tierid'],$userfacilities_data['0']['facility_id']); 
			if( $question_data==null)
			{
				$question_data = $this->Main_model->viewquestiontype($userfacilities_data['0']['tierid']); 
			}
		}
		
		if(isset($_POST['add'])) {
		 	// print_r($_FILES);
			//$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
			for($i=1;$i<$_POST['totaltext'];$i++)
			{
				$insert_data['questionid'] = $_POST['qid_'.$i];
				$insert_data['answer']=$_POST['answer_'.$i];
				$insert_data['userid']=$_SESSION['user_id'];
				$insert_data['facilityid'] = $userfacilities_data[0]['facility_id'];
				$insert_data['tierid'] = $userfacilities_data[0]['tierid'];
				
				$data = $this->Main_model->get_data('answers',array('questionid'=>$_POST['qid_'.$i],'facilityid'=>$userfacilities_data[0]['facility_id'],'tierid'=>$userfacilities_data[0]['tierid']));
      // print_r($data);
      //exit;
  
				if(!empty($data))
				{
				   $id =$data[0]['answerid'];
				   $data=array("answer"=>$this->input->post('answer_'.$i));
				   $answerid=$this->Main_model->update_data('answers',$data,array('answerid'=>$id));
				}
				else
				{
					$questionid=$this->Main_model->insert_data('answers',$insert_data); 
				}	
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
				
				$data = $this->Main_model->get_data('answers',array('questionid'=>$_POST['qfid_'.$i],'facilityid'=>$userfacilities_data[0]['facility_id'],'tierid'=>$userfacilities_data[0]['tierid']));
				if(!empty($data))
				{
					$id =$data[0]['answerid'];
					$answerid=$this->Main_model->update_data('answers',array("documentpath"=>$insert_data['documentpath']),array('answerid'=>$id));
				} 
			   else
				{
					 $questionid=$this->Main_model->insert_data('answers',$insert_data);
				}
			}
			$q=1;
			for($i=1;$i<$_POST['totaldp'];$i++)
			{
				$insert_data['questionid'] = $_POST['qdid_'.$i];
				$insert_data['answer']=$_POST['drpdwn_'.$i];
				$insert_data['userid']=$_SESSION['user_id'];
				$insert_data['facilityid'] = $userfacilities_data[0]['facility_id'];
				$insert_data['tierid'] = $userfacilities_data[0]['tierid'];
				$data = $this->Main_model->get_data('answers',array('questionid'=>$_POST['qdid_'.$i],'facilityid'=>$userfacilities_data[0]['facility_id'],'tierid'=>$userfacilities_data[0]['tierid']));
				if(!empty($data))
                {
					 $id =$data[0]['answerid'];
					 $data=array("answer"=>$this->input->post('drpdwn_'.$i));
					 $answerid=$this->Main_model->update_data('answers',$data,array('answerid'=>$id));
				}
				else
				{
					 $questionid=$this->Main_model->insert_data('answers',$insert_data); 
				}
			}

			$this->Main_model->update_data('userfacilities',array('status'=>"Submitted"),array('id'=>$_GET['id']));
			
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
		
		$this->load->view('user/header');
	    $this->load->view('user/tierform',array('viewquestion'=>$question_data));
		$this->load->view('user/footer'); 
	}
	

	public function tierformpdf() {
		
		if(isset($_GET['id'])) {
			$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
			// print_r($userfacilities_data);
			//$question_data = $this->Main_model->viewquestiontype($userfacilities_data['0']['tierid']);
			$question_data = $this->Main_model->viewanswer($userfacilities_data['0']['tierid'],$userfacilities_data['0']['facility_id']); 
			if( $question_data==null)
			{
				$question_data = $this->Main_model->viewquestiontype($userfacilities_data['0']['tierid']); 
			}
		}
		
		if(isset($_POST['add'])) {
		 	// print_r($_FILES);
			//$userfacilities_data = $this->Main_model->get_data('userfacilities',array('id'=>$_GET['id']));
			for($i=1;$i<$_POST['totaltext'];$i++)
			{
				$insert_data['questionid'] = $_POST['qid_'.$i];
				$insert_data['answer']=$_POST['answer_'.$i];
				$insert_data['userid']=$_SESSION['user_id'];
				$insert_data['facilityid'] = $userfacilities_data[0]['facility_id'];
				$insert_data['tierid'] = $userfacilities_data[0]['tierid'];
				
				$data = $this->Main_model->get_data('answers',array('questionid'=>$_POST['qid_'.$i],'facilityid'=>$userfacilities_data[0]['facility_id'],'tierid'=>$userfacilities_data[0]['tierid']));
      // print_r($data);
      //exit;
  
				if(!empty($data))
				{
				   $id =$data[0]['answerid'];
				   $data=array("answer"=>$this->input->post('answer_'.$i));
				   $answerid=$this->Main_model->update_data('answers',$data,array('answerid'=>$id));
				}
				else
				{
					$questionid=$this->Main_model->insert_data('answers',$insert_data); 
				}	
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
				
				$data = $this->Main_model->get_data('answers',array('questionid'=>$_POST['qfid_'.$i],'facilityid'=>$userfacilities_data[0]['facility_id'],'tierid'=>$userfacilities_data[0]['tierid']));
				if(!empty($data))
				{
					$id =$data[0]['answerid'];
					$answerid=$this->Main_model->update_data('answers',array("documentpath"=>$insert_data['documentpath']),array('answerid'=>$id));
				} 
			   else
				{
					 $questionid=$this->Main_model->insert_data('answers',$insert_data);
				}
			}
			$q=1;
			for($i=1;$i<$_POST['totaldp'];$i++)
			{
				$insert_data['questionid'] = $_POST['qdid_'.$i];
				$insert_data['answer']=$_POST['drpdwn_'.$i];
				$insert_data['userid']=$_SESSION['user_id'];
				$insert_data['facilityid'] = $userfacilities_data[0]['facility_id'];
				$insert_data['tierid'] = $userfacilities_data[0]['tierid'];
				$data = $this->Main_model->get_data('answers',array('questionid'=>$_POST['qdid_'.$i],'facilityid'=>$userfacilities_data[0]['facility_id'],'tierid'=>$userfacilities_data[0]['tierid']));
				if(!empty($data))
                {
					 $id =$data[0]['answerid'];
					 $data=array("answer"=>$this->input->post('drpdwn_'.$i));
					 $answerid=$this->Main_model->update_data('answers',$data,array('answerid'=>$id));
				}
				else
				{
					 $questionid=$this->Main_model->insert_data('answers',$insert_data); 
				}
			}

			$this->Main_model->update_data('userfacilities',array('status'=>"Submitted"),array('id'=>$_GET['id']));
			
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
		
		$this->load->view('user/header');
	    $this->load->view('user/tierformpdf',array('viewquestion'=>$question_data));
		$this->load->view('user/footer'); 
	}



	public function profile()
	{	
		if(isset($_SESSION['user_id']))
	
		{
			$userdata = $this->Main_model->get_data('users',array('userid'=>$_SESSION['user_id']));
			$service  = $this->Main_model->get_data('service_types');
			if(isset($_POST['submit']))
			{
				$data=array("username"=>$this->input->post('uname'),
			            "email"=>$this->input->post('email'),
					     "servicetype"=>$this->input->post('servicetype'),
						 "password_md5"=>$this->input->post('password_md5'));
				$update = $this->Main_model->update_data('users',$data,array('userid'=>$_SESSION['user_id']));		 
			}
		}
		$this->load->view('user/header');
	    $this->load->view('user/profile',array('user'=>$userdata,'service'=>$service));
		$this->load->view('user/footer'); 
	}
	
	
}
