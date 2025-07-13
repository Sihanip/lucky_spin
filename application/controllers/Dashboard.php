<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        $this->load->library('Pdf');
        is_logged_in();
    }

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['konten'] = "dashboard";
		$data['list_hadiah'] = $this->m_dashboard->stok_hadiah();
		$this->load->view('template/header', $data);
		$this->load->view('dashboard_view', $data);
		$this->load->view('template/footer', $data);
	}
    function print_dashboard()
    {
		$data1 = $this->m_dashboard->stok_hadiah();
		$mst_toko = $this->m_dashboard->mst_toko();
        date_default_timezone_set('Asia/Jakarta');
        $date=date('Y-m-d H:i:s');
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'Stock Total',0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,'Update At :'.$date,0,1,'C');
        $pdf->Cell(10,7,'',0,1);
         $pdf->setFillColor(225,90,90);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,6,'No',1,0,'C', TRUE);
        $pdf->Cell(90,6,'Nama ',1,0,'C', TRUE);
        $pdf->Cell(30,6,'Stok Awal',1,0,'C', TRUE);
        $pdf->Cell(30,6,'Hadiah Terpilih',1,0,'C', TRUE);
        $pdf->Cell(30,6,'Stok Akhir',1,1,'C', TRUE);
        $pdf->SetFont('Arial','',10);
        $no=0;
        $total_terpilih=0;
        $total_stok_awal=0;
        $total_stok_akhir=0;
        foreach ($data1 as $data){
            $no++;
            $total_terpilih=$total_terpilih+$data->tot_hadiah_terpilih;
            $total_stok_awal=$total_stok_awal+$data->stok_awal;
            $total_stok_akhir=$total_stok_akhir+($data->stok_awal-$data->tot_hadiah_terpilih);
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(90,6,$data->nama_hadiah,1,0);
            $pdf->Cell(30,6,$data->stok_awal,1,0, 'R');
            $pdf->Cell(30,6,$data->tot_hadiah_terpilih,1,0, 'R');
            $pdf->Cell(30,6,$data->stok_awal-$data->tot_hadiah_terpilih,1,1, 'R');
        }
         $pdf->setFillColor(225,225,225);
            $pdf->Cell(100,6,"Total",1,0, 'C', TRUE);
            $pdf->Cell(30,6,$total_stok_awal,1,0, 'R', TRUE);
            $pdf->Cell(30,6,$total_terpilih,1,0, 'R', TRUE);
            $pdf->Cell(30,6,$total_stok_akhir,1,1, 'R', TRUE);
        
        $no=0;
        foreach ($mst_toko as $ms_t){
            $y=$pdf->getY();
            if($y > 200){$pdf->AddPage();}
            $pdf->Cell(10,5,'',0,1);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,7,'Stock :' .$ms_t->nama_toko ,0,1,'C');
            
            $pdf->SetFont('Arial','',9);
            $url="https://hesluckydraw.com/dashboard/print_stok_detail_toko?toko_id=".$ms_t->id;
            $pdf->Cell(20,4,'Detail : ',0,0,'C', false);
            $pdf->SetTextColor(0,0,205);
            $pdf->Cell(20,4,'Link Detail', '','','',false, $url);
            $pdf->SetTextColor(0,0,0);
            $pdf->Cell(10,4,'',0,1,'C', false);
                  
            $pdf->Cell(10,2,'',0,1);
            $pdf->SetFont('Arial','B',10);
            $pdf->setFillColor(225,90,90);
            $pdf->Cell(10,6,'No',1,0,'C', TRUE);
            $pdf->Cell(90,6,'Nama ',1,0,'C', TRUE);
            $pdf->Cell(30,6,'Stok Awal',1,0,'C', TRUE);
            $pdf->Cell(30,6,'Hadiah Terpilih',1,0,'C', TRUE);
            $pdf->Cell(30,6,'Stok Akhir',1,1, 'C', TRUE);
            $pdf->SetFont('Arial','',10);
            $no=0;
        $total_terpilih_toko=0;
        $total_stok_awal_toko=0;
        $total_stok_akhir_toko=0;
		  $data2 = $this->m_dashboard->stok_hadiah_toko($ms_t->id);
            foreach ($data2 as $data2){
                $no++;
            $total_terpilih_toko=$total_terpilih_toko+$data2->tot_hadiah_terpilih;
            $total_stok_awal_toko=$total_stok_awal_toko+$data2->stok_awal;
            $total_stok_akhir_toko=$total_stok_akhir_toko+($data2->stok_awal-$data2->tot_hadiah_terpilih);
                $pdf->Cell(10,6,$no,1,0, 'C');
                $pdf->Cell(90,6,$data2->nama_hadiah,1,0, 'L');
                $pdf->Cell(30,6,$data2->stok_awal,1,0, 'R');
                $pdf->Cell(30,6,$data2->tot_hadiah_terpilih,1,0, 'R');
                $pdf->Cell(30,6,$data2->stok_awal-$data2->tot_hadiah_terpilih,1,1, 'R');
            }
         $pdf->setFillColor(225,225,225);
            $pdf->Cell(100,6,"Total",1,0, 'C', TRUE);
            $pdf->Cell(30,6,$total_stok_awal_toko,1,0, 'R', TRUE);
            $pdf->Cell(30,6,$total_terpilih_toko,1,0, 'R', TRUE);
            $pdf->Cell(30,6,$total_stok_akhir_toko,1,1, 'R', TRUE);
        }
        $pdf->Output();
	}
	
    function print_stok_detail_toko()
    {
		$toko_id	= $this->input->get('toko_id');
        date_default_timezone_set('Asia/Jakarta');
        $date=date('Y-m-d H:i:s');
        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm','Letter');
            $pdf->AddPage();
            $pdf->Cell(10,5,'',0,1);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(0,7,'Stock '  ,0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,'Update At :'.$date,0,1,'C');
            $pdf->Cell(10,2,'',0,1);
            $pdf->SetFont('Arial','B',10);
         $pdf->setFillColor(225,90,90);
            $pdf->Cell(10,6,'No',1,0,'C', TRUE);
            $pdf->Cell(90,6,'Nama ',1,0,'C', TRUE);
            $pdf->Cell(30,6,'Stok Awal',1,0,'C', TRUE);
            $pdf->Cell(30,6,'Hadiah Terpilih',1,0,'C', TRUE);
            $pdf->Cell(30,6,'Stok Akhir',1,1, 'C', TRUE);
            $pdf->SetFont('Arial','',10);
            $no=0;
		 $data2 = $this->m_dashboard->stok_hadiah_toko($toko_id);
            foreach ($data2 as $data2){
                $no++;
            $total_terpilih_toko=$total_terpilih_toko+$data2->tot_hadiah_terpilih;
            $total_stok_awal_toko=$total_stok_awal_toko+$data2->stok_awal;
            $total_stok_akhir_toko=$total_stok_akhir_toko+($data2->stok_awal-$data2->tot_hadiah_terpilih);
                $pdf->Cell(10,6,$no,1,0, 'C');
                $pdf->Cell(90,6,$data2->nama_hadiah,1,0, 'L');
                $pdf->Cell(30,6,$data2->stok_awal,1,0, 'R');
                $pdf->Cell(30,6,$data2->tot_hadiah_terpilih,1,0, 'R');
                $pdf->Cell(30,6,$data2->stok_awal-$data2->tot_hadiah_terpilih,1,1, 'R');
            }
            $pdf->setFillColor(225,225,225);
            $pdf->Cell(100,6,"Total",1,0, 'C', TRUE);
            $pdf->Cell(30,6,$total_stok_awal_toko,1,0, 'R', TRUE);
            $pdf->Cell(30,6,$total_terpilih_toko,1,0, 'R', TRUE);
            $pdf->Cell(30,6,$total_stok_akhir_toko,1,1, 'R', TRUE);
            
            $pdf->Cell(35,8,'',0,1, 'C');
            
            $pdf->SetFont('Arial','B',10);
         $pdf->setFillColor(225,90,90);
            $pdf->Cell(10,6,'No',1,0,'C', TRUE);
            $pdf->Cell(40,6,'No Receipt ',1,0,'C', TRUE);
            $pdf->Cell(70,6,'Nama Cutomer',1,0,'C', TRUE);
            $pdf->Cell(35,6,'Hadiah',1,0,'C', TRUE);
            $pdf->Cell(35,6,'Jam',1,1, 'C', TRUE);
            $pdf->SetFont('Arial','',10);
            
            $no=0;
		 $data_cust = $this->m_dashboard->customer_hadiah($toko_id);
            foreach ($data_cust as $data_cust){
                $no++;
                $pdf->Cell(10,6,$no,1,0, 'C');
                $pdf->Cell(40,6,$data_cust->id_customer,1,0, 'L');
                $pdf->Cell(70,6,$data_cust->nama,1,0, 'L');
                $pdf->Cell(35,6,$data_cust->nama_hadiah,1,0, 'L');
                $pdf->Cell(35,6,$data_cust->created_at,1,1, 'L');
            }
        $pdf->Output();
    }
	
}
