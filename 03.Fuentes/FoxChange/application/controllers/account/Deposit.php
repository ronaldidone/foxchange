<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends Private_Controller {

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
				$this->load->library('fixer');
    }
  
    /**
	*  Main page
    */
	function index()
	{
		// setup page header data
    $this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));
		// reload the new user data and store in session
    $user = $this->users_model->get_user($this->user['id']);
    
    $paypal = $this->settings_model->get_dep_method(1);
	$perfect_m = $this->settings_model->get_dep_method(2);
	$advcash = $this->settings_model->get_dep_method(3);
	$payeer = $this->settings_model->get_dep_method(4);
	$skrill = $this->settings_model->get_dep_method(5);
	$paygol = $this->settings_model->get_dep_method(6);
	$paypal_manual = $this->settings_model->get_dep_method(7);
	$local_bank = $this->settings_model->get_dep_method(8);
	$coinpayments = $this->settings_model->get_dep_method(9);
	$blockchain = $this->settings_model->get_dep_method(10);
	$neteller   = $this->settings_model->get_dep_method(11);
	$uphold     = $this->settings_model->get_dep_method(12);
	$skrill_manual = $this->settings_model->get_dep_method(13);
	$airtm = $this->settings_model->get_dep_method(14);
	$payoneer = $this->settings_model->get_dep_method(15);
	$webmoney = $this->settings_model->get_dep_method(16);


    
        if ($paypal['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_paypal = TRUE;
		} elseif ($paypal['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_paypal = TRUE;
		} elseif ($paypal['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_paypal = TRUE;
		} else {
			$enabled_paypal = FALSE;
		}
		
		// Check enabled method Perfect Money
		if ($perfect_m['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_perfect_m = TRUE;
		} elseif ($perfect_m['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_perfect_m = TRUE;
		} elseif ($perfect_m['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_perfect_m = TRUE;
		} else {
			$enabled_perfect_m = FALSE;
		}
		
		// Check enabled method Advcash
		if ($advcash['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_advcash = TRUE;
		} elseif ($advcash['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_advcash = TRUE;
		} elseif ($advcash['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_advcash = TRUE;
		} else {
			$enabled_advcash = FALSE;
		}
		
		// Check enabled method Payeer
		if ($payeer['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_payeer = TRUE;
		} elseif ($payeer['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_payeer = TRUE;
		} elseif ($payeer['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_payeer = TRUE;
		} else {
			$enabled_payeer = FALSE;
		}
		
		// Check enabled method Skrill
		if ($skrill['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_skrill = TRUE;
		} elseif ($skrill['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_skrill = TRUE;
		} elseif ($skrill['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_skrill = TRUE;
		} else {
			$enabled_skrill = FALSE;
		}
		
		// Check enabled method Paygol
		if ($paygol['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_paygol = TRUE;
		} elseif ($paygol['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_paygol = TRUE;
		} elseif ($paygol['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_paygol = TRUE;
		} else {
			$enabled_paygol = FALSE;
		}
		
		// Check enabled method paypal_manual
		if ($paypal_manual['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_paypal_manual = TRUE;
		} elseif ($paypal_manual['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_paypal_manual = TRUE;
		} elseif ($paypal_manual['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_paypal_manual = TRUE;
		} else {
			$enabled_paypal_manual = FALSE;
		}
		
		// Check enabled method Local Bank
		if ($local_bank['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_local_bank = TRUE;
		} elseif ($local_bank['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_local_bank = TRUE;
		} elseif ($local_bank['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_local_bank = TRUE;
		} else {
			$enabled_local_bank = FALSE;
		}
		
		// Check enabled method Coinpayments
		if ($coinpayments['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_coinpayments = TRUE;
		} elseif ($coinpayments['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_coinpayments = TRUE;
		} elseif ($coinpayments['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_coinpayments = TRUE;
		} else {
			$enabled_coinpayments = FALSE;
		}
		
		// Check enabled method blockchain
		if ($blockchain['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_blockchain = TRUE;
		} elseif ($blockchain['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_blockchain = TRUE;
		} elseif ($blockchain['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_blockchain = TRUE;
		} else {
			$enabled_blockchain = FALSE;
		}
		
		// Check enabled method Neteller
		if ($neteller['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_neteller = TRUE;
		} elseif ($neteller['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_neteller = TRUE;
		} elseif ($neteller['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_neteller = TRUE;
		} else {
			$enabled_neteller = FALSE;
		}
		
		// Check enabled method Uphold
		if ($uphold['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_uphold = TRUE;
		} elseif ($uphold['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_uphold = TRUE;
		} elseif ($uphold['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_uphold = TRUE;
		} else {
			$enabled_uphold = FALSE;
		}
		
		// Check enabled method Skrill Manual
		if ($skrill_manual['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_skrill_manual = TRUE;
		} elseif ($skrill_manual['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_skrill_manual = TRUE;
		} elseif ($skrill_manual['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_skrill_manual = TRUE;
		} else {
			$enabled_skrill_manual = FALSE;
		}
		
		
		// Check enabled method Airtm
		if ($airtm['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_airtm = TRUE;
		} elseif ($airtm['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_airtm = TRUE;
		} elseif ($airtm['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_airtm = TRUE;
		} else {
			$enabled_airtm = FALSE;
		}
		
		
		// Check enabled method Payoneer
		if ($payoneer['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_payoneer = TRUE;
		} elseif ($payoneer['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_payoneer = TRUE;
		} elseif ($payoneer['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_payoneer = TRUE;
		} else {
			$enabled_payoneer = FALSE;
		}
		
		// Check enabled method Webmoney
		if ($webmoney['start_verify'] == "1" && $user['verify_status'] == 0) {
			$enabled_webmoney = TRUE;
		} elseif ($webmoney['standart_verify'] == "1" && $user['verify_status'] == 1) {
			$enabled_webmoney = TRUE;
		} elseif ($webmoney['expanded_verify'] == "1" && $user['verify_status'] == 2) {
			$enabled_webmoney = TRUE;
		} else {
			$enabled_webmoney = FALSE;
		}
	
    $data = $this->includes;
    
    // set content data
    $content_data = array(
			'user'    => $user,
            'paypal'            => $paypal,
			'enabled_paypal'    => $enabled_paypal,
			'perfect_m'         => $perfect_m,
			'enabled_perfect_m' => $enabled_perfect_m,
			'advcash'           => $advcash,
			'enabled_advcash'   => $enabled_advcash,
			'payeer'            => $payeer,
			'enabled_payeer'    => $enabled_payeer,
			'skrill'            => $skrill,
			'enabled_skrill'    => $enabled_skrill,
			'paygol'            => $paygol,
			'enabled_paygol'    => $enabled_paygol,
			'paypal_manual'             => $paypal_manual,
			'enabled_paypal_manual'     => $enabled_paypal_manual,
			'local_bank'           => $local_bank,
			'enabled_local_bank'   => $enabled_local_bank,
			'coinpayments'         => $coinpayments,
			'enabled_coinpayments' => $enabled_coinpayments,
			'blockchain'           => $blockchain,
			'enabled_blockchain'   => $enabled_blockchain,
			'neteller'             => $neteller,
			'enabled_neteller'     => $enabled_neteller,
			'uphold'               => $uphold,
			'enabled_uphold'       => $enabled_uphold,
			'skrill_manual'        => $skrill_manual,
			'enabled_skrill_manual'=> $enabled_skrill_manual,
			'airtm'             => $airtm,
			'enabled_airtm'     => $enabled_airtm,
			'payoneer'             => $payoneer,
			'enabled_payoneer'     => $enabled_payoneer,
			'webmoney'             => $webmoney,
			'enabled_webmoney'     => $enabled_webmoney
			
    );
    
    // load views
    $data['content'] = $this->load->view('account/deposit/index', $content_data, TRUE);
		$this->load->view($this->template, $data);
    
  }
	
	function confirm()
	{
		
		$user = $this->users_model->get_user($this->user['id']);
		
		$paypal = $this->settings_model->get_dep_method(1);
		$perfect_m = $this->settings_model->get_dep_method(2);
		$advcash = $this->settings_model->get_dep_method(3);
		$payeer = $this->settings_model->get_dep_method(4);
		$skrill = $this->settings_model->get_dep_method(5);
		$paygol = $this->settings_model->get_dep_method(6);
		$paypal_manual = $this->settings_model->get_dep_method(7);
		$local_bank = $this->settings_model->get_dep_method(8);
		$coinpayments  = $this->settings_model->get_dep_method(9);
		$blockchain    = $this->settings_model->get_dep_method(10);
		$neteller      = $this->settings_model->get_dep_method(11);
		$uphold        = $this->settings_model->get_dep_method(12);
		$skrill_manual = $this->settings_model->get_dep_method(13);
		$airtm         = $this->settings_model->get_dep_method(14);
		$payoneer      = $this->settings_model->get_dep_method(15);
		$webmoney      = $this->settings_model->get_dep_method(16);

		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[paypal,perfect_m,advcash,payeer,skrill,paygol,paypal_manual,local_bank,coinpayments,blockchain,neteller,uphold,skrill_manual,airtm,payoneer,webmoney]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));

		} else {
	    if ($user['fraud'] == 0) {

			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$method = $this->input->post("method", TRUE);
			
			if ($method == "paypal") {
				
				$method = $paypal['name'];
				$fee = $paypal['fee'];
				$fee_fix = $paypal['fee_fix'];
				$account = $user['paypal'];
				$terms = $paypal['terms'];
				$minimum = $paypal['minimum_'.$currency.''];
				$maximum = $paypal['maximum_'.$currency.''];
				$code_method = "paypal";
				
				// check verify level
				if ($paypal['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($paypal['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($paypal['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $paypal['debit_base'] == "1") {
					$merchant_account = $paypal['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $paypal['debit_extra1'] == "1") {
					$merchant_account = $paypal['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $paypal['debit_extra2']) {
					$merchant_account = $paypal['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $paypal['debit_extra3']) {
					$merchant_account = $paypal['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $paypal['debit_extra4']) {
					$merchant_account = $paypal['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $paypal['debit_extra5']) {
					$merchant_account = $paypal['ac_debit_extra5'];
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "perfect_m") {
				
				$method = $perfect_m['name'];
				$fee = $perfect_m['fee'];
				$fee_fix = $perfect_m['fee_fix'];
				$account = $user['perfect_m'];
				$minimum = $perfect_m['minimum_'.$currency.''];
				$maximum = $perfect_m['maximum_'.$currency.''];
				$code_method = "perfect_m";
				
				if ($perfect_m['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($perfect_m['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($perfect_m['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $perfect_m['debit_base'] == "1") {
					$merchant_account = $perfect_m['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $perfect_m['debit_extra1'] == "1") {
					$merchant_account = $perfect_m['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $perfect_m['debit_extra2']) {
					$merchant_account = $perfect_m['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $perfect_m['debit_extra3']) {
					$merchant_account = $perfect_m['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $perfect_m['debit_extra4']) {
					$merchant_account = $perfect_m['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $perfect_m['debit_extra5']) {
					$merchant_account = $perfect_m['ac_debit_extra5'];
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "advcash") {
				
				$method = $advcash['name'];
				$fee = $advcash['fee'];
				$fee_fix = $advcash['fee_fix'];
				$minimum = $advcash['minimum_'.$currency.''];
				$maximum = $advcash['maximum_'.$currency.''];
				$code_method = "advcash";
				
				if ($advcash['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($advcash['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($advcash['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $advcash['debit_base'] == "1") {
					$merchant_account = $advcash['ac_debit_base'];
					$symbol = $this->currencys->display->base_code;
				} elseif ($currency == "debit_extra1" && $advcash['debit_extra1'] == "1") {
					$merchant_account = $advcash['ac_debit_extra1'];
					$symbol = $this->currencys->display->extra1_code;
				} elseif ($currency == "debit_extra2" && $advcash['debit_extra2'] == "1") {
					$merchant_account = $advcash['ac_debit_extra2'];
					$symbol = $this->currencys->display->extra2_code;
				} elseif ($currency == "debit_extra3" && $advcash['debit_extra3'] == "1") {
					$merchant_account = $advcash['ac_debit_extra3'];
					$symbol = $this->currencys->display->extra3_code;
				} elseif ($currency =="debit_extra4" && $advcash['debit_extra4'] == "1") {
					$merchant_account = $advcash['ac_debit_extra4'];
					$symbol = $this->currencys->display->extra4_code;
				} elseif ($currency =="debit_extra5" && $advcash['debit_extra5'] == "1") {
					$merchant_account = $advcash['ac_debit_extra5'];
					$symbol = $this->currencys->display->extra5_code;
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "payeer") {
				
				$method = $payeer['name'];
				$fee = $payeer['fee'];
				$fee_fix = $payeer['fee_fix'];
				$minimum = $payeer['minimum_'.$currency.''];
				$maximum = $payeer['maximum_'.$currency.''];
				$code_method = "payeer";
				
				if ($payeer['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($payeer['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($payeer['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $payeer['debit_base'] == "1") {
					$merchant_account = $payeer['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $payeer['debit_extra1'] == "1") {
					$merchant_account = $payeer['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $payeer['debit_extra2'] == "1") {
					$merchant_account = $payeer['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $payeer['debit_extra3'] == "1") {
					$merchant_account = $payeer['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $payeer['debit_extra4'] == "1") {
					$merchant_account = $payeer['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $payeer['debit_extra5'] == "1") {
					$merchant_account = $payeer['ac_debit_extra5'];
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "skrill") {
				
				$method = $skrill['name'];
				$fee = $skrill['fee'];
				$fee_fix = $skrill['fee_fix'];
				$minimum = $skrill['minimum_'.$currency.''];
				$maximum = $skrill['maximum_'.$currency.''];
				$code_method = "skrill";
				
				if ($skrill['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($skrill['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($skrill['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $skrill['debit_base'] == "1") {
					$merchant_account = $skrill['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $skrill['debit_extra1'] == "1") {
					$merchant_account = $skrill['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $skrill['debit_extra2'] == "1") {
					$merchant_account = $skrill['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $skrill['debit_extra3'] == "1") {
					$merchant_account = $skrill['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $skrill['debit_extra4'] == "1") {
					$merchant_account = $skrill['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $skrill['debit_extra5'] == "1") {
					$merchant_account = $skrill['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "paygol") {
				
				$method = $paygol['name'];
				$fee = $paygol['fee'];
				$fee_fix = $paygol['fee_fix'];
				$minimum = $paygol['minimum_'.$currency.''];
				$maximum = $paygol['maximum_'.$currency.''];
				$code_method = "paygol";
				
				if ($paygol['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($paygol['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($paygol['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $paygol['debit_base'] == "1") {
					$merchant_account = $paygol['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $paygol['debit_extra1'] == "1") {
					$merchant_account = $paygol['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $paygol['debit_extra2'] == "1") {
					$merchant_account = $paygol['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $paygol['debit_extra3'] == "1") {
					$merchant_account = $paygol['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $paygol['debit_extra4'] == "1") {
					$merchant_account = $paygol['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $paygol['debit_extra5'] == "1") {
					$merchant_account = $paygol['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "paypal_manual") {
				
				$method = $paypal_manual['name'];
				$fee = $paypal_manual['fee'];
				$fee_fix = $paypal_manual['fee_fix'];
				$minimum = $paypal_manual['minimum_'.$currency.''];
				$maximum = $paypal_manual['maximum_'.$currency.''];
				$code_method = "paypal_manual";
				
				if ($paypal_manual['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($paypal_manual['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($paypal_manual['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $paypal_manual['debit_base'] == "1") {
					$merchant_account = $paypal_manual['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $paypal_manual['debit_extra1'] == "1") {
					$merchant_account = $paypal_manual['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $paypal_manual['debit_extra2'] == "1") {
					$merchant_account = $paypal_manual['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $paypal_manual['debit_extra3'] == "1") {
					$merchant_account = $paypal_manual['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $paypal_manual['debit_extra4'] == "1") {
					$merchant_account = $paypal_manual['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $paypal_manual['debit_extra5'] == "1") {
					$merchant_account = $paypal_manual['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "local_bank") {
				
				$method = $local_bank['name'];
				$fee = $local_bank['fee'];
				$fee_fix = $local_bank['fee_fix'];
				$minimum = $local_bank['minimum_'.$currency.''];
				$maximum = $local_bank['maximum_'.$currency.''];
				$code_method = "local_bank";
				
				if ($local_bank['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($local_bank['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($local_bank['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $local_bank['debit_base'] == "1") {
					$merchant_account = $local_bank['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $local_bank['debit_extra1'] == "1") {
					$merchant_account = $local_bank['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $local_bank['debit_extra2'] == "1") {
					$merchant_account = $local_bank['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $local_bank['debit_extra3'] == "1") {
					$merchant_account = $local_bank['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $local_bank['debit_extra4'] == "1") {
					$merchant_account = $local_bank['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $local_bank['debit_extra5'] == "1") {
					$merchant_account = $local_bank['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "coinpayments") {
				
				$method = $coinpayments['name'];
				$fee = $coinpayments['fee'];
				$fee_fix = $coinpayments['fee_fix'];
				$minimum = $coinpayments['minimum_'.$currency.''];
				$maximum = $coinpayments['maximum_'.$currency.''];
				$code_method = "coinpayments";
				
				if ($coinpayments['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($coinpayments['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($coinpayments['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $coinpayments['debit_base'] == "1") {
					$merchant_account = $coinpayments['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $coinpayments['debit_extra1'] == "1") {
					$merchant_account = $coinpayments['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $coinpayments['debit_extra2'] == "1") {
					$merchant_account = $coinpayments['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $coinpayments['debit_extra3'] == "1") {
					$merchant_account = $coinpayments['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $coinpayments['debit_extra4'] == "1") {
					$merchant_account = $coinpayments['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $coinpayments['debit_extra5'] == "1") {
					$merchant_account = $coinpayments['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "blockchain") {
				
				$method = $blockchain['name'];
				$fee = $blockchain['fee'];
				$fee_fix = $blockchain['fee_fix'];
				$minimum = $blockchain['minimum_'.$currency.''];
				$maximum = $blockchain['maximum_'.$currency.''];
				$code_method = "blockchain";
				
				if ($blockchain['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($blockchain['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($blockchain['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $blockchain['debit_base'] == "1") {
					$merchant_account = $blockchain['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $blockchain['debit_extra1'] == "1") {
					$merchant_account = $blockchain['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $blockchain['debit_extra2'] == "1") {
					$merchant_account = $blockchain['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $blockchain['debit_extra3'] == "1") {
					$merchant_account = $blockchain['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $blockchain['debit_extra4'] == "1") {
					$merchant_account = $blockchain['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $blockchain['debit_extra5'] == "1") {
					$merchant_account = $blockchain['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "neteller") {
				
				$method = $neteller['name'];
				$fee = $neteller['fee'];
				$fee_fix = $neteller['fee_fix'];
				$minimum = $neteller['minimum_'.$currency.''];
				$maximum = $neteller['maximum_'.$currency.''];
				$code_method = "neteller";
				
				if ($neteller['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($neteller['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($neteller['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $neteller['debit_base'] == "1") {
					$merchant_account = $neteller['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $neteller['debit_extra1'] == "1") {
					$merchant_account = $neteller['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $neteller['debit_extra2'] == "1") {
					$merchant_account = $neteller['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $neteller['debit_extra3'] == "1") {
					$merchant_account = $neteller['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $neteller['debit_extra4'] == "1") {
					$merchant_account = $neteller['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $neteller['debit_extra5'] == "1") {
					$merchant_account = $neteller['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "uphold") {
				
				$method = $uphold['name'];
				$fee = $uphold['fee'];
				$fee_fix = $uphold['fee_fix'];
				$minimum = $uphold['minimum_'.$currency.''];
				$maximum = $uphold['maximum_'.$currency.''];
				$code_method = "uphold";
				
				if ($uphold['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($uphold['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($uphold['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $uphold['debit_base'] == "1") {
					$merchant_account = $uphold['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $uphold['debit_extra1'] == "1") {
					$merchant_account = $uphold['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $uphold['debit_extra2'] == "1") {
					$merchant_account = $uphold['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $uphold['debit_extra3'] == "1") {
					$merchant_account = $uphold['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $uphold['debit_extra4'] == "1") {
					$merchant_account = $uphold['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $uphold['debit_extra5'] == "1") {
					$merchant_account = $uphold['ac_debit_extra5'];
				}	else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
				}
				
			} elseif ($method == "skrill_manual") {
				
				$method = $skrill_manual['name'];
				$fee = $skrill_manual['fee'];
				$fee_fix = $skrill_manual['fee_fix'];
				$minimum = $skrill_manual['minimum_'.$currency.''];
				$maximum = $skrill_manual['maximum_'.$currency.''];
				$code_method = "skrill_manual";
				
				if ($skrill_manual['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($skrill_manual['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($skrill_manual['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $skrill_manual['debit_base'] == "1") {
					$merchant_account = $skrill_manual['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $skrill_manual['debit_extra1'] == "1") {
					$merchant_account = $skrill_manual['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $skrill_manual['debit_extra2'] == "1") {
					$merchant_account = $skrill_manual['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $skrill_manual['debit_extra3'] == "1") {
					$merchant_account = $skrill_manual['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $skrill_manual['debit_extra4'] == "1") {
					$merchant_account = $skrill_manual['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $skrill_manual['debit_extra5'] == "1") {
					$merchant_account = $skrill_manual['ac_debit_extra5'];
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
			}
			
			} elseif ($method == "airtm") {
				
				$method = $airtm['name'];
				$fee = $airtm['fee'];
				$fee_fix = $airtm['fee_fix'];
				$minimum = $airtm['minimum_'.$currency.''];
				$maximum = $airtm['maximum_'.$currency.''];
				$code_method = "airtm";
				
				if ($airtm['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($airtm['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($airtm['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $airtm['debit_base'] == "1") {
					$merchant_account = $airtm['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $airtm['debit_extra1'] == "1") {
					$merchant_account = $airtm['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $airtm['debit_extra2'] == "1") {
					$merchant_account = $airtm['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $airtm['debit_extra3'] == "1") {
					$merchant_account = $airtm['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $airtm['debit_extra4'] == "1") {
					$merchant_account = $airtm['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $airtm['debit_extra5'] == "1") {
					$merchant_account = $airtm['ac_debit_extra5'];
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
			}
			
			} elseif ($method == "payoneer") {
				
				$method = $payoneer['name'];
				$fee = $payoneer['fee'];
				$fee_fix = $payoneer['fee_fix'];
				$minimum = $payoneer['minimum_'.$currency.''];
				$maximum = $payoneer['maximum_'.$currency.''];
				$code_method = "payoneer";
				
				if ($payoneer['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($payoneer['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($payoneer['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $payoneer['debit_base'] == "1") {
					$merchant_account = $payoneer['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $payoneer['debit_extra1'] == "1") {
					$merchant_account = $payoneer['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $payoneer['debit_extra2'] == "1") {
					$merchant_account = $payoneer['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $payoneer['debit_extra3'] == "1") {
					$merchant_account = $payoneer['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $payoneer['debit_extra4'] == "1") {
					$merchant_account = $payoneer['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $payoneer['debit_extra5'] == "1") {
					$merchant_account = $payoneer['ac_debit_extra5'];
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
			}
			
			} elseif ($method == "webmoney") {
				
				$method = $webmoney['name'];
				$fee = $webmoney['fee'];
				$fee_fix = $webmoney['fee_fix'];
				$minimum = $webmoney['minimum_'.$currency.''];
				$maximum = $webmoney['maximum_'.$currency.''];
				$code_method = "webmoney";
				
				if ($webmoney['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($webmoney['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($webmoney['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}
				
				// Check currency and account for receiving deposits
				if ($currency == "debit_base" && $webmoney['debit_base'] == "1") {
					$merchant_account = $webmoney['ac_debit_base'];
				} elseif ($currency == "debit_extra1" && $webmoney['debit_extra1'] == "1") {
					$merchant_account = $webmoney['ac_debit_extra1'];
				} elseif ($currency == "debit_extra2" && $webmoney['debit_extra2'] == "1") {
					$merchant_account = $webmoney['ac_debit_extra2'];
				} elseif ($currency == "debit_extra3" && $webmoney['debit_extra3'] == "1") {
					$merchant_account = $webmoney['ac_debit_extra3'];
				} elseif ($currency =="debit_extra4" && $webmoney['debit_extra4'] == "1") {
					$merchant_account = $webmoney['ac_debit_extra4'];
				} elseif ($currency =="debit_extra5" && $webmoney['debit_extra5'] == "1") {
					$merchant_account = $webmoney['ac_debit_extra5'];
				} else {
					
					$this->session->set_flashdata('error', lang('users deposit error_5'));
					redirect(site_url("account/deposit"));
					
			}
				
			}
			
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
			
			// Calculation of the commission and total sum
			$percent = $fee/"100";
			$percent_fee = $amount * $percent;
			$total_fee_calc = $percent_fee + $fee_fix;
			$total_fee = number_format($total_fee_calc, 2, '.', '');
			$total_amount_calc = $amount;
			$total_amount_received = $amount - $total_fee;
			$total_amount = number_format($total_amount_calc, 2, '.', '');
			
			// Check verify status
			if ($verify_status == FALSE) {
				
				$this->session->set_flashdata('error', lang('users deposit error_4'));
				redirect(site_url("account/deposit"));
				
			}
			
			// Check amount for minimum and maximum limits
			if ($minimum > $amount) {
				
				$this->session->set_flashdata('error', lang('users withdrawal error_3'));
				redirect(site_url("account/deposit"));
				
			} elseif ($maximum < $amount) {
				
				$this->session->set_flashdata('error', lang('users withdrawal error_3'));
				redirect(site_url("account/deposit"));
				
			}
			
			
			// setup page header data
			$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

			$data = $this->includes;

			// set content data
			$content_data = array(
				'user'              => $user,
				'total_amount'              => $total_amount,
				'total_fee'              => $total_fee,
				'amount'              => $amount,
				'currency'              => $currency,
				'method'              => $method,
				'account'              => $account,
				'terms'              => $terms,
				'code_method'              => $code_method,
				'account'              => $account,
				'merchant_account'     => $merchant_account,
				'advcash'     => $advcash,
				'payeer'     => $payeer,
				'skrill'     => $skrill,
				'paypal_manual'     => $paypal_manual,
				'local_bank'     => $local_bank,
				'coinpayments'     => $coinpayments,
				'blockchain'     => $blockchain,
				'symbol'     => $symbol,
				'amount_received' => $total_amount_received
			 );

			// load views
			$data['content'] = $this->load->view('account/deposit/confirm', $content_data, TRUE);
			$this->load->view($this->template, $data);
			
	
	     } else {

				$this->session->set_flashdata('error', lang('users error fraud'));
				redirect(site_url("account/deposit"));
	     }
		}
	}
				
	
	function credit_card()
	{
		
		$user = $this->users_model->get_user($this->user['id']);
		
		$skrill = $this->settings_model->get_dep_method(5);
		$paygol = $this->settings_model->get_dep_method(6);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[skrill,paygol]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
			if ($code_method == "skrill") {
				
				$method = $skrill['name'];
				$fee = $skrill['fee'];
				$fee_fix = $skrill['fee_fix'];
				$minimum = $skrill['minimum_'.$currency.''];
				$maximum = $skrill['maximum_'.$currency.''];;

				$random = rand(100000000000, 900000000000);
				$unic = uniqid();
				$id_transaction = ''.$random.'-'.$unic.'';

				if ($skrill['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($skrill['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($skrill['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}

				// Check currency and account for receiving deposits
				if ($currency == "debit_base") {
					$merchant_account = $skrill['ac_debit_base'];
					$symbol = $this->currencys->display->base_code;
				} elseif ($currency == "debit_extra1") {
					$merchant_account = $skrill['ac_debit_extra1'];
					$symbol = $this->currencys->display->extra1_code;
				} elseif ($currency == "debit_extra2") {
					$merchant_account = $skrill['ac_debit_extra2'];
					$symbol = $this->currencys->display->extra2_code;
				} elseif ($currency == "debit_extra3") {
					$merchant_account = $skrill['ac_debit_extra3'];
					$symbol = $this->currencys->display->extra3_code;
				} elseif ($currency =="debit_extra4") {
					$merchant_account = $skrill['ac_debit_extra4'];
					$symbol = $this->currencys->display->extra4_code;
				} elseif ($currency =="debit_extra5") {
					$merchant_account = $skrill['ac_debit_extra5'];
					$symbol = $this->currencys->display->extra5_code;
				}
				
			} elseif ($code_method == "paygol") {
				
				$method = $paygol['name'];
				$fee = $paygol['fee'];
				$fee_fix = $paygol['fee_fix'];
				$minimum = $paygol['minimum_'.$currency.''];
				$maximum = $paygol['maximum_'.$currency.''];;

				$random = rand(100000000000, 900000000000);
				$unic = uniqid();
				$id_transaction = ''.$random.'-'.$unic.'';

				if ($paygol['start_verify'] == "1" && $user['verify_status'] == 0) {
					$verify_status = TRUE;
				} elseif ($paygol['standart_verify'] == "1" && $user['verify_status'] == 1) {
					$verify_status = TRUE;
				} elseif ($paygol['expanded_verify'] == "1" && $user['verify_status'] == 2) {
					$verify_status = TRUE;
				} else {
					$verify_status = FALSE;
				}

				// Check currency and account for receiving deposits
				if ($currency == "debit_base") {
					$merchant_account = $paygol['ac_debit_base'];
					$symbol = $this->currencys->display->base_code;
				} elseif ($currency == "debit_extra1") {
					$merchant_account = $paygol['ac_debit_extra1'];
					$symbol = $this->currencys->display->extra1_code;
				} elseif ($currency == "debit_extra2") {
					$merchant_account = $paygol['ac_debit_extra2'];
					$symbol = $this->currencys->display->extra2_code;
				} elseif ($currency == "debit_extra3") {
					$merchant_account = $paygol['ac_debit_extra3'];
					$symbol = $this->currencys->display->extra3_code;
				} elseif ($currency =="debit_extra4") {
					$merchant_account = $paygol['ac_debit_extra4'];
					$symbol = $this->currencys->display->extra4_code;
				} elseif ($currency =="debit_extra5") {
					$merchant_account = $paygol['ac_debit_extra5'];
					$symbol = $this->currencys->display->extra5_code;
				}
				
			}
			
			// Calculation of the commission and total sum
			$percent = $fee/"100";
			$percent_fee = $amount * $percent;
			$total_fee_calc = $percent_fee + $fee_fix;
			$total_fee = number_format($total_fee_calc, 2, '.', '');
			$total_amount_calc = $amount;
			$total_amount = number_format($total_amount_calc, 2, '.', '');
			
			// Check verify status
			if ($verify_status == FALSE) {
				
				$this->session->set_flashdata('error', lang('users deposit error_4'));
				redirect(site_url("account/deposit"));
				
			}
			
			// Check amount for minimum and maximum limits
			if ($minimum > $amount) {
				
				$this->session->set_flashdata('error', lang('users withdrawal error_3'));
				redirect(site_url("account/deposit"));
				
			} elseif ($maximum < $amount) {
				
				$this->session->set_flashdata('error', lang('users withdrawal error_3'));
				redirect(site_url("account/deposit"));
				
			}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'              => $total_amount,
			'total_fee'              => $total_fee,
			'amount'              => $amount,
			'currency'              => $currency,
			'method'              => $method,
			'code_method'              => $code_method,
			'merchant_account'     => $merchant_account,
			'skrill'     => $skrill,
			'paygol'     => $paygol,
			'symbol'     => $symbol,
			'id_transaction'     => $id_transaction,
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/credit_card', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	
	function bank()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$local_bank = $this->settings_model->get_dep_method(8);
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[local_bank]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			

				if ($code_method == "local_bank") {
					
					$method = $local_bank['name'];
					$fee = $local_bank['fee'];
					$fee_fix = $local_bank['fee_fix'];
					$minimum = $local_bank['minimum_'.$currency.''];
					$maximum = $local_bank['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($local_bank['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($local_bank['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($local_bank['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $local_bank['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $local_bank['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $local_bank['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $local_bank['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $local_bank['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $local_bank['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
				// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
					
				if ($code_method == "local_bank") {
					
					// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $local_bank['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"label" 	        => $label,
						"user_comment" 	    => $id_transaction,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
					
				}
				
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'local_bank'            => $local_bank,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/bank', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	
	function paypal()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$paypal_manual = $this->settings_model->get_dep_method(7);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[paypal_manual]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
				if ($code_method == "paypal_manual") {

					$method = $paypal_manual['name'];
					$fee = $paypal_manual['fee'];
					$fee_fix = $paypal_manual['fee_fix'];
					$minimum = $paypal_manual['minimum_'.$currency.''];
					$maximum = $paypal_manual['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($paypal_manual['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($paypal_manual['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($paypal_manual['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $paypal_manual['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $paypal_manual['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $paypal_manual['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $paypal_manual['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $paypal_manual['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $paypal_manual['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
			// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$amount_sent_cashier =$amount + $fee_fix;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
				if ($code_method == "paypal_manual") {
					
				// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
												"fee_fix"    			=> $fee_fix,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $paypal_manual['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_sent_cashier"=> $amount_sent_cashier,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"label" 	        => $label,
						"user_comment" 	    => $id_transaction,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
				}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'paypal_manual'                 => $paypal_manual,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/paypal', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	function neteller()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$neteller = $this->settings_model->get_dep_method(11);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[neteller]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
				if ($code_method == "neteller") {

					$method = $neteller['name'];
					$fee = $neteller['fee'];
					$fee_fix = $neteller['fee_fix'];
					$minimum = $neteller['minimum_'.$currency.''];
					$maximum = $neteller['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($neteller['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($neteller['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($neteller['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $neteller['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $neteller['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $neteller['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $neteller['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $neteller['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $neteller['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
				// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
				if ($code_method == "neteller") {
					
				// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $neteller['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"label" 	        => $label,
						"user_comment" 	    => $id_transaction,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
				}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'neteller'              => $neteller,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/neteller', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	function skrill()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$skrill_manual = $this->settings_model->get_dep_method(13);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[skrill_manual]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
				if ($code_method == "skrill_manual") {

					$method = $skrill_manual['name'];
					$fee = $skrill_manual['fee'];
					$fee_fix = $skrill_manual['fee_fix'];
					$minimum = $skrill_manual['minimum_'.$currency.''];
					$maximum = $skrill_manual['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($skrill_manual['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($skrill_manual['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($skrill_manual['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $skrill_manual['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $skrill_manual['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $skrill_manual['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $skrill_manual['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $skrill_manual['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $skrill_manual['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
				// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
				if ($code_method == "skrill_manual") {
					
					// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $skrill_manual['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"user_comment" 	    => $id_transaction,
						"label" 	        => $label,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
				}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'skrill_manual'         => $skrill_manual,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/skrill', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	function airtm()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$airtm = $this->settings_model->get_dep_method(14);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[airtm]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
				if ($code_method == "airtm") {

					$method = $airtm['name'];
					$fee = $airtm['fee'];
					$fee_fix = $airtm['fee_fix'];
					$minimum = $airtm['minimum_'.$currency.''];
					$maximum = $airtm['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($airtm['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($airtm['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($airtm['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $airtm['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $airtm['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $airtm['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $airtm['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $airtm['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $airtm['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
				// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
				if ($code_method == "airtm") {
					
				// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $airtm['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"user_comment" 	    => $id_transaction,
						"label" 	        => $label,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
				}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'airtm'         => $airtm,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/airtm', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	function payoneer()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$payoneer = $this->settings_model->get_dep_method(15);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[payoneer]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
				if ($code_method == "payoneer") {

					$method = $payoneer['name'];
					$fee = $payoneer['fee'];
					$fee_fix = $payoneer['fee_fix'];
					$minimum = $payoneer['minimum_'.$currency.''];
					$maximum = $payoneer['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($payoneer['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($payoneer['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($payoneer['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $payoneer['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $payoneer['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $payoneer['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $payoneer['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $payoneer['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $payoneer['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
			// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
				if ($code_method == "payoneer") {
					
					// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $payoneer['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"user_comment" 	    => $id_transaction,
						"label" 	        => $label,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
				}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'payoneer'         => $payoneer,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/payoneer', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	function webmoney()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$webmoney = $this->settings_model->get_dep_method(16);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[webmoney]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
				if ($code_method == "webmoney") {

					$method = $webmoney['name'];
					$fee = $webmoney['fee'];
					$fee_fix = $webmoney['fee_fix'];
					$minimum = $webmoney['minimum_'.$currency.''];
					$maximum = $webmoney['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($webmoney['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($webmoney['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($webmoney['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $webmoney['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $webmoney['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $webmoney['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $webmoney['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $webmoney['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $webmoney['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
			// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
				if ($code_method == "webmoney") {
					
				// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $webmoney['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"user_comment" 	    => $id_transaction,
					    "label" 	        => $label,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
				}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'webmoney'              => $webmoney,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/webmoney', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	function uphold()
	{
		
		$user = $this->users_model->get_user($this->user['id']);

		$uphold = $this->settings_model->get_dep_method(12);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[uphold]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
				if ($code_method == "uphold") {

					$method = $uphold['name'];
					$fee = $uphold['fee'];
					$fee_fix = $uphold['fee_fix'];
					$minimum = $uphold['minimum_'.$currency.''];
					$maximum = $uphold['maximum_'.$currency.''];;

					$random = rand(100000000000, 900000000000);
					$unic = uniqid();
					$id_transaction = ''.$random.'-'.$unic.'';

					if ($uphold['start_verify'] == "1" && $user['verify_status'] == 0) {
						$verify_status = TRUE;
					} elseif ($uphold['standart_verify'] == "1" && $user['verify_status'] == 1) {
						$verify_status = TRUE;
					} elseif ($uphold['expanded_verify'] == "1" && $user['verify_status'] == 2) {
						$verify_status = TRUE;
					} else {
						$verify_status = FALSE;
					}

					// Check currency and account for receiving deposits
					if ($currency == "debit_base") {
						$merchant_account = $uphold['ac_debit_base'];
						$symbol = $this->currencys->display->base_code;
					} elseif ($currency == "debit_extra1") {
						$merchant_account = $uphold['ac_debit_extra1'];
						$symbol = $this->currencys->display->extra1_code;
					} elseif ($currency == "debit_extra2") {
						$merchant_account = $uphold['ac_debit_extra2'];
						$symbol = $this->currencys->display->extra2_code;
					} elseif ($currency == "debit_extra3") {
						$merchant_account = $uphold['ac_debit_extra3'];
						$symbol = $this->currencys->display->extra3_code;
					} elseif ($currency =="debit_extra4") {
						$merchant_account = $uphold['ac_debit_extra4'];
						$symbol = $this->currencys->display->extra4_code;
					} elseif ($currency =="debit_extra5") {
						$merchant_account = $uphold['ac_debit_extra5'];
						$symbol = $this->currencys->display->extra5_code;
					}
					
				}
			
			// Calculation of the commission and total sum
				$percent = $fee/"100";
				$percent_fee = $amount * $percent;
				$total_fee_calc = $percent_fee + $fee_fix;
				$total_fee = number_format($total_fee_calc, 2, '.', '');
				$total_amount_calc = $amount - $total_fee;
				$amount_received = $amount - $total_fee;
				$amount_deposit = $amount;
				$total_amount = number_format($total_amount_calc, 2, '.', '');
			
				$label = uniqid("bmt_");

				// Check verify status
				if ($verify_status == FALSE) {

					$this->session->set_flashdata('error', lang('users deposit error_4'));
					redirect(site_url("account/deposit"));

				}

				// Check amount for minimum and maximum limits
				if ($minimum > $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				} elseif ($maximum < $amount) {

					$this->session->set_flashdata('error', lang('users withdrawal error_3'));
					redirect(site_url("account/deposit"));

				}
			
				if ($code_method == "uphold") {
					
				// add new transaction
					$transactions = $this->transactions_model->add_transaction(array(
						"type" 				=> "1",
						"sum"  				=> $total_amount_calc,
						"fee"    			=> $total_fee_calc,
						"amount" 			=> $amount_received,
						"currency"		    => $currency,
						"status" 			=> "1",
						"sender" 			=> $uphold['name'],
						"receiver" 		    => $user['email'],
						"time"              => date('Y-m-d H:i:s'),
						"amount_deposit" 	=> $amount_deposit,
						"amount_received_deposit" => $amount_received,
						"deposit_method" 	=> $method,
						"user_comment" 	    => $id_transaction,
						"label" 	        => $label,
                        "deposit_account" 	=> ''.$merchant_account.'<br><strong>ID:'.$id_transaction.'</strong>',
						"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
						"protect" 	        => "none",
						)
					);
					
					
				}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'                  => $user,
			'total_amount'          => $total_amount,
			'total_fee'             => $total_fee,
			'amount'                => $amount_received,
			'currency'              => $currency,
			'method'                => $method,
			'code_method'           => $code_method,
			'merchant_account'      => $merchant_account,
			'uphold'                => $uphold,
			'symbol'                => $symbol,
			'id_transaction'        => $id_transaction
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/uphold', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
	/**
    * BlockChain
    */
	function blockchain()
	{
		$user = $this->users_model->get_user($this->user['id']);
		
		$blockchain = $this->settings_model->get_dep_method(10);
		
		$this->form_validation->set_rules('amount', lang('users transfer amount'), 'required|trim|numeric');
		$this->form_validation->set_rules('method', lang('users withdrawal method'), 'required|trim|in_list[blockchain]');
		$this->form_validation->set_rules('currency', lang('users trans cyr'), 'required|trim|in_list[debit_base,debit_extra1,debit_extra2,debit_extra3,debit_extra4,debit_extra5]');
		
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->session->set_flashdata('error', lang('users withdrawal error_1'));
			redirect(site_url("account/deposit"));
			
		} else {
			
			$amount = number_format($this->input->post("amount", TRUE), 2, '.', '');
			$currency = $this->input->post("currency", TRUE);
			$code_method = $this->input->post("method", TRUE);
			
			$method = $blockchain['name'];
			$fee = $blockchain['fee'];
			$fee_fix = $blockchain['fee_fix'];
			$minimum = $blockchain['minimum_'.$currency.''];
			$maximum = $blockchain['maximum_'.$currency.''];;

			$random = rand(100000000000, 900000000000);
			$unic = uniqid();
			$id_transaction = ''.$random.'-'.$unic.'';

			if ($blockchain['start_verify'] == "1" && $user['verify_status'] == 0) {
				$verify_status = TRUE;
			} elseif ($blockchain['standart_verify'] == "1" && $user['verify_status'] == 1) {
				$verify_status = TRUE;
			} elseif ($blockchain['expanded_verify'] == "1" && $user['verify_status'] == 2) {
				$verify_status = TRUE;
			} else {
				$verify_status = FALSE;
			}

			// Check currency and account for receiving deposits
			if ($currency == "debit_base") {
				$merchant_account = $blockchain['ac_debit_base'];
				$symbol = $this->currencys->display->base_code;
			} elseif ($currency == "debit_extra1") {
				$merchant_account = $blockchain['ac_debit_extra1'];
				$symbol = $this->currencys->display->extra1_code;
			} elseif ($currency == "debit_extra2") {
				$merchant_account = $blockchain['ac_debit_extra2'];
				$symbol = $this->currencys->display->extra2_code;
			} elseif ($currency == "debit_extra3") {
				$merchant_account = $blockchain['ac_debit_extra3'];
				$symbol = $this->currencys->display->extra3_code;
			} elseif ($currency =="debit_extra4") {
				$merchant_account = $blockchain['ac_debit_extra4'];
				$symbol = $this->currencys->display->extra4_code;
			} elseif ($currency =="debit_extra5") {
				$merchant_account = $blockchain['ac_debit_extra5'];
				$symbol = $this->currencys->display->extra5_code;
			}
			
			// Calculation of the commission and total sum
			$percent = $fee/"100";
			$percent_fee = $amount * $percent;
			$total_fee_calc = $percent_fee + $fee_fix;
			$total_fee = number_format($total_fee_calc, 2, '.', '');
			$total_amount_calc = $amount + $total_fee;
			$total_amount = number_format($total_amount_calc, 2, '.', '');
			
			$label = uniqid("blc_");

			// Check verify status
			if ($verify_status == FALSE) {

				$this->session->set_flashdata('error', lang('users deposit error_4'));
				redirect(site_url("account/deposit"));

			}

			// Check amount for minimum and maximum limits
			if ($minimum > $amount) {

				$this->session->set_flashdata('error', lang('users withdrawal error_3'));
				redirect(site_url("account/deposit"));

			} elseif ($maximum < $amount) {

				$this->session->set_flashdata('error', lang('users withdrawal error_3'));
				redirect(site_url("account/deposit"));

			}
			
			$my_callback_url = ''.base_url().'ipn/blockchain?secret='.$blockchain['api_value2'];
				
			$call_url = urlencode($my_callback_url);

			$root_url = 'https://api.blockchain.info/v2/receive';

			$parameters = 'xpub='.$merchant_account.'&callback='.urlencode($my_callback_url).'&key='.$blockchain['api_value1'];

			$response = file_get_contents($root_url.'?'.$parameters);

			$object = json_decode($response);

			$forwarding_address = $object->address;
			
			if ($forwarding_address) {
				
				$qr_img = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin:'.$forwarding_address.'';
				
				// check value BTC
				$btc_value = $this->fixer->get_btc_rates($symbol, $total_amount);
				
				// add new transaction
				$transactions = $this->transactions_model->add_transaction(array(
					"type" 				=> "1",
					"sum"  				=> $total_amount_calc,
					"fee"    			=> $total_fee_calc,
					"amount" 			=> $amount,
					"currency"		=> $currency,
					"status" 			=> "1",
					"sender" 			=> $blockchain['name'],
					"receiver" 		=> $user['email'],
					"time"        => date('Y-m-d H:i:s'),
					"label" 	    => $label,
					"admin_comment" 	    => 'none',
					"user_comment" 	    => $forwarding_address,
					"ip_address" 	    =>  $_SERVER["REMOTE_ADDR"],
					"protect" 	    => "none",
					)
				);
				
			} else {
				
				$this->session->set_flashdata('error', lang('users deposit error_6'));
				redirect(site_url("account/deposit"));
				
			}
			
		}
		
		// setup page header data
		$this->set_title(sprintf(lang('users dashboard deposit'), $this->settings->site_name));

		$data = $this->includes;
		
		// set content data
		$content_data = array(
			'user'    => $user,
			'total_amount'              => $total_amount,
			'total_fee'              => $total_fee,
			'amount'              => $amount,
			'currency'              => $currency,
			'method'              => $method,
			'code_method'              => $code_method,
			'merchant_account'     => $merchant_account,
			'blockchain'     => $blockchain,
			'symbol'     => $symbol,
			'forwarding_address'     => $forwarding_address,
			'qr_img'     => $qr_img,
			'btc_value'     => $btc_value,
		);
		
		// load views
		$data['content'] = $this->load->view('account/deposit/blockchain', $content_data, TRUE);
		$this->load->view($this->template, $data);
		
	}
  
}