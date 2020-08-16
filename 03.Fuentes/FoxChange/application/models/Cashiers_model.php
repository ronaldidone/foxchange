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

    function get_all_transaction($limit = 0, $offset = 0, $filters = array(), $sort = 'dir', $dir = 'ASC',$user = NULL)
    { 
        $sql = "
                       with A AS(
                            select id_user, paypal AS VALUE, 'PayPal' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, card AS VALUE, 'Credit card' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, bitcoin AS VALUE, 'Bitcoin' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, swift AS VALUE, 'swift' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, skrill AS VALUE, 'skrill' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, payza AS VALUE, 'payza' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, adv_cash  AS VALUE, 'ADV Cash' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, perfect_m AS VALUE, 'Perfect Money' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, neteller AS VALUE, 'Neteller' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, uphold AS VALUE, 'Uphold' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, payeer AS VALUE, 'Payeer' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, airtm AS VALUE, 'Airtm' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, payeer AS VALUE, 'Payoneer' AS descrip from {$this->_db3} where activo = 1 union all
                            select id_user, webmoney AS VALUE, 'Webmoney' AS descrip from {$this->_db3} where activo = 1 
                        )
                        , B AS(
                                select * from {$this->_db4} WHERE status = 1 AND deposit_method !='' and type in (1,2)
                        )
                        , C AS(
                            select * from {$this->_db} WHERE deleted ='0'
                        )
                        SELECT SQL_CALC_FOUND_ROWS B.* 
                        FROM 
                            A 
                            INNER JOIN B
                                ON A.descrip = B.deposit_method
                            INNER JOIN C
                                ON A.id_user = C.id
                        WHERE A.id_user = '{$user}'  
                        AND (
                            ( B.currency ='debit_base' AND B.amount <= C.debit_base) OR
                            ( B.currency ='debit_extra1' AND B.amount <= C.debit_extra1) OR
                            ( B.currency ='debit_extra2' AND B.amount <= C.debit_extra2) OR
                            ( B.currency ='debit_extra3' AND B.amount <= C.debit_extra3) OR
                            ( B.currency ='debit_extra4' AND B.amount <= C.debit_extra4) OR
                            ( B.currency ='debit_extra5' AND B.amount <= C.debit_extra5) 
                        )       
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
