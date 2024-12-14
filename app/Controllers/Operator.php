<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;

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

    public function dashboard()
    {
        $model = new DashboardModel();
        $reportunit = $model->getReportUnit();
        $reportuser = $model->getReportUser();
        $reportpt = $model->getReportPT();

        $menu = getMenu();
        $data = [
            'title' => '',
            'breadcrumb' => ['Dashboard'],
            'stringmenu' => $menu, 
            'reportunit' => $reportunit,
            'reportuser' => $reportuser,
            'reportpt' => $reportpt
        ];
        return view('operator/v_dashboard',$data);
    }

    public function approval_developer()
	{
		$menu = getMenu();
        $model = new UserModel();
        $developer = $model->getDeveloper();

        $data = [
			'title' => 'Persetujuan Pendaftaran Developer',
			'breadcrumb' => ['Persetujuan','Pendaftaran Developer'],
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
        $userData = $user->where('uuid',$uuid)->first();
        $update = $user->where('uuid',$uuid)->set($data)->update();

        if ($update) { 
            
            $sendMail = sendMail($userData['email'],'Pengajuan Akun Developer Disetujui','Pengajuan developer dengan userid '.$userData['email'].' telah disetujui oleh admin. Silahkan login dengan password yang diisi pada saat pendaftaran. Anda juga bisa merubah password melalui fitur lupa password.');

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

        $sendMail = sendMail($userData['email'],'Pengajuan Akun Developer Ditolak','Pengajuan developer dengan nama '.$userData['nama'].' ditolak oleh admin dengan keterangan penolakan "'.$this->request->getPost('keteranganpenolakan').'". Silahkan ajukan ulang pendaftaran developer.');

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

    
    public function approval_pt()
	{
		$menu = getMenu();
        $model = new PTModel();
        $pt = $model->getPengajuanPT();

        $data = [
			'title' => 'Persetujuan Pendaftaran PT',
			'breadcrumb' => ['Persetujuan','Pendaftaran PT'],
			'stringmenu' => $menu, 
            'result' => $pt,
        ];
        return view('operator/p_pendaftaran_pt',$data);
	}

    public function do_approve_pt()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
        $uuiddeveloper = $this->request->getPost('uuiddeveloper');

        $data = [
            'statusvalidator' => 1,
            'validated_at' => date('Y-m-d H:i:s'),
            'validated_by' => session()->get('uuid')
        ];

        $user = new UserModel();
        $userData = $user->where('uuid',$uuiddeveloper)->first();

        $pt = new PTModel();
        $ptData = $pt->where('uuid',$uuid)->first();
        $update = $pt->where('uuid',$uuid)->set($data)->update();

        if ($update) {
            
            $sendMail = sendMail($userData['email'],'Pengajuan PT Disetujui','Pengajuan PT '.$ptData['namapt'].' telah disetujui oleh admin.');
 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil disetujui!',
                'csrf' => csrf_hash(),
                'uuid' => $uuid,
                'uuiddeveloper' => $uuiddeveloper
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

    public function dont_approve_pt()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
        $uuiddeveloper = $this->request->getPost('uuiddeveloper');

        $user = new UserModel();
        $userData = $user->where('uuid',$uuiddeveloper)->first();
        
        $pt = new PTModel();
        $ptData = $pt->where('uuid',$uuid)->first();

        $sendMail = sendMail($userData['email'],'Pengajuan PT Ditolak','Pengajuan PT '.$ptData['namapt'].' ditolak oleh admin dengan keterangan penolakan '.$this->request->getPost('keteranganpenolakan'));

        // $filePath = WRITEPATH . 'uploads/kta/'.$userData['berkaskta'];
        // delete_file($filePath);
        
        $data = [
            'statusvalidator' => 2,
            'validated_at' => date('Y-m-d H:i:s'),
            'validated_by' => session()->get('uuid'),
            'keteranganpenolakan' => $this->request->getPost('keteranganpenolakan')
        ];

        $pt = new PTModel();
        $update = $pt->where('uuid',$uuid)->set($data)->update();

        if ($update) { 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'PT berhasil ditolak!',
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'PT gagal ditolak!'
                ],
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }
    }

    
    public function approval_dana($uuid)
	{
        // dd($uuid);

		$menu = getMenu();
        $model = new PengajuanModel();
        $dana = $model->getPengajuanDana($uuid);

        // dd($dana);

        $data = [
			'title' => 'Persetujuan Pengajuan Dana',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $dana,
        ];
        return view('operator/p_pengajuan_dana',$data);
	}

    public function do_approve_dana()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
        

        $data = [
            'statusvalidator' => 1,
            'validated_at' => date('Y-m-d H:i:s'),
            'validated_by' => session()->get('uuid')
        ];

        $pt = new PTModel();
        $update = $pt->where('uuid',$uuid)->set($data)->update();

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

    public function dont_approve_dana()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');

        $pt = new PTModel();
        $ptData = $pt->where('uuid',$uuid)->first();
        
        $data = [
            'statusvalidator' => 2,
            'validated_at' => date('Y-m-d H:i:s'),
            'validated_by' => session()->get('uuid'),
            'keteranganpenolakan' => $this->request->getPost('keteranganpenolakan')
        ];

        $pt = new PTModel();
        $update = $pt->where('uuid',$uuid)->set($data)->update();

        if ($update) { 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'PT berhasil ditolak!',
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'PT gagal ditolak!'
                ],
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }
    }

    public function approval_unit()
	{
        $uuid = $this->request->getGet('uuid');

		$menu = getMenu();
        $model = new PengajuanDetailModel();
        $unit = $model->getPengajuanUnit($uuid);

        $data = [
			'title' => 'Persetujuan Pengajuan Unit',
			'breadcrumb' => ['Persetujuan','Pengajuan Unit'],
			'stringmenu' => $menu, 
            'result' => $unit
        ];
        return view('operator/p_pengajuan_unit',$data);
	}

    private function template_approval($type,$action)
    {
        
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'keteranganpenolakan' => [
                'rules' => 'trim|permit_empty|max_length[255]',
                'errors' => [
                    'max_length' => 'Keterangan penolakan tidak boleh lebih dari 255 karakter'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $validation->getError('keteranganpenolakan'),
                'csrf' => csrf_hash()
            ])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');

        $pt = new PengajuanDetailModel();
        $ptData = $pt->where('uuid',$uuid)->first();

        switch($type){
            case 'validator':
                $data = [
                    'statusvalidator' => ($action == 'approve') ? 1 : 2,
                    'validated_at' => date('Y-m-d H:i:s'),
                    'validated_by' => session()->get('uuid'),
                    'keteranganpenolakan' => ($action == 'approve') ? '' : $this->request->getPost('keteranganpenolakan')
                ];
                $keteranganpenolakan = $data['keteranganpenolakan'];
                break;
            case 'sikumbang':
                $data = [
                    'statussikumbang' => ($action == 'approve') ? 1 : 2,
                    'validated_sikumbang_at' => date('Y-m-d H:i:s'),
                    'validated_sikumbang_by' => session()->get('uuid'),
                    'kettolaksikumbang' => ($action == 'approve') ? '' : $this->request->getPost('keteranganpenolakan')
                ];
                $keteranganpenolakan = $data['kettolaksikumbang'];
                break;
            case 'eflpp':
                $data = [
                    'statuseflpp' => ($action == 'approve') ? 1 : 2,
                    'validated_eflpp_at' => date('Y-m-d H:i:s'),
                    'validated_eflpp_by' => session()->get('uuid'),
                    'kettolakeflpp' => ($action == 'approve') ? '' : $this->request->getPost('keteranganpenolakan')
                ];
                $keteranganpenolakan = $data['kettolakeflpp'];
                break;
            case 'sp3k':
                $data = [
                    'statussp3k' => ($action == 'approve') ? 1 : 2,
                    'validated_sp3k_at' => date('Y-m-d H:i:s'),
                    'validated_sp3k_by' => session()->get('uuid'),
                    'kettolaksp3k' => ($action == 'approve') ? '' : $this->request->getPost('keteranganpenolakan')
                ];
                $keteranganpenolakan = $data['kettolaksp3k'];
                break;
            case 'approver':
                $data = [
                    'statusapprover' => ($action == 'approve') ? 1 : 2,
                    'approved_at' => date('Y-m-d H:i:s'),
                    'approved_by' => session()->get('uuid'),
                    'kettolakapprover' => ($action == 'approve') ? '' : $this->request->getPost('keteranganpenolakan')
                ];
                $keteranganpenolakan = $data['kettolakapprover'];
                break;
        }

        // dd($data);

        $pt = new PengajuanDetailModel();
        $update = $pt->where('uuid',$uuid)->set($data)->update();
        // dd($update);
        if ($update) { 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => $keteranganpenolakan,
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal '.$action.' data!'
                ],
                'csrf' => csrf_hash(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }
    }

    public function do_approve_unit($type,$action)
    {
        return $this->template_approval($type,$action);
    }

    public function do_reject_unit($type,$action)
    {
        return $this->template_approval($type,$action);
    }

    public function list_developer()
    {
		$menu = getMenu();
        $userModel = new UserModel();
        $developer = $userModel->getDeveloper();
        
        $data = [
			'title' => 'Daftar Developer',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $developer
        ];

        return view('operator/list_developer', $data);
    }

    public function kembalikan_pengajuan_dana()
    {
        
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        // $validation = \Config\Services::validation();
        // $validation->setRules([
        //     'keteranganpenolakan' => [
        //         'rules' => 'trim|permit_empty|max_length[255]',
        //         'errors' => [
        //             'max_length' => 'Keterangan penolakan tidak boleh lebih dari 255 karakter'
        //         ]
        //     ]
        // ]);

        // if (!$validation->withRequest($this->request)->run()) {
        //     return $this->response->setJSON([
        //         'status' => 'error',
        //         'message' => $validation->getError('keteranganpenolakan'),

        $uuid = $this->request->getPost('uuid');
        $data = [
            'submited_status' => 2,
            'submited_time' => date('Y-m-d H:i:s'),
            'submited_by' => session()->get('uuid'),
        ];
        
        $pengajuan = new PengajuanModel();
        $update = $pengajuan->where('uuid',$uuid)->set($data)->update();

        if (!$update) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal mengembalikan data!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }

        $datadetail = [
            'statusvalidator' => 0,
            'statussikumbang' => 0,
            'statuseflpp' => 0,
            'statussp3k' => 0,
            'submited_status' => 2,
            'submited_time' => date('Y-m-d H:i:s'),
            'submited_by' => session()->get('uuid'),
        ];

        $pengajuanDetail = new PengajuanDetailModel();
        $uuidpengajuan = $pengajuanDetail->select('uuid')->where('uuidheader',$uuid)->findAll();
        $uuidpengajuan = array_column($uuidpengajuan,'uuid');
        //update status pengajuan detail menjadi 2
        $pengajuanDetail->whereIn('uuid',$uuidpengajuan)->set('submited_status',2)->update();

        $uuidList = "'" . implode("','", $uuidpengajuan) . "'";
        $setClause = [];
        foreach ($datadetail as $key => $value) {
            $setClause[] = "$key = " . (is_string($value) ? "'$value'" : $value);
        }
        $setString = implode(", ", $setClause);
        
        $sql = "UPDATE trx_pengajuan_detail 
                SET $setString
                WHERE uuid IN ($uuidList)
                AND (statusvalidator != 1 
                OR statussikumbang != 1
                OR statuseflpp != 1 
                OR statussp3k != 1)";
              
                
        $updatedetail = $pengajuanDetail->query($sql);

        if ($updatedetail) { 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil dikembalikan!',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal mengembalikan data!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }

    }

    
    public function teruskan_pengajuan_dana()
    {
        
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
     
        $data = [
            'submited_status' => 3,
            'submited_time' => date('Y-m-d H:i:s'),
            'submited_by' => session()->get('uuid'),
        ];
        
        $pengajuan = new PengajuanModel();
        $update = $pengajuan->where('uuid',$uuid)->set($data)->update();
        
        if (!$update) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal '.$type.' data!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }

        $datadetail = [
            'submited_status' => 3,
            'submited_time' => date('Y-m-d H:i:s'),
            'submited_by' => session()->get('uuid'),
        ];

        $pengajuanDetail = new PengajuanDetailModel();
        $uuidpengajuan = $pengajuanDetail->select('uuid')->where('uuidheader',$uuid)->findAll();
        $uuidpengajuan = array_column($uuidpengajuan,'uuid');
        $pengajuanDetail->whereIn('uuid',$uuidpengajuan)->set('submited_status',3)->update();

        $uuidList = "'" . implode("','", $uuidpengajuan) . "'";
        $setClause = [];
        foreach ($datadetail as $key => $value) {
            $setClause[] = "$key = " . (is_string($value) ? "'$value'" : $value);
        }
        $setString = implode(", ", $setClause);
        
        $sql = "UPDATE trx_pengajuan_detail 
                SET $setString
                WHERE uuid IN ($uuidList)
                AND (concat(statusvalidator,statussikumbang,statuseflpp,statussp3k) = '1111')";
                
        $updatedetail = $pengajuanDetail->query($sql);

        if ($updatedetail) { 
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diteruskan!',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Data gagal diteruskan!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
                
        }

    }

}
