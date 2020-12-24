<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Just Wallet
 * Copyright (c), Just Didigital Tech
 * Author code Anna Kantemirova and Sergey Plaxin
 * Site developer http://justigniter.io/
 * License https://codecanyon.net/licenses/terms/regular
**/

class Cashiers extends Admin_Controller {
	
    /**
     * @var string
     */
    private $_redirect_url;

    /**
    * Constructor
    */
    function __construct()
    {
        parent::__construct();
			
			
		// load the logs model
		$this->load->library('currencys');
    	$this->load->model('cashiers_model');
		$this->load->model('users_model');
		$this->load->model('transactions_model');
		$this->load->model('template_model');
			
		// set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/cashiers'));
		define('THIS_URL_2', base_url('admin/cashiers/accepted'));
		define('THIS_URL_4', base_url('admin/cashiers/requests'));

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
    * Disputes list
    */
  
	public function index()
	{
		
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
		$filters = array();
		
		if ($this->input->get('email'))
        {
						$email_xss = $this->security->xss_clean($this->input->get('email'));
						$username_replace = htmlentities($username_xss, ENT_QUOTES, "UTF-8");
            $filters['email'] = $username_replace;
		}
		if ($this->input->get('email'))
        {
						$email_xss = $this->security->xss_clean($this->input->get('email'));
						$username_replace = htmlentities($email_xss, ENT_QUOTES, "UTF-8");
            $filters['email'] = $username_replace;
        }

        if ($this->input->get('first_name'))
        {
						$first_name_xss = $this->security->xss_clean($this->input->get('first_name'));
						$first_name_replace = htmlentities($first_name_xss, ENT_QUOTES, "UTF-8");
            $filters['first_name'] = $first_name_replace;
        }

        if ($this->input->get('last_name'))
        {
						$last_name_xss = $this->security->xss_clean($this->input->get('last_name'));
						$last_name_replace = htmlentities($last_name_xss, ENT_QUOTES, "UTF-8");
            $filters['last_name'] = $last_name_replace;
        }
        $filters['status_ATM'] =1;
  
		 // build filter string
		 $filter = "";
		 foreach ($filters as $key => $value)
		 {
			 $filter .= "&{$key}={$value}";
		 }
 
		 // save the current url to session for returning
		 $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

		 // are filters being submitted?
		 if ($this->input->post())
		 {
			 if ($this->input->post('clear'))
			 {
				 // reset button clicked
				 redirect(THIS_URL);
			 }
			 else
			 {
				 // apply the filter(s)
				 $filter = "";
 
				 if ($this->input->post('username'))
				 {
					 $filter .= "&username=" . $this->input->post('username', TRUE);
				 }
								 if ($this->input->post('email'))
				 {
					 $filter .= "&email=" . $this->input->post('email', TRUE);
				 }
 
				 if ($this->input->post('first_name'))
				 {
					 $filter .= "&first_name=" . $this->input->post('first_name', TRUE);
				 }
 
				 if ($this->input->post('last_name'))
				 {
					 $filter .= "&last_name=" . $this->input->post('last_name', TRUE);
				 }
                 $filter .= "&status_ATM = 1";
				 // redirect using new filter(s)
				 redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
			 }
		 }

		 // get list
		 $users = $this->users_model->get_all($limit, $offset, $filters, $sort, $dir);

		 // build pagination
		 $this->pagination->initialize(array(
			 'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
			 'total_rows' => $users['total'],
			 'per_page'   => $limit
		 ));

		  // setup page header data
		$this
		->add_js_theme('users_i18n.js', TRUE )
		->set_title(lang('users title user_list'));

		$data = $this->includes;

		// set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'users'      => $users['results'],
            'total'      => $users['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
		);
		
		 // load views
		 $data['content'] = $this->load->view('admin/cashiers/requests', $content_data, TRUE);
		 $this->load->view($this->template, $data);
		
	}


	 /**
     * Vouchers
     */
    function accepted()
    {
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('email'))
        {
						$email_xss = $this->security->xss_clean($this->input->get('email'));
						$username_replace = htmlentities($username_xss, ENT_QUOTES, "UTF-8");
            $filters['email'] = $username_replace;
        }
			
		if ($this->input->get('email'))
        {
						$email_xss = $this->security->xss_clean($this->input->get('email'));
						$username_replace = htmlentities($email_xss, ENT_QUOTES, "UTF-8");
            $filters['email'] = $username_replace;
        }

        if ($this->input->get('first_name'))
        {
						$first_name_xss = $this->security->xss_clean($this->input->get('first_name'));
						$first_name_replace = htmlentities($first_name_xss, ENT_QUOTES, "UTF-8");
            $filters['first_name'] = $first_name_replace;
        }

        if ($this->input->get('last_name'))
        {
						$last_name_xss = $this->security->xss_clean($this->input->get('last_name'));
						$last_name_replace = htmlentities($last_name_xss, ENT_QUOTES, "UTF-8");
            $filters['last_name'] = $last_name_replace;
        }
        $filters['status_ATM'] =2;
        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('username'))
                {
                    $filter .= "&username=" . $this->input->post('username', TRUE);
                }
								if ($this->input->post('email'))
                {
                    $filter .= "&email=" . $this->input->post('email', TRUE);
                }

                if ($this->input->post('first_name'))
                {
                    $filter .= "&first_name=" . $this->input->post('first_name', TRUE);
                }

                if ($this->input->post('last_name'))
                {
                    $filter .= "&last_name=" . $this->input->post('last_name', TRUE);
                }
                $filter .= "&status_ATM = 2";
                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $users = $this->users_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $users['total'],
            'per_page'   => $limit
        ));

        // setup page header data
		$this
			->add_js_theme('users_i18n.js', TRUE )
			->set_title(lang('users title user_list'));

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'users'      => $users['results'],
            'total'      => $users['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('admin/cashiers/accepted', $content_data, TRUE);
        $this->load->view($this->template, $data);
	}
	


	function rejected()
    {
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('email'))
        {
						$email_xss = $this->security->xss_clean($this->input->get('email'));
						$username_replace = htmlentities($username_xss, ENT_QUOTES, "UTF-8");
            $filters['email'] = $username_replace;
        }
			
		if ($this->input->get('email'))
        {
						$email_xss = $this->security->xss_clean($this->input->get('email'));
						$username_replace = htmlentities($email_xss, ENT_QUOTES, "UTF-8");
            $filters['email'] = $username_replace;
        }

        if ($this->input->get('first_name'))
        {
						$first_name_xss = $this->security->xss_clean($this->input->get('first_name'));
						$first_name_replace = htmlentities($first_name_xss, ENT_QUOTES, "UTF-8");
            $filters['first_name'] = $first_name_replace;
        }

        if ($this->input->get('last_name'))
        {
						$last_name_xss = $this->security->xss_clean($this->input->get('last_name'));
						$last_name_replace = htmlentities($last_name_xss, ENT_QUOTES, "UTF-8");
            $filters['last_name'] = $last_name_replace;
        }
        $filters['status_ATM'] =3;
        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('username'))
                {
                    $filter .= "&username=" . $this->input->post('username', TRUE);
                }
								if ($this->input->post('email'))
                {
                    $filter .= "&email=" . $this->input->post('email', TRUE);
                }

                if ($this->input->post('first_name'))
                {
                    $filter .= "&first_name=" . $this->input->post('first_name', TRUE);
                }

                if ($this->input->post('last_name'))
                {
                    $filter .= "&last_name=" . $this->input->post('last_name', TRUE);
                }
                $filter .= "&status_ATM = 3";
                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $users = $this->users_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $users['total'],
            'per_page'   => $limit
        ));

        // setup page header data
		$this
			->add_js_theme('users_i18n.js', TRUE )
			->set_title(lang('users title user_list'));

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'users'      => $users['results'],
            'total'      => $users['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('admin/cashiers/rejected', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function btnAccept($id=NULL){
        if ( ! is_null($id) OR ! is_numeric($id))
         {
             $user = $this->users_model->get_user($id);
             
             if ($user)
             {
                 //2-->Aceptado
                 $status_id=2;
                 $update = $this->cashiers_model->edit_user_statusAtm($status_id,$id);
                 if ($update)
                 {
                     $this->session->set_flashdata('message', sprintf(lang('users msg delete_user'), $user['first_name'] . " " . $user['last_name']));
                 }
                 else
                 {
                     $this->session->set_flashdata('error', sprintf(lang('users error delete_user'), $user['first_name'] . " " . $user['last_name']));
                 }
             }
             else
             {
                 $this->session->set_flashdata('error', lang('users error user_not_exist'));
             }
         }
         else
         {
             $this->session->set_flashdata('error', lang('users error user_id_required'));
         }
       
         // return to list and display message
         redirect($this->_redirect_url);
    }

    function btnRefuse($id=NULL){
        if ( ! is_null($id) OR ! is_numeric($id))
         {
             $user = $this->users_model->get_user($id);
             
             if ($user)
             {
                 //3-->Rechazado
                 $status_id=3;
                 $update = $this->cashiers_model->edit_user_statusAtm($status_id,$id);
                 if ($update)
                 {
                     $this->session->set_flashdata('message', sprintf(lang('users msg delete_user'), $user['first_name'] . " " . $user['last_name']));
                 }
                 else
                 {
                     $this->session->set_flashdata('error', sprintf(lang('users error delete_user'), $user['first_name'] . " " . $user['last_name']));
                 }
             }
             else
             {
                 $this->session->set_flashdata('error', lang('users error user_not_exist'));
             }
         }
         else
         {
             $this->session->set_flashdata('error', lang('users error user_id_required'));
         }
 
         // return to list and display message
       
          redirect($this->_redirect_url);
    }


}