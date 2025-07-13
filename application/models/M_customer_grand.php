<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_customer_grand extends CI_Model
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
    function get_list_customer()
    {
            $query = $this->db->query("SELECT
            customer_grand.*,mst_toko.nama_toko,voucher_hadiah.status_voucher
        FROM customer_grand
        inner join mst_toko on mst_toko.id=customer_grand.id_toko
        inner join voucher_hadiah on voucher_hadiah.id_customer=customer_grand.no_receipt
            ");  
        $result = $query->result();        
        return $result;
    }
    function get_toko($kode_toko)
    {
            $result = $this->db->query("SELECT
            count(*) as total,mst_toko.*
        FROM mst_toko
        WHERE mst_toko.kode_akses = '$kode_toko'
            ");         
        return $result;
    }
    function get_no_receip($no_receip)
    {
            $result = $this->db->query("SELECT
            count(*) as total,customer_grand.*
        FROM customer_grand
        WHERE customer_grand.no_receipt = '$no_receip'
        AND NOT EXISTS(
        SELECT voucher_hadiah.id from voucher_hadiah where voucher_hadiah.id_customer=customer_grand.no_receipt AND voucher_hadiah.status_voucher ='')
            ");         
        return $result;
    }
    function get_list_voucher($toko_id)
    {
		 $query = $this->db->query("SELECT
                *
            FROM voucher_hadiah
            left join mst_hadiah on mst_hadiah.id=voucher_hadiah.id_hadiah
            WHERE (voucher_hadiah.id_toko = '$toko_id'  )
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
    function simpan_customer($data_cust)
    {
        $this->db->trans_start();
        $this->db->insert('customer_grand', $data_cust);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    function add_stok($data_hadiah,$data_log,$id_toko,$id_hadiah)
    {
        $this->db->trans_start();
        $this->db->where('id_toko', $id_toko);
        $this->db->where('id_hadiah', $id_hadiah);
        $this->db->update('hadiah_toko', $data_hadiah);
        $this->db->trans_complete();
        
        $this->db->trans_start();
        $this->db->insert('log_add_stok', $data_log);
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