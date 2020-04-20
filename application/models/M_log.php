<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_log extends CI_Model {
 
    public function save_log($param)
    {
        $sql        = $this->db->insert_string('histori',$param);
        $ex         = $this->db->query($sql);
        return $this->db->affected_rows($sql);
    }

    public function histori_admin()
        {
            $query = $this->db->get('histori');
            return $query->result();
        }
}