<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Permintaan_user extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'form');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('permintaan_user_model');

    }

    public function index()
    {
        $id_user=$this->session->userdata('id_user');
        $data = [
            'list' => $this->permintaan_user_model->permintaan_user($id_user),
            'jenis_kopi'=> $this->permintaan_user_model->jenis_kopi(),
            'user'=> $this->permintaan_user_model->user(),

            
        ];
       // echo var_dump($list);
        $this->load->view('permintaan_user/index', $data);
    }
    
    public function create()
    {
        $data['jenis_kopi'] = $this->permintaan_user_model->jenis_kopi();
        $this->load->view('permintaan_user/create',$data);
    }

    public function store()
    {
        
            $data = [
                
                'id_user' => $this->session->userdata('id_user'),
                'id_kopi' => $this->input->post('id_kopi'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => $this->input->post('tanggal'),
                'status' => "Diajukan"
            ];
            
           
            $this->form_validation->set_rules('id_kopi', 'ID Kopi', 'required');
            $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
            $this->form_validation->set_rules('tanggal', 'tanggal', 'required');

            

            if ($this->form_validation->run() != false) {
                $result = $this->permintaan_user_model->insert($data);
               helper_log("add", "menambahkan permintaan_user");
                if ($result) {
                    redirect('permintaan_user');
                }
            } else {
                $this->session->set_flashdata('message', 'Data Harus Diisi Semua');
                redirect('permintaan_user/create');
                
            }
        

    }

    public function show($id_permintaan_user)
    {
        $permintaan_user = $this->permintaan_user_model->show($id_permintaan_user);
        $jenis_kopi = $this->permintaan_user_model->jenis_kopi();
        $data = [
            'data' => $permintaan_user,
            'jenis_kopi'=>$jenis_kopi
        ];
        $this->load->view('permintaan_user/show', $data);
    }

    public function edit($id_permintaan_user)
    {
        $permintaan_user = $this->permintaan_user_model->show($id_permintaan_user);
        $jenis_kopi = $this->permintaan_user_model->jenis_kopi();
        $data = [
            'permintaan_user' => $permintaan_user,
            'jenis_kopi'=>$jenis_kopi
        ];
        $this->load->view('permintaan_user/edit', $data);
    }

    public function update($id_permintaan_user)
    {
        // TODO: implementasi update data berdasarkan $id_permintaan_user
        $id_permintaan_user = $this->input->post('id_permintaan_user');
        $data = array(
            'id_kopi' => $this->input->post('id_kopi'),
                'jumlah' => $this->input->post('jumlah'),
                'tanggal' => $this->input->post('tanggal')
        );

        $this->permintaan_user_model->update($id_permintaan_user, $data);
       helper_log("edit", "mengubah data permintaan_user");
        redirect('permintaan_user');
    }

    public function destroy($id_permintaan_user)
    {
        $this->permintaan_user_model->delete($id_permintaan_user);
        helper_log("delete", "menghapus data permintaan_user");
        redirect('permintaan_user');
    }

    public function laporan()
        {
            
            $jenis_kopi = $this->permintaan_user_model->jenis_kopi();
            $data['jenis_kopi']=$jenis_kopi;
            $this->load->view('permintaan_user/laporan_permintaan_user',$data);
            
        }

        //export permintaan_user
    
    public function export_laporan()
	{
        
        $id_kopi= $this->input->post('id_kopi');
        $tgl_awal = date_format(date_create($this->input->post('tgl_awal')), 'Y-m-d');
        $tgl_akhir = date_format(date_create($this->input->post('tgl_akhir')), 'Y-m-d');
        $jenis_kopi = $this->permintaan_user_model->jenis_kopi();
        $data['jenis_kopi']=$jenis_kopi;
        if($id_kopi == NULL){
            $data['permintaan_user'] = $this->permintaan_user_model->export_permintaan_user($tgl_awal, $tgl_akhir);
        }else{
            $data['permintaan_user'] = $this->permintaan_user_model->export_permintaan_user_byjenis($id_kopi,$tgl_awal, $tgl_akhir);
        }
		$this->load->view('permintaan_user/excel_permintaan_user', $data);
    }
    
    public function admin()
    {
        //$id_user=$this->session->userdata('id_user');
        $data = [
            'list' => $this->permintaan_user_model->list(),
            'jenis_kopi'=> $this->permintaan_user_model->jenis_kopi(),
            'user'=> $this->permintaan_user_model->user(),

            
        ];
       // echo var_dump($list);
        $this->load->view('permintaan/permintaan_user', $data);
    }
    public function tambah_permintaan($id_permintaan_user)
    {
        $data_new_permintaan = $this->permintaan_user_model->data_new_permintaan($id_permintaan_user);
        $change_status = $this->permintaan_user_model->change_status($id_permintaan_user);
        $jenis_kopi = $this->permintaan_user_model->jenis_kopi();
      
        $data = [
            'id_kopi' => $data_new_permintaan->id_kopi,
                'jumlah' => $data_new_permintaan->jumlah,
                'tanggal' => $data_new_permintaan->tanggal
        ];
        if($data_new_permintaan->status == "Diajukan"){
        $result = $this->permintaan_user_model->tambah_permintaan($data);
        redirect('permintaan_user/admin');
    }else{
        redirect('permintaan_user/admin');
        }
    }

}
?>