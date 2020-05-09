<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    public function login($username, $passwordx)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', $passwordx);
        return $this->db->get()->row();
    }

    public function getTotal_kopi()
    {
        return $this->db->count_all('jenis_kopi');
    }

    public function getTotal_produksi()
    {
        return $this->db->count_all('jenis_kopi');
    }

    public function get_produksi(){
        $query = $this->db->query("SELECT SUM(jumlah) as jumlah_produksi FROM produksi_kopi")->row_array();
        return $query;
    }

    public function get_riwayat($id_user){
        $query = $this->db->query("SELECT * FROM histori WHERE log_user='$id_user'")->result();
        return $query;
    }
}

?>
