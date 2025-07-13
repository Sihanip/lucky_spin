<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    function stok_hadiah()
    {
        $query = $this->db->query("SELECT * FROM `mst_hadiah` 
        inner join ( select sum(hadiah_toko.stok) as stok_awal, hadiah_toko.id_hadiah 
        from hadiah_toko group by hadiah_toko.id_hadiah) htko ON htko.id_hadiah=mst_hadiah.id 
        left join (select count(*) as tot_hadiah_terpilih,id_hadiah from hadiah_terpilih group by id_hadiah)ht 
        on ht.id_hadiah=htko.id_hadiah
         group by htko.id_hadiah
        ");  
        $result = $query->result();        
        return $result;
    }
    function mst_toko()
    {
        $query = $this->db->query("SELECT * from mst_toko order by id asc
        ");  
        $result = $query->result();        
        return $result;
    }
    function stok_hadiah_toko($idtoko)
    {
        $query = $this->db->query("SELECT * FROM `mst_hadiah` 
        inner join ( select sum(hadiah_toko.stok) as stok_awal, hadiah_toko.id_hadiah 
        from hadiah_toko where hadiah_toko.id_toko='$idtoko' group by hadiah_toko.id_hadiah) htko ON htko.id_hadiah=mst_hadiah.id 
        left join (select count(*) as tot_hadiah_terpilih,id_hadiah from hadiah_terpilih   where hadiah_terpilih.id_toko='$idtoko' group by id_hadiah)ht 
        on ht.id_hadiah=htko.id_hadiah
         group by htko.id_hadiah
        ");  
        $result = $query->result();        
        return $result;
    }
    function customer_hadiah($idtoko)
    {
        $query = $this->db->query("SELECT 
            customer_grand.nama,
            mst_hadiah.nama_hadiah,
            voucher_hadiah.id_customer,
            DATE_FORMAT(substr(customer_grand.created_at, 1, 10), '%d/%m/%Y') AS register_at,
            customer_grand.created_at
            FROM 
            `voucher_hadiah` 
            inner join customer_grand on voucher_hadiah.id_customer=customer_grand.no_receipt
            left join mst_hadiah on voucher_hadiah.id_hadiah=mst_hadiah.id
            where voucher_hadiah.id_toko='$idtoko' 
            order by customer_grand.created_at
        ");  
        $result = $query->result();        
        return $result;
    }
    function list_hadiah_rand($id_toko)
    {
        $query = $this->db->query("SELECT mst_hadiah.nama_hadiah, hadiah_toko.stok,(hadiah_toko.stok-tot_hadiah_terpilih) as stok_akhir,
        tot_hadiah_terpilih,hadiah_toko.id_toko,hadiah_toko.id_hadiah,mst_hadiah.gambar
        FROM `mst_hadiah` 
        inner join hadiah_toko on hadiah_toko.id_hadiah=mst_hadiah.id 
        inner join mst_toko on hadiah_toko.id_toko=mst_toko.id 
        left join (select count(*) as tot_hadiah_terpilih,id_hadiah,id_toko from hadiah_terpilih group by id_hadiah,id_toko)ht 
        on ht.id_hadiah=hadiah_toko.id_hadiah AND ht.id_toko=mst_toko.id 
        where mst_toko.id='$id_toko'
        having (hadiah_toko.stok-tot_hadiah_terpilih)>0 OR tot_hadiah_terpilih is null
        order by mst_hadiah.id asc
        ");  
        return $query;
    }
    function cek_voucher($id_voucher)
    {
        $query = $this->db->query("SELECT *
        FROM voucher_hadiah
        where voucher_hadiah.kode_voucher='$id_voucher' AND
        (status_voucher is null or status_voucher='')
        ");  
        return $query;
    }
    function get_id($id)
    {
        $query = $this->db->query("SELECT
               *
           FROM voucher_hadiah
           WHERE (voucher_hadiah.kode_voucher = '$id'  )
        ");  
        return $query;
    }
    function save_history_hadiah($data_log)
    {
        $this->db->trans_start();
        $this->db->insert('hadiah_terpilih', $data_log);
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
        
        // return $insert_id;
    }
}