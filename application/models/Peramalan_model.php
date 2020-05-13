<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Peramalan_model extends CI_Model
{
    /**
     * This function is used to get the jenis_kopi listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    public function get_jenis_kopi()
    {
        $query = $this->db->get('jenis_kopi');
        return $query->result();
    }

    public function get_produksi_bybulan($tanggal_awal,$tanggal_akhir,$id_kopi){
        $query = $this->db->query("SELECT tanggal,MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun, MONTH(tanggal) as bulan_angka, SUM(jumlah) as jumlah, id_kopi FROM produksi_kopi WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND id_kopi='$id_kopi' GROUP BY bulan ORDER BY tanggal ASC")->result();
        return $query;
    }
    public function get_produksi_bytahun($tanggal_awal,$tanggal_akhir,$id_kopi,$tahun){
        $query = $this->db->query("SELECT tanggal,MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun, MONTH(tanggal) as bulan_angka, SUM(jumlah) as jumlah, id_kopi FROM produksi_kopi WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND id_kopi='$id_kopi' AND YEAR(tanggal)='$tahun' GROUP BY bulan ORDER BY tanggal ASC")->result();
        return $query;
    }

    public function get_jeniskopi_bybulan($id_kopi){
        $query = $this->db->query("SELECT * FROM jenis_kopi WHERE id_kopi='$id_kopi'")->row();
        return $query;
    }

    public function get_produksi_for_peramalan($id_kopi){
        $query = $this->db->query("SELECT tanggal, MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun, MONTH(tanggal) as bulan_angka, SUM(jumlah) as jumlah, id_kopi FROM produksi_kopi WHERE id_kopi='$id_kopi' GROUP BY bulan ORDER BY tanggal ASC")->result();
        return $query;
    }
    public function get_produksi_for_peramalan_bytahun($id_kopi,$tahun){
        $query = $this->db->query("SELECT tanggal, MONTHNAME(tanggal) as bulan, YEAR(tanggal) as tahun, MONTH(tanggal) as bulan_angka, SUM(jumlah) as jumlah, id_kopi FROM produksi_kopi WHERE id_kopi='$id_kopi' AND YEAR(tanggal)='$tahun' GROUP BY bulan ORDER BY tanggal ASC")->result();
        return $query;
    }
    
   
   
   
}

  