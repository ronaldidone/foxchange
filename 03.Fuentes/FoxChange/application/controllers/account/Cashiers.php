<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cashiers extends Private_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('users');

        // load the users model
        $this->load->model('users_model');
				$this->load->model('transactions_model');
				$this->load->model('disputes_model');
				$this->load->model('cashiers_model');
				$this->load->library('fixer');
			

				// set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('account/cashiers'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "id");
        define('DEFAULT_DIR', "desc");
			
				// use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }
    }
  
     /**
	 * Default
     */

	function index()
	{ 


		$user = $this->users_model->get_user($this->user['id']);
		
		// get parameters
    $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
    $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
    $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
    $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;
		
		// get filters
    $filters = array();
			
		if ($this->input->get('id', TRUE))
    {
      $id_xss = $this->security->xss_clean($this->input->get('id'));
			$id_string = htmlentities($id_xss, ENT_QUOTES, "UTF-8");
			$filters['id'] = $id_string;
    }
		
		if ($this->input->get('time'))
    {
      $time_xss = $this->security->xss_clean($this->input->get('time'));
			$time_string = htmlentities($time_xss, ENT_QUOTES, "UTF-8");
			$filters['time'] = $time_string;
    }
		
		if ($this->input->get('sender'))
    {
      $sender_xss = $this->security->xss_clean($this->input->get('sender'));
			$sender_string = htmlentities($sender_xss, ENT_QUOTES, "UTF-8");
			$filters['sender'] = $sender_string;
    }
		
		if ($this->input->get('receiver'))
    {
      $receiver_xss = $this->security->xss_clean($this->input->get('receiver'));
			$receiver_string = htmlentities($receiver_xss, ENT_QUOTES, "UTF-8");
			$filters['receiver'] = $receiver_string;
    }
		
		if ($this->input->get('sum'))
    {
      $sum_xss = $this->security->xss_clean($this->input->get('sum'));
			$sum_string = htmlentities($sum_xss, ENT_QUOTES, "UTF-8");
			$filters['sum'] = $sum_string;
    }
		
		if ($this->input->get('user_comment'))
    {
      $user_comment_xss = $this->security->xss_clean($this->input->get('user_comment'));
			$user_comment_string = htmlentities($user_comment_xss, ENT_QUOTES, "UTF-8");
			$filters['user_comment'] = $user_comment_string;
    }
		// build filter string
    $filter = "";
    foreach ($filters as $key => $value)
    {
       $filter .= "&{$key}={$value}";
    }
		
		// are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            } else {

                // apply the filter(s)
                $filter = "";

                if ($this->input->post('id'))
                {
                    $filter .= "&id=" . $this->input->post('id', TRUE);
                }
								if ($this->input->post('time'))
                {
                    $filter .= "&time=" . $this->input->post('time', TRUE);
                }
							
								if ($this->input->post('sender'))
                {
                    $filter .= "&sender=" . $this->input->post('sender', TRUE);
                }
							
								if ($this->input->post('receiver'))
                {
                    $filter .= "&receiver=" . $this->input->post('receiver', TRUE);
                }
							
								if ($this->input->post('sum'))
                {
                    $filter .= "&sum=" . $this->input->post('sum', TRUE);
                }
							
								if ($this->input->post('user_comment'))
                {
                    $filter .= "&user_comment=" . $this->input->post('user_comment', TRUE);
                }
                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }

			//$history = $this->transactions_model->get_all($limit, $offset, $filters, $sort, $dir, $user['email']);
			$history = $this->cashiers_model->get_all_transaction($limit, $offset, $filters, $sort, $dir, $user['id']);			

		}
     // setup page header data
	 $this->set_title(sprintf(lang('users title history'), $this->settings->site_name));
		// reload the new user data and store in session

    $data = $this->includes;
					
		$history = $this->cashiers_model->get_all_transaction($limit, $offset, $filters, $sort, $dir, $user['id']);
					
		// build pagination
		$this->pagination->initialize(array(
			'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			'total_rows' => $history['total'],
			'per_page'   => $limit
		));
			
		// set content data
        $content_data = array(
			'user'       => $user,
			'email'   => $email,
            'this_url'   => THIS_URL,
            'history'    => $history['results'],
            'total'      => $history['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );


        // load views
        $data['content'] = $this->load->view('account/cashiers/index', $content_data, TRUE);
		$this->load->view($this->template, $data);
	}

	
	
	/**
    * Detail transaction
    */
	function detail($id = NULL)
    {
		$user = $this->users_model->get_user($this->user['id']);

		
			
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
		}		

        // get the data
		$transactions = $this->transactions_model->get_detail_transactions_cashier($id);
		
		
		// get transaction chat
		$transaction_chat = $this->cashiers_model->get_chat_transaccion($id);
		
	

        if ( ! $transactions)
        {
            redirect($this->_redirect_url);
        }
			
			//Check dispute history
			$dispute_history = $this->disputes_model->get_history_dispute($id);
			if ( $dispute_history)
			{
				$dispute_mode = "0"; // no start dispute
			} else {
				$dispute_mode = "1"; // yes start dispute
			}
			
		// setup page header data
		$this->add_js_theme('cashiers.js', TRUE );	
        $this->set_title( lang('users title history') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   		=> THIS_URL,
			'user'              => $user,
			'dispute_mode'      => $dispute_mode,
            'cancel_url'        => $this->_redirect_url,
            'transactions'      => $transactions,
			'transactions_id'   => $id,
			'transaction_chat'	=> $transaction_chat
        );

        // load views
        $data['content'] = $this->load->view('account/cashiers/detail', $content_data, TRUE);
        $this->load->view($this->template, $data);
	}
	
	/**
    * Detail transaction
    */
	function chat($id = NULL)
    {
		$user = $this->users_model->get_user($this->user['id']);
		

		
			
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
		}		

        // get the data
		$transactions = $this->transactions_model->get_detail_transactions_cashier($id);
		
		
		// get transaction chat
		$transaction_chat = $this->cashiers_model->get_chat_transaccion($id);
		
		
	

        if ( ! $transactions)
        {
            redirect($this->_redirect_url);
        }
			
			//Check dispute history
			$dispute_history = $this->disputes_model->get_history_dispute($id);
			if ( $dispute_history)
			{
				$dispute_mode = "0"; // no start dispute
			} else {
				$dispute_mode = "1"; // yes start dispute
			}
			
		// setup page header data
		$this->add_js_theme('cashiers.js', TRUE );	
        $this->set_title( lang('users title history') );

        $data = $this->includes;

        // set content data
        $content_data = array(
			'this_url'   		=> THIS_URL,
			'user'              => $user,
			'dispute_mode'      => $dispute_mode,
            'cancel_url'        => $this->_redirect_url,
            'transactions'      => $transactions,
			'transactions_id'   => $id,
			'transaction_chat'	=> $transaction_chat
        );

        // load views
        $data['content'] = $this->load->view('account/cashiers/chat', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
	
	/**
     * Start confirm protect transaction
   */
	
	function protect_confirm()
	{
		
		$user = $this->users_model->get_user($this->user['id']);
		
		$this->form_validation->set_rules('code_protect', lang('users transfer code_protect'), 'required|trim|numeric|max_length[4]|min_length[4]');
		$this->form_validation->set_rules('id', lang('users col user_id'), 'required|trim|numeric|min_length[1]');
		
		if ($this->form_validation->run() == TRUE) {
			
			$id = $this->input->post("id", TRUE);
			
			$transactions = $this->transactions_model->get_transactions($id);
			
			$check_start_user = $this->users_model->get_email($transactions['receiver']);
		
			$sender_transfer = $this->users_model->get_email($transactions['sender']);

			$wallet = $transactions['currency'];
			
			$code_protect = $this->input->post("code_protect", TRUE);
			
			if ($user['email'] == $check_start_user['email']) {
				
				// check protect
				if ($transactions['protect'] != "none") {
			
					// check status
					if ($transactions['status'] == 1) {

						if ($code_protect == $transactions['protect']) {

							// Calculation of the amount to be credited to receiver
							$transfer = $user[$wallet]+$transactions['amount'];

							// update transaction history
							$this->transactions_model->update_dispute_transactions($transactions['id'],
								array(
									"status"   	 => "2",
								)
							);

							// update wallet sender
							$this->users_model->update_user($transactions['receiver'],
								array(
									$transactions['currency']  => $transfer,
									)
							);

							$this->session->set_flashdata('message', lang('users transfer success'));
							redirect(site_url("account/transactions"));

						} else {
							
							// add attempt
							$attempt = $transactions['protect_attempts'] + "1";
							
							// update transaction history
							$this->transactions_model->update_dispute_transactions($transactions['id'],
								array(
									"protect_attempts"   => $attempt,
								)
							);
							
							$transactions = $this->transactions_model->get_transactions($id);
							
							if($transactions['protect_attempts'] >= 3) {
								
								// update wallet sender
								$this->users_model->update_user($transactions['receiver'],
									array(
										"fraud"  => "1",
									)
								);
								
								// update transaction history
								$this->transactions_model->update_dispute_transactions($transactions['id'],
									array(
										"status"   	 => "3",
									)
								);
								
								// Calculation of the amount to be credited to sender
								$return = $sender_transfer[$wallet]+$transactions['sum'];
								
								// update wallet sender
								$this->users_model->update_user($transactions['sender'],
									array(
										$transactions['currency']  => $return,
									)
								);
								
							}

							$this->session->set_flashdata('error', lang('users error invalid_form'));
							redirect(site_url("account/transactions"));

						}

					} else {

						$this->session->set_flashdata('error', lang('users error invalid_form'));
						redirect(site_url("account/transactions"));

					}

				} else {

					$this->session->set_flashdata('error', lang('users error invalid_form'));
					redirect(site_url("account/transactions"));

				}
				
			} else {
				
				$this->session->set_flashdata('error', lang('users error invalid_form'));
				redirect(site_url("account/transactions"));
				
			}
			
		} else {
			
			$this->session->set_flashdata('error', lang('users error invalid_form'));
			redirect(site_url("account/transactions"));
			
		}
		
	}
	
	
	/**
     * Start refund protect transaction
   */
	function protect_refund($id)
	{
		// make sure we have a numeric id
    if (is_null($id) OR ! is_numeric($id))
    {
    	redirect(site_url("account/transactions"));
    }
		
		// get the data
    $transactions = $this->transactions_model->get_transactions($id);
		
		$user = $this->users_model->get_user($this->user['id']);
		
		$check_start_user = $this->users_model->get_email($transactions['receiver']);
		
		$sender_transfer = $this->users_model->get_email($transactions['sender']);
		
		$wallet = $transactions['currency'];
		
		// check status
		if ($transactions['status'] == 1) {
		
			// check protect
			if ($transactions['protect'] != "none") {

				// Calculation of the amount to be credited to sender
				$return = $sender_transfer[$wallet]+$transactions['sum'];

				if ($user['email'] == $check_start_user['email']) {

					// update transaction history
					$this->transactions_model->update_dispute_transactions($transactions['id'],
						array(
							"status"   	 => "3",
						)
					);

					// update wallet sender
					$this->users_model->update_user($transactions['sender'],
						array(
							$transactions['currency']  => $return,
							)
						);

					$this->session->set_flashdata('message', lang('users refund success'));
					redirect(site_url("account/transactions"));

				} else {

					$this->session->set_flashdata('error', lang('users error invalid_form'));
					redirect(site_url("account/transactions"));

				}

			} else {

				$this->session->set_flashdata('error', lang('users error invalid_form'));
				redirect(site_url("account/transactions"));

			}
			
		} else {
			
			$this->session->set_flashdata('error', lang('users error invalid_form'));
			redirect(site_url("account/transactions"));
			
		}
		
	}

	//-->Get transaction chat messages
	function get_transaccion_chat($id_transaccion){
		// get transaction chat
		$transaction_chat = $this->cashiers_model->get_chat_transaccion($id_transaccion);

		// set content data
        $content_data = array(
			'chat_mensajes'   	=> $transaction_chat,
			'transactions_id'   => $id_transaccion,
			'user_id'			=> $this->user['id']
        );

        // load views
        $data['content'] = $this->load->view('account/cashiers/chat', $content_data, TRUE);
        $this->load->view($this->template, $data);
	}

	//-->Get transaction chat messages
	function register_chat_message(){
		exit("Ingresa al metodo");

		$id_transaccion = $this->input->post("id_trans", TRUE);
		$msg			= $this->input->post("msgtrans", TRUE);
		$id_user=$this->user['id'];
		// register message
		$register_message = $this->cashiers_model->register_chat_message($id_transaccion, $id_user, $msg);

		// get transaction chat
		$transaction_chat = $this->cashiers_model->get_chat_transaccion($id_transaccion);

		// set content data
        $content_data = array(
			'chat_mensajes'   	=> $transaction_chat,
			'transactions_id'   => $id_transaccion,
			'user_id'			=> $this->user['id']
        );

        // load views
        $data['content'] = $this->load->view('account/cashiers/chat', $content_data, TRUE);
        $this->load->view($this->template, $data);
	}


function ok_deposit($id = NULL)
  {


	//echo($user['email']);exit();

		// make sure we have a numeric id
     if (is_null($id) OR ! is_numeric($id))
     {
     	redirect($this->_redirect_url);
     }

     // get the data
     $transactions = $this->transactions_model->get_transactions($id);
       
     // if empty results, return to list
     if ( ! $transactions)
     {
     	redirect($this->_redirect_url);
     }
		
		if ($transactions['status'] == 1 && ($transactions['type'] == 1 or $transactions['type']) == 2) {
			
			$user = $this->users_model->get_email($transactions['receiver']);
			
			$wallet = $transactions['currency'];
			$amount = $transactions['amount'];
			
			// Calculation of the amount to be credited to the claimant 
			$return = $user[$wallet]+$amount;
		
			// update claimant wallet
			$this->users_model->update_user($transactions['receiver'],
				array(
					$transactions['currency']  => $return,
				)
			);
			
			// update transaction history
			$this->transactions_model->update_btc_transactions($transactions['id'],
				array(
					"status"   => "2",
				)
			);
			
			//change today
			$user = $this->users_model->get_user($this->user['id']);
			$debit_base=$user['debit_base'];
			$temp= $debit_base+$amount*(-1);
			$this->users_model->update_user($user['email'],
				array(
					$transactions['currency']  => $temp,
				)
			);

			$email_template = $this->template_model->get_email_template(32);
				
			if($email_template['status'] == "1") {
			    
			            $currency = $transactions['currency'];
						
						// Check currency
						if ($currency == "debit_base") {
							$symbol = $this->currencys->display->base_code;
						} elseif ($currency == "debit_extra1") {
							$symbol = $this->currencys->display->extra1_code;
						} elseif ($currency == "debit_extra2") {
							$symbol = $this->currencys->display->extra2_code;
						} elseif ($currency == "debit_extra3") {
							$symbol = $this->currencys->display->extra3_code;
						} elseif ($currency =="debit_extra4") {
							$symbol = $this->currencys->display->extra4_code;
						} elseif ($currency =="debit_extra5") {
							$symbol = $this->currencys->display->extra5_code;
						}
			
				// variables to replace
				$site_name = $this->settings->site_name;
				$link = site_url('account/transactions');
				$name_user = $user['first_name'] . ' ' . $user['last_name'];
				$amount = $transactions['amount'];
				$sender = $transactions['sender'];
				$rawstring = $email_template['message'];

				// what will we replace
			     $placeholders = array('[SITE_NAME]', '[SITE_LINK]', '[NAME]', '[AMOUNT]', '[CUR]', '[SENDER]');

				$vals_1 = array($site_name, $link, $name_user, $amount, $symbol, $sender);

				//replace
				$str_1 = str_replace($placeholders, $vals_1, $rawstring);

				$this -> email -> from($this->settings->site_email, $this->settings->site_name);
				$this->email->to($user['email']);
				//$this -> email -> to($user['email']);
				$this -> email -> subject($email_template['title']);

				$this -> email -> message($str_1);

				$this->email->send();
			
			}
			
			$this->session->set_flashdata('message', lang('admin profit 17'));
			redirect($this->_redirect_url);
			
		} else {
			
			redirect($this->_redirect_url);
			
		}
		
	}
  
}