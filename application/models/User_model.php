<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function tambahPengajuan($data)
    {
        $this->db->insert('pengajuan', $data);
    }
}
