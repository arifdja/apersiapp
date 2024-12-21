<?php

namespace App\Controllers;
use App\Models\ProvinsiModel;
use App\Models\DPDModel;
use App\Models\BankModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;
use App\Models\UserModel;
use App\Models\PendanaModel;

class Rumput extends BaseController
{
    
    public function __construct()
    {
        $access = ['rumput'];
		if (!in_array(session('kdgrpuser'),$access)) {
			echo view('errors/html/error_403');
			die();
		}
    }

    public function index(): string
    {
        $menu = getMenu();
        
        $data = [
			'title' => 'Welcome',
			'breadcrumb' => ['Developer','Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }

    public function form_manajemen_akun()
    {
        $menu = getMenu(); 

        $model = new UserModel();
        $user = $model->whereIn('kdgrpuser', ['developer', 'operator'])
            ->where('statusvalidator', 1)
            ->findAll();

        
        $data = [
			'title' => 'Manajemen Akun',
			'breadcrumb' => ['Manajemen','Akun'],
			'stringmenu' => $menu, 
			'result' => $user,
			'validation' => \Config\Services::validation(), 
        ];
		return view('rumput/form_manajemen_akun',$data);
    }

    public function form_manajemen_pendana()
    {
        $menu = getMenu();
        
        $model = new PendanaModel();
        $pendana = $model->findAll();
        
        $data = [
            'title' => 'Manajemen Pendana',
            'breadcrumb' => ['Manajemen','Pendana'],
            'stringmenu' => $menu,
            'result' => $pendana,
            'validation' => \Config\Services::validation(),
        ];
        return view('rumput/form_manajemen_pendana', $data);
    }

    public function save_pendana()
    {
        // Validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pendana harus diisi'
                ]
            ]
        ])) {
            return redirect()->to('/rumput/form_manajemen_pendana')->withInput();
        }

        $model = new PendanaModel();
        $data = [
            'uuid' => generate_uuid(),
            'nama' => $this->request->getVar('nama')
        ];
        
        $model->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/rumput/form_manajemen_pendana');
    }

    public function update_pendana()
    {
        // Validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama pendana harus diisi'
                ]
            ]
        ])) {
            return json_encode(['status' => false, 'message' => 'Validasi gagal']);
        }

        $model = new PendanaModel();
        $uuid = $this->request->getVar('uuid');
        $data = [
            'nama' => $this->request->getVar('nama')
        ];
        
        $model->set($data)->where('uuid', $uuid)->update();
        return json_encode(['status' => true, 'message' => 'Data berhasil diupdate']);
    }

    public function delete_pendana()
    {
        $model = new PendanaModel();
        $uuid = $this->request->getVar('uuid');
        
        $model->where('uuid', $uuid)->delete();
        return json_encode(['status' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function get_pendana()
    {
        $model = new PendanaModel();
        $uuid = $this->request->getVar('uuid');
        $data = $model->where('uuid', $uuid)->first();
        
        return json_encode($data);
    }

    public function getCSRF()
    {
        return json_encode(['token' => csrf_hash()]);
    }

    




}
