<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vacancy_model extends CI_Model
{
    public $table = 't_vacancy';
    public $id = 'vacancy_id';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_vacancy($limit, $start, $order_by, $order_dir, $search) {
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
        $this->db->from('t_vacancy');

        if (!empty($search)) {
            $this->db->like('vacancy_name', $search);
            $this->db->like('minimum_exp', $search);
            $this->db->like('created_date', $search);
        }

        $this->db->where('deleted_at', null);
        $this->db->and_where('expired_date >=', date('Y-m-d'));
        $this->db->order_by($order_by, $order_dir);
        $this->db->limit($limit, $start);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function count_all_vacancy() {
        $this->db->where('deleted_at', null);
        $this->db->where('expired_date >=', date('Y-m-d'));
        $this->db->count_all('t_vacancy');

        return $this->db->count_all_results();
    }

    // get by id
    public function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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
