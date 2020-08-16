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
    }

    function get_chat_transaccion($id_transaccion )
    {

         
        $sql = "
            SELECT *
            FROM {$this->_db2}
            WHERE id_transaccion=" . $this->db->escape($id_transaccion) . "
        ";

       

        $sql .= " ORDER BY id desc";

       

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

}