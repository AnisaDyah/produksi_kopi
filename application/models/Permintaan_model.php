<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Permintaan_model extends CI_Model
{
    /**
     * This function is used to get the data_permintaan listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    public function list()
    {
        $query = $this->db->get('data_permintaan');
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('data_permintaan');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('data_permintaan', $data);
        return $result;
    }

    public function show($id_permintaan)
    {
        $this->db->where('id_permintaan', $id_permintaan);
        $query = $this->db->get('data_permintaan');
        return $query->row();
    }

    public function update($id_permintaan, $data = [])
    {
        $ubah = array(
            'id_kopi' => $data['id_kopi'],
            'jumlah' => $data['jumlah'],
            'tanggal'  => $data['tanggal']
        );

        $this->db->where('id_permintaan', $id_permintaan);
        $this->db->update('data_permintaan', $ubah);
    }


    public function delete($id_permintaan)
    {
        $this->db->where('id_permintaan', $id_permintaan);
        $this->db->delete('data_permintaan');
    }

    public function jenis_kopi()
    {
        $query = $this->db->get('jenis_kopi');
        return $query->result();
    }

    public function export_produksi($tgl_awal, $tgl_akhir)
	{
		$this->db->where('tanggal BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get('data_permintaan')->result();
    }
    public function export_produksi_byjenis($id_kopi,$tgl_awal, $tgl_akhir)
	{
        $this->db->where('id_kopi',$id_kopi);
		$this->db->where('tanggal BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get('data_permintaan')->result();
    }
  
}

  