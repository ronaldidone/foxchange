<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cashiers_model extends CI_Model {

    /**
     * @vars
     */
    private $_db;
    private $_db2;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // define primary table
        $this->_db = 'users';
        $this->_db2 = 'cashier_chat';
        $this->_db3 = 'user_cashier';   
        $this->_db4 = 'transactions';           
        
        
    }


    /**
     * Get list of non-deleted users
     *
     * @param  int $limit
     * @param  int $offset
     * @param  array $filters
     * @param  string $sort
     * @param  string $dir
     * @return array|boolean
     */
    function get_all($limit=0, $offset=0, $filters=array(), $sort='last_name', $dir='ASC')
    {
        $sql = "
            SELECT SQL_CALC_FOUND_ROWS as d*
            FROM {$this->_db}
            WHERE deleted = '0' and status_ATM is not null
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


  
    
    /**
     * User edits status ATM
     *
     * @param  int $status_Atm
     * @param  int $user_id
     * @return boolean
     */
    function edit_user_statusAtm($status_id, $user_id )
    {
        
        if ($status_id && $user_id)
        { 
                $sql .= "
                UPDATE {$this->_db}
                SET
                    status_ATM = " . $this->db->escape($status_id) . ",
                    updated = '" . date('Y-m-d H:i:s') . "'
                WHERE id = " . $this->db->escape($user_id) . "
                    AND deleted = '0'
                ";
            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }

    function get_chat_transaccion($id_transaccion )
    {

         
        $sql = "
            SELECT *
            FROM {$this->_db2}
            WHERE id_transaccion=" . $this->db->escape($id_transaccion) . "
        ";

       

        $sql .= " ORDER BY id asc";

       

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

    function register_chat_message($id_transaccion, $id_user, $msg){

        $id_transaccion = $this->db->escape($id_transaccion);
        $id_user = $this->db->escape($id_user);
        $msg = $this->db->escape($msg);

        if ($id_transaccion && $id_user)
        { 
                $sql = "
                INSERT INTO {$this->_db2} (id_transaccion, id_user, message, fecha_hora)
                VALUES($id_transaccion, $id_user, $msg, '". date('Y-m-d H:i:s') ."' )
                ";
            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;

    }

    function accept_transaction($id_transaccion, $id_user){
        $id_transaccion = $this->db->escape($id_transaccion);
        $id_user = $this->db->escape($id_user);

        $sql = "SELECT t.type, t.status, t.amount_deposit, 
                        sd.fee_fix as fee_fix_dep, sd.fee as fee_dep, 
                        sw.fee_fix as fee_fix_wit, sw.fee  as fee_wit
                FROM {$this->_db4}  as t   
                    left join settings_deposit sd on sd.name=t.deposit_method
                    left join settings_withdrawal sw on sw.name=t.withdraw_method
               WHERE t.id =" . $id_transaccion . "";

        $query = $this->db->query($sql);
        $results = $query->result_array();

        $status_trans=$results[0]["status"];
        $amount_deposit=$results[0]["status"];
        $type=$results[0]["type"];
        if($type==1){
            $fee_fix=$results[0]["fee_fix_dep"];
            $fee    =$results[0]["fee_dep"];
        }else{
            $fee_fix=$results[0]["fee_fix_wit"];
            $fee    =$results[0]["fee_wit"];
        }

        $fee_cashier=($fee/100);

        
        //calc amount sent cashier
		$amount_sent_cashier=$amount_deposit-($amount_deposit*$fee_cashier);


        if ($id_transaccion && $id_user && $status_trans=='1')
        { 
                $sql = "
                UPDATE {$this->_db4}
                SET
                    id_cashier = " . $id_user . ",
                    amount_sent_cashier =".$amount_sent_cashier.",
                    status = '7'
                WHERE id = " . $id_transaccion . "
                   
                ";
                
            $this->db->query($sql);

            if ($this->db->affected_rows())
            {
                return TRUE;
            }
        }

        return FALSE;
    }

    function get_all_transaction($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC',$user = NULL)
    { 
        $sql = "
                       with A AS(
                            select id_user, paypal AS VALUE, 'PayPal' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, card AS VALUE, 'Credit card' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, bitcoin AS VALUE, 'Bitcoin' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, swift AS VALUE, 'Transferencia Bancaria Perú' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, skrill AS VALUE, 'Skrill' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, payza AS VALUE, 'Payza' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, adv_cash  AS VALUE, 'ADV Cash' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, perfect_m AS VALUE, 'Perfect Money' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, neteller AS VALUE, 'Neteller' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, uphold AS VALUE, 'Uphold' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, payeer AS VALUE, 'Payeer' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, airtm AS VALUE, 'Airtm' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, payoneer AS VALUE, 'Payoneer' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, webmoney AS VALUE, 'Webmoney' AS descrip from {$this->_db3} where activo = 1 
                        )
                        , B AS(
                                select * from {$this->_db4} WHERE status in(1,7) AND type in (1,2)
                        )
                        , C AS(
                            select * from {$this->_db} WHERE deleted ='0'
                        )
                        SELECT SQL_CALC_FOUND_ROWS A.descrip, A.value, C.debit_base, B.* 
                        FROM 
                            A 
                            INNER JOIN B
                                ON (A.descrip = B.deposit_method) OR (A.descrip = B.withdraw_method)
                            INNER JOIN C
                                ON A.id_user = C.id
                        WHERE A.id_user = '{$user}'  /*AND value =1*/
                        /* AND (
                            ( B.currency ='debit_base' AND B.amount <= C.debit_base) OR
                            ( B.currency ='debit_extra1' AND B.amount <= C.debit_extra1) OR
                            ( B.currency ='debit_extra2' AND B.amount <= C.debit_extra2) OR
                            ( B.currency ='debit_extra3' AND B.amount <= C.debit_extra3) OR
                            ( B.currency ='debit_extra4' AND B.amount <= C.debit_extra4) OR
                            ( B.currency ='debit_extra5' AND B.amount <= C.debit_extra5) 
                        )   */    
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


    function get_all_transaction_history($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC',$user = NULL)
    { 
        $sql = "
                        
                SELECT SQL_CALC_FOUND_ROWS /* A.descrip, A.value, C.debit_base, */ B.* 
                FROM 
                    {$this->_db4} B
                    
                WHERE B.id_cashier = '4' AND  status in(2,7) AND type in (1,2)  
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
   


}