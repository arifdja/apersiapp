<?php

namespace App\Controllers;
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
        $user = $model->whereIn('kdgrpuser', ['developer', 'operator', 'approver'])
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

    public function save_user()
    {
        // Validasi input
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'kdgrpuser' => [
                'rules' => 'required|in_list[developer,operator]',
                'errors' => [
                    'required' => 'Grup user harus dipilih',
                    'in_list' => 'Grup user tidak valid'
                ]
            ]
        ])) {
            return redirect()->to('/rumput/form_manajemen_akun')->withInput();
        }

        $model = new UserModel();
        $data = [
            'uuid' => generate_uuid(),
            'email' => $this->request->getVar('email'),
            'nama' => $this->request->getVar('nama'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'kdgrpuser' => $this->request->getVar('kdgrpuser'),
            'statusvalidator' => 1,
            'is_email_verified' => 1
        ];
        
        $model->insert($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/rumput/form_manajemen_akun');
    }

    public function update_user()
    {
        // Validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'kdgrpuser' => [
                'rules' => 'required|in_list[developer,operator]',
                'errors' => [
                    'required' => 'Grup user harus dipilih',
                    'in_list' => 'Grup user tidak valid'
                ]
            ]
        ])) {
            return json_encode(['status' => false, 'message' => 'Validasi gagal']);
        }

        $model = new UserModel();
        $uuid = $this->request->getVar('uuid');
        $data = [
            'nama' => $this->request->getVar('nama'),
            'kdgrpuser' => $this->request->getVar('kdgrpuser')
        ];

        // Jika password diisi, update password
        if ($this->request->getVar('password')) {
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }
        
        $model->set($data)->where('uuid', $uuid)->update();
        return json_encode(['status' => true, 'message' => 'Data berhasil diupdate']);
    }

    public function delete_user()
    {
        $model = new UserModel();
        $uuid = $this->request->getVar('uuid');
        $data = $model->where('uuid', $uuid)->first();
        $email_token_expired = $data['email_token_expired'];
        $current_time = date('Y-m-d H:i:s');
        if ($email_token_expired > $current_time) {
            return json_encode(['status' => false, 'message' => 'Token email belum kedaluwarsa']);
        }
        
        $model->where('uuid', $uuid)->delete();
        return json_encode(['status' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function get_user()
    {
        $model = new UserModel();
        $uuid = $this->request->getVar('uuid');
        $data = $model->where('uuid', $uuid)->first();
        
        // Hapus password dari response
        unset($data['password']);
        
        return json_encode($data);
    }

    




}
