<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Jenis_kopi extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('JenisKopi_model');

        
    }

    public function index()
    {
        $data = [
            'list' => $this->JenisKopi_model->list(),
            
        ];
       // echo var_dump($list);
        $this->load->view('jenis_kopi/index', $data);
    }
    
    public function create()
    {
       
        $this->load->view('jenis_kopi/create');
    }

    public function store()
    {
        
            $data = [
                'jenis_kopi' => $this->input->post('jenis_kopi')
            ];
            
           
            $this->form_validation->set_rules('jenis_kopi', 'Jenis Kopi', 'required');
       

            

            if ($this->form_validation->run() != false) {
                $result = $this->JenisKopi_model->insert($data);
               helper_log("add", "menambahkan jenis_kopi");
                if ($result) {
                    redirect('jenis_kopi');
                }
            } else {
                redirect('jenis_kopi/create');
                
            }
        

    }

    public function show($id_kopi)
    {
        $jenis_kopi = $this->JenisKopi_model->show($id_kopi);
      
        $data = [
            'data' => $jenis_kopi,
         
        ];
        $this->load->view('jenis_kopi/show', $data);
    }

    public function edit($id_kopi)
    {
        $jenis_kopi = $this->JenisKopi_model->show($id_kopi);
     
        $data = [
            'jenis_kopi' => $jenis_kopi,
         
        ];
        $this->load->view('jenis_kopi/edit', $data);
    }

    public function update($id_kopi)
    {
        // TODO: implementasi update data berdasarkan $id_kopi
        $id_kopi = $this->input->post('id_kopi');
        $data = array(
            'jenis_kopi' => $this->input->post('jenis_kopi'),
           
        );

        $this->JenisKopi_model->update($id_kopi, $data);
       helper_log("edit", "mengubah data jenis_kopi");
        redirect('jenis_kopi');
    }

    public function destroy($id_kopi)
    {
        $this->JenisKopi_model->delete($id_kopi);
        helper_log("delete", "menghapus data jenis_kopi");
        redirect('jenis_kopi');
    }

}
?>