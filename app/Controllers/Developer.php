<?php

namespace App\Controllers;
use App\Models\DPDModel;
use App\Models\BankModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;
use App\Models\DashboardModel;
use App\Models\UserModel;
use App\Models\WilayahModel;

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
        return view('developer/v_dashboard',$data);
	}

    public function form_pengajuan_pt()
	{
        $menu = getMenu();
        
        $data = [
			'title' => 'Form Pengajuan PT',
			'breadcrumb' => ['Pengajuan','PT'],
			'stringmenu' => $menu, 
			'dropdownprovinsi' => getDropdownProvinsi(),
			'dropdowndpd' => getDropdownDPD(),
			'dropdownbank' => getDropdownBank(),
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
                'rules' => 'trim|required|checkUniqueNamaPT',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'checkUniqueNamaPT' => '{field} sudah terdaftar'
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
                'rules' => 'trim|required|checkNPWPPT|min_length[15]|max_length[16]|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'checkNPWPPT' => 'Melihat data NPWP PT, PT sudah terdaftar pada sistem',
                    'min_length' => '{field} minimal 15 angka tanpa tanda penghubung atau titik',
                    'max_length' => '{field} maksimal 16 angka tanpa tanda penghubung atau titik',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'berkasnpwppt' => [
                'label' => 'NPWP PT',
                'rules' => 'uploaded[berkasnpwppt]|max_size[berkasnpwppt,1024]|ext_in[berkasnpwppt,pdf]|mime_in[berkasnpwppt,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 1 MB',
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
                'rules' => 'trim|required|exact_length[16]|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'exact_length' => '{field} harus 16 angka tanpa tanda penghubung atau titik',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'berkasktp_penanggung_jawab' => [
                'label' => 'KTP Penanggung Jawab',
                'rules' => 'uploaded[berkasktp_penanggung_jawab]|max_size[berkasktp_penanggung_jawab,1024]|ext_in[berkasktp_penanggung_jawab,pdf]|mime_in[berkasktp_penanggung_jawab,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 1 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'npwp_penanggung_jawab' => [
                'label' => 'NPWP Penanggung Jawab',
                'rules' => 'trim|required|min_length[15]|max_length[16]|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 15 angka tanpa tanda penghubung atau titik',
                    'max_length' => '{field} maksimal 16 angka tanpa tanda penghubung atau titik',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'berkasnpwp_penanggung_jawab' => [
                'label' => 'NPWP Penanggung Jawab',
                'rules' => 'uploaded[berkasnpwp_penanggung_jawab]|max_size[berkasnpwp_penanggung_jawab,1024]|ext_in[berkasnpwp_penanggung_jawab,pdf]|mime_in[berkasnpwp_penanggung_jawab,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 1 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pengurus_pt' => [
                'label' => 'Nama dan Jabatan Pengurus PT',
                'rules' => 'trim|required|max_length[600]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'max_length' => '{field} maksimal 600 karakter'
                ]
            ],
            'berkasnpwp_pengurus_pt' => [
                'label' => 'NPWP Pengurus PT',
                'rules' => 'uploaded[berkasnpwp_pengurus_pt]|max_size[berkasnpwp_pengurus_pt,5120]|ext_in[berkasnpwp_pengurus_pt,pdf]|mime_in[berkasnpwp_pengurus_pt,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 5 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'berkasktp_pengurus_pt' => [
                'label' => 'KTP Pengurus PT',
                'rules' => 'uploaded[berkasktp_pengurus_pt]|max_size[berkasktp_pengurus_pt,5120]|ext_in[berkasktp_pengurus_pt,pdf]|mime_in[berkasktp_pengurus_pt,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 5 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'berkasakta_pendirian' => [
                'label' => 'Akta Pendirian PT',
                'rules' => 'uploaded[berkasakta_pendirian]|max_size[berkasakta_pendirian,5120]|ext_in[berkasakta_pendirian,pdf]|mime_in[berkasakta_pendirian,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 5 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'berkasskkemenkumham' => [
                'label' => 'SK Kemenkumham',
                'rules' => 'uploaded[berkasskkemenkumham]|max_size[berkasskkemenkumham,5120]|ext_in[berkasskkemenkumham,pdf]|mime_in[berkasskkemenkumham,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 5 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'berkaslaporankeuangan' => [
                'label' => 'Laporan Keuangan 2 Tahun Terakhir',
                'rules' => 'permit_empty|max_size[berkaslaporankeuangan,10240]|ext_in[berkaslaporankeuangan,pdf]|mime_in[berkaslaporankeuangan,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'bank' => [
                'label' => 'Bank Operasional PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'rekening' => [
                'label' => 'Nomor Rekening PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'rekeningescrow' => [
                'label' => 'Nomor Rekening Escrow',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkasrekening' => [
                'label' => 'Rekening PT',
                'rules' => 'uploaded[berkasrekening]|max_size[berkasrekening,1024]|ext_in[berkasrekening,pdf]|mime_in[berkasrekening,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 1 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'berkasrekeningescrow' => [
                'label' => 'Rekening Escrow',
                'rules' => 'uploaded[berkasrekeningescrow]|max_size[berkasrekeningescrow,1024]|ext_in[berkasrekeningescrow,pdf]|mime_in[berkasrekeningescrow,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 1 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }

        try {
            $fileberkasnpwppt = $this->request->getFile('berkasnpwppt');
            $fileberkasktp_penanggung_jawab = $this->request->getFile('berkasktp_penanggung_jawab');
            $fileberkasnpwp_penanggung_jawab = $this->request->getFile('berkasnpwp_penanggung_jawab');
            $fileberkasktp_pengurus_pt = $this->request->getFile('berkasktp_pengurus_pt');
            $fileberkasnpwp_pengurus_pt = $this->request->getFile('berkasnpwp_pengurus_pt');
            $fileberkasakta_pendirian = $this->request->getFile('berkasakta_pendirian');
            $fileberkasskkemenkumham = $this->request->getFile('berkasskkemenkumham');
            $fileberkasrekening = $this->request->getFile('berkasrekening');
            $fileberkasrekeningescrow = $this->request->getFile('berkasrekeningescrow');
            $fileberkaslaporankeuangan = $this->request->getFile('berkaslaporankeuangan');

            if (
                !$fileberkasnpwppt->isValid() || !$fileberkasktp_penanggung_jawab->isValid() ||
                !$fileberkasnpwp_penanggung_jawab->isValid() || !$fileberkasakta_pendirian->isValid() ||
                !$fileberkasrekening->isValid() || !$fileberkasktp_pengurus_pt->isValid() || 
                !$fileberkasnpwp_pengurus_pt->isValid() || !$fileberkasskkemenkumham->isValid() ||
                !$fileberkasrekeningescrow->isValid()
            ) {
                throw new \RuntimeException('One or more files are invalid');
            }

            $uuid = generate_uuid();

            // Move files with unique names
            $newfilenameberkasnpwppt = "npwppt_".$uuid."_".$fileberkasnpwppt->getRandomName();
            $newfilenameberkasktp_penanggung_jawab = "ktp_penanggungjawab_".$uuid."_".$fileberkasktp_penanggung_jawab->getRandomName();
            $newfilenameberkasnpwp_penanggung_jawab = "npwp_penanggungjawab_".$uuid."_".$fileberkasnpwp_penanggung_jawab->getRandomName();
            $newfilenameberkasakta_pendirian = "akta_pendirian_".$uuid."_".$fileberkasakta_pendirian->getRandomName();
            $newfilenameberkasrekening = "rekening_".$uuid."_".$fileberkasrekening->getRandomName();
            $newfilenameberkasktp_pengurus_pt = "ktp_pengurus_".$uuid."_".$fileberkasktp_pengurus_pt->getRandomName();
            $newfilenameberkasnpwp_pengurus_pt = "npwp_pengurus_".$uuid."_".$fileberkasnpwp_pengurus_pt->getRandomName();
            $newfilenameberkasskkemenkumham = "kemenkumham_".$uuid."_".$fileberkasskkemenkumham->getRandomName();
            $newfilenameberkasrekeningescrow = "rekeningescrow_".$uuid."_".$fileberkasrekeningescrow->getRandomName();
            
            // Handle optional laporan keuangan file
            $newfilenameberkaslaporankeuangan = null;
            if ($fileberkaslaporankeuangan && $fileberkaslaporankeuangan->isValid()) {
                $newfilenameberkaslaporankeuangan = "laporankeuangan_".$uuid."_".$fileberkaslaporankeuangan->getRandomName();
                $fileberkaslaporankeuangan->move(WRITEPATH . 'uploads/laporan_keuangan', $newfilenameberkaslaporankeuangan);
            }
           
            // Move all required files
            $fileberkasnpwppt->move(WRITEPATH . 'uploads/npwp_pt', $newfilenameberkasnpwppt);
            $fileberkasktp_penanggung_jawab->move(WRITEPATH . 'uploads/ktp_penanggungjawab', $newfilenameberkasktp_penanggung_jawab);
            $fileberkasnpwp_penanggung_jawab->move(WRITEPATH . 'uploads/npwp_penanggungjawab', $newfilenameberkasnpwp_penanggung_jawab);
            $fileberkasakta_pendirian->move(WRITEPATH . 'uploads/akta_pendirian', $newfilenameberkasakta_pendirian);
            $fileberkasrekening->move(WRITEPATH . 'uploads/rekening', $newfilenameberkasrekening);
            $fileberkasktp_pengurus_pt->move(WRITEPATH . 'uploads/ktp_pengurus', $newfilenameberkasktp_pengurus_pt);
            $fileberkasnpwp_pengurus_pt->move(WRITEPATH . 'uploads/npwp_pengurus', $newfilenameberkasnpwp_pengurus_pt);
            $fileberkasskkemenkumham->move(WRITEPATH . 'uploads/sk_kemenkumham', $newfilenameberkasskkemenkumham);
            $fileberkasrekeningescrow->move(WRITEPATH . 'uploads/rekening_escrow', $newfilenameberkasrekeningescrow);

            $data = [
                "uuid" => $uuid,
                "uuiddeveloper" => session('uuid'),
                "namapt" => $this->request->getVar('nama_pt'),
                "alamatref" => $this->request->getVar('lokasiref'),
                "alamatinput" => $this->request->getVar('detail_alamat'),
                "npwppt" => $this->request->getVar('npwp_pt'),
                "berkasnpwp" => $newfilenameberkasnpwppt,
                "namapj" => $this->request->getVar('penanggung_jawab_pt'),
                "ktppj" => $this->request->getVar('ktp_penanggung_jawab'),
                "berkasktppj" => $newfilenameberkasktp_penanggung_jawab,
                "npwppj" => $this->request->getVar('npwp_penanggung_jawab'),
                "berkasnpwppj" => $newfilenameberkasnpwp_penanggung_jawab,
                "penguruspt" => $this->request->getVar('pengurus_pt'),
                "berkaspengurusptnpwp" => $newfilenameberkasnpwp_pengurus_pt,
                "berkaspengurusptktp" => $newfilenameberkasktp_pengurus_pt,
                "berkasaktapendirian" => $newfilenameberkasakta_pendirian,
                "rekening" => $this->request->getVar('rekening'),
                "kodebank" => $this->request->getVar('bank'),
                "kodebankescrow" => $this->request->getVar('bank'),
                "rekeningescrow" => $this->request->getVar('rekeningescrow'),
                "berkasrekening" => $newfilenameberkasrekening,
                "berkasrekeningescrow" => $newfilenameberkasrekeningescrow,
                "berkasskkemenkumham" => $newfilenameberkasskkemenkumham,
                "berkaslaporankeuangan" => $newfilenameberkaslaporankeuangan,
                "statusvalidator" => 0,
            ];

            $pt = new PTModel();
            if (!$pt->save($data)) {
                throw new \RuntimeException('Failed to save data to database');
            }

            setNotifikasi(env('uuiddpp'), 'PT Baru', 'PT baru telah dikirimkan untuk validasi', '/operator/approval_pt');

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!',
                'csrfHash' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            // Clean up any uploaded files if an error occurs
            $this->cleanupFiles($uuid);
            
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Gagal menyimpan data: ' . $e->getMessage()
                ],
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }
    }

    public function form_pengajuan_dana()
	{
        $menu = getMenu(); 

        $model = new PTModel();
        $pt = $model->where([
            'uuiddeveloper' => session('uuid'),
            'statusvalidator' => 1
            ])->findAll();

        $dropdownpt['pt'] = ['' => 'Pilih PT'];
        foreach ($pt as $pt) {
            $dropdownpt['pt'][$pt['uuid']] = $pt['namapt'];
        }

        
        $data = [
			'title' => 'Form Pengajuan Dana',
			'breadcrumb' => ['Pengajuan','Dana'],
			'stringmenu' => $menu, 
			'dropdownpt' => $dropdownpt,
			'dropdownprovinsi' => getDropdownProvinsi(),
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
                'rules' => 'uploaded[berkassiteplan]|max_size[berkassiteplan,10240]|ext_in[berkassiteplan,pdf]|mime_in[berkassiteplan,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'berkaspsu' => [
                'label' => 'Foto Rumah, Prasarana, Sarana, dan Utilitas Umum',
                'rules' => 'uploaded[berkaspsu]|max_size[berkaspsu,10240]|ext_in[berkaspsu,pdf]|mime_in[berkaspsu,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
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

        

        $fileberkassiteplan = $this->request->getFile('berkassiteplan');
        $fileberkaspsu = $this->request->getFile('berkaspsu');
        
        if (
            $fileberkassiteplan->isValid() && !$fileberkassiteplan->hasMoved() &&
            $fileberkaspsu->isValid() && !$fileberkaspsu->hasMoved()
        ) {
            $uuid = generate_uuid();
            $newfilenameberkassiteplan = "siteplan_".$uuid."_".$fileberkassiteplan->getRandomName();
            $newfilenameberkaspsu = "psu_".$uuid."_".$fileberkaspsu->getRandomName();

            $fileberkassiteplan->move(WRITEPATH . 'uploads/site_plan', $newfilenameberkassiteplan);
            $fileberkaspsu->move(WRITEPATH . 'uploads/psu', $newfilenameberkaspsu);

            $pt = new PTModel();
            $datapt = $pt->where('uuid',$this->request->getVar('pt'))->first();

            if(count($datapt) == 0){
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => [
                        'simpan' => 'PT tidak ditemukan'
                    ]
                ])->setStatusCode(400);
            }

            $data = [
                "uuid" => $uuid,
                "uuidpt" => $this->request->getVar('pt'),
                "alamatperumahanref" => $this->request->getVar('alamatperumahanref'),
                "alamatperumahaninput" => $this->request->getVar('alamatperumahaninput'),
                "berkassiteplan" => $newfilenameberkassiteplan,
                "berkaspsu" => $newfilenameberkaspsu,
                "statusvalidator" => 0 ,
                //daript
                "namapj" => $datapt['namapj'],
                "ktppj" => $datapt['ktppj'],
                "berkasktppj" => $datapt['berkasktppj'],
                "npwppj" => $datapt['npwppj'],
                "berkasnpwppj" => $datapt['berkasnpwppj'],
                "penguruspt" => $datapt['penguruspt'],
                "berkaspengurusptktp" => $datapt['berkaspengurusptktp'],
                "berkaspengurusptnpwp" => $datapt['berkaspengurusptnpwp'],
                "berkasaktapendirian" => $datapt['berkasaktapendirian'],
                "rekening" => $datapt['rekening'],
                "kodebank" => $datapt['kodebank'],
                "berkasrekening" => $datapt['berkasrekening'],
                "kodebankescrow" => $datapt['kodebankescrow'],
                "rekeningescrow" => $datapt['rekeningescrow'],
                "berkasrekeningescrow" => $datapt['berkasrekeningescrow'],
                "berkasskkemenkumham" => $datapt['berkasskkemenkumham'],
            ];

            $headerpengajuan = new PengajuanModel();
            $save = $headerpengajuan->save($data);

            if ($save) { 
                // setNotifikasi(env('uuiddpp'), 'Pengajuan Dana', 'Pengajuan dana telah dikirimkan untuk validasi', '/operator/list_developer');
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
        $data = $pt->select('ref_pt.*, ref_bank.namabank, bank_escrow.namabank as namabankescrow')
            ->join('ref_bank','ref_bank.kodebank = ref_pt.kodebank','left')
            ->join('ref_bank as bank_escrow','bank_escrow.kodebank = ref_pt.kodebankescrow','left')
            ->where('uuid', $uuid)->first();

        $html = '<div id="divberkas" class="form-group">
                    <a href="#" onclick="showPDF(\'akta_pendirian\', \''.$data['berkasaktapendirian'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">Akta Pendirian</a>
                 
                    <a href="#" onclick="showPDF(\'npwp_pt\', \''.$data['berkasnpwp'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">NPWP PT : '.$data['npwppt'].'</a>
                 
                    <a href="#" onclick="showPDF(\'rekening\', \''.$data['berkasrekening'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">Rekening Operasional : '.$data['rekening'].' '.$data['namabank'].'</a>

                    <a href="#" onclick="showPDF(\'rekening_escrow\', \''.$data['berkasrekeningescrow'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">Rekening Escrow : '.$data['rekeningescrow'].' '.$data['namabankescrow'].'</a>

                    <a href="#" onclick="showPDF(\'sk_kemenkumham\', \''.$data['berkasskkemenkumham'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">SK Kemenkumham</a>
                  
                    <a href="#" onclick="showPDF(\'ktp_penanggungjawab\', \''.$data['berkasktppj'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">Penanggung Jawab : '.$data['namapj'].'</a>
                 
                    <a href="#" onclick="showPDF(\'npwp_penanggungjawab\', \''.$data['berkasnpwppj'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">NPWP Penanggung Jawab : '.$data['npwppj'].'</a>
                     
                    <a href="#" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">Pengurus PT : '.$data['penguruspt'].'</a>

                    <a href="#" onclick="showPDF(\'npwp_pengurus\', \''.$data['berkaspengurusptnpwp'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">NPWP Pengurus PT</a>

                    <a href="#" onclick="showPDF(\'ktp_pengurus\', \''.$data['berkaspengurusptktp'].'\')" data-toggle="modal" data-target="#pdfModal" class="form-control" style="text-decoration: none; background-color: #e9ecef;margin-bottom: 10px;">KTP Pengurus PT</a>

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
            'title' => 'Pengajuan Dana',
            'breadcrumb' => ['Pengajuan','Dana'],
            'stringmenu' => $menu, 
            'pengajuan' => $pengajuan,
        ];
        return view('developer/v_pengajuan_dana',$data);
    }

    public function monitoring_detail_pengajuan_dana()
    {
        $menu = getMenu();

        $uuid = $this->request->getGet('uuid');
        $model = new PengajuanModel();
        $pengajuan = $model->where('uuid',$uuid)->first();

        if(empty($pengajuan)){
            return redirect()->to(site_url('developer/monitoring_pengajuan_dana'))->with('error','Data tidak ditemukan');
        }
        $tampilkan = false;
        if($pengajuan['submited_status'] == 0 || $pengajuan['submited_status'] == 2){
            $tampilkan = true;
        }

        $model = new PengajuanDetailModel();
        $pengajuandetail = $model->getPengajuanUnit($uuid);


        $data = [
            'title' => 'Data Unit',
            'breadcrumb' => ['Pengajuan','Dana','Unit'],
            'stringmenu' => $menu, 
            'uuidheader' => $uuid,
            'pengajuandetail' => $pengajuandetail,
            'tampilkan' => $tampilkan,
        ];
        return view('developer/v_detail_pengajuan_dana',$data);
    }

    
    public function form_tambah_unit()
	{
        $uuidheader = $this->request->getGet('uuidheader');
        
        $menu = getMenu();
        
        $data = [
			'title' => 'Form Tambah Unit',
			'breadcrumb' => ['Developer','Tambah Unit'],
			'stringmenu' => $menu, 
			'dropdownprovinsi' => getDropdownProvinsi(),
			'dropdowndpd' => getDropdownDPD(),
			'dropdownbank' => getDropdownBank(),
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
        
        $pengajuanmodel = new PengajuanModel();
        $pengajuan = $pengajuanmodel->where('uuid',$this->request->getVar('uuidheader'))->first();

        if(empty($pengajuan)){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data pengajuan tidak ditemukan',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }
        //check status pengajuan harus 0 atau 2
        if($pengajuan['submited_status'] == 1 || $pengajuan['submited_status'] == 3 || $pengajuan['submited_status'] == 4 || $pengajuan['submited_status'] == 5 || $pengajuan['submited_status'] == 6 || $pengajuan['submited_status'] == 7 || $pengajuan['submited_status'] == 8){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Pengajuan sudah dikirim ke validator atau sudah disetujui',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
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
                'rules' => 'trim|required|checkUniqueUnit[sertifikat,nomordokumensp3k]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'checkUniqueUnit' => 'Dilihat dari sertifikat dan nomor dokumen SP3K, unit sudah terdaftar pada sistem'
                ]
            ],
            'berkassertifikat' => [
                'label' => 'Sertifikat',
                'rules' => 'uploaded[berkassertifikat]|max_size[berkassertifikat,10240]|ext_in[berkassertifikat,pdf]|mime_in[berkassertifikat,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'berkaspbgimb' => [
                'label' => 'PBG/IMB',
                'rules' => 'uploaded[berkaspbgimb]|max_size[berkaspbgimb,10240]|ext_in[berkaspbgimb,pdf]|mime_in[berkaspbgimb,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
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
                'rules' => 'uploaded[berkaspbb]|max_size[berkaspbb,10240]|ext_in[berkaspbb,pdf]|mime_in[berkaspbb,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'harga' => [
                'label' => 'Harga Sesuai Persetujuan Kredit (SP3K)',
                'rules' => 'trim|required|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'nilaikredit' => [
                'label' => 'Nilai Dana Talangan',
                'rules' => 'trim|required|numeric|checkDanaTalangan[harga]|checkMaxDanaTalangan',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka',
                    'checkDanaTalangan' => '{field} tidak boleh lebih besar dari 70% dari harga sesuai persetujuan kredit (SP3K)',
                    'checkMaxDanaTalangan' => '{field} tidak valid'
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
                'rules' => 'uploaded[berkassp3k]|max_size[berkassp3k,10240]|ext_in[berkassp3k,pdf]|mime_in[berkassp3k,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
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
                'rules' => 'uploaded[berkasktpdebitur]|max_size[berkasktpdebitur,10240]|ext_in[berkasktpdebitur,pdf]|mime_in[berkasktpdebitur,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pinjaman_kpl' => [
                'label' => 'Pinjaman KPL',
                'rules' => 'trim|numeric|permit_empty|required_with[berkaspinjaman_kpl]|checkDanaByKPL[nilaikredit]',
                'errors' => [
                    'numeric' => '{field} harus berupa angka',
                    'required_with' => '{field} harus diisi',
                    'checkDanaByKPL' => 'Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan'
                ]
            ],
            'berkaspinjaman_kpl' => [
                'label' => 'Berkas Pinjaman KPL',
                'rules' => 'permit_empty|uploaded[berkaspinjaman_kpl]|max_size[berkaspinjaman_kpl,10240]|ext_in[berkaspinjaman_kpl,pdf]|mime_in[berkaspinjaman_kpl,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pinjaman_kyg' => [
                'label' => 'Pinjaman KYG',
                'rules' => 'trim|numeric|permit_empty|required_with[berkaspinjaman_kyg]|checkDanaByKPL[nilaikredit]',
                'errors' => [
                    'numeric' => '{field} harus berupa angka',
                    'required_with' => '{field} harus diisi',
                    'checkDanaByKPL' => 'Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan'
                ]
            ],
            'berkaspinjaman_kyg' => [
                'label' => 'Berkas Pinjaman KYG',
                'rules' => 'permit_empty|uploaded[berkaspinjaman_kyg]|max_size[berkaspinjaman_kyg,10240]|ext_in[berkaspinjaman_kyg,pdf]|mime_in[berkaspinjaman_kyg,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pinjaman_lain' => [
                'label' => 'Pinjaman Lain',
                'rules' => 'trim|numeric|permit_empty|required_with[berkaspinjaman_lain]|checkDanaByKPL[nilaikredit]',
                'errors' => [
                    'numeric' => '{field} harus berupa angka',
                    'required_with' => 'Berkas Pinjaman lain harus diisi',
                    'checkDanaByKPL' => 'Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan'
                ]
            ],
            'berkaspinjaman_lain' => [
                'label' => 'Berkas Pinjaman Lain',
                'rules' => 'permit_empty|uploaded[berkaspinjaman_lain]|max_size[berkaspinjaman_lain,10240]|ext_in[berkaspinjaman_lain,pdf]|mime_in[berkaspinjaman_lain,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
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
                'message' => $this->validator->getErrors(),
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);

        } 

        $fileberkassertifikat = $this->request->getFile('berkassertifikat');
        $fileberkaspbb = $this->request->getFile('berkaspbb');
        $fileberkaspbgimb = $this->request->getFile('berkaspbgimb');
        $fileberkassp3k = $this->request->getFile('berkassp3k');
        $fileberkasktpdebitur = $this->request->getFile('berkasktpdebitur');
        $fileberkaspinjaman_kpl = $this->request->getFile('berkaspinjaman_kpl');
        $fileberkaspinjaman_kyg = $this->request->getFile('berkaspinjaman_kyg');
        $fileberkaspinjaman_lain = $this->request->getFile('berkaspinjaman_lain');
        $uuidheader = $this->request->getVar('uuidheader');

        // dd($fileberkaspinjaman_kpl);
        // var_dump($fileberkaspinjaman_kyg);
        // var_dump($fileberkaspinjaman_lain);
        // die();

        
        if (
            $fileberkassertifikat->isValid() && !$fileberkassertifikat->hasMoved() &&
            $fileberkaspbb->isValid() && !$fileberkaspbb->hasMoved() &&
            $fileberkassp3k->isValid() && !$fileberkassp3k->hasMoved() &&
            $fileberkasktpdebitur->isValid() && !$fileberkasktpdebitur->hasMoved() &&
            $fileberkaspbgimb->isValid() && !$fileberkaspbgimb->hasMoved()
        ) {
            $uuid = generate_uuid();
            // Move the file to a permanent location
            $newfilenameberkassertifikat = "sertifikat_".$uuid."_".$fileberkassertifikat->getRandomName();
            $newfilenameberkaspbb = "pbb_".$uuid."_".$fileberkaspbb->getRandomName();
            $newfilenameberkassp3k = "sp3k_".$uuid."_".$fileberkassp3k->getRandomName();
            $newfilenameberkasktpdebitur = "ktpdebitur_".$uuid."_".$fileberkasktpdebitur->getRandomName();
            $newfilenameberkaspbgimb = "pbgimb_".$uuid."_".$fileberkaspbgimb->getRandomName();

            $fileberkassertifikat->move(WRITEPATH . 'uploads/sertifikat', $newfilenameberkassertifikat);
            $fileberkaspbb->move(WRITEPATH . 'uploads/pbb', $newfilenameberkaspbb);
            $fileberkassp3k->move(WRITEPATH . 'uploads/sp3k', $newfilenameberkassp3k);
            $fileberkasktpdebitur->move(WRITEPATH . 'uploads/ktp_debitur', $newfilenameberkasktpdebitur);
            $fileberkaspbgimb->move(WRITEPATH . 'uploads/pbgimb', $newfilenameberkaspbgimb);

            $data = [
                "uuid" => $uuid,
                "uuidheader" => $uuidheader,
                "sertifikat" => $this->request->getVar('sertifikat'),
                "berkassertifikat" => $newfilenameberkassertifikat,
                "pbb" => $this->request->getVar('pbb'),
                "berkaspbb" => $newfilenameberkaspbb,
                "berkaspbgimb" => $newfilenameberkaspbgimb,
                "harga" => $this->request->getVar('harga'),
                "nilaikredit" => $this->request->getVar('nilaikredit'),
                "alamatref" => $this->request->getVar('lokasiref'),
                "alamatinput" => $this->request->getVar('detail_alamat'),
                "nomordokumensp3k" => $this->request->getVar('sp3k'),
                "tanggalsp3k" => $this->request->getVar('tanggalsp3k'),
                "berkassp3k" => $newfilenameberkassp3k,
                "namadebitur" => $this->request->getVar('debitur'),
                "berkasktpdebitur" => $newfilenameberkasktpdebitur,
                "submited_status" => 0,
                "submited_time" => date('Y-m-d H:i:s'),
                "submited_by" => session()->get('uuid'),
                "statusvalidator" => 0,
            ];

            if($fileberkaspinjaman_kpl->isValid() && !$fileberkaspinjaman_kpl->hasMoved()){
                $newfilenameberkaspinjaman_kpl = "pinjaman_kpl_".$uuid."_".$fileberkaspinjaman_kpl->getRandomName();
                $fileberkaspinjaman_kpl->move(WRITEPATH . 'uploads/pinjaman_kpl', $newfilenameberkaspinjaman_kpl);
                $data['pinjamankpl'] = $this->request->getVar('pinjaman_kpl');
                $data['berkaspinjamankpl'] = $newfilenameberkaspinjaman_kpl;
            }
            if($fileberkaspinjaman_kyg->isValid() && !$fileberkaspinjaman_kyg->hasMoved()){
                $newfilenameberkaspinjaman_kyg = "pinjaman_kyg_".$uuid."_".$fileberkaspinjaman_kyg->getRandomName();
                $fileberkaspinjaman_kyg->move(WRITEPATH . 'uploads/pinjaman_kyg', $newfilenameberkaspinjaman_kyg);
                $data['pinjamankyg'] = $this->request->getVar('pinjaman_kyg');
                $data['berkaspinjamankyg'] = $newfilenameberkaspinjaman_kyg;
            }
            if($fileberkaspinjaman_lain->isValid() && !$fileberkaspinjaman_lain->hasMoved()){
                $newfilenameberkaspinjaman_lain = "pinjaman_lain_".$uuid."_".$fileberkaspinjaman_lain->getRandomName();
                $fileberkaspinjaman_lain->move(WRITEPATH . 'uploads/pinjaman_lain', $newfilenameberkaspinjaman_lain);
                $data['pinjamanlain'] = $this->request->getVar('pinjaman_lain');
                $data['berkaspinjamanlain'] = $newfilenameberkaspinjaman_lain;
            }
           
            

            try {

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
        $pengajuan = $model->getPengajuanPT(session()->get('uuid'));

        $data = [
            'title' => 'Pengajuan PT',
            'breadcrumb' => ['Pengajuan','PT'],
            'stringmenu' => $menu, 
            'pengajuan' => $pengajuan,
        ];
        return view('developer/v_pengajuan_pt',$data);
    }

    public function form_edit_unit()
    {
        // echo "ster";exit;
        $menu = getMenu();
        $uuid = $this->request->getVar('uuid');
        $uuidheader = $this->request->getVar('uuidheader');

        $model = new PengajuanDetailModel();
        $unit = $model->where('trx_pengajuan_detail.uuid', $uuid)
                      ->first();

        // dd($unit);

        if (!$unit) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data unit tidak ditemukan');
        }

        // // Ambil ID provinsi, kabupaten, kota dari alamatref
        $unit['provinsi'] = substr($unit['alamatref'], 0, 2);
        $unit['kabupaten'] = substr($unit['alamatref'], 0, 5); 
        $unit['kota'] = substr($unit['alamatref'], 0, 8);
        $unit['kecamatan'] = substr($unit['alamatref'], 0, 13);

        $data = [
            'title' => 'Form Edit Unit',
            'breadcrumb' => ['Developer','Edit Unit'],
            'stringmenu' => $menu,
            'dropdownbank' => getDropdownBank(),
            'uuidheader' => $uuidheader,
            'unit' => $unit,
            'dropdownprovinsi' => getDropdownProvinsi(),
            'validation' => \Config\Services::validation(),
            'dropdownkabupaten' => getDropdownKabupaten($unit['provinsi']),
            'dropdownkota' => getDropdownKota($unit['kabupaten']), 
            'dropdownkecamatan' => getDropdownKecamatan($unit['kota']),
        ];
        return view('developer/form_edit_unit', $data);
    }

    public function edit_unit_ajax()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }    
        //check status unit harus 1,3 dan 4
        $unit = new PengajuanDetailModel();
        $unit = $unit->where('uuid', $this->request->getVar('uuid'))->first();
        if($unit['submited_status'] == 1 || $unit['submited_status'] == 3 || $unit['submited_status'] == 4){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unit sudah dikirim ke validator atau sudah disetujui',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }

        //check session uuid berhak untuk mengedit
        $pt = new PTModel();
        $daftarpt = $pt->where('uuiddeveloper', session()->get('uuid'))->findAll();   
        $uuidpt = array_column($daftarpt, 'uuid');
  
        $pengajuan = new PengajuanModel();
        $daftarpengajuan = $pengajuan->whereIn('uuidpt', $uuidpt)->findAll();
        $uuidheader = array_column($daftarpengajuan, 'uuid');

        $pengajuandetail = new PengajuanDetailModel();
        $daftarpengajuandetail = $pengajuandetail->whereIn('uuidheader', $uuidheader)->findAll();
        $uuidunit = array_column($daftarpengajuandetail, 'uuid');

        if(!in_array($this->request->getVar('uuidheader'), $uuidheader)){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Anda tidak memiliki izin untuk mengedit',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }

        $validationRules = [
            'uuid' => [
                'label' => 'UUID',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'pbb' => [
                'label' => 'PBB',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
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
                'label' => 'Nilai Dana Talangan',
                'rules' => 'trim|required|numeric|checkDanaTalangan[harga]|checkMaxDanaTalangan',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'numeric' => '{field} harus berupa angka',
                    'checkDanaTalangan' => '{field} tidak boleh lebih besar dari 70% dari harga sesuai persetujuan kredit (SP3K)',
                    'checkMaxDanaTalangan' => '{field} tidak valid'
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
            // 'tanggalsp3k' => [
            //     'label' => 'Tanggal SP3K',
            //     'rules' => 'trim|required|date',
            //     'errors' => [
            //         'required' => '{field} harus diisi',
            //         'date' => '{field} harus berformat tanggal'
            //     ]
            // ],
            'debitur' => [
                'label' => 'Nama Debitur',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'pinjaman_kpl' => [
                'label' => 'Pinjaman KPL',
                'rules' => 'trim|numeric|permit_empty|required_with[berkaspinjaman_kpl]|checkDanaByKPL[nilaikredit]',
                'errors' => [
                    'numeric' => '{field} harus berupa angka',
                    'required_with' => '{field} harus diisi',
                    'checkDanaByKPL' => 'Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan'
                ]
            ],
            'pinjaman_kyg' => [
                'label' => 'Pinjaman KYG',
                'rules' => 'trim|numeric|permit_empty|required_with[berkaspinjaman_kyg]|checkDanaByKPL[nilaikredit]',
                'errors' => [
                    'numeric' => '{field} harus berupa angka',
                    'required_with' => '{field} harus diisi',
                    'checkDanaByKPL' => 'Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan'
                ]
            ],
            'pinjaman_lain' => [
                'label' => 'Pinjaman Lain',
                'rules' => 'trim|numeric|permit_empty|required_with[berkaspinjaman_lain]|checkDanaByKPL[nilaikredit]',
                'errors' => [
                    'numeric' => '{field} harus berupa angka',
                    'required_with' => 'Berkas Pinjaman lain harus diisi',
                    'checkDanaByKPL' => 'Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan'
                ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }

        $uuid = $this->request->getVar('uuid');
        $data = [
            "pbb" => $this->request->getVar('pbb'),
            "harga" => $this->request->getVar('harga'),
            "nilaikredit" => $this->request->getVar('nilaikredit'),
            // "tanggalsp3k" => $this->request->getVar('tanggalsp3k'),
            "namadebitur" => $this->request->getVar('debitur'),
            "alamatref" => $this->request->getVar('lokasiref'),
            "alamatinput" => $this->request->getVar('detail_alamat'),
            "pinjamankpl" => $this->request->getVar('pinjaman_kpl'),
            "pinjamankyg" => $this->request->getVar('pinjaman_kyg'),
            "pinjamanlain" => $this->request->getVar('pinjaman_lain'),
            "statusvalidator" => 0,
        ];

        // Perbaiki mapping nama file ke field database
        $fileMapping = [
            'berkaspbb' => [
                'path' => 'pbb',
                'field' => 'berkaspbb'
            ],
            'berkaspbgimb' => [
                'path' => 'pbgimb',
                'field' => 'berkaspbgimb'
            ],
            'berkasktpdebitur' => [
                'path' => 'ktp_debitur',
                'field' => 'berkasktpdebitur'
            ],
            'berkaspinjaman_kpl' => [
                'path' => 'pinjaman_kpl',
                'field' => 'berkaspinjamankpl'  // sesuaikan dengan nama field di database
            ],
            'berkaspinjaman_kyg' => [
                'path' => 'pinjaman_kyg',
                'field' => 'berkaspinjamankyg'  // sesuaikan dengan nama field di database
            ],
            'berkaspinjaman_lain' => [
                'path' => 'pinjaman_lain',
                'field' => 'berkaspinjamanlain' // sesuaikan dengan nama field di database
            ]
        ];

        // Handle file uploads
        foreach ($fileMapping as $inputName => $config) {
            $uploadedFile = $this->request->getFile($inputName);
            if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
                $newName = $inputName."_".$uuid."_".$uploadedFile->getRandomName();
                $uploadedFile->move(WRITEPATH . 'uploads/'.$config['path'], $newName);
                $data[$config['field']] = $newName; // Gunakan nama field yang benar
            }
        }

        try {
            $pdm = new PengajuanDetailModel();
            $save = $pdm->where('uuid', $uuid)->set($data)->update();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diperbarui!',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'update' => $e->getMessage()
                ],
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }
    }

    public function delete_unit_ajax()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }    

        $uuid = $this->request->getPost('uuid');

        
        //check status unit harus 1,3 dan 4
        $unit = new PengajuanDetailModel();
        $unit = $unit->where('uuid', $uuid)->first();
        if($unit['submited_status'] == 1 || $unit['submited_status'] == 3 || $unit['submited_status'] == 4){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unit sudah dikirim ke validator atau sudah disetujui',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }

        if (empty($uuid)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'UUID tidak ditemukan',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }

        //check session uuid berhak untuk mengedit
        $pt = new PTModel();
        $daftarpt = $pt->where('uuiddeveloper', session()->get('uuid'))->findAll();   
        $uuidpt = array_column($daftarpt, 'uuid');
  
        $pengajuan = new PengajuanModel();
        $daftarpengajuan = $pengajuan->whereIn('uuidpt', $uuidpt)->findAll();
        $uuidheader = array_column($daftarpengajuan, 'uuid');

        $pengajuandetail = new PengajuanDetailModel();
        $daftarpengajuandetail = $pengajuandetail->whereIn('uuidheader', $uuidheader)->findAll();
        $uuidunit = array_column($daftarpengajuandetail, 'uuid');

        if(!in_array($uuid, $uuidunit)){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Anda tidak memiliki izin untuk menghapus',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        }

        try {
            $model = new PengajuanDetailModel();
            
            // Ambil data unit sebelum dihapus untuk menghapus file-filenya
            $unit = $model->where('uuid', $uuid)->first();
            
            if (!$unit) {
                throw new \Exception('Data unit tidak ditemukan');
            }

            // Array file yang akan dihapus
            $files = [
                'berkassertifikat' => WRITEPATH . 'uploads/sertifikat/',
                'berkaspbb' => WRITEPATH . 'uploads/pbb/',
                'berkaspbgimb' => WRITEPATH . 'uploads/pbgimb/',
                'berkassp3k' => WRITEPATH . 'uploads/sp3k/',
                'berkasktpdebitur' => WRITEPATH . 'uploads/ktp_debitur/',
                'berkasrekening' => WRITEPATH . 'uploads/rekening_debitur/'
            ];

            // Hapus file-file terkait
            foreach ($files as $field => $path) {
                if (!empty($unit[$field]) && file_exists($path . $unit[$field])) {
                    unlink($path . $unit[$field]);
                }
            }

            // Hapus data dari database
            $delete = $model->where('uuid', $uuid)->delete();

            if (!$delete) {
                throw new \Exception('Gagal menghapus data');
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data unit berhasil dihapus',
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrfName' => csrf_token(),
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }
    }

    
    public function ajukan_dana_ajax()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }    

        $jumlahunit = $this->request->getPost('jumlahunit');

        if($jumlahunit == 0){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Jumlah unit tidak boleh 0',
                'csrfToken' => csrf_token(),
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');

        if (empty($uuid)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'UUID tidak ditemukan',
                'csrfToken' => csrf_token(),
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }

        try {

            $data = [
                'statusvalidator' => null,
                'validate_at' => null,
                'validate_by' => null,
                'keteranganpenolakan' => null,
                'submited_status' => 1,
                'submited_time' => date('Y-m-d H:i:s'),
                'submited_by' => session()->get('uuid')
            ];
            
            $model = new PengajuanModel();
            $update = $model->where('uuid', $uuid)->set($data)->update();

            if (!$update) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal mengubah status header',
                    'csrfToken' => csrf_token(),
                    'csrfHash' => csrf_hash()
                ])->setStatusCode(400);
            }

            $datadetail = [
                'statusvalidator' => 0,
                'validated_at' => null,
                'validated_by' => null,
                'keteranganpenolakan' => null,
                'statussikumbang' => 0,
                'validated_sikumbang_at' => null,
                'validated_sikumbang_by' => null,
                'kettolaksikumbang' => null,
                'statuseflpp' => 0,
                'validated_eflpp_at' => null,
                'validated_eflpp_by' => null,
                'kettolakeflpp' => null,
                'statussp3k' => 0,
                'validated_sp3k_at' => null,
                'validated_sp3k_by' => null,
                'kettolaksp3k' => null,
                'submited_status' => 1,
                'submited_time' => date('Y-m-d H:i:s'),
                'submited_by' => session()->get('uuid')
            ];

            $modelDetail = new PengajuanDetailModel();
            $setClause = [];
            foreach ($datadetail as $key => $value) {
                $setClause[] = "$key = " . (is_string($value) ? ($value === null ? "NULL" : "'$value'") : ($value === null ? "NULL" : $value));
            }
            $setString = implode(", ", $setClause);
            
            $sql = "UPDATE trx_pengajuan_detail 
                    SET $setString
                    WHERE uuidheader = '$uuid'
                    AND (CONCAT(statusvalidator,statussikumbang,statuseflpp,statussp3k) != '1111')";
                    
            $update = $modelDetail->query($sql);

            if (!$update) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal mengubah status detail',
                    'csrfToken' => csrf_token(),
                    'csrfHash' => csrf_hash()
                ])->setStatusCode(400);
            }
            
            setNotifikasi(env('uuiddpp'), 'Pengajuan Dana', 'Pengajuan dana '.session()->get('nama').' telah dikirimkan untuk validasi', '/operator/approval_dana/'.session()->get('uuid'));
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Dana berhasil di ajukan. Mohon tunggu konfirmasi admin',
                'csrfToken' => csrf_token(),
                'csrfHash' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'csrfToken' => csrf_token(),
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }
    }

    public function edit_pt_ajax()
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
            'penanggung_jawab_pt' => [
                'label' => 'Penanggung Jawab PT',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'ktp_penanggung_jawab' => [
                'label' => 'KTP Penanggung Jawab',
                'rules' => 'trim|required|exact_length[16]|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'exact_length' => '{field} harus 16 angka tanpa tanda penghubung atau titik',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'npwp_penanggung_jawab' => [
                'label' => 'NPWP Penanggung Jawab',
                'rules' => 'trim|required|min_length[15]|max_length[16]|numeric',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 15 angka tanpa tanda penghubung atau titik',
                    'max_length' => '{field} maksimal 16 angka tanpa tanda penghubung atau titik',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'pengurus_pt' => [
                'label' => 'Nama dan Jabatan Pengurus PT',
                'rules' => 'trim|required|max_length[600]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'max_length' => '{field} maksimal 600 karakter'
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
                'label' => 'Nomor Rekening',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'rekeningescrow' => [
                'label' => 'Nomor Rekening Escrow',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
        $pt = new PTModel();
        $existingData = $pt->where('uuid', $uuid)->first();

        if (!$existingData) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => ['Data PT tidak ditemukan'],
                'csrfHash' => csrf_hash()
            ])->setStatusCode(404);
        }

        try {
            $data = [
                "namapt" => $this->request->getVar('nama_pt'),
                "alamatref" => $this->request->getVar('lokasiref'),
                "alamatinput" => $this->request->getVar('detail_alamat'),
                "namapj" => $this->request->getVar('penanggung_jawab_pt'),
                "ktppj" => $this->request->getVar('ktp_penanggung_jawab'),
                "npwppj" => $this->request->getVar('npwp_penanggung_jawab'),
                "penguruspt" => $this->request->getVar('pengurus_pt'),
                "rekening" => $this->request->getVar('rekening'),
                "kodebank" => $this->request->getVar('bank'),
                "kodebankescrow" => $this->request->getVar('bank'),
                "rekeningescrow" => $this->request->getVar('rekeningescrow'),
                "statusvalidator" => 0
            ];

            // Handle file uploads
            $files = ['berkasnpwppt', 'berkasktp_penanggung_jawab', 'berkasnpwp_penanggung_jawab', 
                     'berkasnpwp_pengurus_pt', 'berkasktp_pengurus_pt', 'berkasakta_pendirian',
                     'berkasskkemenkumham', 'berkasrekening', 'berkasrekeningescrow', 'berkaslaporankeuangan'];

            foreach($files as $fileField) {
                $file = $this->request->getFile($fileField);
                if($file && $file->getSize() > 0) {

                    if($fileField == 'berkasnpwppt'){
                        $newFileName = "npwppt_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/npwp_pt', $newFileName);
                        $data['berkasnpwp'] = $newFileName;
                    }
                    if($fileField == 'berkasktp_penanggung_jawab'){
                        $newFileName = "ktp_penanggungjawab_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/ktp_penanggungjawab', $newFileName);
                        $data['berkasktppj'] = $newFileName;
                    }
                    if($fileField == 'berkasnpwp_penanggung_jawab'){
                        $newFileName = "npwp_penanggungjawab_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/npwp_penanggungjawab', $newFileName);
                        $data['berkasnpwppj'] = $newFileName;
                    }
                    if($fileField == 'berkasktp_pengurus_pt'){
                        $newFileName = "ktp_pengurus_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/ktp_pengurus', $newFileName);
                        $data['berkaspengurusptktp'] = $newFileName;
                    }   
                    if($fileField == 'berkasnpwp_pengurus_pt'){
                        $newFileName = "npwp_pengurus_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/npwp_pengurus', $newFileName);
                        $data['berkaspengurusptnpwp'] = $newFileName;
                    }  
                    if($fileField == 'berkasakta_pendirian'){
                        $newFileName = "akta_pendirian_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/akta_pendirian', $newFileName);
                        $data['berkasaktapendirian'] = $newFileName;
                    }   
                    if($fileField == 'berkasskkemenkumham'){
                        $newFileName = "kemenkumham_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/sk_kemenkumham', $newFileName);
                        $data['berkasskkemenkumham'] = $newFileName;
                    }   
                    if($fileField == 'berkasrekening'){
                        $newFileName = "rekening_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/rekening', $newFileName);
                        $data['berkasrekening'] = $newFileName;
                    }   
                    if($fileField == 'berkasrekeningescrow'){
                        $newFileName = "rekeningescrow_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/rekening_escrow', $newFileName);
                        $data['berkasrekeningescrow'] = $newFileName;
                    }   
                    if($fileField == 'berkaslaporankeuangan'){
                        $newFileName = "laporankeuangan_".$uuid."_".$file->getRandomName();
                        $file->move(WRITEPATH . 'uploads/laporan_keuangan', $newFileName);
                        $data['berkaslaporankeuangan'] = $newFileName;
                    }   


                }
            }

            if (!$pt->where('uuid', $existingData['uuid'])->set($data)->update()) {
                throw new \RuntimeException('Gagal mengupdate data PT');
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Data berhasil diupdate!',
                'csrfHash' => csrf_hash()
            ]);

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => ['Gagal mengupdate data: ' . $e->getMessage()],
                'csrfHash' => csrf_hash()
            ])->setStatusCode(400);
        }
    }

    public function form_edit_pt()
    {
        $menu = getMenu();
        $uuid = $this->request->getGet('uuid');
        
        $model = new PTModel();
        $pt = $model->where('uuid', $uuid)->first();
        
        if (!$pt) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data PT tidak ditemukan');
        }

        $pt['provinsi'] = substr($pt['alamatref'], 0, 2);
        $pt['kabupaten'] = substr($pt['alamatref'], 0, 5); 
        $pt['kota'] = substr($pt['alamatref'], 0, 8);
        $pt['kecamatan'] = substr($pt['alamatref'], 0, 13);
    
        $data = [
            'title' => 'Edit PT',
            'breadcrumb' => ['Developer','Edit PT'],
            'stringmenu' => $menu,
            'pt' => $pt,
            'dropdownbank' => getDropdownBank(),
            'dropdownprovinsi' => getDropdownProvinsi(),
            'dropdownkabupaten' => getDropdownKabupaten($pt['provinsi']),
            'dropdownkota' => getDropdownKota($pt['kabupaten']),
            'dropdownkecamatan' => getDropdownKecamatan($pt['kota']),
            'dropdowndpd' => getDropdownDpd()
        ];
    
        return view('developer/form_edit_pt', $data);
    }

    public function hapus_pt()
    {
        // Cek apakah request adalah AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ]);
        }
        // Ambil UUID dari POST request
        $uuid = $this->request->getPost('uuid');
        
        // Validasi UUID
        if (empty($uuid)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'UUID tidak valid',
                'csrfHash' => csrf_hash()
            ]);
        }

        // Load model yang diperlukan
        $ptModel = new PTModel();
        
        try {
            // Cari data PT berdasarkan UUID
            $pt = $ptModel->where('uuid', $uuid)->first();
            
            if (!$pt) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Data PT tidak ditemukan',
                    'csrfHash' => csrf_hash()
                ]);
            }

            // echo WRITEPATH . 'uploads/npwp_pt/'.$pt['berkasnpwp'];exit;

            // Hapus file-file yang terkait
            $files = [
                'berkasnpwp' => WRITEPATH . 'uploads/npwp_pt/',
                'berkasktppj' => WRITEPATH . 'uploads/ktp_penanggungjawab/',
                'berkasnpwppj' => WRITEPATH . 'uploads/npwp_penanggungjawab/',
                'berkaspengurusptktp' => WRITEPATH . 'uploads/ktp_pengurus/',
                'berkaspengurusptnpwp' => WRITEPATH . 'uploads/npwp_pengurus/',
                'berkasaktapendirian' => WRITEPATH . 'uploads/akta_pendirian/',
                'berkasskkemenkumham' => WRITEPATH . 'uploads/sk_kemenkumham/',
                'berkasrekening' => WRITEPATH . 'uploads/rekening/',
                'berkasrekeningescrow' => WRITEPATH . 'uploads/rekening_escrow/',
                'berkaslaporankeuangan' => WRITEPATH . 'uploads/laporan_keuangan/'
            ];

            foreach ($files as $field => $path) {
                if (!empty($pt[$field]) && file_exists($path . $pt[$field])) {
                    unlink($path . $pt[$field]);
                }
            }

            // Hapus data PT dari database
            if ($ptModel->where('uuid', $uuid)->delete()) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data PT berhasil dihapus',
                    'csrfHash' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Gagal menghapus data PT',
                    'csrfHash' => csrf_hash()
                ]);
            }

        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'csrfHash' => csrf_hash()
            ]);
        }
    }

    function monitoring_sp3k()
    {
        $menu = getMenu();
        $model = new PengajuanDetailModel();
        $pengajuanDetail = $model->select('trx_pengajuan_detail.*,trx_pengajuan_detail.uuid as uuidheader,ref_pt.namapt')
        ->join('trx_pengajuan','trx_pengajuan.uuid = trx_pengajuan_detail.uuidheader','left')
        ->join('ref_pt','ref_pt.uuid = trx_pengajuan.uuidpt','left')
        ->where('trx_pengajuan_detail.submited_status',6)->findAll();

        $data = [
            'title' => 'Monitoring SP3K',
            'breadcrumb' => ['Developer','Monitoring SP3K'],
            'stringmenu' => $menu, 
            'pengajuanDetail' => $pengajuanDetail,
        ];
        return view('developer/v_sp3k',$data);
    }

    public function kirimkependana()
    {
        if(!$this->request->isAJAX()){
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }

        $uuid = $this->request->getPost('uuid');
        $fileberkassuratpermohonan = $this->request->getFile('berkassuratpermohonan');

        if(empty($uuid) || empty($fileberkassuratpermohonan)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Berkas Surat Permohonan harus diisi!'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }

        $pengajuanmodel = new PengajuanModel();
        $pengajuan = $pengajuanmodel->where('uuid',$uuid)->first();

        if(empty($pengajuan)){
            return $this->response->setJSON([
                'status' => 'error', 
                'message' => [
                    'simpan' => 'Data pengajuan tidak ditemukan'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }

        $userModel = new UserModel();
        $developer = $userModel->getDeveloperByUUIDPengajuan($uuid);
        $uuiddeveloper = $developer['uuid'];

        $pendana = $pengajuan['uuidpendana'];
        $userspendana = $userModel->getUUIDUserByUUIDPendana($pendana);
        $uuiduserspendana = $userspendana['uuid'];

        if($pengajuan['submited_status'] != 5 && $pengajuan['submited_status'] != 7){
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'Masih dalam tahap pengajuan Approver'
                ],
                'csrfHash' => csrf_hash(),
                'csrfToken' => csrf_token(),
                'uuid' => $uuid
            ])->setStatusCode(400);
        }

        $validationRules = [
            'uuid' => [
                'label' => 'UUID',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkassuratpermohonan' => [
                'label' => 'Berkas Surat Permohonan',
                'rules' => 'permit_empty|uploaded[berkassuratpermohonan]|max_size[berkassuratpermohonan,2048]|ext_in[berkassuratpermohonan,pdf]|mime_in[berkassuratpermohonan,application/pdf,application/force-download,application/x-download,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 2 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(400);
        } 

        $fileberkassuratpermohonan = $this->request->getFile('berkassuratpermohonan');

        if($fileberkassuratpermohonan->isValid() && !$fileberkassuratpermohonan->hasMoved()){
            $newfilenameberkassuratpermohonan = "suratpermohonan_".$uuid."_".$fileberkassuratpermohonan->getRandomName();
            $fileberkassuratpermohonan->move(WRITEPATH . 'uploads/surat_permohonan', $newfilenameberkassuratpermohonan);

            $datetime = date('Y-m-d H:i:s');
         
            $data = [
                'submited_status' => 6,
                'submited_time' => $datetime,
                'submited_by' => session()->get('uuid'),
                'berkassuratpermohonan' => $newfilenameberkassuratpermohonan,
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
                        AND (concat(statusvalidator,statussikumbang,statuseflpp,statussp3k) = '1111')";
                        
                $updatedetail = $pengajuanDetail->query($sql);
                
                // setNotifikasi($uuiddeveloper, 'Pengajuan Dana', 'Pengajuan dana telah diteruskan ke Pendana', '/developer/monitoring_pengajuan_dana');
                setNotifikasi($uuiduserspendana, 'Pengajuan Dana', 'Pengajuan dana '.$developer['nama'].' telah divalidasi Approver dan sudah dilampirkan surat permohonan. Silahkan cek surat permohonan dan melakukan konfirmasi', '/pendana/permintaan_dana');

                if (!$updatedetail) {
                    throw new \Exception('Gagal update detail pengajuan!');
                }

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Data berhasil dikirim ke pendana!',
                    'csrfHash' => csrf_hash(),
                    'csrfToken' => csrf_token(),
                    'uuid' => $uuid,
                ])->setStatusCode(200);

            } catch(\Exception $e) {
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
        }
    }

}
