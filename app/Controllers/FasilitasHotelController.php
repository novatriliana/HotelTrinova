<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FasilitasHotel;

class FasilitasHotelController extends BaseController
{


public function index()
    {
        return view('Hotel/tampil-FasilitasHotel');
    }
public function tampil(){
            $fasilitas = new FasilitasHotel;
            $data['ListFasilitasHotel'] = $fasilitas->findAll();
            return view('Hotel/tampil-FasilitasHotel', $data);
        }
public function tambahfasilitasHotel(){
            return view('Hotel/tambah-FasilitasHotel', ); 
        }
public function simpanFasilitasHotel(){
            helper(['form']);
            $upload = $this->request->getFile('txtFoto');
            $upload->move(WRITEPATH. '../public/gambar/');
            $datanya=[
                'nama_fasilitas_hotel'=>$this->request->getPost('txtInputNamaFasilitas'),
                'deskripsi'=>$this->request->getPost('txtInputDeskripsi'),
                'foto'=>$upload->getName()
            ];
            $fasilitas = new FasilitasHotel;
           $fasilitas->insert($datanya);
            return redirect()->to('/fasilitas_hotel')->with('berhasil', 'Data Berhasil di simpan');
        }
public function editfasilitashotel($id_fasilitashotel){
            if(session()->get('sudahkah login')){
            return redirect()->to('/petugas');
            exit;
                    }
                // cek apakah yang login bukan admin ?
                if(session()->get('level')!='admin'){
                return redirect()->to('/petugas/dashboard');
                exit;
                }
                $Datafasilitashotel = New Fasilitashotel;
                $data['detailfasilitashotel'] = $Datafasilitashotel->where('id_fasilitashotel', $id_fasilitashotel)->findAll();
                return view('Hotel/edit-FasilitasHotel', $data);
    }
    public function editfoto($id_fasilitashotel){ 
        // cek apakah sudah login ?
             if(!session()->get('sudahkahLogin')){
                  return redirect()->to('/petugas'); 
                  exit; }
                  
                // cek apakah yang login bukan admin ?
                if(session()->get('level')!='admin'){ 
                    return redirect()->to('/petugas/dashboard'); 
                    exit; }
                $Datahotel = New FasilitasHotel;
                $data['detailhotel']=$Datahotel->where('id_fasilitashotel',$id_fasilitashotel)->findAll();
                return view('Hotel/edit-foto',$data); 
            }
            public function updateFasilitashotel(){
                // cek apakah sudah login ?
                if(session()->get('sudahkah login')){
                return redirect()->to('/petugas');
                exit;
                }
                // cek apakah yang login bukan admin ?
                if(session()->get('level')!='admin'){
                return redirect()->to('/petugas/dashboard');
                exit;
            }
                $Datakamar = New FasilitasHotel;
                helper(['form']);
                $data=[
                'nama_fasilitas_hotel'=>$this->request->getPost('txtInputnama_fasilitas_hotel'),
                'deskripsi'=>$this->request->getPost('txtInputDeskripsi'),
            ];
                $Datakamar->update($this->request->getPost('txtInputIdFhotel'),$data);
                return redirect()->to('/fasilitas_hotel');
                
            }             
            public function updatefoto(){
                 // cek apakah sudah login 
                if(!session()->get('sudahkahLogin')){
                    return redirect()->to('/petugas'); exit; }
            // cek apakah yang login bukan admin ? 
            if(session()->get('level')!='admin'){
                return redirect()->to('/petugas/dashboard');
                exit; }
                
                helper(['form']);
           $upload = $this->request->getFile('txtinputfoto');
           $id = $this->request->getPost('id_fhotel');
           $syarat = ['id_fasilitashotel' => $id];
           $upload->move(WRITEPATH . '../public/gambar/');
           $data=['foto'=> $upload->getName()];
        //    dd($data);
            $this->fasilitashotel->update($id, $data);
            return redirect()->to('/fasilitas_hotel')->with('berhasil', 'Data Berhasil di update'); 
                }
        // hapus fasilitashotel
    public function hapusfasilitashotel($id_fasilitashotel)
        {
            if(!session()->get('sudahkahLogin')){
                return redirect()->to('/petugas');
                exit; 
        }
        // cek apakah yang login bukan admin ?
            if(session()->get('level')!='admin'){
                return redirect()->to('/petugas/dashboard');
                exit;   
        }
    $Datafasilitashotel = New FasilitasHotel;
    $Datafasilitashotel->where('id_fasilitashotel',$id_fasilitashotel)->delete();
    return redirect()->to('/fasilitas_hotel');
    }
    }