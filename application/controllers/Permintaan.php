<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Permintaan extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('permintaan_model');

    }

    public function index()
    {
        $data = [
            'list' => $this->permintaan_model->list(),
            'jenis_kopi'=> $this->permintaan_model->jenis_kopi()
            
        ];
       // echo var_dump($list);
        $this->load->view('permintaan/index', $data);
    }
    
    public function create()
    {
        $data['jenis_kopi'] = $this->permintaan_model->jenis_kopi();
        $this->load->view('permintaan/create',$data);
    }

    public function store()
    {
        
            $data = [
                'id_kopi' => $this->input->post('id_kopi'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => $this->input->post('tanggal')
            ];
            
           
            $this->form_validation->set_rules('id_kopi', 'ID Kopi', 'required');
            $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');

            

            if ($this->form_validation->run() != false) {
                $result = $this->permintaan_model->insert($data);
               helper_log("add", "menambahkan permintaan");
                if ($result) {
                    redirect('permintaan');
                }
            } else {
                $this->session->set_flashdata('message', 'Data Harus Diisi Semua');
                redirect('permintaan/create');
                
            }
        

    }

    public function show($id_permintaan)
    {
        $permintaan = $this->permintaan_model->show($id_permintaan);
        $jenis_kopi = $this->permintaan_model->jenis_kopi();
        $data = [
            'data' => $permintaan,
            'jenis_kopi'=>$jenis_kopi
        ];
        $this->load->view('permintaan/show', $data);
    }

    public function edit($id_permintaan)
    {
        $permintaan = $this->permintaan_model->show($id_permintaan);
        $jenis_kopi = $this->permintaan_model->jenis_kopi();
        $data = [
            'permintaan' => $permintaan,
            'jenis_kopi'=>$jenis_kopi
        ];
        $this->load->view('permintaan/edit', $data);
    }

    public function update($id_permintaan)
    {
        // TODO: implementasi update data berdasarkan $id_permintaan
        $id_permintaan = $this->input->post('id_permintaan');
        $data = array(
            'id_kopi' => $this->input->post('id_kopi'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => $this->input->post('tanggal')
        );

        $this->permintaan_model->update($id_permintaan, $data);
       helper_log("edit", "mengubah data permintaan");
        redirect('permintaan');
    }

    public function destroy($id_permintaan)
    {
        $this->permintaan_model->delete($id_permintaan);
        helper_log("delete", "menghapus data permintaan");
        redirect('permintaan');
    }

    public function laporan()
        {
            
            $jenis_kopi = $this->permintaan_model->jenis_kopi();
            $data['jenis_kopi']=$jenis_kopi;
            $this->load->view('permintaan/laporan_permintaan',$data);
            
        }

        //export permintaan
    
    public function export_laporan()
	{
        
        $id_kopi= $this->input->post('id_kopi');
        $tgl_awal = date_format(date_create($this->input->post('tgl_awal')), 'Y-m-d');
        $tgl_akhir = date_format(date_create($this->input->post('tgl_akhir')), 'Y-m-d');
        $jenis_kopi = $this->permintaan_model->jenis_kopi();
        $data['jenis_kopi']=$jenis_kopi;
        if($id_kopi == NULL){
            $data['permintaan'] = $this->permintaan_model->export_permintaan($tgl_awal, $tgl_akhir);
        }else{
            $data['permintaan'] = $this->permintaan_model->export_permintaan_byjenis($id_kopi,$tgl_awal, $tgl_akhir);
        }
		$this->load->view('permintaan/excel_permintaan', $data);
	}

}
?>