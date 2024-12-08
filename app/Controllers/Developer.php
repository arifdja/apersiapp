<?php

namespace App\Controllers;
use App\Models\ProvinsiModel;
use App\Models\DPDModel;
use App\Models\BankModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;

class Developer extends BaseController
{

    public function __construct()
    {
        $access = ['developer'];
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
		$menu = getMenu();

        $data = [
			'title' => 'Dashboard',
			'breadcrumb' => ['Developer','Dashboard'],
			'stringmenu' => $menu, 
        ];
        return view('developer/v_dashboard',$data);
	}

    public function form_pengajuan_pt()
	{
        $menu = getMenu();
        $model = new ProvinsiModel();
        $provinsi = $model->findAll();

        $model = new DPDModel();
        $dpd = $model->findAll();

        $model = new BankModel();
        $bank = $model->findAll();

        $dropdownprovinsi['provinsi'] = ['' => 'Pilih Provinsi'];
        foreach ($provinsi as $prov) {
            $dropdownprovinsi['provinsi'][$prov['id']] = $prov['namaprovinsi'];
        }

        $dropdowndpd['dpd'] = ['' => 'Pilih DPD'];
        foreach ($dpd as $dp) {
            $dropdowndpd['dpd'][$dp['id']] = $dp['namadpd'];
        }

        $dropdownbank['bank'] = ['' => 'Pilih Bank'];
        foreach ($bank as $b) {
            $dropdownbank['bank'][$b['kodebank']] = $b['kodebank'].' - '.$b['namabank'];
        }
        
        $data = [
			'title' => 'Form Pengajuan PT',
			'breadcrumb' => ['Pengajuan','PT'],
			'stringmenu' => $menu, 
			'dropdownprovinsi' => $dropdownprovinsi,
			'dropdowndpd' => $dropdowndpd,
			'dropdownbank' => $dropdownbank,
			'validation' => \Config\Services::validation(), 
        ];
		return view('developer/form_pengajuan_pt',$data);
    }

    public function pengajuan_pt_ajax()
	{
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }    

        $validationRules = [
            'nama_pt' => [
                'label' => 'Nama PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'lokasiref' => [
                'label' => 'Lokasi',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'detail_alamat' => [
                'label' => 'Detail Alamat',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'npwp_pt' => [
                'label' => 'NPWP PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkasnpwppt' => [
                'label' => 'NPWP PT',
                'rules' => 'uploaded[berkasnpwppt]|max_size[berkasnpwppt,10240]|ext_in[berkasnpwppt,pdf]|mime_in[berkasnpwppt,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'penanggung_jawab_pt' => [
                'label' => 'Penanggung Jawab PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'ktp_penanggung_jawab' => [
                'label' => 'KTP Penanggung Jawab',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkasktp_penanggung_jawab' => [
                'label' => 'KTP Penanggung Jawab',
                'rules' => 'uploaded[berkasktp_penanggung_jawab]|max_size[berkasktp_penanggung_jawab,10240]|ext_in[berkasktp_penanggung_jawab,pdf]|mime_in[berkasktp_penanggung_jawab,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'npwp_penanggung_jawab' => [
                'label' => 'NPWP Penanggung Jawab',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkasnpwp_penanggung_jawab' => [
                'label' => 'NPWP Penanggung Jawab',
                'rules' => 'uploaded[berkasnpwp_penanggung_jawab]|max_size[berkasnpwp_penanggung_jawab,10240]|ext_in[berkasnpwp_penanggung_jawab,pdf]|mime_in[berkasnpwp_penanggung_jawab,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'akta_pendirian' => [
                'label' => 'Akta Pendirian',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkasakta_pendirian' => [
                'label' => 'Akta Pendirian PT',
                'rules' => 'uploaded[berkasakta_pendirian]|max_size[berkasakta_pendirian,10240]|ext_in[berkasakta_pendirian,pdf]|mime_in[berkasakta_pendirian,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'bank' => [
                'label' => 'Bank PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'rekening' => [
                'label' => 'Rekening PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkasrekening' => [
                'label' => 'Rekening PT',
                'rules' => 'uploaded[berkasrekening]|max_size[berkasrekening,10240]|ext_in[berkasrekening,pdf]|mime_in[berkasrekening,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pinjaman_kpl' => [
                'label' => 'Pinjaman KPL',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkaspinjaman_kpl' => [
                'label' => 'Pinjaman KPL',
                'rules' => 'uploaded[berkaspinjaman_kpl]|max_size[berkaspinjaman_kpl,10240]|ext_in[berkaspinjaman_kpl,pdf]|mime_in[berkaspinjaman_kpl,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pinjaman_kyg' => [
                'label' => 'Pinjaman KYG',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkaspinjaman_kyg' => [
                'label' => 'Pinjaman KYG',
                'rules' => 'uploaded[berkaspinjaman_kyg]|max_size[berkaspinjaman_kyg,10240]|ext_in[berkaspinjaman_kyg,pdf]|mime_in[berkaspinjaman_kyg,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pinjaman_lain' => [
                'label' => 'Pinjaman Lain',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkaspinjaman_lain' => [
                'label' => 'Pinjaman Lain',
                'rules' => 'uploaded[berkaspinjaman_lain]|max_size[berkaspinjaman_lain,10240]|ext_in[berkaspinjaman_lain,pdf]|mime_in[berkaspinjaman_lain,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ])->setStatusCode(400);

        } 

        

        $fileberkasnpwppt = $this->request->getFile('berkasnpwppt');
        $fileberkasktp_penanggung_jawab = $this->request->getFile('berkasktp_penanggung_jawab');
        $fileberkasnpwp_penanggung_jawab = $this->request->getFile('berkasnpwp_penanggung_jawab');
        $fileberkasakta_pendirian = $this->request->getFile('berkasakta_pendirian');
        $fileberkasrekening = $this->request->getFile('berkasrekening');
        $fileberkaspinjaman_kpl = $this->request->getFile('berkaspinjaman_kpl');
        $fileberkaspinjaman_kyg = $this->request->getFile('berkaspinjaman_kyg');
        $fileberkaspinjaman_lain = $this->request->getFile('berkaspinjaman_lain');

        
        if (
            $fileberkasnpwppt->isValid() && !$fileberkasnpwppt->hasMoved() &&
            $fileberkasktp_penanggung_jawab->isValid() && !$fileberkasktp_penanggung_jawab->hasMoved() &&
            $fileberkasnpwp_penanggung_jawab->isValid() && !$fileberkasnpwp_penanggung_jawab->hasMoved() &&
            $fileberkasakta_pendirian->isValid() && !$fileberkasakta_pendirian->hasMoved() &&
            $fileberkasrekening->isValid() && !$fileberkasrekening->hasMoved() &&
            $fileberkaspinjaman_kpl->isValid() && !$fileberkaspinjaman_kpl->hasMoved() &&
            $fileberkaspinjaman_kyg->isValid() && !$fileberkaspinjaman_kyg->hasMoved() &&
            $fileberkaspinjaman_lain->isValid() && !$fileberkaspinjaman_lain->hasMoved()
        ) {
            $uuid = generate_uuid();
            // Move the file to a permanent location
            $newfilenameberkasnpwppt = "npwppt_".$uuid."_".$fileberkasnpwppt->getRandomName();
            $newfilenameberkasktp_penanggung_jawab = "ktp_penanggungjawab_".$uuid."_".$fileberkasktp_penanggung_jawab->getRandomName();
            $newfilenameberkasnpwp_penanggung_jawab = "npwp_penanggungjawab_".$uuid."_".$fileberkasnpwp_penanggung_jawab->getRandomName();
            $newfilenameberkasakta_pendirian = "akta_pendirian_".$uuid."_".$fileberkasakta_pendirian->getRandomName();
            $newfilenameberkasrekening = "rekening_".$uuid."_".$fileberkasrekening->getRandomName();
            $newfilenameberkaspinjaman_kpl = "pinjaman_kpl_".$uuid."_".$fileberkaspinjaman_kpl->getRandomName();
            $newfilenameberkaspinjaman_kyg = "pinjaman_kyg_".$uuid."_".$fileberkaspinjaman_kyg->getRandomName();
            $newfilenameberkaspinjaman_lain = "pinjaman_lain_".$uuid."_".$fileberkaspinjaman_lain->getRandomName();
            
            $fileberkasnpwppt->move(WRITEPATH . 'uploads/npwp_pt', $newfilenameberkasnpwppt);
            $fileberkasktp_penanggung_jawab->move(WRITEPATH . 'uploads/ktp_penanggungjawab', $newfilenameberkasktp_penanggung_jawab);
            $fileberkasnpwp_penanggung_jawab->move(WRITEPATH . 'uploads/npwp_penanggungjawab', $newfilenameberkasnpwp_penanggung_jawab);
            $fileberkasakta_pendirian->move(WRITEPATH . 'uploads/akta_pendirian', $newfilenameberkasakta_pendirian);
            $fileberkasrekening->move(WRITEPATH . 'uploads/rekening', $newfilenameberkasrekening);
            $fileberkaspinjaman_kpl->move(WRITEPATH . 'uploads/pinjaman_kpl', $newfilenameberkaspinjaman_kpl);
            $fileberkaspinjaman_kyg->move(WRITEPATH . 'uploads/pinjaman_kyg', $newfilenameberkaspinjaman_kyg);
            $fileberkaspinjaman_lain->move(WRITEPATH . 'uploads/pinjaman_lain', $newfilenameberkaspinjaman_lain);
           
            $data = [
                "uuid" => $uuid,
                "uuiddeveloper" => session('uuid'),
                "namapt" => $this->request->getVar('nama_pt'),
                "alamatref" => $this->request->getVar('lokasiref'),
                "alamatinput" => $this->request->getVar('detail_alamat'),
                "npwppt" => $this->request->getVar('npwp_pt'),
                "berkasnpwp" => $newfilenameberkasnpwppt,
                "namapj" => $this->request->getVar('penanggung_jawab_pt'),
                "ktppj" => $newfilenameberkasktp_penanggung_jawab,
                "berkasktppj" => $newfilenameberkasktp_penanggung_jawab,
                "npwppj" => $this->request->getVar('npwp_penanggung_jawab'),
                "berkasnpwppj" => $newfilenameberkasnpwp_penanggung_jawab,
                "aktapendirian" => $this->request->getVar('akta_pendirian'),
                "berkasaktapendirian" => $newfilenameberkasakta_pendirian,
                "rekening" => $this->request->getVar('rekening'),
                "kodebank" => $this->request->getVar('bank'),
                "berkasrekening" => $newfilenameberkasrekening,
                "pinjamankpl" => $this->request->getVar('pinjaman_kpl'),
                "berkaspinjamankpl" => $newfilenameberkaspinjaman_kpl,
                "pinjamankyg" => $this->request->getVar('pinjaman_kyg'),
                "berkaspinjamankyg" => $newfilenameberkaspinjaman_kyg,
                "pinjamanlain" => $this->request->getVar('pinjaman_lain'),
                "berkaspinjamanlain" => $newfilenameberkaspinjaman_lain,
                "statusvalidator" => 0,
            ];

            $pt = new PTModel();
            $save = $pt->save($data);
            if ($save) { 
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan!',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => [
                        'simpan' => 'Gagal menyimpan data'
                    ]
                ])->setStatusCode(400);
            }

        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal menyimpan data'
                ]
            ])->setStatusCode(400);
        }
        
    }

    public function form_pengajuan_dana()
	{
        $menu = getMenu(); 

        $model = new PTModel();
        $pt = $model->findAll();

        $dropdownpt['pt'] = ['' => 'Pilih PT'];
        foreach ($pt as $pt) {
            $dropdownpt['pt'][$pt['uuid']] = $pt['namapt'];
        }

        $model = new DPDModel();
        $dpd = $model->findAll();

        $dropdowndpd['dpd'] = ['' => 'Pilih DPD/DPP/Korwil'];
        foreach ($dpd as $dpd) {
            $dropdowndpd['dpd'][$dpd['id']] = $dpd['namadpd'];
        }

        $model = new ProvinsiModel();
        $provinsi = $model->findAll();

        $dropdownprovinsi['provinsi'] = ['' => 'Pilih Provinsi'];
        foreach ($provinsi as $prov) {
            $dropdownprovinsi['provinsi'][$prov['id']] = $prov['namaprovinsi'];
        }
        
        $data = [
			'title' => 'Form Pengajuan Dana',
			'breadcrumb' => ['Pengajuan','Dana'],
			'stringmenu' => $menu, 
			'dropdownpt' => $dropdownpt,
			'dropdowndpd' => $dropdowndpd,
			'dropdownprovinsi' => $dropdownprovinsi,
			'validation' => \Config\Services::validation(), 
        ];
		return view('developer/form_pengajuan_dana',$data);
    }

    public function pengajuan_dana_ajax()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }    

        $validationRules = [
            'pt' => [
                'label' => 'Nama PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'suratpermohonan' => [
                'label' => 'Permohonan Pengajuan Pinjaman',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkassuratpermohonan' => [
                'label' => 'Berkas Permohonan Pengajuan Pinjaman',
                'rules' => 'uploaded[berkassuratpermohonan]|max_size[berkassuratpermohonan,10240]|ext_in[berkassuratpermohonan,pdf]|mime_in[berkassuratpermohonan,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                        'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'dpd' => [
                'label' => 'DPD/DPP/Korwil',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamatperumahanref' => [
                'label' => 'Lokasi',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'alamatperumahaninput' => [
                'label' => 'Detail Alamat',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkassiteplan' => [
                'label' => 'Site Plan',
                'rules' => 'uploaded[berkassiteplan]|max_size[berkassiteplan,10240]|ext_in[berkassiteplan,pdf]|mime_in[berkassiteplan,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'jumlahunit' => [
                'label' => 'Jumlah Unit',
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ])->setStatusCode(400);

        } 

        

        $fileberkassuratpermohonan = $this->request->getFile('berkassuratpermohonan');
        $fileberkassiteplan = $this->request->getFile('berkassiteplan');

        
        if (
            $fileberkassuratpermohonan->isValid() && !$fileberkassuratpermohonan->hasMoved() &&
            $fileberkassiteplan->isValid() && !$fileberkassiteplan->hasMoved()
        ) {
            $uuid = generate_uuid();
            // Move the file to a permanent location
            $newfilenameberkassuratpermohonan = "suratpermohonan_".$uuid."_".$fileberkassuratpermohonan->getRandomName();
            $newfilenameberkassiteplan = "siteplan_".$uuid."_".$fileberkassiteplan->getRandomName();
            
            $fileberkassuratpermohonan->move(WRITEPATH . 'uploads/surat_permohonan', $newfilenameberkassuratpermohonan);
            $fileberkassiteplan->move(WRITEPATH . 'uploads/site_plan', $newfilenameberkassiteplan);
           
            $data = [
                "uuid" => $uuid,
                "uuidpt" => $this->request->getVar('pt'),
                "suratpermohonan" => $this->request->getVar('suratpermohonan'),
                "berkassuratpermohonan" => $newfilenameberkassuratpermohonan,
                "alamatperumahanref" => $this->request->getVar('alamatperumahanref'),
                "alamatperumahaninput" => $this->request->getVar('alamatperumahaninput'),
                "dpd" => $this->request->getVar('dpd'),
                "berkassiteplan" => $newfilenameberkassiteplan,
                "jumlahunit" => $this->request->getVar('jumlahunit'),
                "statusvalidator" => 0 
            ];

            $headerpengajuan = new PengajuanModel();
            $save = $headerpengajuan->save($data);
            if ($save) { 
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan!',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => [
                        'simpan' => 'Gagal menyimpan data'
                    ]
                ])->setStatusCode(400);
            }

        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal menyimpan data'
                ]
            ])->setStatusCode(400);
        }

    }

    public function get_pt()
    {
        $uuid = $this->request->getPost('uuid');

        if(empty($uuid)){
            return $this->response->setJSON([
                'html' => '',
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }

        $pt = new PTModel();
        $data = $pt->join('ref_bank','ref_bank.kodebank = ref_pt.kodebank')
            ->where('uuid', $uuid)->first();

        $html = '<div id="divberkas" class="form-group">
                    <a href="'.base_url('download/akta_pendirian/'.$data['berkasaktapendirian']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef;">Akta Pendirian : '.$data['aktapendirian'].'</a>
                 
                    <a href="'.base_url('download/npwp_pt/'.$data['berkasnpwp']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef; margin-top: 10px;">NPWP PT : '.$data['npwppt'].'</a>
                 
                    <a href="'.base_url('download/rekening/'.$data['berkasrekening']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef; margin-top: 10px;">Rekening : '.$data['rekening'].' '.$data['namabank'].'</a>
                  
                    <a href="'.base_url('download/ktp_penanggungjawab/'.$data['berkasktppj']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef; margin-top: 10px;">Penanggung Jawab : '.$data['namapj'].'</a>
                 
                    <a href="'.base_url('download/npwp_penanggungjawab/'.$data['berkasnpwppj']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef; margin-top: 10px;">NPWP Penanggung Jawab : '.$data['npwppj'].'</a>
                 
                    <a href="'.base_url('download/pinjaman_kpl/'.$data['berkaspinjamankpl']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef; margin-top: 10px;">Pinjaman KPL : '.number_format($data['pinjamankpl'],0,',','.') .'</a>
                 
                    <a href="'.base_url('download/pinjaman_kyg/'.$data['berkaspinjamankyg']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef; margin-top: 10px;">Pinjaman KYG : '.number_format($data['pinjamankyg'],0,',','.') .'</a>
                  
                    <a href="'.base_url('download/pinjaman_lain/'.$data['berkaspinjamanlain']).'" class="form-control" style="text-decoration: none; background-color: #e9ecef; margin-top: 10px;">Pinjaman Lain : '.number_format($data['pinjamanlain'],0,',','.') .'</a>
                  </div>
                  
                  ';  

        return $this->response->setJSON(
            [
                'html' => $html,
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ]
        );
    }

    function monitoring_pengajuan_dana()
    {
        $menu = getMenu();
        $model = new PengajuanModel();
        $pengajuan = $model->getPengajuanDana();

        $data = [
            'title' => 'Monitoring Pengajuan Dana',
            'breadcrumb' => ['Monitoring','Pengajuan Dana'],
            'stringmenu' => $menu, 
            'pengajuan' => $pengajuan,
        ];
        return view('developer/v_pengajuan_dana',$data);
    }

    public function monitoring_detail_pengajuan_dana()
    {
        $menu = getMenu();

        $uuid = $this->request->getGet('uuid');

        $model = new PengajuanDetailModel();
        $pengajuandetail = $model->where('uuidheader',$uuid)->findAll();

        $data = [
            'title' => 'Monitoring Detail Pengajuan Dana',
            'breadcrumb' => ['Monitoring','Detail','Pengajuan Dana'],
            'stringmenu' => $menu, 
            'uuidheader' => $uuid,
            'pengajuandetail' => $pengajuandetail,
        ];
        return view('developer/v_detail_pengajuan_dana',$data);
    }

    
    public function form_tambah_unit()
	{
        $uuidheader = $this->request->getGet('uuidheader');
        

        $menu = getMenu();
        $model = new ProvinsiModel();
        $provinsi = $model->findAll();

        $model = new DPDModel();
        $dpd = $model->findAll();

        $model = new BankModel();
        $bank = $model->findAll();

        $dropdownprovinsi['provinsi'] = ['' => 'Pilih Provinsi'];
        foreach ($provinsi as $prov) {
            $dropdownprovinsi['provinsi'][$prov['id']] = $prov['namaprovinsi'];
        }

        $dropdowndpd['dpd'] = ['' => 'Pilih DPD'];
        foreach ($dpd as $dp) {
            $dropdowndpd['dpd'][$dp['id']] = $dp['namadpd'];
        }

        $dropdownbank['bank'] = ['' => 'Pilih Bank'];
        foreach ($bank as $b) {
            $dropdownbank['bank'][$b['kodebank']] = $b['kodebank'].' - '.$b['namabank'];
        }
        
        $data = [
			'title' => 'Form Tambah Unit',
			'breadcrumb' => ['Developer','Tambah Unit'],
			'stringmenu' => $menu, 
			'dropdownprovinsi' => $dropdownprovinsi,
			'dropdowndpd' => $dropdowndpd,
			'dropdownbank' => $dropdownbank,
			'uuidheader' => $uuidheader,
			'validation' => \Config\Services::validation(), 
        ];
		return view('developer/form_tambah_unit',$data);
    }
    
    
    public function tambah_unit_ajax()
	{
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }    

        $validationRules = [
            'uuidheader' => [
                'label' => 'UUID Header',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'sertifikat' => [
                'label' => 'Sertifikat',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkassertifikat' => [
                'label' => 'Sertifikat',
                'rules' => 'uploaded[berkassertifikat]|max_size[berkassertifikat,10240]|ext_in[berkassertifikat,pdf]|mime_in[berkassertifikat,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pbb' => [
                'label' => 'PBB',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkaspbb' => [
                'label' => 'BerkasPBB',
                'rules' => 'uploaded[berkaspbb]|max_size[berkaspbb,10240]|ext_in[berkaspbb,pdf]|mime_in[berkaspbb,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'harga' => [
                'label' => 'Harga',
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'nilaikredit' => [
                'label' => 'Nilai Kredit',
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'sp3k' => [
                'label' => 'Dokumen SP3K',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'tanggalsp3k' => [
                'label' => 'Tanggal SP3K',
                'rules' => 'trim|required|date',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'date' => '{field} harus berformat tanggal'
                ]
            ],
            'berkassp3k' => [
                'label' => 'Dokumen SP3K',
                'rules' => 'uploaded[berkassp3k]|max_size[berkassp3k,10240]|ext_in[berkassp3k,pdf]|mime_in[berkassp3k,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'debitur' => [
                'label' => 'Nama Debitur',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkasktpdebitur' => [
                'label' => 'KTP Debitur',
                'rules' => 'uploaded[berkasktpdebitur]|max_size[berkasktpdebitur,10240]|ext_in[berkasktpdebitur,pdf]|mime_in[berkasktpdebitur,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'bank' => [
                'label' => 'Bank',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'rekening' => [
                'label' => 'Rekening Debitur',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
                ],
            'berkasrekening' => [
                'label' => 'Berkas Rekening Debitur',
                'rules' => 'uploaded[berkasrekening]|max_size[berkasrekening,10240]|ext_in[berkasrekening,pdf]|mime_in[berkasrekening,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ])->setStatusCode(400);

        } 

        $fileberkassertifikat = $this->request->getFile('berkassertifikat');
        $fileberkaspbb = $this->request->getFile('berkaspbb');
        $fileberkassp3k = $this->request->getFile('berkassp3k');
        $fileberkasktpdebitur = $this->request->getFile('berkasktpdebitur');
        $fileberkasrekening = $this->request->getFile('berkasrekening');
        $uuidheader = $this->request->getVar('uuidheader');

        // var_dump($uuidheader);
        // die();

        
        if (
            $fileberkassertifikat->isValid() && !$fileberkassertifikat->hasMoved() &&
            $fileberkaspbb->isValid() && !$fileberkaspbb->hasMoved() &&
            $fileberkassp3k->isValid() && !$fileberkassp3k->hasMoved() &&
            $fileberkasktpdebitur->isValid() && !$fileberkasktpdebitur->hasMoved() &&
            $fileberkasrekening->isValid() && !$fileberkasrekening->hasMoved()
        ) {
            $uuid = generate_uuid();
            // Move the file to a permanent location
            $newfilenameberkassertifikat = "sertifikat_".$uuid."_".$fileberkassertifikat->getRandomName();
            $newfilenameberkaspbb = "pbb_".$uuid."_".$fileberkaspbb->getRandomName();
            $newfilenameberkassp3k = "sp3k_".$uuid."_".$fileberkassp3k->getRandomName();
            $newfilenameberkasktpdebitur = "ktpdebitur_".$uuid."_".$fileberkasktpdebitur->getRandomName();
            $newfilenameberkasrekening = "rekeningdebitur_".$uuid."_".$fileberkasrekening->getRandomName();
            
            $fileberkassertifikat->move(WRITEPATH . 'uploads/sertifikat', $newfilenameberkassertifikat);
            $fileberkaspbb->move(WRITEPATH . 'uploads/pbb', $newfilenameberkaspbb);
            $fileberkassp3k->move(WRITEPATH . 'uploads/sp3k', $newfilenameberkassp3k);
            $fileberkasktpdebitur->move(WRITEPATH . 'uploads/ktp_debitur', $newfilenameberkasktpdebitur);
            $fileberkasrekening->move(WRITEPATH . 'uploads/rekening_debitur', $newfilenameberkasrekening);
           
            

            try {
                $data = [
                    "uuid" => $uuid,
                    "uuidheader" => $uuidheader,
                    "sertifikat" => $this->request->getVar('sertifikat'),
                    "berkassertifikat" => $newfilenameberkassertifikat,
                    "pbb" => $this->request->getVar('pbb'),
                    "berkaspbb" => $newfilenameberkaspbb,
                    "harga" => $this->request->getVar('harga'),
                    "nilaikredit" => $this->request->getVar('nilaikredit'),
                    "nomordokumensp3k" => $this->request->getVar('sp3k'),
                    "tanggalsp3k" => $this->request->getVar('tanggalsp3k'),
                    "berkassp3k" => $newfilenameberkassp3k,
                    "namadebitur" => $this->request->getVar('debitur'),
                    "berkasktpdebitur" => $newfilenameberkasktpdebitur,
                    "bank" => $this->request->getVar('bank'),
                    "rekening" => $this->request->getVar('rekening'),
                    "berkasrekening" => $newfilenameberkasrekening,
                    "statusvalidator" => 0,
                ];

                // dd($data);

                $pdm = new PengajuanDetailModel();
                $save = $pdm->save($data);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan!',
                    'csrfName' => csrf_token(), 
                    'csrfHash' => csrf_hash(),
                ]);

            } catch (DatabaseException $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => [
                        'simpan' => $e->getMessage()
                    ],
                    'csrfName' => csrf_token(), 
                    'csrfHash' => csrf_hash(),
                ])->setStatusCode(400);
            }

        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal menyimpan data'
                ],
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }
        
    }

    
    function monitoring_pengajuan_pt()
    {
        $menu = getMenu();
        $model = new PTModel();
        $pengajuan = $model->getPengajuanPT();

        $data = [
            'title' => 'Monitoring Pengajuan PT',
            'breadcrumb' => ['Monitoring','Pengajuan PT'],
            'stringmenu' => $menu, 
            'pengajuan' => $pengajuan,
        ];
        return view('developer/v_pengajuan_pt',$data);
    }




}
