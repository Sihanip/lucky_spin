<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_mst_toko extends CI_Model
{
    function list_toko()
    {
        $this->db->select('*');
        $this->db->from('mst_toko');
        $this->db->order_by('mst_toko.id', 'ASC');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    function get_toko($toko_id)
    {
        $this->db->select('*');
        $this->db->from('mst_toko');
        $this->db->where('id', $toko_id);
        $this->db->order_by('mst_toko.id', 'ASC');
        $query = $this->db->get();    
        return $query;
    }
    function save_newtoko($data_toko)
    {
        $this->db->trans_start();
        $this->db->insert('mst_toko', $data_toko);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    function edittoko($data_toko,$id)
    {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('mst_toko', $data_toko);
    
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
}