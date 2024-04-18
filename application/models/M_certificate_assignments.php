<?php

class M_certificate_assignments extends CI_Model
{

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data)
    {
        $this->db->insert('certificate_assignments', $data);
    }

    public function certificate_assignment($id)
    {
        $this->db->where('assignment', $id);
        $query = $this->db->get('assignment_id');
        return $query->row();
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
