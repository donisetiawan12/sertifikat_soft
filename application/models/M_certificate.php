<?php

class M_certificate extends CI_Model
{

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function sertifikat_details($id)
    {
        $this->db->where('certificate_id', $id);
        $query = $this->db->get('certificates');
        return $query->row();
    }

    public function update_data($data, $table)
    {
        $this->db->where('certificate_id', $data['certificate_id']);
        $this->db->update($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
