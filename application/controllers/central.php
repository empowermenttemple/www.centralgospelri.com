<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Central extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
                 $this->load->library('email');
                
	}
	public function index()
	{
            $data['title'] = 'Welcome to International Central Gospel Church';
            $this->load->view('header',$data);
            $this->load->view('index',$data);
            $this->load->view('foot');	
	}
       public function service_time(){
            $data['title'] = 'Service Times - ICGC RI - Empowerment Temple';
            $this->load->view('header',$data);
            $this->load->view('service-time',$data);
            $this->load->view('foot');  
       }
       public function special_event()
       {
            $data['title'] = 'Crossroads Shelter Party 2013 - ICGC RI - Empowerment Temple';
            $this->load->view('header',$data);
            $this->load->view('special_event',$data);
            $this->load->view('foot');          
       }
        public function crossroads(){
            $data['title'] = 'Crossroads Shelter Party 2013 - ICGC RI - Empowerment Temple';
            $this->load->view('header',$data);
            $this->load->view('crossroads',$data);
            $this->load->view('foot');
        }
        public function carols_night(){
            $data['title'] = 'Carol\'s Night with Music and Arts - ICGC RI - Empowerment Temple';
            $this->load->view('header',$data);
            $this->load->view('carolsnight',$data);
            $this->load->view('foot');     
        }
        public function carol_night()
        {
            $data['title'] = 'Carol\'s Night with Music and Arts - ICGC RI - Empowerment Temple';
            $this->load->view('header',$data);
            $this->load->view('summit',$data);
            $this->load->view('foot');  
        }
        public function media()
        {
            $data['title'] = 'Gallery - International Central Gospel Church - Rhode Island Assembly';
            $this->load->view('header',$data);
            $this->load->view('photos',$data);
            $this->load->view('foot');  
        }

        public function connect()
        {
            $data['title'] = 'Connect with Us -  Empowerment Temple';
            $this->load->view('header',$data);
            $this->load->view('connect',$data);
            $this->load->view('foot');
        }
        public function leaders()
        {
            $data['title'] = 'Church Leadership - International Central Gospel Church - Rhode Island Assembly';
            $data['message'] = '';
            $this->load->view('lead_head',$data);
            $this->load->view('leaders',$data);
            $this->load->view('footer');      
        }
        public function data()
        {
            $this->central_model->get_male();
            $this->central_model->get_female();
        }
	public function contact()
	{
			$data['title'] = 'Contact Us - International Central Gospel Church - Rhode Island Assembly';
                        $this->load->view('header',$data);
			$data['message'] = '';
			$this->load->view('contact',$data);
			$this->load->view('foot');
		
	}
	public function church()
	{
		$data['title'] = 'About Our Church - International Central Gospel Church - Empowerment Temple';
                $this->load->view('header',$data);
		$data['message'] = '';
		$this->load->view('about',$data);
		$this->load->view('foot');
	}
	public function church_setup()
	{
		if($this->session->userdata('is_logged_in'))
		{
			$data['title'] = 'Setup Church - International Central Gospel Church - Empowerment Temple';
			$this->load->view('head',$data);
			$data['message'] = '';
                        $this->user();
			$this->load->view('church',$data);
			//$this->load->view('footer');
		}else{
			$this->login();
		}
	}
	public function prayer_request()
	{
		$data['title'] = 'Send Prayer Request - International Central Gospel Church - Empowerment Temple';
		$this->load->view('header',$data);
		$data['message'] = '';
		$this->load->view('prayer_request',$data);
		$this->load->view('foot');
	}
	public function testimony()
	{
		$data['message'] = '';
		$data['title'] = 'Let uss what God has done for you - International Central Gospel Church - Empowerment Temple';
		$this->load->view('photo_head',$data);
		$this->load->view('testimony',$data);
		$this->load->view('footer');
	}
	public function service_times()
	{
		$data['title'] = 'Service Times - International Central Gospel Church - Empowerment Temple';
		$this->load->view('photo_head',$data);
		$data['message'] = '';
		$this->load->view('service_times',$data);
		$this->load->view('footer');
	}

	public function sendPrayer()
	{
			$add = $this->central_model->send_prayer();
			if($add)
			{
                             echo  '<span>Your Prayer Request has been sent to our Prayer Department. You will receive a email confimration shortly.!!!</span>';
                        }else{
                               echo '<b id="error">An error occurred while processing your prayer... please try again shortly.!!!</b>';
				
                        }
                            
		
	}

	public function send_contact()
	{
           
			$add = $this->central_model->sendMessage();
			if($add)
			{
                          echo  "<p>Thank you very much for contacting us today. </p><p>We really appreciate you spending time with us on our website and also sending us a message. We hope that we will be able to Worship with this Sunday at our church in Pawtucket. </p>";
 
                        }else{
                            echo 'Sorry... an error occured. Please try again.';
                        }
           
	
        }

        public function search_tithe_number()
        {
            $query= $this->central_model->list_tithe_number();
                if($query!== false)
                {
                    
                    echo json_encode($query);
                }else{
                    echo 'Sorry..No Tithe record was found.';
                }
        }
        public function user()
        {
            $user = $this->session->userdata('username');
            $data['results']=$this->central_model->search_user($user);
            $data['username']= $user;
            $this->load->view('user',$data);
        }
        public function add_devotion()
        {
            if($this->session->userdata('is_logged_in'))
		{
                        $user = $this->session->userdata('username');
			$data['title'] = 'Daily Devotion - LampStand Church Management System - ::';
                        $data['results']=$this->central_model->search_user($user);
			$this->load->view('head', $data);
                        $data['message'] = '';
                        $this->load->view('add_devotion',$data);
		}else{
			$this->login();
		}
        }
        public function save_devotion()
        {
            $this->form_validation->set_rules('date','Date','required');
            $this->form_validation->set_rules('reading','Scripture Reading','trim|required');
            $this->form_validation->set_rules('prayer','Devotion Prayer','trim|required');
            $this->form_validation->set_rules('devotion','Devotion','trim|required');
            $this->form_validation->set_rules('scripture','Scripture','trim|required');
            $this->form_validation->set_rules('topic','Devotion Topic','trim|required');
            $validate = $this->form_validation->run();
            if($validate)
            {
                $devotion = $this->central_model->saveDevotion();
                if($devotion)
                {
			redirect('central/add_devotion');
                }else{
			$data['title'] = 'Daily Devotion - LampStand Church Management System - ::';
                        $data['results']=$this->central_model->search_user();
			$this->load->view('head', $data);
                        $data['message'] = 'Sorry..An error has occured and you will have to retry again.';
                        $this->load->view('add_devotion',$data);
                        $this->load->view('foot');
                }
            }else{
                $this->add_devotion();
            }
        }
        public function devotion()
        {
			$data['title'] = date('F d, Y').' - Devotion - ICGC Rhode Island ::Empowerment Temple::';
                        $data['search'] = $this->central_model->daily_devotion();
                        $this->load->view('devotion',$data);  
                        $this->load->view('foot');
        }
	public function home()
	{
		if($this->session->userdata('is_logged_in'))
		{
                    if($this->session->userdata('role')== 'Church Employee')
                    {
                        redirect('lampstand/home');
                    }else{
                        $user  = $this->session->userdata('username');
			$data['title'] = 'LampStand Church Management System - ::';
                        $data['results']=$this->central_model->search_user($user);
			$this->load->view('head', $data);
                        $this->load->view('financial',$data);
                    }
		}else{
			$this->login();
		}
	}
        public function purge($key)
        {
            if($key == "")
            {
                $data['title'] = 'Events and Programmes - Asore Management System ::<?php echo $church; ?>::';
                $data['message'] = 'Error occured';
                $user  = $this->session->userdata('username');
                $data['results']=$this->central_model->search_user($user);
		$this->load->view('head',$data);
		$data['events']=$this->central_model->get_events();
                $this->load->view('event',$data);
                $this->load->view('foot',$data);
            }else{
                $purge = $this->central_model->delete_event($key);
                if($purge)
                {
                    $data['title'] = 'Events and Programmes - Asore Management System ::<?php echo $church; ?>::';
                    $data['message'] = 'Event Purge Successfully';
                    $user  = $this->session->userdata('username');
                    $data['results']=$this->central_model->search_user($user);
                    $this->load->view('head',$data);
                    $data['events']=$this->central_model->get_events();
                    $this->load->view('event',$data);
                    $this->load->view('foot',$data);
                }
            }
        }



	public function member()
	{
		if($this->session->userdata('is_logged_in'))
		{
			$data['message'] = '';
                        $user  = $this->session->userdata('username');
			$data['title'] = 'Church Membership - Asore Management System ::::';
                        $data['results']=$this->central_model->search_user($user);
			$this->load->view('head',$data);
                        $data['members'] =$this->central_model->getmembers();
                        $this->load->view('member',$data);
		}else{
			$this->login();
		}

	}
	public function members_validation()
	{
		$this->form_validation->set_rules('firstname','First Name','trim|required');
		$this->form_validation->set_rules('lastname','Last Name','trim|required');
		$this->form_validation->set_rules('phone','Phone Number','trim|required');
		$this->form_validation->set_rules('email','Email Address','trim|required|is_unique[members.email]|valid_email');
		$this->form_validation->set_rules('address','Address','trim|required');
		$this->form_validation->set_rules('gender','Gender','trim|required');
		$this->form_validation->set_rules('city','City','trim|required');
		$this->form_validation->set_rules('state','State','trim|required');
		$this->form_validation->set_rules('zip','Zip Code','trim|required|numeric|max_length[5]');
		$validate = $this->form_validation->run();
                if($validate)
                {
                	$add = $this->central_model->add_member();
			if($add)
			{
                            return true;
			}else{
                            return false;
                        }
                }else{
                    $this->add_member();
                }
	}

	public function change_password_validation()
	{
		$this->form_validation->set_rules('password','New Password','required|min_length[8]|matches[confirmpwd]');
		$this->form_validation->set_rules('confirmpwd','Confirm Password','required');
		if( $this->form_validation->run())
		{
			$good = $this->central_model->change_password();
			if($good){
				$data['title'] = 'AsoreMS - Changed Password';
				$this->load->view('login_head',$data);
				echo br(4);
				echo '<div class="log" id="login-details"><center><b>Your Password has been changed.</b></center><br>';
				echo "<p>Click here to go the Login page and login in using your new Log in Credentials</p>";
				echo nbs(3);
				echo anchor('central/login','Login');
				echo '</div>';
				echo br(3);
				$this->load->view('foot',$data);
			}
		}else{
			$config['title'] = 'Change Passwords';
			$this->load->view('login_head',$config);
			$data['look'] = $this->central_model->fetch_password();
			$this->load->view('forgot_password_results',$data);
			$this->load->view('foot');
		}
	}
	public function forgot_password()
	{
		$data['title'] = 'Forgot Password';
		$this->load->view('login_head',$data);
		$this->load->view('forgot_password');
		$this->load->view('foot');
	}
	public function forgot_password_results()
	{
		$config['title'] = 'Change Passwords';
		$this->load->view('login_head',$config);
		$data['look'] = $this->central_model->fetch_password();
		$this->load->view('forgot_password_results',$data);
		$this->load->view('foot');
	}
	public function security_questions()
	{
		$config['title'] = 'Security Questions';
		$this->load->view('login_head',$config);
		$data['look'] = $this->central_model->fetch_password();
		$this->load->view('security_questions',$data);
		$this->load->view('foot',$data);
	}
	public function security_question_validation()
	{
		$this->form_validation->set_rules('answer1','Answer 1','required');
		$this->form_validation->set_rules('answer2','Answer 2','required');
		$run = $this->form_validation->run();
		if($run)
		{
			$results =$this->central_model->check_security();
			if($results)
			{
				redirect('central/forgot_password_results');
			}else{
				$this->load->view('central/security_questions');
				echo "<b>No Records Found for the Information provided</b>";
				echo "<div>Click here to go back and try again.</div>";
				echo anchor('central/forgot_password','Forgot Password');
				$this->load->view('foot');
			}
		}
	}
	public function forgot_password_validation()
	{
		$this->form_validation->set_rules('username','Username','required');
		$scan=$this->form_validation->run();
		if($scan )
		{
			$result = $this->central_model->fetch_password();
			if($result)
			{
				redirect('central/security_questions');
			}else{
				echo "<b>No Records Found for the Information provided</b>";
				echo "<div>Click here to go back and try again.</div>";
				echo anchor('central/forgot_password','Forgot Password');
				$this->load->view('foot');
			}
		} else{
			$this->load->view('forgot_password');
		}
	}
	public function forgot_username()
	{
		$data['title'] = 'Forgot Password';
		$this->load->view('login_head',$data);
		$this->load->view('forgot_username');
		$this->load->view('foot');
	}
	public function update_profile($key)
	{
		$this->form_validation->set_rules('firstname','First Name','trim|required');
		$this->form_validation->set_rules('lastname','Last Name','trim|required');
		$this->form_validation->set_rules('phone','Phone Number','trim|required');
		$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
		$this->form_validation->set_rules('address','Address','trim|required');
		$this->form_validation->set_rules('gender','Gender','trim|required');
		$this->form_validation->set_rules('month','Month of Birth','trim|required');
		$this->form_validation->set_rules('year','Year of Birth','trim|required|numeric|max_length[4]');
		$this->form_validation->set_rules('city','City','trim|required');
		$this->form_validation->set_rules('state','State','trim|required');
		$this->form_validation->set_rules('zip','Zip Code','trim|required|numeric|max_length[5]');
		$update = $this->form_validation->run();
		if($update)
		{
			$save = $this->central_model->edit_member($key);
			if($save)
			{
				redirect('central/member');
			}else{
				$this->edit_profile($key);
			}
		}else{
			$this->edit_profile($key);
		}
	}
        public function saveAjax()
        {
            $this->central_model->save_ajax();
        }

	public function add_member()
	{
		if($this->session->userdata('is_logged_in'))
		{
			$data['title'] = 'Add New Members - Asore Management System';
                        $user = $this->session->userdata('username');
                        $data['results']=$this->central_model->search_user($user);
			$this->load->view('head',$data);
			$data['error']= '';
                        $data['results'] = '';
			$this->load->view('add_member',$data);
			$this->load->view('foot',$data);
		}else{
			$this->login();
		}
	}
	public function member_profile($key)
	{
		if($this->session->userdata('is_logged_in')){
                        $user  = $this->session->userdata('username');
			$data['title'] = 'Member Profile - Asore Management System';
                        $data['results']=$this->central_model->search_user($user);
			$this->load->view('head',$data);
			$data['message'] = '';
			$data['member'] = $this->central_model->get_member($key);
			$data['record']= $this->central_model->get_ministrys($key);
			$data['depart']= $this->central_model->get_member_department($key);
			$this->load->view('member_profile',$data);
		}else{
			$this->login();
		}
	}
	public function edit_profile($key)
	{
		if($this->session->userdata('is_logged_in')){
                        $user  = $this->session->userdata('username');
			$data['title'] = 'Member Profile - Asore Management System ::<?php echo $church; ?>::';
                        $data['results']=$this->central_model->search_user($user);
			$this->load->view('head',$data);
			$data['member'] = $this->central_model->get_member($key);
			$this->load->view('edit_member',$data);
		}else{
			$this->login();
		}
	}
	public function delete_department($key)
	{
                $this->user();
		$this->load->view('head');
		$data['department'] = $this->central_model->search_department($key);
		$this->load->view('delete_department',$data);
			
	}
	public function deleteDepartment($key)
	{
		$delete = $this->central_model->delete_department($key);
		if($delete)
		{
			redirect('central/department','refresh');
		}else{
			echo 'Sorry,...there is an internal error, Department was not able to delete. Go back and try again.';
		}
	}
	public function delete_profile($key)
	{
		if($this->session->userdata('is_logged_in')){
                    
			$data['title'] = 'Member Profile - Asore Management System';
                        $user  = $this->session->userdata('username');
                        $data['results']=$this->central_model->search_user($user);
			$this->load->view('head',$data);
			$data['member'] = $this->central_model->get_member($key);
			$this->load->view('delete_member',$data);
			$this->load->view('footer');
		}else{
			$this->login();
		}
	}
	public function cancel_member()
	{
		redirect('central/member');
	}
	public function cancel_events()
	{
		redirect('central/event');
	}
	public function cancel_department()
	{
		redirect('central/department');
	}
	public function delete_member($key)
	{
		$delete = $this->central_model->delete_member($key);
		if($delete)
		{
			$data['message'] = 'Church Member Profile has been Delete.';
			$this->member($data);
		}else{
			redirect('/central/delete_profile/'.$key);
		}
	}





}

