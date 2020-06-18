<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accessor_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function updateStatus($id)
    {
        $this->db->set('status', '4');
        $this->db->where('id', $id);
        $this->db->update('pengajuan');
    }

    public function tambahPengajuan($data)
    {
        $this->db->insert('pengajuan', $data);
    }

    public function getData()
    {
        $this->db->get('pengajuan');
    }
}
