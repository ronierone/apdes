<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Editor_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getPengajuan()
    {
        $query =   $this->db->get('pengajuan');
        return $query;
    }
    public function updateStatus($id)
    {
        $this->db->set('status', '2');
        $this->db->where('id', $id);
        $this->db->update('pengajuan');
    }
    public function uploadFile($id, $gambar, $data)
    {
        $this->db->set('status', '3');
        $this->db->set('file', $data);
        $this->db->set('gambar', $gambar);
        $this->db->where('id', $id);
        $this->db->update('pengajuan');
    }
}
