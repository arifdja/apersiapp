<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;
use App\Models\PendanaModel;

class Pendana extends BaseController
{
    public function __construct()
    {
        $access = ['pendana'];
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
			'breadcrumb' => ['Pendana','Welcome'],
			'stringmenu' => $menu, 
        ];
        return view('v_welcome',$data);
    }
    
    public function list_developer()
    {
		$menu = getMenu();
        $userModel = new UserModel();
        $developer = $userModel->getDeveloperByPendana();
        // dd($developer);
        
        $data = [
			'title' => 'Monitoring Pengajuan Dana',
			'breadcrumb' => ['Monitoring','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $developer
        ];

        return view('operator/list_developer', $data);
    }

    
    public function developer()
    {
		$menu = getMenu();
        $model = new UserModel();
        $developer = $model->getDeveloperByPendana();

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
        $pt = $model->getPTByPendana();

        $data = [
			'title' => 'PT',
			'breadcrumb' => ['Data','PT'],
			'stringmenu' => $menu, 
            'result' => $pt,
        ];
        return view('operator/p_pendaftaran_pt',$data);
	}
    
    public function permintaan_dana()
    {
       
		$menu = getMenu();
        $model = new PengajuanModel();
        $dana = $model->getPengajuanDana();

        // dd($dana);

        $data = [
			'title' => 'Persetujuan Pengajuan Dana',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $dana,
        ];
        return view('operator/u_pengajuan_dana',$data);
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

    public function danai_pengajuan()
    {

        // echo "tes";
        // die();
        // Validasi request AJAX
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        // Validasi input
        $uuid = $this->request->getPost('uuid');
        $userModel = new UserModel();
        $developer = $userModel->getDeveloperByUUIDPengajuan($uuid);
        $uuiddeveloper = $developer['uuid'];

        if(empty($uuid)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'UUID harus diisi!'
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
        if($pengajuan['submited_status'] != 5){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Status pengajuan tidak valid!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }

        $datetime = date('Y-m-d H:i:s');
     
        // Update data pengajuan
        $data = [
            'submited_status' => 6,
            'submited_time' => $datetime,
            'submited_by' => session()->get('uuid')
        ];
        
        try {
            $update = $pengajuanmodel->where('uuid',$uuid)->set($data)->update();
            
            if (!$update) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => [
                        'simpan' => 'Gagal danai pengajuan!'
                    ],
                    'csrfHash' => csrf_hash(),
                    'csrfToken' => csrf_token(),
                    'uuid' => $uuid
                ])->setStatusCode(400);
            }

            // Update detail pengajuan
            $datadetail = [
                'submited_status' => 6,
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
                    AND statusapprover = 1";
                    
            $updatedetail = $pengajuanDetail->query($sql);
            
            setNotifikasi($uuiddeveloper, 'Pengajuan Dana', 'Pengajuan dana telah disetujui Pendana', '/developer/monitoring_pengajuan_dana');
            setNotifikasi(env('uuidapprover'), 'Pengajuan Dana', 'Pengajuan dana '.$developer['nama'].' telah disetujui Pendana', '/approver/approval_dana/'.$uuiddeveloper);


            if (!$updatedetail) {
                throw new \Exception('Gagal update detail pengajuan!');
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Pengajuan berhasil danai!',
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
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