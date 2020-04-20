<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url', 'form');
        $this->load->model('Login_model');
    }
    public function index()
    {
        $this->load->view('login');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $passwordx = md5($password);
        $set = $this->Login_model->login($username, $passwordx);
        if($set)
        { 
            $log = [
                'id_user' => $set->id_user,
                'username' => $set->username,
                'id_user_level' => $set->id_user_level,
                'status' => 'Logged'
            ];
            $this->session->set_userdata($log);            

            helper_log("Login", "Login");
            redirect('/dashboard');

          
        }
        else
        {
            redirect('login');
        }
    }

    public function logout()
    { 
        $this->session->sess_destroy();
       helper_log("logout", "Logout");
        redirect('login');
    }
}

?>