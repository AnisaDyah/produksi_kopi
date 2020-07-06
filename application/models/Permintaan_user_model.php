<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Permintaan_user_model extends CI_Model
{
    /**
     * This function is used to get the permintaan_user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    public function list()
    {
        $query = $this->db->get('permintaan_user');
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('permintaan_user');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('permintaan_user', $data);
        return $result;
    }

    public function show($id_permintaan_user)
    {
        $this->db->where('id_permintaan_user', $id_permintaan_user);
        $query = $this->db->get('permintaan_user');
        return $query->row();
    }

    public function update($id_permintaan_user, $data = [])
    {
        $ubah = array(
            'id_kopi' => $data['id_kopi'],
            'jumlah' => $data['jumlah'],
            'tanggal'  => $data['tanggal']
        );

        $this->db->where('id_permintaan_user', $id_permintaan_user);
        $this->db->update('permintaan_user', $ubah);
    }


    public function delete($id_permintaan_user)
    {
        $this->db->where('id_permintaan_user', $id_permintaan_user);
        $this->db->delete('permintaan_user');
    }

    public function jenis_kopi()
    {
        $query = $this->db->get('jenis_kopi');
        return $query->result();
    }
    public function user()
    {
        $query = $this->db->get('user');
        return $query->result();
    }
    public function permintaan_user($id_user){
        $query = $this->db->query("SELECT * FROM permintaan_user WHERE id_user='$id_user'")->result();
        return $query;
    }

    public function export_produksi($tgl_awal, $tgl_akhir)
	{
		$this->db->where('tanggal BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get('permintaan_user')->result();
    }
    public function export_produksi_byjenis($id_kopi,$tgl_awal, $tgl_akhir)
	{
        $this->db->where('id_kopi',$id_kopi);
		$this->db->where('tanggal BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get('permintaan_user')->result();
    }
    public function data_new_permintaan($id_permintaan_user)
    {
        $this->db->where('id_permintaan_user', $id_permintaan_user);
        $query = $this->db->get('permintaan_user');
        return $query->row();
    }
    public function tambah_permintaan($data = [])
    {
        $result = $this->db->insert('data_permintaan', $data);
        return $result;
    }
    public function change_status($id_permintaan_user)
	    {
		$data['status'] = "Diterima";
		$this->db->where('id_permintaan_user',$id_permintaan_user);
		$this->db->update('permintaan_user',$data);
        }
}

  