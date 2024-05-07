<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Candidate_model extends CI_Model
{
    public $table = 't_candidate';
    public $id = 'candidate_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_candidates($limit, $start, $order_by, $order_dir, $search) {
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
        
        $this->db->select('*');
        $this->db->from('t_candidate');

        if (!empty($search)) {
            $this->db->like('email', $search);
            $this->db->or_like('phone_number', $search);
            $this->db->or_like('full_name', $search);
            $this->db->or_like('pob', $search);
            $this->db->or_like('gender', $search);
            $this->db->or_like('last_salary', $search);
        }

        $this->db->where('deleted_at', null);
        $this->db->order_by($order_by, $order_dir);
        $this->db->limit($limit, $start);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function count_all_candidates() {
        $this->db->where('deleted_at', null);
        $this->db->count_all('t_candidate');

        return $this->db->count_all_results();
    }

    // get by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // create
    public function create($data)
    {
        $this->db->insert($this->table, $data);
    }

    // upadate
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->update($this->table);
    }
}
