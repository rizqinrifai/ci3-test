<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Application extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(array('Application_model'));

        if ($this->session->userdata('is_login') != 'TRUE') {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->template->load('template', 'application/list');
    }

    public function datatable(){
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $order_by = $this->input->get('order')[0]['column'];
        $order_dir = $this->input->get('order')[0]['dir'];
        $search = $this->input->get('search')['value'];

        $application = $this->application_model->get_application($limit, $start, $order_by, $order_dir, $search);
        $total_application = $this->Application_model->count_all_application();

        $data = array(
            'recordsTotal' => $total_application,
            'recordsFiltered' => $total_application,
            'data' => $application
        );

        echo json_encode($data);
    }

    public function add()
    {
        $this->template->load('template', 'application/create');
    }

    public function create()
    {
        $data = array(
            'candidate_id' => $this->input->post('candidate_id'),
            'vacancy_id' => $this->input->post('vacancy_id'),
            'application_name' => $this->input->post('application_name'),
            'minimum_exp' => $this->input->post('minimum_exp'),
            'created_date' => date('Y-m-d'),
            'flag_status' => '1',
        );

        $this->Application_model->create($data);

        echo json_encode(array("status" => TRUE));
    }

    public function delete($id)
    {
        $this->Application_model->delete($id);
        
        echo json_encode(array("status" => TRUE));
    }

}
