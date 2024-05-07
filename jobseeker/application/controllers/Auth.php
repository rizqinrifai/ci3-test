<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Auth_model'));
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login()
    {
        if ($this->session->userdata('is_login') == true) {

            redirect(base_url() . 'dashboard');

        } else {

            if (isset($_POST['Login']) != 'Login') {
                $this->template->load('template', 'login');
            }else{
                //get data from FORM
                $email =  $this->input->post("email", true);
                $password =  $this->input->post('password', true);

                if ($email != '' && $password != ''){
                    $user = $this->Auth_model->get_by_email($email);
                    
                    if ($user != null) {

                        if ($this->bcrypt->check_password($password, $user->password)) {
                            if ($user->status == "1") {
                                $session_data = array(
                                    'user_id'           => $user->user_id,
                                    'fullname'          => $user->fullname,
                                    'email'     	    => $user->email,
                                    'is_login'          => true
                                );

                                $this->session->set_userdata($session_data);

                                redirect(base_url() . 'dashboard');

                            } else {
                                $data['error'] = "This user is not active";
                                $this->template->load('template', 'login', $data);
                            }
                        } 
                    } 
                }else if($email == '' || $password == ''){
                    $data['error'] = "Email or password can't be empty";
                    $this->template->load('template', 'login', $data);
                }
            }
        } 
    }

    public function logout()
    {
        $this->session->sess_destroy();
        
        redirect(base_url().'auth/login');
    }
}
