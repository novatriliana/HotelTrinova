<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use TCPDF;
class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function home_tamu()
    {
        return view('home');
    }
    public function kamar()
    {
        return view('template/kamartamu');   
    }
    public function hotel()
    {
        return view('template/hoteltamu');
    }

    public function cari(){
        $keyword = $this->request->getVar('keyword');
        $datatamu = $this->reservasi->where('email_pemesan', $keyword)->findAll();
        $data = [
            'title'=> 'Berikut ini daftar Tamu yang sudah terdaftar dalam database.',
            'tamu' => $datatamu
            ] ;
        return view ('cari', $data);
    }

    public function reservasi()
    {
            $data['ListKamar'] = 
            $this->kamar->findAll();
        return view('template/reservasi',$data);
    }
    public function simpanreservasi(){
        helper(['form']);
        $aturanForm=[
            'txtInputTipeKamar'=>'required',
            'nama'=>'required',
            'nohp'=>'required',
            'email'=>'required',
            'tamu'=>'required',
            'checkin'=>'required',
            'checkout'=>'required',
            'jml_kmr'=>'required'
        ];
        
        if($this->validate($aturanForm)){
            $data=[
                'id_kamar'=>$this->request->getPost('txtInputTipeKamar'),
                'nama_pemesan'=>$this->request->getPost('nama'),
                'email'=>$this->request->getPost('email'),
                'nama_tamu'=>$this->request->getPost('tamu'),
                'telepon'=>$this->request->getPost('nohp'),
                'tgl_cek_in'=>$this->request->getPost('checkin'),
                'tgl_cek_out'=>$this->request->getPost('checkout'),
                'jumlah_kamar'=>$this->request->getPost('jml_kmr'),

            ];
            $this->reservasi->save($data);
            return redirect()->to(site_url('/inv/'.$this->reservasi->getInsertID()))->with('berhasil', 'Berasil pesan Kamar');
        }
        $this->kamar->join('fasilitas_kamar', 'fasilitas_kamar.id_kamar=kamar.id_kamar' );
        $data['ListKamar'] = $this->kamar->findAll();
        return view ('reservasi', $data);
    }
    public function invoice($idreservasi){
        $this->reservasi->select('reservasi.id_reservasi, reservasi.nama_pemesan, reservasi.email, 
                                reservasi.tgl_cek_in, reservasi.tgl_cek_out, kamar.harga, kamar.type_kamar, reservasi.jumlah_kamar,
                                (datediff(reservasi.tgl_cek_out, reservasi.tgl_cek_in))as jml_hari, 
                                (datediff(reservasi.tgl_cek_out, reservasi.tgl_cek_in)*reservasi.jumlah_kamar* kamar.harga)as total_bayar');
         $this->reservasi->join('kamar', 'kamar.id_kamar=reservasi.id_kamar');
		$data['transaksi'] = $this->reservasi->find($idreservasi);
		$html = view('invoice',$data);
		$pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Hotel Trinova');
		$pdf->SetTitle('Invoice');
		$pdf->SetSubject('Invoice');

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->addPage();

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');
		//line ini penting
		$this->response->setContentType('application/pdf');
		//Close and output PDF document
		$pdf->Output('invoice.pdf', 'I');
		
	}    
}