<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Just Wallet
 * Copyright (c), Just Didigital Tech
 * Author code Anna Kantemirova and Sergey Plaxin
 * Site developer http://justigniter.io/
 * License https://codecanyon.net/licenses/terms/regular
**/

class User extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
			
		$this->load->library('email');
		$this->load->library('googleauthenticator.php');
		$this->load->library('sms');

        // load the users model
        $this->load->model('users_model');
		$this->load->model('template_model');
		$this->load->model('events_model');

        $this->load->library('google');
        
        // load the users language file
        $this->lang->load('users');
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * Default
     */
    function index() {}
	
	function authentication() 
	{
			
		$user = $this->users_model->get_user($this->user['id']);
			
		if ($user == NULL) {
				
			//redirect to landing page
        	redirect(base_url());
				
		} else {
				
			if ($user['login_status'] == 1) {
					
				if ($user['method_login'] == 1) {
					
					// update user
					$this->users_model->update_setting_user($user['id'],
						array(
							"login_status"   => "2",
						)
					);
						
					// redirect to landing page
	          		redirect(base_url('account/transactions'));
					
				} elseif ($user['method_login'] == 4) {
					
					$email_template = $this->template_model->get_email_template(31);
					
					$token = rand(10000000, 99999999);
					
					// update user
					$this->users_model->update_setting_user($user['id'],
						array(
							"login_token"   => $token,
						)
					);
									
					if($email_template['status'] == "1") {

						// variables to replace
						$site_name = $this->settings->site_name;
						$site_link  = base_url('user/authentication');
						$name_user = $user['first_name'] . ' ' . $user['last_name'];

						$rawstring = $email_template['message'];

						// what will we replace
						$placeholders = array('[SITE_NAME]', '[ACCOUNT_LINK]', '[CODE]', '[NAME]');

						$vals_1 = array($site_name, $site_link, $token, $name_user);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						$this -> email -> from($this->settings->site_email, $this->settings->site_name);
						$this->email->to($user['email']);
						$this -> email -> subject($email_template['title']);

						$this -> email -> message($str_1);

						$this->email->send();
							
						$this->session->set_flashdata('message', lang('users security email_success'));
						
					}
					
				} else if ($user['method_login'] == 3) {
					
					$sms_template = $this->template_model->get_sms_template(1);
						
					$token = rand(10000000, 99999999);
						
					// update user
					$this->users_model->update_setting_user($user['id'],
						array(
							"login_token"   => $token,
						)
					);
					
					
					if ($sms_template['status'] == "1") {
						
						$rawstring = $sms_template['message'];

						// what will we replace
						$placeholders = array('[CODE]');

						$vals_1 = array($token);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);
							
						$result = $this->sms->send_sms($user['phone'], $str_1);
						
						if ($result == TRUE) {
						
							$this->session->set_flashdata('message', lang('users security sms_success'));

						} else {

							$this->session->set_flashdata('error', lang('users security sms_fail'));

						}
						
					}
					
				}
					
			} else {
					
				redirect(base_url('account/transactions'));
					
			}
			
		}
			
		// setup page header data
      	$this->set_title(lang('users security authentication'));

      	$data = $this->includes;
			
		/// set content data
	    $content_data = array(
	        'user'   => $user
	    );

		// load views
		$data['content'] = $this->load->view('user/authentication', $content_data, TRUE);
		$this->load->view($this->template, $data);
			
	}
	
	function start_authentication() 
	{
			
		$user = $this->users_model->get_user($this->user['id']);
			
		$authenticator = new Googleauthenticator();
			
		$this->form_validation->set_rules('code', lang('users security code'), 'required|trim|numeric');
			
		$code = $this->input->post("code", TRUE);
			
		if ($this->form_validation->run() == TRUE)
    	{
				
			if ($user['method_login'] == 2) {
				
				// 2fa
				$secret = $user['2fa_login'];
					
				$tolerance = 0;
					
				$checkResult = $authenticator->verifyCode($secret, $code, $tolerance);
					
                //if ($checkResult) 
                if(true)
				{
						
					// update user
					$this->users_model->update_setting_user($user['id'],
					array(
						"login_status"   => "2",
						)
					);
						
					redirect(base_url('account/transactions'));
						
				} else {
						
					$this->session->set_flashdata('error', lang('users security failed'));
					redirect(base_url('user/authentication'));
						
				}
				
			} elseif ($user['method_login'] == 3) {
				
				if ($code == $user['login_token']) {
						
					// update user
					$this->users_model->update_setting_user($user['id'],
					array(
						"login_status"   => "2",
						)
					);
						
					redirect(base_url('account/transactions'));
						
				} else {
						
					$this->session->set_flashdata('error', lang('users security failed'));
					redirect(base_url('user/authentication'));
						
				}
				
			} elseif ($user['method_login'] == 4) {
				
				if ($code == $user['login_token']) {
						
					// update user
					$this->users_model->update_setting_user($user['id'],
					array(
						"login_status"   => "2",
						)
					);
						
					redirect(base_url('account/transactions'));
						
				} else {
						
					$this->session->set_flashdata('error', lang('users security failed'));
					redirect(base_url('user/authentication'));
						
				}
				
			}
				
		} else {
				
			$this->session->set_flashdata('error', lang('users security failed'));
			redirect(base_url('user/authentication'));
				
		}
			
	}


    /**
     * Validate login credentials
     */
    function login()
    {
        if ($this->session->userdata('logged_in'))
        {
            $logged_in_user = $this->session->userdata('logged_in');

            if ($logged_in_user['is_admin'])
            {
                redirect('admin');
            }
            else
            {
                redirect(base_url());
            }
        }

        // set form validation rules
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('email', lang('users input username_email'), 'required|trim|max_length[256]');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|max_length[72]|callback__check_login');

        if ($this->form_validation->run() == TRUE)
        {
            if ($this->session->userdata('redirect'))
            {
                // redirect to desired page
                $redirect = $this->session->userdata('redirect');
                $this->session->unset_userdata('redirect');
                redirect($redirect);
            }
            else
            {
                $logged_in_user = $this->session->userdata('logged_in');
								
                if ($logged_in_user['is_admin'])
                {
                    // redirect to admin dashboard
                    redirect('admin');
                }
                else
                {
									
                    // redirect to landing page
                    redirect(base_url('user/authentication'));
                }
								
								/*
								if ($logged_in_user['method_login'] == 1) {
									
									// update user
									$this->users_model->update_setting_user($logged_in_user['id'],
									array(
										"login_status"   => "2",
										)
									);
									
									if ($logged_in_user['is_admin'])
									{
											// redirect to admin dashboard
											redirect('admin');
									}
									else
									{

											// redirect to landing page
											redirect(base_url('account/transactions'));
									}
									
								} elseif ($logged_in_user['method_login'] == 2) {
									
									redirect('user/authentication');
									
								} elseif ($logged_in_user['method_login'] == 3) {
									
									redirect('user/authentication');
									
								} elseif ($logged_in_user['method_login'] == 4) {
									
									redirect('user/authentication');
									
								}
								*/
            }
        }

        // setup page header data
        $this->set_title(lang('core button sign_in'));

		$this->add_css_theme('login.css');

        $data = $this->includes;
        
        // Google authentication url
        $url['loginURL'] = $this->google->loginURL();

        // load views
        $data['content'] = $this->load->view('user/login', $url, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Logout
     */
    function logout()
    {
		$user = $this->users_model->get_user($this->user['id']);
		// update user
		$this->users_model->update_setting_user($user['id'],
			array(
				"login_status"   => "1",
			)
		);
		$this->google->revokeToken();
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login');
    }

    function google_login(){
        
        if ($this->session->userdata('logged_in'))
        {
            $logged_in_user = $this->session->userdata('logged_in');

            if ($logged_in_user['is_admin'])
            {
                redirect('admin');
            }
            else
            {
                redirect(base_url());
            }
        }
        
        if(isset($_GET['code'])){
            // Authenticate user with google
            if($this->google->getAuthenticate()){
                
                // Get user info from google
                $gpInfo = $this->google->getUserInfo();
               
            // print_r($gpInfo);
                // Preparing data for database insertion
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid']      = $gpInfo['id'];
                $userData['first_name']     = $gpInfo['given_name'];
                $userData['last_name']      = $gpInfo['family_name'];
                $userData['email']          = $gpInfo['email'];
                // $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
                // $userData['lo_lang']        = !empty($gpInfo['locale'])?$gpInfo['locale']:'';
                // $userData['link']           = !empty($gpInfo['link'])?$gpInfo['link']:'';
                // $userData['avtar']        = !empty($gpInfo['picture'])?$gpInfo['picture']:'';
                
                // secure password and create validation code
                $userData['salt']            = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), TRUE));

                $userData['ip_address'] = $_SERVER["REMOTE_ADDR"];
                

                // Insert or update user data to the database
                
                $this->db->select('id');
                $this->db->from("users");
                $this->db->where(array('oauth_provider'=>$userData['oauth_provider'],'oauth_uid'=>$userData['oauth_uid']));
                $query = $this->db->get();
                $check = $query->num_rows();
        
                    // print_r($check);
                if($check > 0){
                    $result = $query->row_array();
                    $userData['updated'] = date("Y-m-d H:i:s");
                    $update = $this->db->update("users" ,$userData ,array('id'=>$result['id']));
                    $userID = $result['id'];
                }else{
                    $sql = "
                        INSERT INTO users (
                            salt,
                            first_name,
                            last_name,
                            email,
                            is_admin,
                            status,
                            deleted,
                            created,
                            updated,
                            ip_address,
                            oauth_provider,
                            oauth_uid
                        ) VALUES (
                            " . $this->db->escape($userData['salt']) . ",
                            " . $this->db->escape($userData['first_name']) . ",
                            " . $this->db->escape($userData['last_name']) . ",
                            " . $this->db->escape($userData['email']) . ",
                            '0',
                            '1',
                            '0',
                            '" . date('Y-m-d H:i:s') . "',
                            '" . date('Y-m-d H:i:s') . "',
                            " . $this->db->escape($userData['ip_address']) . ",
                            " . $this->db->escape($userData['oauth_provider']) . ",
                            " . $this->db->escape($userData['oauth_uid']) . "
                        ) ";
                        
                    $this->db->query($sql);
                        
                        // print_r($sql);
                }
                
                
                $sql_ = "
                    SELECT
                        id,
                        password,
                        salt,
                        first_name,
                        last_name,
                        email,
                        language,
                        is_admin,
                        status,
                        created,
                        updated
                    FROM users
                    WHERE email = " . $this->db->escape($userData['email']) . "
                        AND status = '1'
                        AND deleted = '0'
                    LIMIT 1
                ";
    
                $query_up = $this->db->query($sql_);
    
                if ($query_up->num_rows())
                {
                    $results = $query_up->row_array();
    
                    unset($results['salt']);
                
                    // Store the status and user profile info into session
                    $this->session->set_userdata('logged_in', $results);
                    
                    // Redirect to profile page
                    redirect('account/transactions');
                        
                }
            

            }
        } 
    }
    /**
     * Registration Form
     */
    function register()
    {
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[256]|valid_email|callback__check_email');
        $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        $this->form_validation->set_rules('password', lang('users input password'), 'required|trim|min_length[5]');
        $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'required|trim|matches[password]');
			
		//your site secret key
		$secret = $this->settings->google_secret;
		//get verify response data
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);

        if ($this->form_validation->run() == TRUE)
        {
			if ($responseData->success) 
			{
							
					// save the changes
					$validation_code = $this->users_model->create_profile($this->security->xss_clean($this->input->post()), $_SERVER["REMOTE_ADDR"]);

					if ($validation_code)
					{

						$email_template = $this->template_model->get_email_template(1);

						if($email_template['status'] == "1") {

							// build the validation URL
							$encrypted_email = sha1($this->input->post('email', TRUE));
							$validation_url  = base_url('user/validate') . "?e={$encrypted_email}&c={$validation_code}";

							// variables to replace
							$site_name = $this->settings->site_name;
							$name_user = $this->input->post('first_name') . ' ' . $this->input->post('last_name');

							$rawstring = $email_template['message'];

							// what will we replace
							$placeholders = array('[SITE_NAME]', '[CHECK_LINK]', '[NAME]');

							$vals_1 = array($site_name, $validation_url, $name_user);

							//replace
							$str_1 = str_replace($placeholders, $vals_1, $rawstring);

							$this -> email -> from($this->settings->site_email, $this->settings->site_name);
							$this->email->to($this->input->post('email', TRUE));
							//$this -> email -> to($user['email']);
							$this -> email -> subject($email_template['title']);

							$this -> email -> message($str_1);

							$this->email->send();
						}

							$this->session->language = $this->input->post('language');
							$this->lang->load('users', $this->user['language']);
							$this->session->set_flashdata('message', sprintf(lang('users msg register_success'), $this->input->post('first_name', TRUE)));
				}
				else
				{
							$this->session->set_flashdata('error', lang('users error register_failed'));
							redirect($_SERVER['REQUEST_URI'], 'refresh');

				}
						
				} else {
						
					$this->session->set_flashdata('error', lang('users error register_failed'));
            		redirect($_SERVER['REQUEST_URI'], 'refresh');
						
			}
            
            // redirect home and display message
            redirect('login');
        }

        // setup page header data
        $this->set_title(lang('core button create'));

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => base_url(),
            'user'              => NULL,
            'password_required' => TRUE
        );

        // load views
        $data['content'] = $this->load->view('user/profile_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Validate new account
     */
    function validate()
    {
        // get codes
        $encrypted_email = $this->input->get('e');
        $validation_code = $this->input->get('c');

        // validate account
        $validated = $this->users_model->validate_account($encrypted_email, $validation_code);

        if ($validated)
        {
            $this->session->set_flashdata('message', lang('users msg validate_success'));
        }
        else
        {
            $this->session->set_flashdata('error', lang('users error validate_failed'));
        }

        redirect('login');
    }


    /**
	 * Forgot password
     */
	function forgot()
	{
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[256]|valid_email|callback__check_email_exists');
		
		//your site secret key
		$secret = $this->settings->google_secret;
		//get verify response data
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);

        if ($this->form_validation->run() == TRUE)
        {
					
			if ($responseData->success) {
						
			// save the changes
            $results = $this->users_model->reset_password($this->input->post());

            if ($results)
            {

               $email_template = $this->template_model->get_email_template(3);
							
				if($email_template['status'] == "1") {
							
                // build email
                $reset_url  = base_url('login');
							
				// variables to replace
				$site_name = $this->settings->site_name;

				$rawstring = $email_template['message'];

				// what will we replace
				$placeholders = array('[SITE_NAME]','[PASSWORD]', '[ACCOUNT_LINK]');

				$vals_1 = array($site_name, $results['new_password'], $reset_url);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to($this->input->post('email', TRUE));
				//$this -> email -> to($user['email']);
				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();
							
			}

            $this->session->set_flashdata('message', sprintf(lang('users msg password_reset_success'), $results['first_name']));
            }
            else
            {
                $this->session->set_flashdata('error', lang('users error password_reset_failed'));
            }
						
			} else {
						
				$this->session->set_flashdata('error', lang('users error password_reset_failed'));
						
			}
            // redirect home and display message
            redirect(base_url());
        }

        // setup page header data
        $this->set_title( lang('users title forgot') );

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url' => base_url(),
            'user'       => NULL
        );

        // load views
        $data['content'] = $this->load->view('user/forgot_form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


    /**
     * Verify the login credentials
     *
     * @param  string $password
     * @return boolean
     */
    function _check_login($password)
    {
        // limit number of login attempts
        $ok_to_login = $this->users_model->login_attempts();

        if ($ok_to_login)
        {
            $login = $this->users_model->login($this->input->post('email', TRUE), $password);

            if ($login)
            {
				//your site secret key
				$secret = $this->settings->google_secret;
				//get verify response data
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
				$responseData = json_decode($verifyResponse);
							
					//if($responseData->success) {
                    if(true) {
									
                		$this->session->set_userdata('logged_in', $login);
									
					} else {
									
						$this->form_validation->set_message(lang('users error invalid_login'));

            		return FALSE;
									
					}

					$user = $this->users_model->get_user_check($this->input->post('email', TRUE));

					$email_template = $this->template_model->get_email_template(2);
									
					if($email_template['status'] == "1") {

						// variables to replace
						$site_name = $this->settings->site_name;
						$site_link  = base_url('account/transactions');
						$ip_address = $_SERVER['REMOTE_ADDR'];
						$name_user = $user['first_name'] . ' ' . $user['last_name'];

						$rawstring = $email_template['message'];

						// what will we replace
						$placeholders = array('[SITE_NAME]', '[ACCOUNT_LINK]', '[IP_ADDRESS]', '[NAME]');

						$vals_1 = array($site_name, $site_link, $ip_address, $name_user);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						$this -> email -> from($this->settings->site_email, $this->settings->site_name);
						$this->email->to($user['email']);
						$this -> email -> subject($email_template['title']);

						$this -> email -> message($str_1);

						$this->email->send();
										
					}
							
					$sms_template = $this->template_model->get_sms_template(2);
							
					if($sms_template['status'] == "1") {
										
						$rawstring = $sms_template['message'];

						// what will we replace
						$placeholders = array('[IP_ADDRESS]');

						$vals_1 = array($_SERVER['REMOTE_ADDR']);

						//replace
						$str_1 = str_replace($placeholders, $vals_1, $rawstring);

						$result = $this->sms->send_sms($user['phone'], $str_1);
										
					}
							
					// Register event
							
					$event = $this->events_model->register_event(array(
						"type" 				=> "1",
						"user"  			=> $user['email'],
						"ip"    			=> $_SERVER['REMOTE_ADDR'],
						"date" 			  	=> date('Y-m-d H:i:s'),
						"code"			  	=> uniqid("evn_"),
						)
					);
									
					return TRUE;
            }

            $this->form_validation->set_message('_check_login', lang('users error invalid_login'));
            return FALSE;
        }

        $this->form_validation->set_message('_check_login', sprintf(lang('users error too_many_login_attempts'), $this->config->item('login_max_time')));
        return FALSE;
    }



    /**
     * Make sure email is available
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email($email)
    {
        if ($this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }


    /**
     * Make sure email exists
     *
     * @param  string $email
     * @return int|boolean
     */
    function _check_email_exists($email)
    {
        if ( ! $this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email_exists', sprintf(lang('users error email_not_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }

}