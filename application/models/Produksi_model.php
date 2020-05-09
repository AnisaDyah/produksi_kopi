<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Produksi_model extends CI_Model
{
    /**
     * This function is used to get the produksi_kopi listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    public function list()
    {
        $query = $this->db->get('produksi_kopi');
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('produksi_kopi');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('produksi_kopi', $data);
        return $result;
    }

    public function show($id_produksi)
    {
        $this->db->where('id_produksi', $id_produksi);
        $query = $this->db->get('produksi_kopi');
        return $query->row();
    }

    public function update($id_produksi, $data = [])
    {
        $ubah = array(
            'id_kopi' => $data['id_kopi'],
            'jumlah' => $data['jumlah'],
            'tanggal'  => $data['tanggal']
        );

        $this->db->where('id_produksi', $id_produksi);
        $this->db->update('produksi_kopi', $ubah);
    }


    public function delete($id_produksi)
    {
        $this->db->where('id_produksi', $id_produksi);
        $this->db->delete('produksi_kopi');
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
		return $this->db->get('produksi_kopi')->result();
    }
    public function export_produksi_byjenis($id_kopi,$tgl_awal, $tgl_akhir)
	{
        $this->db->where('id_kopi',$id_kopi);
		$this->db->where('tanggal BETWEEN "'.$tgl_awal.'" AND "'.$tgl_akhir.'"');
		$this->db->order_by('tanggal', 'ASC');
		return $this->db->get('produksi_kopi')->result();
    }
  
}

  