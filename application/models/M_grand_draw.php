<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_grand_draw extends CI_Model
{
    function list_user()
    {
        
            $query = $this->db->query("SELECT
           *
        FROM customer_grand order by RAND() limit 30
            ");  
        $result = $query->result();        
        return $result;
    }
    
    function get_user()
    {
        $query = $this->db->query("SELECT
           *
        FROM customer_grand where not exists(
        select penerima_grand.id_user from penerima_grand where penerima_grand.id_user=customer_grand.id
        ) order by RAND()  limit 15
        ");  
        return $query;
    }
    function list_winner()
    {
        $query = $this->db->query("SELECT
           penerima_grand.*,customer_grand.nama,customer_grand.email,customer_grand.no_telp,mst_toko.nama_toko
        FROM penerima_grand 
        inner join customer_grand on  penerima_grand.id_user=customer_grand.id
        inner join mst_toko on  customer_grand.id_toko=mst_toko.id
        ");  
        return $query;
    }
    function list_menang()
    {
        $query = $this->db->query("SELECT
           customer_grand.nama,penerima_grand.hadiah
        FROM penerima_grand
        inner join customer_grand on customer_grand.id=penerima_grand.id_user
        ");  
        return $query;
    }
    function penerima_grand($data_hadiah)
    {
        $this->db->trans_start();
        $this->db->insert('penerima_grand', $data_hadiah);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    function update_hadiah($data_hadiah,$username_toko,$no_spinner)
    {
        $this->db->trans_start();
        $this->db->where('username_toko', $username_toko);
        $this->db->where('no_spinner', $no_spinner);
        $this->db->update('setting_spinner', $data_hadiah);
        $this->db->trans_complete();
        
        echo json_encode("success");
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