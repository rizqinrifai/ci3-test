<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Application_model extends CI_Model
{
    public $table = 't_application';
    public $id = 'application_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_applications($limit, $start, $order_by, $order_dir, $search) {
        // default values if not set
        if (empty($limit)) {
            $limit = 10;
        }

        if (empty($start)) {
            $start = 0;
        }

        if (empty($order_by)) {
            $order_by = 'created_at';
        }

        if (empty($order_dir)) {
            $order_dir = 'DESC';
        }
        
        $this->db->select('a.*');
        $this->db->select('v.vacancy_name');
        $this->db->select('c.full_name as candidate_name');
        $this->db->from('t_application as a');
        $this->db->join('t_vacancy as v', 'a.vacancy_id = v.vacancy_id');
        $this->db->join('t_candidate as c', 'a.candidate_id = c.candidate_id');

        if (!empty($search)) {
            $this->db->like('a.application_date', $search);
            $this->db->or_like('a.application_status', $search);
            $this->db->or_like('v.vacancy_name', $search);
            $this->db->or_like('c.candidate_name', $search);
        }

        $this->db->where('deleted_at', null);
        $this->db->order_by($order_by, $order_dir);
        $this->db->limit($limit, $start);

        $query = $this->db->get();

        return $query->result_array();
    }

    // create
    public function create($data)
    {
        $this->db->insert($this->table, $data);
    }

    // delete
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->update($this->table);
    }
}
