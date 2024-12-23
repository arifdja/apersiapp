<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;
use App\Models\PendanaModel;

class Approver extends BaseController
{
    public function __construct()
    {
        $access = ['approver'];
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
			'breadcrumb' => ['Approver','Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }

    public function dashboard()
	{
		$menu = getMenu();

        $data = [
			'title' => 'Dashboard',
			'breadcrumb' => ['Approver','Dashboard'],
			'stringmenu' => $menu, 
        ];
        return view('approver/v_dashboard',$data);
	}

    
    public function developer()
    {
		$menu = getMenu();
        $model = new UserModel();
        $developer = $model->getDeveloper();

        $data = [
			'title' => 'Developer',
			'breadcrumb' => ['Data','Developer'],
			'stringmenu' => $menu, 
            'result' => $developer,
        ];
        return view('operator/p_pendaftaran_developer',$data);
    }

    public function pt()
	{
		$menu = getMenu();
        $model = new PTModel();
        $pt = $model->getPengajuanPT();

        $data = [
			'title' => 'PT',
			'breadcrumb' => ['Data','PT'],
			'stringmenu' => $menu, 
            'result' => $pt,
        ];
        return view('operator/p_pendaftaran_pt',$data);
	}

    public function list_developer()
    {
		$menu = getMenu();
        $userModel = new UserModel();
        $developer = $userModel->getDeveloper();
        
        $data = [
			'title' => 'Persetujuan Pengajuan Dana',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $developer
        ];

        return view('operator/list_developer', $data);
    }

    public function approval_dana($uuid)
	{

		$menu = getMenu();
        $model = new PengajuanModel();
        $dana = $model->getPengajuanDana($uuid);

        $pendanaModel = new PendanaModel();
        $pendana = $pendanaModel->findAll();

        $dropdownpendana['pendana'] = ['' => 'Pilih Pendana'];
        foreach ($pendana as $p) {
            $dropdownpendana['pendana'][$p['uuid']] = $p['nama'];
        }

        $data = [
			'title' => 'Persetujuan Pengajuan Dana',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $dana,
            'dropdownpendana' => $dropdownpendana
        ];
        return view('operator/p_pengajuan_dana',$data);
	}

    
    public function setujui_pengajuan_dana()
    {
        
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
        
        
        $pengajuanmodel = new PengajuanModel();
        $pengajuan = $pengajuanmodel->where('uuid',$uuid)->first();

        if(empty($pengajuan)){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Data pengajuan tidak ditemukan!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }
        //check status pengajuan harus 1
        if($pengajuan['submited_status'] != 3 ){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Pengajuan sudah disetujui!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }
     
        $data = [
            'submited_status' => 4,
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
            'statusapprover' => 1,
            'approved_at' => date('Y-m-d H:i:s'),
            'approved_by' => session()->get('uuid'),
            'submited_status' => 4,
            'submited_time' => date('Y-m-d H:i:s'),
            'submited_by' => session()->get('uuid'),
        ];

        $pengajuanDetail = new PengajuanDetailModel();
        $uuidpengajuan = $pengajuanDetail->select('uuid')->where('uuidheader',$uuid)->findAll();
       
        $uuidpengajuan = array_column($uuidpengajuan,'uuid');

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
                'message' => 'Data berhasil disetujui!',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(200);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Data gagal disetujui!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
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

    
    public function kirimkependana()
    {
        // Validasi request AJAX
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        // Validasi input
        $uuid = $this->request->getPost('uuid');
        $pendana = $this->request->getPost('pendana');
        $pendanaText = $this->request->getPost('pendanaText');

        if(empty($uuid) || empty($pendana)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'UUID dan Pendana harus diisi!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token()
            ])->setStatusCode(400);
        }

        // Get data pengajuan
        $pengajuanmodel = new PengajuanModel();
        $pengajuan = $pengajuanmodel->where('uuid',$uuid)->first();

        if(empty($pengajuan)){
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => [
                    'simpan' => 'Data pengajuan tidak ditemukan!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }

        // Validasi status pengajuan
        if($pengajuan['submited_status'] != 4){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Pengajuan belum disetujui!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }

        $datetime = date('Y-m-d H:i:s');
     
        // Update data pengajuan
        $data = [
            'submited_status' => 5,
            'submited_time' => $datetime,
            'submited_by' => session()->get('uuid'),
            'uuidpendana' => $pendana,
            'senttopendana_at' => $datetime,
            'senttopendana_by' => session()->get('uuid'),
        ];
        
        try {
            $update = $pengajuanmodel->where('uuid',$uuid)->set($data)->update();
            
            if (!$update) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => [
                        'simpan' => 'Gagal kirim ke pendana!'
                    ],
                    'csrfHash' => csrf_hash(),
                    'csrfToken' => csrf_token(),
                    'uuid' => $uuid
                ])->setStatusCode(400);
            }

            // Update detail pengajuan
            $datadetail = [
                'submited_status' => 5,
                'submited_time' => $datetime,
                'submited_by' => session()->get('uuid'),
            ];

            $pengajuanDetail = new PengajuanDetailModel();
            $uuidpengajuan = $pengajuanDetail->select('uuid')
                                           ->where('uuidheader',$uuid)
                                           ->findAll();
           
            if(empty($uuidpengajuan)) {
                throw new \Exception('Detail pengajuan tidak ditemukan!');
            }

            $uuidpengajuan = array_column($uuidpengajuan,'uuid');
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

            if (!$updatedetail) {
                throw new \Exception('Gagal update detail pengajuan!');
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil dikirim ke pendana!',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid,
                'pendanaText' => $pendanaText
            ])->setStatusCode(200);

        } catch(\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => $e->getMessage()
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }

    }



}
