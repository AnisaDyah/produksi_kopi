<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Produksi extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Produksi_model');

    }

    public function index()
    {
        $data = [
            'list' => $this->Produksi_model->list(),
            'jenis_kopi'=> $this->Produksi_model->jenis_kopi()
            
        ];
       // echo var_dump($list);
        $this->load->view('produksi/index', $data);
    }
    
    public function create()
    {
        $data['jenis_kopi'] = $this->Produksi_model->jenis_kopi();
        $this->load->view('produksi/create',$data);
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
                $result = $this->Produksi_model->insert($data);
               helper_log("add", "menambahkan produksi");
                if ($result) {
                    redirect('produksi');
                }
            } else {
                redirect('produksi/create');
                
            }
        

    }

    public function show($id_produksi)
    {
        $produksi = $this->Produksi_model->show($id_produksi);
        $jenis_kopi = $this->Produksi_model->jenis_kopi();
        $data = [
            'data' => $produksi,
            'jenis_kopi'=>$jenis_kopi
        ];
        $this->load->view('produksi/show', $data);
    }

    public function edit($id_produksi)
    {
        $produksi = $this->Produksi_model->show($id_produksi);
        $jenis_kopi = $this->Produksi_model->jenis_kopi();
        $data = [
            'produksi' => $produksi,
            'jenis_kopi'=>$jenis_kopi
        ];
        $this->load->view('produksi/edit', $data);
    }

    public function update($id_produksi)
    {
        // TODO: implementasi update data berdasarkan $id_produksi
        $id_produksi = $this->input->post('id_produksi');
        $data = array(
            'id_kopi' => $this->input->post('id_kopi'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => $this->input->post('tanggal')
        );

        $this->Produksi_model->update($id_produksi, $data);
       helper_log("edit", "mengubah data produksi");
        redirect('produksi');
    }

    public function destroy($id_produksi)
    {
        $this->Produksi_model->delete($id_produksi);
        helper_log("delete", "menghapus data produksi");
        redirect('produksi');
    }

}
?>