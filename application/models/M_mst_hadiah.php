<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_mst_hadiah extends CI_Model
{
    function list_hadiah()
    {
        $this->db->select('*');
        $this->db->from('mst_hadiah');
        $this->db->order_by('mst_hadiah.id', 'ASC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    function get_hadiah($id)
    {
        $this->db->select('*');
        $this->db->from('mst_hadiah');
        $this->db->where('id', $id);
        $this->db->order_by('mst_hadiah.id', 'DESC');
        $query = $this->db->get();    
        return $query;
    }
    function save_newtoko($data_hadiah)
    {
        $this->db->trans_start();
        $this->db->insert('mst_hadiah', $data_hadiah);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    function edittoko($data_toko,$id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('mst_hadiah', $data_toko);
    
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}