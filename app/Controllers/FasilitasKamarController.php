<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FasilitasKamar;

class FasilitasKamarController extends BaseController
{


public function index()
    {
        return view('Fasilitas/tampil-FasilitasKamar');
    }
    public function login(){
        $syarat = [ 'username'=>$this->request->getPost('txtUsername'),
                'password'=>md5($this->request->getPost('txtPassword')) ]; 
        $Userpetugas = $this->petugas->where($syarat)->find();
          if(count($Userpetugas)==1){
              $session_data=[ 
                  'username' => $Userpetugas[0]['username'],
                  'nama_petugas' => $Userpetugas[0]['nama_petugas'],
                  'level'    => $Userpetugas[0]['level'],
                  'sudahkahLogin' => TRUE];
                  session()->set($session_data);
                  return redirect()->to('/petugas/dashboard');
                  }else{
                        return redirect()->to('/petugas');
                    }
    }
    public function logout(){
        session()->destroy();
        return redirect()->to('/petugas');
    }
public function tampil(){
        if(!session()->get('sudahkahLogin')){
            return redirect()->to('/petugas');
            exit;
            }
            // cek apakah yang login bukan admin ?
            if(session()->get('level')!='admin'){
            return redirect()->to('/petugas/dashboard');
            exit;
            }
            $fasilitas = New FasilitasKamar;
            $data['ListFasilitasKamar'] = 
            $fasilitas->findAll();
            return view('Fasilitas/tampil-FasilitasKamar', $data);
        }
        public function tambahFasilitas(){
            if(!session()->get('sudahkahLogin')){ 
                return redirect()->to('/petugas'); 
                exit;
            }
            // cek apakah yang login bukan admin ? 
            if(session()->get('level')!='admin'){ 
            return redirect()->to('/petugas/dashboard'); 
            exit; 
        } 
            return view('Fasilitas/tambah-fasilitaskamar'); 
        }
        public function simpanFasilitas(){
            if(!session()->get('sudahkahLogin')){ 
                return redirect()->to('/petugas'); 
                exit;
            }
            // cek apakah yang login bukan admin ? 
            if(session()->get('level')!='admin'){ 
            return redirect()->to('/petugas/dashboard'); 
            exit; 
        }
            helper(['form']);
            $datanya=[
                'tipe_kamar'=>$this->request->getPost('txtInputTipeKamar'),
                'nama_fasilitas'=>$this->request->getPost('txtInputNamaFasilitas')
            ];
            $this->fasilitas->insert($datanya);
            return redirect()->to('/fasilitas-kamar')->with('berhasil', 'Data Berhasil di simpan');
        }
        public function editFasilitasKamar($id_fasilitaskamar){
            if(session()->get('sudahkah login')){
            return redirect()->to('/petugas');
            exit;
                    }
                // cek apakah yang login bukan admin ?
                if(session()->get('level')!='admin'){
                return redirect()->to('/petugas/dashboard');
                exit;
                }
                $Datafasilitaskamar = New FasilitasKamar;
                $data['detailfasilitaskamar'] = $Datafasilitaskamar->where('id_fasilitaskamar', $id_fasilitaskamar)->findAll();
                return view('Fasilitas/edit-FasilitasKamar', $data);
    }
    public function updatefasilitaskamar(){
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
        $Datakamar = New FasilitasKamar;
        helper(['form']);
        $data=[
        'id_kamar'=>$this->request->getPost('txtInputNoKamar'),
        'nama_fasilitas'=>$this->request->getPost('txtInputnamafasilitas'),
        // 'deskripsi'=>$this->request->getPost('txtInputDeskripsi'),
    ];
        $Datakamar->update($this->request->getPost('id_fkamar'),$data);
        return redirect()->to('/fasilitas-kamar');
}
    // hapus fasilitaskamar
        public function hapusfasilitaskamar($id_fasilitaskamar)
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
    $Datafasilitaskamar = New FasilitasKamar;
    $Datafasilitaskamar->where('id_fasilitaskamar',$id_fasilitaskamar)->delete();
    return redirect()->to('/fasilitas-kamar');
    }
}