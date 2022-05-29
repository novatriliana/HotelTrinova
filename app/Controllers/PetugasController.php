<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Petugas;
use App\Models\Kamar;

class PetugasController extends BaseController
{
    public function index()
    {
        return view('v_login');
    }
        public function login(){
        $Datapetugas = New Petugas;
        $syarat = [ 'username'=>
        $this->request->getPost('txtUsername'),
                            'password'=>
        md5($this->request->getPost('txtPassword'))
                            ];                        
        $Userpetugas =
        $Datapetugas->where($syarat)->find();
        if(count($Userpetugas)==1){
            $session_data=[
            'username' => $Userpetugas[0]['username'],
// 'id_petugas' => $Userpetugas[0]['id_petugas'],
                'level' => $Userpetugas[0]['level'],
                'sudahkahLogin' => TRUE
                ];
        session()->set($session_data);
        if (session()->get('level') == 'admin') {
        return redirect()->to('/petugas/dashboard');
        }else{
        return redirect()->to('/resepsionis/dashboard');
    }
    }else{
    session()->setFlashdata('salahLogin', 'Username atau Password Anda salah.'); 
    return redirect()->to('/petugas');
}
}
    public function logout(){
    session()->destroy();
    return redirect()->to('/login');
    }
    public function tampilKamar()
{
    if(!session()->get('sudahkahLogin')){
    return redirect()->to('/petugas');
    exit;
}
    // cek apakah yang login bukan admin ?
    if(session()->get('level')!='admin'){
    return redirect()->to('/kamar/dashboard');
    exit;
    }
$DataKamar = New Kamar;
$data['ListKamar'] = $DataKamar->findAll();
return view('Kamar/tampil-kamar', $data);
}
        public function tambahkamar(){
        if(!session()->get('sudahkahLogin')){
        return redirect()->to('/petugas');
        exit;
        }
        // cek apakah yang login bukan admin ?
        if(session()->get('level')!='admin'){
        return redirect()->to('/petugas/dashboard');
        exit;
        }
        return view('Kamar/tambah-kamar');    
    }
    public function simpanKamar(){
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
        $Datakamar=new Kamar;
        $upload = $this->request->getFile('txtInputFoto');
        $upload->move(WRITEPATH. '../public/gambar/');
        $datanya=[
            'id'=>$this->request->getPost('txtInputId'),
            'no_kamar'=>$this->request->getPost('txtInputNoKamar'),
            'type_kamar'=>$this->request->getPost('txtInputTipeKamar'),
            'deskripsi'=>$this->request->getPost('txtInputDeskripsi'),
            'foto'=>$upload->getName()
            ];
        $Datakamar->insert($datanya);
        return redirect()->to('/kamar');
}
   
        public function editkamar($id_kamar){
        if(session()->get('sudahkah login')){
        return redirect()->to('/petugas');
        exit;
                }
            // cek apakah yang login bukan admin ?
            if(session()->get('level')!='admin'){
            return redirect()->to('/petugas/dashboard');
            exit;
            }
            $Datakamar=new Kamar;
            $data['detailKamar'] = $Datakamar->where('id_kamar', $id_kamar)->findAll();
            return view('Kamar/edit-kamar', $data);
        }
            public function editfoto($id_kamar){ 
                // cek apakah sudah login ?
                     if(!session()->get('sudahkahLogin')){
                          return redirect()->to('/petugas'); 
                          exit; }
                          
                        // cek apakah yang login bukan admin ?
                        if(session()->get('level')!='admin'){ 
                            return redirect()->to('/petugas/dashboard'); 
                            exit; }
                        // cek apakah yang login bukan admin ? 
                        if(session()->get('level')!='admin'){
                            return redirect()->to('/petugas/dashboard');
                            exit; }
                        $Datakamar = New Kamar;
                        $data['detailkamar']=$Datakamar->where('id_kamar',$id_kamar)->findAll();
                        return view('Kamar/edit-foto',$data); }

        public function updatekamar(){
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
            $Datakamar = New Kamar;
            helper(['form']);
            $data=[
            'type_kamar'=>$this->request->getPost('txtInputTipeKamar'),
            'deskripsi'=>$this->request->getPost('txtInputDeskripsiKamar'),
        ];
            $Datakamar->update($this->request->getPost('txtInputNoKamar'),$data);
            return redirect()->to('/kamar');
            
        }             
        public function updatefoto(){ // cek apakah sudah login 
            if(!session()->get('sudahkahLogin')){
                return redirect()->to('/petugas'); exit; }
        // cek apakah yang login bukan admin ? 
        if(session()->get('level')!='admin'){
            return redirect()->to('/petugas/dashboard');
            exit; }
            
            helper(['form']);
           $Datakamar = New Kamar;
           $syarat=$this->request->getPost('foto');
           unlink('gambar/'.$syarat);
           $upload = $this->request->getFile('txtinputfoto');
            $upload->move(WRITEPATH . '../public/gambar/');
            $data=['foto'=> $upload->getName()];
            $this->kamar->update($this->request->getPost('txtinputnokamar'),$data);
            return redirect()->to('/kamar')->with('berhasil', 'Data Berhasil di update'); 
                }
        // hapus kamar
        public function hapusKamar($id_kamar)
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
    $Datakamar = New Kamar;
    $Datakamar->where('id_kamar',$id_kamar)->delete();
    return redirect()->to('/kamar');
    }
}