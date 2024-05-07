<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth_model extends CI_Model
{
    public $table = 't_user';
    public $id = 'user_id';

    public function __construct()
    {
        parent::__construct();
    }

    // get user by email
    public function get_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get($this->table)->row();
    }

    // update
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update('users', $data);
    }

    // delete user
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->set('user_status', 0);
        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->update($this->table);
    }
}
