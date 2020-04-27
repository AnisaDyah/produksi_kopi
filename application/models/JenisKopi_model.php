<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class JenisKopi_model extends CI_Model
{
    /**
     * This function is used to get the jenis_kopi listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    public function list()
    {
        $query = $this->db->get('jenis_kopi');
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('jenis_kopi');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('jenis_kopi', $data);
        return $result;
    }

    public function show($id_kopi)
    {
        $this->db->where('id_kopi', $id_kopi);
        $query = $this->db->get('jenis_kopi');
        return $query->row();
    }

    public function update($id_kopi, $data = [])
    {
        $ubah = array(
            'jenis_kopi' => $data['jenis_kopi']
        );

        $this->db->where('id_kopi', $id_kopi);
        $this->db->update('jenis_kopi', $ubah);
    }


    public function delete($id_kopi)
    {
        $this->db->where('id_kopi', $id_kopi);
        $this->db->delete('jenis_kopi');
    }

   
}

  