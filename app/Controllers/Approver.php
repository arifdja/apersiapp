<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;

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


        $data = [
			'title' => 'Persetujuan Pengajuan Dana',
			'breadcrumb' => ['Persetujuan','Pengajuan Dana'],
			'stringmenu' => $menu, 
            'result' => $dana,
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



}
