<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'transactions';
				$this->_db2 = 'vouchers';
				$this->_db3 = 'users';
    }
	
	function get_transaction_user_admin($user) 
	{
		$where = "(sender = '$user' OR receiver = '$user')";
		return $this->db->where($where)->order_by('id', 'DESC')->limit(20)->get("transactions");
	}
	
	function get_all_vouchers($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db2}
						WHERE id > '0'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_vouchers($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db2}
                WHERE id = " . $this->db->escape($id) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }
	
	function update_voucher($transaction, $data) {
		$this->db->where("ID", $transaction)->update("vouchers", $data);
	}
	
	function get_all($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE id > '0'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
  
    function get_user_transactions($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC', $user = NULL)
    {
        $sql = "
			SELECT SQL_CALC_FOUND_ROWS 
			sd.fee_fix as fee_fix_dep, sd.fee as fee_dep, 
			sw.fee_fix as fee_fix_wit, sw.fee  as fee_wit,
			t.*
			FROM {$this->_db} as t
				left join settings_deposit sd on sd.name=t.deposit_method and sd.status=1
				left join settings_withdrawal sw on sw.name=t.withdraw_method and sw.status=1
			WHERE (t.sender = '{$user}' OR t.receiver = '{$user}')
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }	
	
	function get_history($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC', $user = NULL)
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE sender = '{$user}' OR receiver = '{$user}'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_pending($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '1'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
    
    function get_deposits($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE type = '1'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
    
    function get_withdrawals($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE type = '2'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_confirmed($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '2'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_disputed($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '4'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_blocked($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '5'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_refunded($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS *
            FROM {$this->_db}
						WHERE status = '3'
        ";

        if ( ! empty($filters))
        {
            foreach ($filters as $key=>$value)
            {
                $value = $this->db->escape('%' . $value . '%');
                $sql .= " AND {$key} LIKE {$value}";
            }
        }

        $sql .= " ORDER BY {$sort} {$dir}";

        if ($limit)
        {
            $sql .= " LIMIT {$offset}, {$limit}";
        }

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
        {
            $results['results'] = $query->result_array();
        }
        else
        {
            $results['results'] = NULL;
        }

        $sql = "SELECT FOUND_ROWS() AS total";
        $query = $this->db->query($sql);
        $results['total'] = $query->row()->total;

        return $results;
    }
	
	function get_total_transactions() 
	{
		$s= $this->db->select("COUNT(*) as num")->get("transactions");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
	
	function get_transactions($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE id = " . $this->db->escape($id) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_label($label = NULL)
    {
        if ($label)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE label = " . $this->db->escape($label) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_duplicate($txn_id = NULL)
    {
        if ($txn_id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE user_comment = " . $this->db->escape($txn_id) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_chain($user_comment = NULL)
    {
        if ($user_comment)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE user_comment = " . $this->db->escape($user_comment) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_merchant($id = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM merchants
                WHERE id = " . $this->db->escape($id) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }
	
	function get_chain_sci($adress = NULL)
    {
        if ($adress)
        {
            $sql = "
                SELECT *
                FROM btc_order
                WHERE adress = " . $this->db->escape($adress) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_adress($adress = NULL)
    {
        if ($adress)
        {
            $sql = "
                SELECT *
                FROM {$this->_db_sci}
                WHERE adress = " . $this->db->escape($adress) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function delete_order($adress) {
		$this->db->where("adress", $adress)->delete("btc_order");
	}
	
	function get_detail_transactions($id = NULL, $email = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE (id = " . $this->db->escape($id) . " AND sender = " . $this->db->escape($email) . ") OR (id = " . $this->db->escape($id) . " AND receiver = " . $this->db->escape($email) . ")
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
	}	
	
	function get_detail_transactions_cashier($id = NULL)
    {
        if ($id)
        {
            $sql = "
					SELECT
							sd.fee_fix as fee_fix_dep, sd.fee as fee_dep, 
							sw.fee_fix as fee_fix_wit, sw.fee  as fee_wit,
							(t.amount_deposit - t.amount_deposit*(ifnull(sd.fee,0)/100)) as dep_cashier_calc, 
							(t.amount_deposit - t.amount_deposit*(ifnull(sw.fee,0)/100)) as wit_cashier_calc, 
							t.*
					FROM {$this->_db}  as t   
						left join settings_deposit sd on sd.name=t.deposit_method and sd.status=1
						left join settings_withdrawal sw on sw.name=t.withdraw_method and sw.status=1
								WHERE (t.id = " . $this->db->escape($id) . " )
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_detail_btc_order($adress = NULL)
    {
        if ($adress)
        {
            $sql = "
                SELECT *
                FROM {$this->_db_sci}
                WHERE adress = " . $this->db->escape($adress) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_detail_btc_transactions($user_comment = NULL, $email = NULL)
    {
        if ($user_comment)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE (user_comment = " . $this->db->escape($user_comment) . " AND sender = " . $this->db->escape($email) . ") OR (user_comment = " . $this->db->escape($user_comment) . " AND receiver = " . $this->db->escape($email) . ")
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function get_start_dispute($id = NULL, $email = NULL)
    {
        if ($id)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
								WHERE id = " . $this->db->escape($id) . " AND sender = " . $this->db->escape($email) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	public function update_transactions($data) 
	{
		$this->db->where("id", $this->db->escape($data['id']))->update("transactions", $data);
	}
	
	function update_btc_transactions($transaction, $data) {
		$this->db->where("ID", $transaction)->update("transactions", $data);
	}
	
	function update_dispute_transactions($transaction, $data) {
		$this->db->where("ID", $transaction)->update("transactions", $data);
	}
	
	function add_transaction($data) 
	{
		$this->db->insert("transactions", $data);
		return $this->db->insert_id();
	}
	
	function get_detail_sci_transactions($badge_sci = NULL)
    {
        if ($badge_sci)
        {
            $sql = "
                SELECT *
                FROM {$this->_db}
                WHERE admin_comment = " . $this->db->escape($badge_sci) . "
            ";

            $query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
    }	
	
	function add_order($data) 
	{
		$this->db->insert("btc_order", $data);
		return $this->db->insert_id();
	}
	
	function get_log_transactions() 
	{
		return $this->db->where("status", "1")->order_by('id', 'DESC')->limit(5)->get("transactions");
	}
	
	/**
     * Edit transaction
     *
     * @param  array $data
     * @return boolean
     */
    function edit_transaction($data = array())
    {
        if ($data)
        {
            $sql = "
                UPDATE {$this->_db}
                SET
										time = " . $this->db->escape($data['time']) . ",
										ip_address = " . $this->db->escape($data['ip_address']) . ",
										label = " . $this->db->escape($data['label']) . ",
										protect = " . $this->db->escape($data['protect']) . ",
                    sender = " . $this->db->escape($data['sender']) . ",
                    receiver = " . $this->db->escape($data['receiver']) . ",
                    user_comment = " . $this->db->escape($data['user_comment']) . ",
                    admin_comment = " . $this->db->escape($data['admin_comment']) . "
                WHERE id = " . $this->db->escape($data['id']) . "
            ";

            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }
	
	/**
     * Save generated CAPTCHA to database
     *
     * @param  array $data
     * @return boolean
     */
    public function save_captcha($data = array())
    {
        // CAPTCHA data required
        if ($data)
        {
            // insert CAPTCHA
            $query = $this->db->insert_string('captcha', $data);
            $this->db->query($query);

            // return
            return TRUE;
        }

        return FALSE;
    }


    /**
     * Verify CAPTCHA
     *
     * @param  string $captcha
     * @return boolean
     */
    public function verify_captcha($captcha = NULL)
    {
        // CAPTCHA string required
        if ($captcha)
        {
            // remove old CAPTCHA
            $expiration = time() - 7200; // 2-hour limit
            $this->db->query("DELETE FROM captcha WHERE captcha_time < {$expiration}");

            // build query
            $sql = "
                SELECT
                    COUNT(*) AS count
                FROM captcha
                WHERE word = " . $this->db->escape($captcha) . "
                    AND ip_address = '" . $this->input->ip_address() . "'
            ";

            // execute query
            $query = $this->db->query($sql);

            // return results
            if ($query->row()->count > 0)
            {
                return TRUE;
            }
        }

        return FALSE;
    }
	
	function delete_captcha($captcha) {
		$this->db->where("word", $captcha)->delete("captcha");
	}
	
	// total deposits ////////////////////////////////////////////
  function total_deposits($data = array())
  {
		if ( ! empty($data)) {
    	
				$where = "(status = '2' AND type = '1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1')";
		}
		//$where = "(status = '2' AND type = '1' AND time >= '2018-02-05' AND time <= '2018-02-16')";
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// total deposits
  function total_deposits_debit_base($data = array())
  {
		if ( ! empty($data)) {
    	
				$where = "(status = '2' AND type = '1' AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_base')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// total deposits
  function total_deposits_debit_extra1($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra1')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// total deposits
  function total_deposits_debit_extra2($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra2')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// total deposits
  function total_deposits_debit_extra3($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra3')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// total deposits
  function total_deposits_debit_extra4($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra4')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// total deposits
  function total_deposits_debit_extra5($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra5')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	function select_sum_total_deposits_debit_base($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_deposits_debit_extra1($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_deposits_debit_extra2($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_deposits_debit_extra3($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_deposits_debit_extra4($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_deposits_debit_extra5($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	// FEE //
	
	function select_sum_total_fee_debit_base($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_fee_debit_extra1($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_fee_debit_extra2($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_fee_debit_extra3($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_fee_debit_extra4($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_fee_debit_extra5($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	// deposit method stat
	
	function select_sum_total_method($method = NULL, $data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND sender = '$method' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '1' AND sender = '$method')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	function select_sum_win_total_method($method = NULL, $data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '1' AND user_comment = '$method' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND user_comment = '$method')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// summar
	
	function select_sum_withd_fee_debit_base($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2' AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_transfer_fee_debit_base($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '3' AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '3' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_exchange_fee_debit_base($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '4' AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '4' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_sci_fee_debit_base($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '5' AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '5' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	
	
	function select_sum_withd_fee_debit_extra1($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_transfer_fee_debit_extra1($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_exchange_fee_debit_extra1($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_sci_fee_debit_extra1($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	
	function select_sum_withd_fee_debit_extra2($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_transfer_fee_debit_extra2($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_exchange_fee_debit_extra2($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_sci_fee_debit_extra2($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_withd_fee_debit_extra3($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_transfer_fee_debit_extra3($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_exchange_fee_debit_extra3($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_sci_fee_debit_extra3($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_withd_fee_debit_extra4($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_transfer_fee_debit_extra4($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_exchange_fee_debit_extra4($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_sci_fee_debit_extra4($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_withd_fee_debit_extra5($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_transfer_fee_debit_extra5($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '3' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_exchange_fee_debit_extra5($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '4' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_sci_fee_debit_extra5($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '5' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	// withdrawal
	
  function total_withdrawal($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
  function total_withdrawal_debit_base($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_base')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
  function total_withdrawal_debit_extra1($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra1')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }

  function total_withdrawal_debit_extra2($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra2')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }

  function total_withdrawal_debit_extra3($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra3')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
  function total_withdrawal_debit_extra4($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra4')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
  function total_withdrawal_debit_extra5($data = array())
  {
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra5')";
		}
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	function select_sum_total_withdrawal_debit_base($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_withdrawal_debit_extra1($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_withdrawal_debit_extra2($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_withdrawal_debit_extra3($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_withdrawal_debit_extra4($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_withdrawal_debit_extra5($data = array())  // sum profit 
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('sum', 'Sum');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Sum == NULL) {
			return 0;
		} else {
			return $result[0]->Sum;
		}
	}
	
	function select_sum_total_withdrawal_fee_debit_base($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_base' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_base')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_withdrawal_fee_debit_extra1($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra1' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra1')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_withdrawal_fee_debit_extra2($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra2' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra2')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_withdrawal_fee_debit_extra3($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra3' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra3')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_withdrawal_fee_debit_extra4($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra4' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra4')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function select_sum_total_withdrawal_fee_debit_extra5($data = array())
	{
		if ( ! empty($data)) {
    	
			$where = "(status = '2' AND type = '2'  AND currency = 'debit_extra5' AND time >= " . $this->db->escape($data['start_date']) . " AND time <= " . $this->db->escape($data['end_date']) . ")";
    } else {
			$where = "(status = '2' AND type = '2' AND currency = 'debit_extra5')";
		}
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
	}
	
	function hold_balance($user = NULL, $currency = NULL, $idcashier =NULL)
	{

		/*Verificamos si el usurio es cajero*/
		$sql = "
        SELECT id, status_ATM FROM {$this->_db3}        
        WHERE email = '" . $user . "'          
        ";
        $query = $this->db->query($sql);
        $results = $query->result_array();
		
		$status_cashier=$results[0]["status_ATM"];
		$idcashier=$results[0]["id"];
		
		//exit("($status_cashier),($idcashier)");

		if($status_cashier==2 and  $idcashier>0){
			$condicion_cajero = " OR (status = '7' AND id_cashier = '$idcashier' AND currency = '$currency')";
		}else{
			$condicion_cajero ="";
		}


		$where = "(status = '4' AND receiver = '$user' AND currency = '$currency') OR (status = '5' AND receiver = '$user' AND currency = '$currency') $condicion_cajero";
		$query = $this->db->select_sum('amount', 'Amount');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();

		//exit("condicion ($where)");
		if ($result[0]->Amount == NULL) {
			return 0;
		} else {
			return $result[0]->Amount;
		}
		
	}
	
	function profit_user_debit_base($user = NULL)
	{

		$where = "(status = '2' AND sender = '$user' AND currency = 'debit_base') OR (status = '2' AND receiver = '$user' AND currency = 'debit_base')";
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
		
	}
	
	function profit_user_debit_extra1($user = NULL)
	{

		$where = "(status = '2' AND sender = '$user' AND currency = 'debit_extra1') OR (status = '2' AND receiver = '$user' AND currency = 'debit_extra1')";
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
		
	}
	
	function profit_user_debit_extra2($user = NULL)
	{

		$where = "(status = '2' AND sender = '$user' AND currency = 'debit_extra2') OR (status = '2' AND receiver = '$user' AND currency = 'debit_extra2')";
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
		
	}
	
	function profit_user_debit_extra3($user = NULL)
	{

		$where = "(status = '2' AND sender = '$user' AND currency = 'debit_extra3') OR (status = '2' AND receiver = '$user' AND currency = 'debit_extra3')";
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
		
	}
	
	function profit_user_debit_extra4($user = NULL)
	{

		$where = "(status = '2' AND sender = '$user' AND currency = 'debit_extra4') OR (status = '2' AND receiver = '$user' AND currency = 'debit_extra4')";
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
		
	}
	
	function profit_user_debit_extra5($user = NULL)
	{

		$where = "(status = '2' AND sender = '$user' AND currency = 'debit_extra5') OR (status = '2' AND receiver = '$user' AND currency = 'debit_extra5')";
		$query = $this->db->select_sum('fee', 'Fee');
		$query = $this->db->where($where);
		$query = $this->db->get('transactions');
		$result = $query->result();
		if ($result[0]->Fee == NULL) {
			return 0;
		} else {
			return $result[0]->Fee;
		}
		
	}
	
	// sum requests (for menu)
  function sum_transactions_pending()
  {
		$where = "(status = '1')";
  	$s= $this->db->where($where)->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	// total transactions ////////////////////////////////////////////
  function total_dash_transactions()
  {
  	$s= $this->db->select("COUNT(*) as num")->get("transactions");
    $r = $s->row();
    if(isset($r->num)) return $r->num;
    return 0;

    return $result[0]->Transactions;
  }
	
	function get_pending_dash($user) 
	{
		$where = "status = '1' AND type = '2'";
		return $this->db->where($where)->order_by('id', 'DESC')->limit(20)->get("transactions");
	}

	//Transaction info for cashiers option
	function get_transaction_account_user_cashier_info($id){
		$id_trans = $this->db->escape($id); 
		if($id){
				$sql ="
				SELECT t.status,  k.id as id_cashier, u.id as id_user, 
				( case 
					when (t.deposit_method='Paypal' or t.withdraw_method='Paypal') then k.paypal
					when (t.deposit_method='Credit card' or t.withdraw_method='Credit card') then k.card
					when (t.deposit_method='Bitcoin' or t.withdraw_method='Bitcoin') then k.bitcoin
					when (t.deposit_method='Transferencia Bancaria Perú' or t.withdraw_method='Transferencia Bancaria Perú') then k.swift
					when (t.deposit_method='Skrill' or t.withdraw_method='Skrill') then k.skrill
					when (t.deposit_method='Payza' or t.withdraw_method='Payza') then k.payza
					when (t.deposit_method='ADV Cash' or t.withdraw_method='ADV Cash') then k.advcash
					when (t.deposit_method='Perfect Money' or t.withdraw_method='Perfect Money') then k.perfect_m
					when (t.deposit_method='Neteller' or t.withdraw_method='Neteller') then k.neteller
					when (t.deposit_method='Uphold' or t.withdraw_method='Uphold') then k.uphold
					when (t.deposit_method='Payeer' or t.withdraw_method='Payeer') then k.payeer
					when (t.deposit_method='Airtm' or t.withdraw_method='Airtm') then k.airtm
					when (t.deposit_method='Payoneer' or t.withdraw_method='Payoneer') then k.payoneer
					when (t.deposit_method='Webmoney' or t.withdraw_method='Webmoney') then k.webmoney
				end) as cashier_account,
				( case 
					when (t.deposit_method='Paypal' or t.withdraw_method='Paypal') then u.paypal
					when (t.deposit_method='Credit card' or t.withdraw_method='Credit card') then u.card
					when (t.deposit_method='Bitcoin' or t.withdraw_method='Bitcoin') then u.bitcoin
					when (t.deposit_method='Transferencia Bancaria Perú' or t.withdraw_method='Transferencia Bancaria Perú') then u.swift
					when (t.deposit_method='Skrill' or t.withdraw_method='Skrill') then u.skrill
					when (t.deposit_method='Payza' or t.withdraw_method='Payza') then u.payza
					when (t.deposit_method='ADV Cash' or t.withdraw_method='ADV Cash') then u.advcash
					when (t.deposit_method='Perfect Money' or t.withdraw_method='Perfect Money') then u.perfect_m
					when (t.deposit_method='Neteller' or t.withdraw_method='Neteller') then u.neteller
					when (t.deposit_method='Uphold' or t.withdraw_method='Uphold') then u.uphold
					when (t.deposit_method='Payeer' or t.withdraw_method='Payeer') then u.payeer
					when (t.deposit_method='Airtm' or t.withdraw_method='Airtm') then u.airtm
					when (t.deposit_method='Payoneer' or t.withdraw_method='Payoneer') then u.payoneer
					when (t.deposit_method='Webmoney' or t.withdraw_method='Webmoney') then u.webmoney
				end) as user_account,
				t.* 
			FROM transactions t 
			INNER JOIN users k on k.id=t.id_cashier 
			LEFT JOIN users u on (u.email =t.sender or u.email=t.receiver)
			where t.id=".$id_trans.";
				";
		
			$query = $this->db->query($sql);

            if ($query->num_rows())
            {
                return $query->row_array();
            }
        }

        return FALSE;
	}

	function confirmdep($id_trans, $id_deposit){
		$id_trans = $this->db->escape($id_trans); 
		$id_deposit = $this->db->escape($id_deposit); 
		$sql="
			UPDATE  transactions 
				SET id_deposit_cashier=".$id_deposit." 
			WHERE id=".$id_trans."
			";
		$query = $this->db->query($sql);
		if ($this->db->affected_rows())
            {
                return TRUE;
            }else{
				return FALSE;
			}
	}


}