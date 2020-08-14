<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cashiers_model extends CI_Model {

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
        $this->_db = 'users';
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
            SELECT SQL_CALC_FOUND_ROWS *
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


   


}
