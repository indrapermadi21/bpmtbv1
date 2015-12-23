<?php
/**
 * Date: 2/19/14
 * Time: 5:24 PM
 */

class MY_Model extends CI_Model
{

    var $url;

    function __construct()
    {
        parent::__construct();
    }

    public function log($message)
    {
        $this->firephp->log($message);
    }

    public function start($page, $limit){
        $page=(int)$page;
        if($page===0 || $page===1){
            return 0;
        } else {
            return (int)(($page*$limit)-$limit);
        }
    }

    public function insert_id()
    {
        return $this->db->insert_id();
    }

    public function query($query)
    {
        return $this->db->query($query);
    }

    public function last_query()
    {
        return $this->db->last_query();
    }

    public function log_last_query()
    {
        $this->log($this->last_query());
    }
}