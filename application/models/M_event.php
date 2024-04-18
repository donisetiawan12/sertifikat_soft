<?php 

class M_event extends CI_Model {

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

     public function event_details($id)
    {
        $this->db->where('event_id', $id);
        $query = $this->db->get('events');
        return $query->row();
    }

    public function update_data($data, $table)
    {
        $this->db->where('event_id', $data['event_id']);
        $this->db->update($table, $data);
    }
        
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

}