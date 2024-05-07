<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vacancy extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(array('Vacancy_model'));

        if ($this->session->userdata('is_login') != 'TRUE') {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->template->load('template', 'vacancy/list');
    }

    public function datatable(){
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $order_by = $this->input->get('order')[0]['column'];
        $order_dir = $this->input->get('order')[0]['dir'];
        $search = $this->input->get('search')['value'];

        $vacancy = $this->Vacancy_model->get_vacancy($limit, $start, $order_by, $order_dir, $search);
        $total_vacancy = $this->Vacancy_model->count_all_vacancy();

        $data = array(
            'recordsTotal' => $total_vacancy,
            'recordsFiltered' => $total_vacancy,
            'data' => $vacancy
        );

        echo json_encode($data);
    }

    public function add()
    {
        $this->template->load('template', 'vacancy/create');
    }

    public function detail($id)
    {
        $vacancy = $this->Vacancy_model->get_by_id($id);

        $data = array(
            'vacancy' => $vacancy
        );

        $this->template->load('template', 'vacancy/detail', $data);
    }

    public function create()
    {
        $data = array(
            'vacancy_name' => $this->input->post('vacancy_name'),
            'minimum_exp' => $this->input->post('minimum_exp'),
            'created_date' => date('Y-m-d'),
            'flag_status' => '1',
        );

        $this->Vacancy_model->create($data);

        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $id = $this->input->post('vacancy_id');
        $data = array(
            'vacancy_name' => $this->input->post('vacancy_name'),
            'minimum_exp' => $this->input->post('minimum_exp'),
            'flag_status' => $this->input->post('flag_status'),
        );

        $this->Vacancy_model->update($id, $data);
        
        echo json_encode(array("status" => TRUE));
    }

    public function delete($id)
    {
        $this->Vacancy_model->delete($id);
        
        echo json_encode(array("status" => TRUE));
    }

}
