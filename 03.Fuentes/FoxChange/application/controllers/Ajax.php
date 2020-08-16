<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * All  > PUBLIC <  AJAX functions should go in here
 *
 * CSRF protection has been disabled for this controller in the config file
 *
 * IMPORTANT: DO NOT DO ANY WRITEBACKS FROM HERE!!! For retrieving data only.
 */
class Ajax extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        $this->load->model('cashiers_model');
    }


    /**
	 * Change session language - user selected
     */
	function set_session_language()
	{
        $language = $this->input->post('language');
        $this->session->language = $language;
        $results['success'] = TRUE;
        echo json_encode($results);
        die();
    }

    /*Get chat messages*/
    function get_transaccion_chat($id_transaccion=0){
        if(intval($id_transaccion==0)){
            $id_transaccion = $this->input->post("id_trans", TRUE);
        }
        
        
		// get transaction chat
		$TransChat_msgs = $this->cashiers_model->get_chat_transaccion($id_transaccion);
        
		// set content data
        $content_data = array(
            'chat_mensajes'    => $TransChat_msgs['results'],
            'total'      => $TransChat_msgs['total'],			
			'transactions_id'   => $id_transaccion,
			'user_id'			=> $this->user['id']
        );

        // load views
        $this->load->view('account/cashiers/chat_messages', $content_data);
	}
    
    /*Add messages to chat of cashier*/
    function register_chat_message(){
		

		$id_transaccion = $this->input->post("id_trans", TRUE);
		$msg			= $this->input->post("msgtrans", TRUE);
        $id_user=$this->user['id'];
        
		// register message
		$register_message = $this->cashiers_model->register_chat_message($id_transaccion, $id_user, $msg);
        //exit("reg:($register_message) idt:($id_transaccion) msg:($id_transaccion) idusr:($id_transaccion)");
        // get transaction chat
        $this->get_transaccion_chat($id_transaccion);
		/*$TransChat_msgs = $this->cashiers_model->get_chat_transaccion($id_transaccion);

		// set content data
        $content_data = array(
            'chat_mensajes'    => $TransChat_msgs['results'],
            'total'      => $TransChat_msgs['total'],			
			'transactions_id'   => $id_transaccion,
			'user_id'			=> $this->user['id']
        );

        // load views
        $this->load->view('account/cashiers/chat', $content_data);
        //$data['content'] = $this->load->view('account/cashiers/chat', $content_data, TRUE);
        //$this->load->view($this->template, $data);*/
	}

}
