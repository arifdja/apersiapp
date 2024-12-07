<?php

namespace App\Controllers;
use App\Models\UserModel;

class Operator extends BaseController
{
    
    public function __construct()
    {
        $access = ['operator'];
		if (!in_array(session('kdgrpuser'),$access)) {
			echo view('errors/html/error_403');
			die();
		}
    }

    public function index(): string
    {
        $menu = getMenu();
        
        $data = [
            'title' => '',
			'breadcrumb' => ['Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }

    public function approvalDeveloper()
	{
		$menu = getMenu();
        $model = new UserModel();
        $developer = $model->getDeveloper();

        $data = [
			'title' => 'Approval Developer',
			'breadcrumb' => ['Approval','Pendaftaran Developer'],
			'stringmenu' => $menu, 
            'result' => $developer,
        ];
        return view('operator/p_pendaftaran_developer',$data);
	}

    public function do_approve_developer()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
        

        $data = [
            'statusvalidator' => 1,
            'approved_at' => date('Y-m-d H:i:s'),
            'approved_by' => session()->get('uuid')
        ];

        $user = new UserModel();
        $update = $user->where('uuid',$uuid)->set($data)->update();

        if ($update) { 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil disetujui!',
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'O01 Data gagal disetujui!'
                ],
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }
    }

    public function dont_approve_developer()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');

        $user = new UserModel();
        $userData = $user->where('uuid',$uuid)->first();

        $sendMail = sendMail($userData['email'],'Pengajuan Akun Developer Ditolak','Pengajuan developer dengan nama '.$userData['nama'].' ditolak oleh admin dengan keterangan penolakan '.$this->request->getPost('keteranganpenolakan'));

        $filePath = WRITEPATH . 'uploads/kta/'.$userData['berkaskta'];
        delete_file($filePath);

        $user = new UserModel();
        $delete = $user->where('uuid',$uuid)->delete();

        if ($delete) { 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil ditolak!',
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Data gagal ditolak!'
                ],
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }
    }




}
