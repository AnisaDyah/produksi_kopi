<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class History extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url', 'form');
            $this->load->model('M_log');
            $this->load->model('User_model');
        }

        public function index()
        {
            $user_level=$this->session->userdata('id_user_level');
            $user = $this->User_model->get_user();
            if($user_level == 1){
                $riwayat = $this->M_log->histori_admin();
                $user_level = $this->User_model->user_level();
                $data = [
                    'user' => $user,
                    'riwayat'=>$riwayat,
                    'user_level'=> $user_level
                ];
            }else{
                $id_user=$this->session->userdata('id_user');
                $riwayat = $this->M_log->histori_user($id_user);
                $user_level = $this->User_model->user_level();
                $data = [
                    'user' => $user,
                    'riwayat'=>$riwayat,
                    'user_level'=> $user_level
                ];
            }
            
            
            $this->load->view('history', $data);
        }

        

    }
    
    /* End of file .php */
