<?php

namespace App\Controllers;

class Notifikasi extends BaseController
{
    public function __construct()
    {
        $access = ['developer','operator','approver','pendana'];
		if (!in_array(session('kdgrpuser'),$access)) {
			echo view('errors/html/error_403');
			die();
		}
    }

    public function index(): string
    {
        $menu = getMenu();
        $notifikasi = getNotifikasi(session()->get('uuid'), false);
        
        $data = [
            'title' => 'Notifikasi',
            'breadcrumb' => ['Notifikasi'],
            'stringmenu' => $menu,
            'notifikasi' => $notifikasi
        ];
        return view('notifikasi/v_notifikasi', $data);
    }

    public function tandai_dibaca()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $id = $this->request->getPost('id');
        
        $notifikasiModel = new \App\Models\NotifikasiModel();
        $update = $notifikasiModel->update($id, ['status' => 1]);

        if ($update) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Notifikasi ditandai sudah dibaca',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token()
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => 'Gagal menandai notifikasi',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token()
            ])->setStatusCode(400);
        }
    }

    public function tandai_semua_dibaca()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $notifikasiModel = new \App\Models\NotifikasiModel();
        $update = $notifikasiModel->where('uuid', session()->get('uuid'))
                                 ->set(['status' => 1])
                                 ->update();

        if ($update) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Semua notifikasi ditandai sudah dibaca',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token()
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menandai notifikasi',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token()
            ])->setStatusCode(400);
        }
    }


}
