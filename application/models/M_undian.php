<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_undian extends CI_Model
{
    function list_hadiah($id_toko)
    {
        $query = $this->db->query("SELECT mst_hadiah.nama_hadiah, hadiah_toko.stok,(hadiah_toko.stok-tot_hadiah_terpilih) as stok_akhir,
        tot_hadiah_terpilih,hadiah_toko.id_toko,hadiah_toko.id_hadiah,mst_hadiah.gambar
        FROM `mst_hadiah` 
        inner join hadiah_toko on hadiah_toko.id_hadiah=mst_hadiah.id 
        inner join mst_toko on hadiah_toko.id_toko=mst_toko.id 
        left join (select count(*) as tot_hadiah_terpilih,id_hadiah,id_toko from hadiah_terpilih group by id_hadiah,id_toko)ht 
        on ht.id_hadiah=hadiah_toko.id_hadiah AND ht.id_toko=mst_toko.id 
        where mst_toko.id='$id_toko'
         having ((hadiah_toko.stok-tot_hadiah_terpilih)>0 OR (tot_hadiah_terpilih is null AND hadiah_toko.stok >0))
        order by mst_hadiah.id asc
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
         having ((hadiah_toko.stok-tot_hadiah_terpilih)>0 OR (tot_hadiah_terpilih is null AND hadiah_toko.stok >0))
        order by mst_hadiah.id asc
        ");  
        return $query;
    }
    function get_spin($no_receip)
    {
        $query = $this->db->query("SELECT 
count(*) as tot_spin,kode_voucher,nama FROM 
(select voucher_hadiah.*,customer_grand.nama from  `voucher_hadiah`
inner join customer_grand on customer_grand.no_receipt=voucher_hadiah.id_customer
where customer_grand.no_receipt='$no_receip' AND (status_voucher='' or status_voucher is null) group by voucher_hadiah.kode_voucher) vh
order by kode_voucher asc 
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