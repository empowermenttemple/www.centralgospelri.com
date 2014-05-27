<?php
class Central_model extends CI_Model
{
    public function __construct()
	{
		parent::__construct();
	}
  
   public function get_gender()
   {
       $delimiter = ",";
        $newline = "\r\n";
       $this->load->dbutil();
       
       $sql = $this->db->query("Select gender,count(*) as count
From members
Group by gender;");
    $data= $this->dbutil->csv_from_result($sql,$delimiter,$newline);


if ( ! write_file('./data/total_gender.csv', $data))
{
     return true;
}
else
{
     return false;
}
   }
    public function getChurch()
    {
        $data = array(
          'churchID'=> '1' 
        );
        $sql=$this->db->get_where('church',$data);
        return $sql->result();
        if($sql->num_rows > 0)
        {
            $row = $sql->row;
            $row->branch;
            $row->Name;
            $row->address1;
            $row->address2;
            $row->phone;
            $row->fax;
            $row->email;
            $row->city;
            $row->state;
            $row->zip;
            return true;
           
        }else{
            return false;
        }
    }
    
    
public function sendMessage()
	{
                $message = $this->input->post('message');
                $location = $this->input->post('location');
                $phone = $this->input->post('phone');
                $fullname= $this->input->post('name');
                $email = $this->input->post('email');
		$data = array(
			'full_name'=>$this->input->post('name'),
			'email'=>$this->input->post('email'),
			'phone'=>$this->input->post('phone'),
			'location'=>$this->input->post('location'),
			'message'=>$this->input->post('message'),
                        'contact_date'=> now()
		);
		$add = $this->db->insert('contact_message',$data);
		if($add)
		{
                    $this->sendContact_Church($email,$fullname);
                    return true;
		}else{
			return false;
		}
	}
        public function sendContact_Church($email,$fullname){
                            $message = "<p>Thank you very much for contacting us today. </p><p>We really appreciate you spending time with us on our website and also sending us a message. We hope that we will be able to Worship with this Sunday at our church in Pawtucket. </p>";
                            $this->email->from($email,'Contact from'.$fullname);
                            $this->email->to('contactus@centralgospelri.com');
                            $this->email->subject("Contact from ".$this->input->post('name'));
                            $this->email->message($message);
                            $this->email->send();
                           
                            
        }
     

	public function delete_ministry($key)
	{
			$data = array(
				'ministryID'=> $key
			);
			$delete = $this->db->delete('ministry',$data);
			if($delete)
			{
                            $delete_member = $this->db->delete('ministry_members',$key);
                            if($delete_member)
                            {
                                return true;
                            }else{
                                return false;
                            }
			}else{
				return false;
			}
	}
	public function delete_department($key)
	{
			$data = array(
				'departmentID'=> $key
			);
			$delete = $this->db->delete('department',$data);
			if($delete)
			{
                            $delete_member = $this->db->delete('department_members',$key);
                            if($delete_member)
                            {
                                return true;
                            }else{
                                return false;
                            }
			}else{
				return false;
			}
	}
	public function events()
	{
		$data = array(
			'event_week'=>date('W')
		);
		$events = $this->db->get_where('events',$data);
		return $events->result();
	}
        public function sendPrayer($data){
                           //Email Configuration - Sends email to the Church prayer department email address
                            $this->email->from('prayer_request@centralgospelri.com','International Central Gospel Church - Rhode Island Assenbly - Prayer Request');
                            $this->email->to($data);
                            $this->email->subject("Prayer Request ".$this->input->post('your_name'));
                            $message =  $this->input->post('message')  ;
                            $this->email->message($message);
                            return true;
        }
	public function send_prayer()
	{
		$data = array(
			'name'=>$this->input->post('your_name'),
			'location'=>$this->input->post('location'),
			'email'=>$this->input->post('email'),
			'phone'=>$this->input->post('phone'),
			'prayer_type'=>$this->input->post('prayer_type'),
			'message'=>$this->input->post('message')
		);
		if($this->db->insert('prayerrequest',$data))
		{
                    return true;
			
		}
	}
	public function loginstamp()
    {
        $data = array(
            'username'=>$this->input->post('username'),
            'date'=>now()/*Saves the time in Unix timestamp**/
        );
        $this->db->insert('login',$data);
    }
 
	public function add_member_ministry($key)
	{
		$data = array(
			'ministry'=>$this->input->post('ministry'),
			'memberID'=>$key
		);
		$add = $this->db->insert('ministry_members',$data);
		if($add)
		{
			return true;
		}else{
			return false;
		}
	}
	public function add_member_department($key)
	{
		$data = array(
			'department'=>$this->input->post('department'),
			'memberID'=>$key
		);
		$add = $this->db->insert('department_members',$data);
		if($add)
		{
			return true;
		}else{
			return false;
		}
	}
	public function edit_member($key)
	{
			$data = array(
			'firstname'=>$this->input->post('firstname'),
			'lastname'=>$this->input->post('lastname'),
			'address'=>$this->input->post('address'),
			'address1'=>$this->input->post('address1'),
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'zip'=>$this->input->post('zip'),
			'gender'=>$this->input->post('gender'),
			'b_month'=>$this->input->post('month'),
			'b_year'=>$this->input->post('year'),
			'created'=>now()
		);
		$this->db->where('memberID',$key);
		$update = $this->db->update('members',$data);
		if($update)
		{
                    return true;
		}else
                {
                    return false;
		}
	}
        public function search_members()
        {
            $values = array(
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname')               
            );
		$search = $this->db->get_where('members',$values);	
		return $search->result();
                if($search->num_rows() > 0)
                {
                    $row = $search->row();
                    $row->firstname;
                    $row->lastname;
                    $row->address1;
                    $row->address2;
                    $row->city;
                    $row->state;
                    $row->zipcode;
                    $row->email;
                    $row->phone;
                    return true;
                }else{
                    return false;
                }
                
        }
	public function get_member($key)
	{
		$data = array(
			'memberID'=>$key
		);
		$list = $this->db->get_where('members',$data);
		
		if($list->num_rows > 0)
		{
			return $list->result();
		}else{
			return false;
		}
	}
        public function save_ajax()
        {
          
            $events = array(
			'event_name'=>$this->input->post('event_name'),
			'fdate'=>$this->input->post('event_date'),
			'event_ftime'=>$this->input->post('event_ftime'),
			'event_ttime'=>$this->input->post('event_ttime'),
			'events_notes'=>$this->input->post('event_notes'),
			'speaker'=>$this->input->post('event_speaker'),
			'event_week'=>date("W",strtotime($this->input->post('event_fdate'))),
                        'month'=>date("m",strtotime($this->input->post('event_fdate')))
		);
		$query = $this->db->insert('events',$events);
                if($query)
                {
                   $id = mysql_insert_id();
                   $search = array(
                      'event_name' => $id 
                   );
                   $this->db->select('event_name');
                   $this->db->get_where('events',$search);
                   echo '<p>Event: &nbsp;'.$this->input->post('event_name').' has been added.</p>';
                }else{
                    echo 'Sorry and error ocured';
                }
                
                
        }
	public function add_member()
	{
		$data = array(
			'firstname'=>$this->input->post('firstname'),
			'lastname'=>$this->input->post('lastname'),
			'address'=>$this->input->post('address'),
			'address1'=>$this->input->post('address1'),
			'phone'=>$this->input->post('phone'),
			'email'=>$this->input->post('email'),
			'city'=>$this->input->post('city'),
			'state'=>$this->input->post('state'),
			'zip'=>$this->input->post('zip'),
			'gender'=>$this->input->post('gender'),
			'agegroup'=>$this->input->post('agegroup'),
			'created'=>now()
                    
		);
			$add = $this->db->insert('members',$data);
			$id = mysql_insert_id();
		if($add)
		{
                    $this->get_gender();
                    $this->get_agegroup();
                   $name = $this->input->post('firstname').' '.$this->input->post('lastname');
                   echo '<p id="results" style="padding: 5px;"> '.$name.' Church ID number and Tithe Number is <b>'.$id.' and his or her information has been added.</b></p>';
                   echo anchor('central/add_member', 'Add New Member');
                   echo nbs(5);
                   echo anchor('central/members', 'Member List');
		}else{
                    echo 'Sorry... and error has occured, please try again.';
		}
	}
        public function new_member_info($key)
        {
          
            $data = array(
              'memberID'=> $key  
            );
            $sql = $this->db->select('*')->where($data)->get('members',$data);
            return $sql->result();
            if($sql->num_rows() > 0)
            {
              return json_encode($sql);
               
            }else{
                return false;
            }
            
            
        }
	public function get_ministrys($key)
	{
		$data = array(
			'memberID'=>$key
		);
		$run = $this->db->get_where('ministry_members',$data);
		return $run->result();
		if($run->num_rows > 0)
		{
			foreach($run->result() as $row)
				$row = $run->row();
				$row->ministry_name;
				$row->ministryID;
			
		}else{
			echo 'No Record';
		}
	}
	public function getMinistry($key)
	{
				$data = array(
			'ministryID'=>$key
		);
		$run = $this->db->get_where('ministry',$data,1);
		return $run = $run->result();
	}
	public function get_department()
	{
		$depart = $this->db->get('department');
		return $depart->result();
		if($depart->num_rows > 0)
		{
			$row = $depart->row();
			$row->department_name;
			$row->department_head;
			$row->department_assist;
			$row->department_notes;
			$row->departmentID;
		}else{
			return false;
		}
	}
	public function add_new_ministry()
	{
		$data = array(
		'ministry_name'=>$this->input->post('ministry_name'),
		'notes'=>$this->input->post('ministry_notes'),
		);
		$add = $this->db->insert('ministry',$data);
		if($add)
		{
			return true;
		}else{
			return false;
		}
	}
	public function ministry_members($key)
	{
				$data = array(
			'ministryID'=>$key
		);
		$query =$this->db->get_where('ministry',$data);
		return $query->result();
		
	}
	public function depart_members($key)
	{
		$data = array(
			'departmentID'=>$key
		);
		$query =$this->db->get_where('department',$data);
		return $query->result();
		
	}
	public function get_ministry()
	{
		$record = $this->db->get('ministry');
		return $record->result();
	}
	public function search_department($key)
	{
		$config = array(
			'departmentID'=>$key
		);
		$data = array(
			'department_name'=>$this->input->post('department_name'),
			'department_head'=>$this->input->post('department_head'),
			'department_assist'=>$this->input->post('department_assist'),
			'department_notes'=>$this->input->post('department_notes')
		);
		
		$update = $this->db->where($config)->get('department');
		return $update = $update->result();
	}
	public function add_department()
	{
		$data = array(
			'department_name'=>$this->input->post('department_name'),
			'department_notes'=>$this->input->post('department_notes'),
			'created'=>now()
		);
		$save = $this->db->insert('department',$data);
		if($save)
		{
			return true;
		}else{
			return false;
		}
	}
	public function add_new_user()
    {
        $data = array(
            'firstname'=>$this->input->post('firstname'),
            'lastname'=>$this->input->post('lastname'),
            'email'=>$this->input->post('email'),
            'username'=>$this->input->post('username'),
            'password'=>sha1($this->input->post('password')),
            'position'=>$this->input->post('position'),
            'security1'=>$this->input->post('question1'),
            'answer1'=>$this->input->post('answer1'),
            'security2'=>$this->input->post('question2'),
            'answer2'=>$this->input->post('answer2')
        );
        $adduser = $this->db->insert('member_user', $data);

        if($adduser){
            return true;
        } else {
            return false;
        }
        
    }
	public function church_setup()
	{
		 $data = array(
            'name'=>$this->input->post('church_name'),
            'address1'=>$this->input->post('address1'),
            'address2'=>$this->input->post('address2'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zip'=>$this->input->post('zipcode'),
            'branch'=>$this->input->post('branch'),
            'email'=>$this->input->post('email'),
            'fax'=>$this->input->post('fax'),
            'slogan'=>$this->input->post('slogan'),
            'phone'=>$this->input->post('phone')
        );
        $church = $this->db->insert('church',$data);	
        if($church)
        {
        	$data['message'] = ' <center><b> Church Information has been added and saved</b>
        	<i><small>Note that you can only have One Church information </small></i></center>';
        	$data['title'] = 'Asore Management System - ::<?php echo $church; ?>::';
	        $this->load->view('head', $data);
	        $this->load->view('home',$data);
	        $data['church']= $this->get_church();
	        $this->load->view('footer',$data);
        }	
	}
	public function login_admin()
	{
        $this->db->where('username',$this->input->post('username'));
        $this->db->where('password',sha1($this->input->post('password')));
        $query = $this->db->get('member_user');
        if($query->num_rows()==1)
        {
            $row = $query->row();
            return $row->position;
        }else{
            return false;
        }
	}

    /**Searches for the users Username and returns the Username**/
    public function fetch_username()
        {
          
           $query = $this->db->get_where('member_user',array('email'=>$this->input->post('email')));
           return $query->result();
           if($query->num_rows() == 1)
           {
               $row = $query->row();
               echo $row->username;
           }
           else {
               echo "<b>No Records Found for the Information provided</b>";
           }
        }
public function check_security()
    {
        $this->db->select('answer1,answer2');
        $this->db->from('member_user');
        $data = array(
            'answer1'=>$this->input->post('answer1'),
            'answer2'=>$this->input->post('answer2')
        );
        $this->db->where($data);
        $look = $this->db->get();
        return $look->result();
        if($look->num_rows()==1)
        {            
            return true;
        }else{
            return false;
        }
    }
    public function fetch_password()
    {
        $look = $this->db->get_where('member_user',array('username'=>$this->input->post('username')));
        return $look->result();
        if($look->num_rows()==1)
        {
            $row = $look->row();
            
            echo $row->username;
            echo $row->security1;
            echo $row->security2;
            echo $row->answer1;
            echo $row->answer2;
        
        }else {
               return false;
           }
    }
	
    
        public function change_password()
        {
            $data = array(
                'password' => sha1($this->input->post('password'))
            );

            $config = array(
               'churchno'=> $this->input->post('usercode')
                    );
            $this->db->where($config);
            $change = $this->db->update('member_user',$data);
            if($change)
            {
                return true;
            }else{
                return false;
            }
            
        }

	public function update_department($key)
	{
		$config = array(
			'departmentID'=>$key
		);
		$data = array(
			'department_name'=>$this->input->post('department_name'),
			'department_head'=>$this->input->post('department_head'),
			'department_assist'=>$this->input->post('department_assist'),
			'department_notes'=>$this->input->post('department_notes')
		);
		$save = $this->db->where($config)->update('department',$data);
		if($save)
		{
			return true;
		}else{
			return false;
		}
	}
	public function delete_ministry_record($key)
	{
		$data = array(
			'ministryID'=>$key
		);
		$delete = $this->db->delete('ministry',$data);
		if($delete)
		{
			return true;
		}else{
			return false;
		}
	}
	public function edit_ministry($key)
	{
		$data = array(
			'ministryID'=>$key
		);
		$edit =$this->db->get_where('ministry',$data);
		return $edit->result();
		if($edit->num_rows ==1 )
		{
			$row = $edit->row();
			$row->ministry_name;
			$row->ministry_notes;
			$row->ministryID;
			return $edit;
		}else{
			return false;
		}
	}
	public function edit_ministry_record($key)
	{
		$data = array(
		'ministry_name'=>$this->input->post('ministry_name'),
		'notes'=>$this->input->post('ministry_notes'),
		);
		$this->db->where('ministryID',$key);
		$update = $this->db->update('ministry',$data);
		if($update)
		{
			return true;
		}else{
			return false;
		}
	}
	
	public function prayer_blog()
        {
            $prayer = $this->db->get('prayerrequest',20);
            return $prayer->result();
            if($prayer->num_rows() > 0)
            {
                $row = $prayer -> $row();
                $row->phone;
                $row->email;
                $row->prayer_type;
                $row->message;
                $row->name;
                
            }else{
                return false;
            }
        }
	public function getmembers()
        {
                $data['message'] = '';
		$config['base_url'] = base_url().'central/member';
		$config['total_rows'] = $this->db->get('members')->num_rows();
		$config['per_page'] =10;
		$config['num_links'] = 200;
                $config['full_tag_open'] = '<p class="member-tbl">';
                $config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config);
		$events = $this->db->select('memberID,firstname,lastname,address,address1,city,state,zip,email,phone')
				->limit(10)->order_by('firstname','asc')->get('members',10,$this->uri->segment(3));
                return $events->result();
                if($events->num_rows() > 0)
                {
                    $row = $events->row;
                        $row->firstname;
                        $row->lastname;
                        $row->city;
                        $row->phone;
                        $row->zip;
                        $row->state;
                        $row->email;
                }else{
                    return 'No Record';
                }
        }
	public function get_events()
	{
               
		$config['base_url'] = base_url().'central/event';
		$config['total_rows'] = $this->db->get('events')->num_rows();
		$config['per_page'] =10;
		$config['num_links'] = 200;
		$this->pagination->initialize($config);

                $events =$this->db->get('events',10,'desc');
                return $events->result();
	}
	public function week_event()
	{
		$data = array(
			'event_week'=> date('W')
		);
		$weeks =$this->db->get_where('events',$data);
		return  $weeks->result();
		
	}
        public function get_devotion()
        {
            $data = array(
                'date'=>date('m/d/Y')
            );
            $devotion = $this->db->get_where('devotion',$data);
            return $devotion->result();
        }
	public function add_events()
	{
         
		$events = array(
			'event_name'=>$this->input->post('event'),
			'fdate'=>$this->input->post('fdate'),
			'event_ftime'=>$this->input->post('ftime'),
			'event_ttime'=>$this->input->post('ttime'),
			'events_notes'=>$this->input->post('notes'),
			'speaker'=>$this->input->post('speaker'),
			'event_week'=>date("W",strtotime($this->input->post('event_date'))),
                        'month'=>date("m",strtotime($this->input->post('event_date')))
		);
		$query = $this->db->insert('events',$events);
		if($query)
		{
                   $id = mysql_insert_id();
                   $this->last_event($id);
                }else{
			redirect('central/event');
		}
	}
        public function last_event($key)
        {
          $search = array(
                      'eventsID' => $key 
                   );
                   $event =$this->db->get_where('events',$search);
                   if($event->num_rows() > 0)
                   {
                       $row = $event->row();
                   echo '<div class="results" style="margin: auto; width: 400px;text-align:center; background-color: lavender;border:1px solid lightgray;font-family: Verdana "><p>&nbsp;<b>'.$row->event_name.'</b> event has been added.</p>';
                   echo anchor(base_url('central/create_events'),'Add New Event');
                   }else{
                      $data['message'] = '<p>Sorry....and Error occurred . Please contact the Administrator.</p>'; 
                     $this->load->view('events',$data);
                   }
                     
        }
	public function update_church()
    {
        $data = array(
            'name'=>$this->input->post('church_name'),
            'address1'=>$this->input->post('address1'),
            'address2'=>$this->input->post('address2'),
            'city'=>$this->input->post('city'),
            'state'=>$this->input->post('state'),
            'zipcode'=>$this->input->post('zipcode'),
            'branch'=>$this->input->post('branch'),
            'email'=>$this->input->post('email'),
            'fax'=>$this->input->post('fax'),
            'slogan'=>$this->input->post('slogan'),
            'phone'=>$this->input->post('phone')
        );
        $church = $this->db->update('church_setup',$data,"churchID = 1");
        if($church)
        {
            
            return true;
        }else{
            return false;
        }
    }

    public function daily_devotion()
    {
       $data  = array(
           'date'=> date('m/d/Y')
       );
        $devotion = $this->db->select('*')->where($data)->get('devotion');
        return $devotion->result();
    }
	public function view_ministry_details($key)
	{
		$data = array(
			'ministry'=>$key
		);
		$this->db->select('members.*');
		$this->db->from('members');
		$this->db->join('ministry_members','ministry_members.memberID = members.memberID');
		$this->db->where($data);
		$run = $this->db->get();
		return $run->result();
		
	}
	public function view_department($key)
	{
		$data = array(
			'department'=>$key
		);
		$this->db->select('members.*');
		$this->db->from('members');
		$this->db->join('department_members','department_members.memberID = members.memberID');
		$this->db->where($data);
		$run = $this->db->get();
		if($run->num_rows() > 0)
                {
                    $row = $run->rows();
                $results = "<thead>
                            <tr>
                            <th> Full Name</th>
                            <th> Phone Number</th>
                            <th>Email Address</th>
                            </tr>
                            </thead>
                            <tr><td>
                            <?php echo $row->firstname,' ',$row->lastname; ?></td>
                                <td><?php echo $row->phone;?></td>
                                <td><?php echo $row->email?></td>
                                </tr>";
                return $results;
                }
	}

	public function add_member_pledge($key)
	{
		$data = array(
			'memberID'=>$key,
			'pledgeID'=>$this->input->post('pledge'),
			'amount_paid'=>$this->input->post('amount')
		);
		$this->db->insert('pledge_payment',$data);
	}
	public function get_pledge($key)
	{
		$data = array(
			'pledgeID'=>$key
		);
		$pledge = $this->db->get_where('pledge',$data);
		return $pledge = $pledge->result();
	}
	public function get_pledgeName($key)
	{
		$data = array(
			'pledgeID'=>$key
		);
		$pledge = $this->db->get_where('pledge',$data);
		return $pledge->result();
		if($pledge->num_rows ==1)
		{
			$row = $pledge->row();
			
			return $row->purpose;
		}else{
			return false;
		}
	}
	public function search_pledge()
	{
		$pledge = $this->db->get('pledge');
		return $pledge->result();
	}
	public function pledge_payment($key,$id)
	{
		$data = array(
			'pledge.pledgeID' =>$id,
                        'memberID'=>$key
		);
		$pledge_payment = $this->db->select('pledge_payment.*,pledge.*,sum(pledge_payment.amount_paid) todate')->from('pledge_payment')->join('pledge','pledge_payment.pledgeID = pledge.pledgeID')->where($data)->get();
		return $pledge_payment->result();
	}
	public function pledge_details($key,$id)
	{    //$key = memberID
            //$id = pledgeID
		$data = array(
			'pledge.pledgeID' =>$id,
                        'memberID' => $key
		);
		$pledge_details = $this->db->select('pledge_details.*,pledge.*')->from('pledge_details')->join('pledge','pledge_details.pledgeID = pledge.pledgeID')->where($data)->get();
		return $pledge_details->result();
		
	}
	public function pledgeDetails($id)
	{    //$key = memberID
            //$id = pledgeID
		$data = array(
			'pledge.pledgeID' =>$id
		);
		$pledge_details = $this->db->select('pledge_details.*,pledge.*,members.*')->from('pledge_details')->join('pledge','pledge_details.pledgeID = pledge.pledgeID')->join('members','pledge_details.memberID=members.memberID')->where($data)->get();
		return $pledge_details->result();
		
	}
        public function pledgeTotal($key)
        {
            $data = array(
			'pledgeID' =>$key
		);
		$total = $this->db->query("Select CONCAT('$',FORMAT(SUM(`total_pledge`),2)) AS Pledge Total from pledge_details where pledgeID = $data");
                
                return $total;
		
        }
        public function member_pledge_total($key, $id)
        {    //$key = memberID
            //$id = pledgeID
		$data = array(
			'pledge.pledgeID' =>$id,
                        'memberID' => $key
		);
                $total = $this->db->select('sum(pledge_details.amount),pledge.*')->from('pledge_details')->join('pledge','pledge_details.pledgeID = pledge.pledgeID')->where($data)->get();
                return $total;
        }
	public function member_pledge_details($key)
	{ //$key = memberID
		$data = array(
			'members.memberID'=>$key
		);
		$pledge_details = $this->db->select('firstname, lastname')->distinct()->from('members')->join('pledge_details','pledge_details.memberID = members.memberID')->where($data)->get();
		return  $pledge_details->result();
               
	}
        public function member_pledge_payment($key,$id)
        {
            //$key = memberID
            //$id = pledgeID
            $data = array(
                'pledgeID'=>$id,
                'memberID'=>$key,
                'paymentDate'=>now(),
                'amount_paid'=>$this->input->post('amount')
            );
            $pay = $this->db->insert('pledge_payment',$data);
            if($pay)
            {
                return true;
            }else{
                return false;
            }
        }
	public function list_tithe_number()
	{
            
		$data = array(
			'tithe.memberID'=>$this->input->get('memberID'),
			'tithe.year'=>$this->input->get('year')
		);
		$list = $this->db->select('tithe.*,members.*')->from('tithe')->join('members','tithe.memberID=members.memberID')->where($data)->get();
                return $list->result();
                if($list->num_rows() > 0)
                {
                  return $list->result();
                    
                }else{
                    return false;
                }
                
	}
        public function tithe_month()
	{
		$data =array (
			'tithe.memberID' =>$this->input->get('membersID'),
			'tithe.year' => $this->input->get('years'),
                        'tithe.tithe_month'=>$this->input->get('months')
                      );
		$list = $this->db->select('tithe.*,members.*')->from('tithe')->join('members','tithe.memberID=members.memberID')->where($data)->get();
                return  $list->result();
                if($list ->num_rows() > 0)
                {
                    return  $list->result();
                }else{
                    return false;
                }
                
                
	}
	public function add_pledge_details($key,$id)
	{
		/**
		 * $key = MemberID 
		 * $id = PledgeID
		 */
		$data = array(
			'memberID'=>$id,
			'pledgeID'=>$key,
			'amount_pledge'=>$this->input->post('amount'),
			'created'=>now()
		);
		$add = $this->db->insert('pledge_details',$data);
		if($add)
		{
			return true;
		}else{
			return false;
		}
	}
	
	public function pledge_list($id)
	{
		$data = array(
			
		);
	}
	public function add_pledge()
	{
		$data = array(
			'date'=>$this->input->post('pledge_date'),
			'total_amount'=>$this->input->post('pledge_amount'),
                        'fulfil_date'=>$this->input->post('pledge_fdate'),
			'purpose'=>$this->input->post('pledge_reason'),
			'notes'=>$this->input->post('pledge_notes')
		);
		$add = $this->db->insert('pledge',$data);
		if($add)
		{
			return true;
		}else{
			return false;
		}
	}
	public function get_member_department($key)
	{
		$data = array(
			'memberID'=>$key
		);
		$query = $this->db->get_where('department_members',$data);
		return $query->result();
	}
	
	public function add_member_depart()
	{
		$data = array(
			'memberKey'=>$this->input->post('key'),
			'departmentID'=>$this->input->post('department')
		);
		$add = $this->db->insert('department_members',$data);
		if($add){
			return true;
		}else{
			return false;
		}
	}
	public function update_pledge($key)
	{
		$data = array(
			'pledgeID'=>$key
		);
		$data1 = array(
			'date'=>$this->input->post('pledge_date'),
			'total_amount'=>$this->input->post('pledge_amount'),
			'purpose'=>$this->input->post('pledge_reason'),
			'notes'=>$this->input->post('pledge_notes')
		);
		$this->db->where($data);
		$update =$this->db->update('pledge',$data1);
		if($update)
		{
			return true;
		}else{
			return false;
		}
	}
	public function search_tithe_name()
	{
		$data = array(
			'firstname'=>$this->input->post('firstname'),
			'lastname'=>$this->input->post('lastname')
		);
		$run = $this->db->get_where('members',$data);
		return $run->result();
		if($run->num_rows > 0)
		{
			$row = $run->row;
			$row->firstname;
			$row->lastname;
			$row->phone;
			$row->memberID;
		}else{
			return false;
		}
	}
	public function search_member_name()
	{
		$data = array(
			'firstname'=>$this->input->post('firstname'),
			'lastname'=>$this->input->post('lastname')
		);
		$run = $this->db->get_where('members',$data);
		return $run->result();
		if($run->num_rows == 1)
		{
                    $row = $run->row;
			$row->firstname;
			$row->lastname;
			$row->phone;
			$row->email;
			$row->address;
			$row->address1;
			$row->city;
			$row->state;
			$row->zip;
			$row->memberID;
		}else{
			return false;
		}
	}
        public function search_tithe_number()
        {
            $data = array(
                'memberID'=>$this->input->post('titheID')
            );
            $run = $this->db->get_where('members',$data);
            return $run->result();
        }


	public function search_member_number()
	{
		$data = array(
			'memberID'=>$this->input->post('churchnumber')
		);
		$run = $this->db->get_where('members',$data);
		return $run = $run->result();
		if($run->num_rows == 1)
		{
			$row = $run->row;
			$row->firstname;
			$row->lastname;
			$row->phone;
			$row->email;
			$row->address;
			$row->address1;
			$row->city;
			$row->state;
			$row->zip;
			$row->memberKey;
		}else{
   		$data['title'] = 'Search Member - Asore Management System ::Pentecost International Worship Center::';
   		$data['member'] = $this->central_model->search_member_number();
        $this->load->view('header',$data);
        $data['message']= 'No Record';
    	$this->load->view('search_member',$data);
    	$this->load->view('member_profile',$data);
    	$this->load->view('footer');
		}
	}
	public function delete_member($key)
	{
		$data = array(
			'memberID'=>$key
		);
		$delete = $this->db->delete('members',$data);
		if($delete)
		{
			return true;
		}else{
			return false;
		}
	}
	public function add_members_pledge($key)
	{
		$data = array(
			'amount_pledge'=>$this->input->post('member_amount'),
			'pledgeID'=>$key,
			'memberID'=>$this->input->post('memberID'),
			'created'=>now()
		);
		$add = $this->db->insert('pledge_details',$data);
		if($add)
		{
			return true;
		}else{
			return false;
		}
	}
	public function add_tithe()
	{
		$data = array(
			'memberID'=>$this->input->post('titheID'),
			'amount'=>$this->input->post('tithe_amount'),
			'type'=>$this->input->post('type_tithe'),
			'date'=>$this->input->post('tithe_date'),
                        'tithe_month'=>$this->input->post('tithe_month'),
			'year'=>date("Y")
		);
		$add = $this->db->insert('tithe',$data);
		if($add)
		{
	        $data['message']= '<b id="error">Member\'s tithe information has been saved</b>';
                $data['title'] = 'Tithes and Offerings - LampStand:';
                $this->load->view('head',$data);
	        $this->load->view('add_tithe',$data);

		}else{
			$data['title'] = 'Tithes and Offerings - Asore Management System ::Pentecost International Worship Center::';
	   		$data['name_tithe'] = $this->central_model->search_tithe_name();
	        $this->load->view('header',$data);
	        $data['message']= '<id="error">Member\'s tithe information was not saved...please try again later..</div>';
	    	$this->load->view('tithe',$data);
	    	$this->load->view('add_tithe',$data);
	    	$this->load->view('footer');
		}
	}
	
	
}