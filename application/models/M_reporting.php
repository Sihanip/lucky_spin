<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_reporting extends CI_Model
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
    function customer_hadiah_perday($idtoko,$date)
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
            where voucher_hadiah.id_toko='$idtoko' and DATE_FORMAT(substr(customer_grand.created_at, 1, 10), '%Y-%m-%d') =substr('$date', 1, 10) 
            order by customer_grand.created_at;
        ");
        $result = $query->result();        
        return $result;
    }
}