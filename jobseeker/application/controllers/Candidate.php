<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(array('Candidate_model'));

        if ($this->session->userdata('is_login') != 'TRUE') {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $this->template->load('template', 'candidate/list');
    }

    public function datatable(){
        $limit = $this->input->get('length');
        $start = $this->input->get('start');
        $order_by = $this->input->get('order')[0]['column'];
        $order_dir = $this->input->get('order')[0]['dir'];
        $search = $this->input->get('search')['value'];

        $candidates = $this->Candidate_model->get_candidates($limit, $start, $order_by, $order_dir, $search);
        $total_candidates = $this->Candidate_model->count_all_candidates();

        $data = array(
            'recordsTotal' => $total_candidates,
            'recordsFiltered' => $total_candidates,
            'data' => $candidates
        );

        echo json_encode($data);
    }

    public function add()
    {
        $this->template->load('template', 'candidate/create');
    }

    public function detail($id)
    {
        $candidate = $this->Candidate_model->get_by_id($id);

        $data = array(
            'candidate' => $candidate
        );

        $this->template->load('template', 'candidate/detail', $data);
    }

    public function create()
    {
        $data = array(
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number'),
            'full_name' => $this->input->post('full_name'),
            'dob' => $this->input->post('dob'),
            'pob' => $this->input->post('pob'),
            'gender' => $this->input->post('gender'),
            'year_exp' => $this->input->post('year_exp'),
            'last_salary' => $this->input->post('last_salary')
        );

        $this->Candidate_model->create($data);

        echo json_encode(array("status" => TRUE));
    }

    public function update()
    {
        $id = $this->input->post('candidate_id');
        $data = array(
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number'),
            'full_name' => $this->input->post('full_name'),
            'dob' => $this->input->post('dob'),
            'pob' => $this->input->post('pob'),
            'gender' => $this->input->post('gender'),
            'year_exp' => $this->input->post('year_exp'),
            'last_salary' => $this->input->post('last_salary')
        );

        $this->Candidate_model->update($id, $data);
        
        echo json_encode(array("status" => TRUE));
    }

    public function delete($id)
    {
        $this->Candidate_model->delete($id);
        
        echo json_encode(array("status" => TRUE));
    }

}
