<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_setting_spinner extends CI_Model
{
    function list_toko()
    {
        $name=$this->session->userdata('name');
        $email=$this->session->userdata('email');
        if($name ==  "admin"){
            $this->db->select('*');
            $this->db->from('mst_toko');
            $this->db->order_by('mst_toko.id', 'DESC');
            $query = $this->db->get();
        }else{
            $query = $this->db->query("SELECT
            mst_toko.*
        FROM users
        inner join mst_toko on mst_toko.username_akses=users.email
        WHERE users.email = '$email' 
            ");  

        }
        $result = $query->result();        
        return $result;
    }
    function list_hadiah()
    {
        $name=$this->session->userdata('name');
        $email=$this->session->userdata('email');
        if($name ==  "admin"){
            $query = $this->db->query("SELECT
                mst_hadiah.id as id_hadiah,mst_hadiah.nama_hadiah
            FROM mst_hadiah
            ");  
        }else{
            $query = $this->db->query("SELECT
            mst_hadiah.id as id_hadiah,mst_hadiah.nama_hadiah
        FROM users
        inner join mst_toko on mst_toko.username_akses=users.email
        inner join hadiah_toko on hadiah_toko.id_toko=mst_toko.id
        inner join mst_hadiah on mst_hadiah.id=hadiah_toko.id_hadiah
        WHERE users.email = '$email' 
            ");  
        }
        // $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }
    function get_toko($toko_id)
    {
        $this->db->select('*');
        $this->db->from('mst_toko');
        $this->db->where('id', $toko_id);
        $this->db->order_by('mst_toko.id', 'DESC');
        $query = $this->db->get();    
        return $query;
    }
    function get_setting_spinner($toko_id)
    {
		 $query = $this->db->query("SELECT
                setting_spinner.*,hadiah_toko.stok,mst_hadiah.nama_hadiah,ht.terpilih as hadiah_didapat
            FROM setting_spinner
            inner join mst_toko on mst_toko.username_akses=setting_spinner.username_toko
            left join hadiah_toko on setting_spinner.id_hadiah=hadiah_toko.id_hadiah
            AND  mst_toko.id=hadiah_toko.id_toko
            left join mst_hadiah on mst_hadiah.id=setting_spinner.id_hadiah
            left join (
            select count(*) as terpilih,id_toko, id_hadiah 
            from hadiah_terpilih   group by  id_toko,id_hadiah ) ht on 
            ht.id_toko=mst_toko.id and ht.id_hadiah=setting_spinner.id_hadiah
            WHERE (mst_toko.id = '$toko_id'  )
            order by setting_spinner.no_spinner asc
		 ");  
        return $query;
    }
    function get_cek_toko($id_toko,$id_hadiah)
    {
		 $query = $this->db->query("SELECT
                count(*) as total
            FROM hadiah_toko
            WHERE (hadiah_toko.id_toko = '$id_toko' AND  id_hadiah='$id_hadiah' )
		 ");  
        return $query;
    }
    function add_hadiah($data_hadiah)
    {
        $this->db->trans_start();
        $this->db->insert('hadiah_toko', $data_hadiah);
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