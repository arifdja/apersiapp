<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProvinsiModel;
use App\Models\KotaModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\KabupatenModel;



class User extends BaseController
{
    public function login(): string
    {
        $data['validation'] = \Config\Services::validation();
        return view('user/v_login', $data);
    }

    // public function hashpassword($password)
    // {
    //     echo password_hash($password, PASSWORD_DEFAULT);
    // }

    public function validateUser()
    {

        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $secretKey = env('secretKey'); // Masukkan Secret Key Anda

        // Verifikasi reCAPTCHA
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $response = file_get_contents($url . "?secret={$secretKey}&response={$recaptchaResponse}");
        $responseKeys = json_decode($response, true);

        if (!$responseKeys['success']) {
            return redirect()->back()->withInput()->with('captcha_error', 'Invalid CAPTCHA. Please try again.');
        }

		$username   = $this->request->getVar('username');
        $password   = $this->request->getVar('password');
        
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]])) {
                
            $validation = \Config\Services::validation();
            return redirect()->to('/User')->withInput()->with('validation',$validation);
        }
        
        $model = new UserModel();
        $data = $model->where([
            'email' => $username
            ])->first();
       
        
        if ($data) {

            if($data['kdgrpuser'] == 'developer' && ($data['statusvalidator'] == 0 || $data['statusvalidator'] == '')){
                session()->setFlashdata('type','Warning');
                session()->setFlashdata('msg','U05 Gagal Login');
                return redirect()->to('/login');
            }
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'uuid' => $data['uuid'],
                    'email' => $data['email'],
                    'kdgrpuser' => $data['kdgrpuser'],
                    'nama' => $data['nama'],
                    'notelp' => $data['notelp'],
                    'alamatref' => $data['alamatref'],
                    'alamatinput' => $data['alamatinput'],
                    'kodepos' => $data['kodepos'],
                    'kta' => $data['kta'],
                    'berkaskta' => $data['berkaskta'],
                    'logged_in' => true
                ];
                session()->set($ses_data);
                session()->setFlashdata('type','Success');
                session()->setFlashdata('msg',$data['nama'].' Berhasil Login');
                return redirect()->to("/".$data['kdgrpuser']);
               
            } else {
                session()->setFlashdata('type','Warning');
                session()->setFlashdata('msg','U01 Gagal Login');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('type','Warning');
            session()->setFlashdata('msg','U02 Gagal Login');
            return redirect()->to('/login');
        }	
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function get_kabupaten()
    {
        $provinsiId = $this->request->getPost('provinsi_id');

        $kabupatenModel = new KabupatenModel();
        $kabupaten = $kabupatenModel->where('idprovinsi', $provinsiId)->findAll();

        return $this->response->setJSON(
            [
                'kabupaten' => $kabupaten,
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ]
        );
    }

    public function get_kota()
    {
        $kabupatenId = $this->request->getPost('kabupaten_id');

        $kotaModel = new KotaModel();
        $kota = $kotaModel->where('idkabupaten', $kabupatenId)->findAll();

        return $this->response->setJSON(
            [
                'kota' => $kota,
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ]
        );
    }

    public function get_kecamatan()
    {
        $kotaId = $this->request->getPost('kota_id');

        $kecamatanModel = new KecamatanModel();
        $kecamatan = $kecamatanModel->where('idkota', $kotaId)->findAll();

        return $this->response->setJSON(
            [
                'kecamatan' => $kecamatan,
                'csrfName' => csrf_token(), 
                'csrfHash' => csrf_hash(),
            ]
        );
    }

    public function form_register()
	{
        $menu = "";
        $model = new ProvinsiModel();
        $provinsi = $model->findAll();

        $dropdownprovinsi['provinsi'] = ['' => 'Pilih Provinsi'];
        foreach ($provinsi as $prov) {
            $dropdownprovinsi['provinsi'][$prov['id']] = $prov['namaprovinsi'];
        }
        
        $data = [
			'title' => 'Register',
			'breadcrumb' => ['Home','Profil'],
			'stringmenu' => $menu, 
			'dropdownprovinsi' => $dropdownprovinsi,
			'validation' => \Config\Services::validation(), 
        ];
		return view('user/form_register_ajax',$data);
    }

    
    public function register_ajax()
	{
        // Check if it's an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['message' => 'Invalid request'])->setStatusCode(400);
        }    

        $validationRules = [
            'nama' => [
                'label' => 'Nama',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'email' => [
                'label' => 'Alamat Email',
                'rules' => 'trim|required|valid_email|checkEmail',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'checkEmail' => 'Email {field} sudah terdaftar'
                ]
            ],
            'telp' => [
                'label' => 'Telepon',
                'rules' => 'trim|required|numeric',
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
            'kode_pos' => [
                'label' => 'Kode Pos',
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
            'kta' => [
                'label' => 'KTA',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'berkaskta' => [
                'label' => 'KTA',
                'rules' => 'uploaded[berkaskta]|max_size[berkaskta,10240]|ext_in[berkaskta,pdf]|mime_in[berkaskta,application/pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'max_size' => '{field} maksimal 10 MB',
                    'ext_in' => '{field} harus berformat PDF',
                    'mime_in' => '{field} harus berformat PDF'
                ]
            ],
            'pbru' => [
                'label' => 'Password',
                'rules' => 'required|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&])[A-Za-z\d@$#!%*?&]{8,}$]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'regex_match' => '{field} Panjang minimal 8 karakter, Minimal satu huruf besar, Minimal satu huruf kecil, Minimal satu angka, dan Minimal satu simbol @$#!%*?&'
                ]
            ],
            'pbru2' => [
                'label' => 'Ulangi Password',
                'rules' => 'required|matches[pbru]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'matches' => '{field} harus sama dengan Password'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors()
            ])->setStatusCode(400);

        } 

        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $secretKey = env('secretKey'); // Masukkan Secret Key Anda

        // Verifikasi reCAPTCHA
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $response = file_get_contents($url . "?secret={$secretKey}&response={$recaptchaResponse}");
        $responseKeys = json_decode($response, true);

        if (!$responseKeys['success']) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'captcha' => 'Invalid CAPTCHA. Please try again.'
                ]
            ])->setStatusCode(400);
        }
        
        $token = bin2hex(random_bytes(32));
        $expired = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $fileberkaskta = $this->request->getFile('berkaskta');
        
        if ($fileberkaskta->isValid() && !$fileberkaskta->hasMoved()) {
            $uuid = generate_uuid();
            // Move the file to a permanent location
            $newFileName = "kta_".$uuid."_".$fileberkaskta->getRandomName();
            $fileberkaskta->move(WRITEPATH . 'uploads/kta', $newFileName);

            $data = [
                "uuid" => $uuid,
                "email" => $this->request->getVar('email'),
                "password" => password_hash($this->request->getVar('pbru'), PASSWORD_DEFAULT),
                "kdgrpuser" => 'developer',
                "nama" => $this->request->getVar('nama'),
                "alamatref" => $this->request->getVar('lokasiref'),
                "alamatinput" => $this->request->getVar('detail_alamat'),
                "notelp" => $this->request->getVar('telp'),
                "kodepos" => $this->request->getVar('kode_pos'),
                "kta" => $this->request->getVar('kta'),
                "berkaskta" => $newFileName,
                "statusvalidator" => 0, // pending
                "validated_at" => date('Y-m-d H:i:s'),
                "validated_by" => session('uuid'),
                "email_token" => $token,
                "email_token_expired" => $expired
            ];

            $this->sendVerificationEmail($this->request->getVar('email'), $token);


            $user = new UserModel();
            $save = $user->save($data);
            if ($save) { 
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'File uploaded successfully!',
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => [
                        'simpan' => 'U03 Gagal menyimpan data'
                    ]
                ])->setStatusCode(400);
            }

        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => [
                    'simpan' => 'U04 Gagal menyimpan data'
                ]
            ])->setStatusCode(400);
        }
        
    }

    private function sendVerificationEmail($email, $token)
    {

        $message = "Click this link to verify your email:\n\n";
        $message .= base_url("verify_email/$token");
        $message .= "\n\nLink ini akan kadaluarsa dalam 1 jam.";

        $kirim = sendMail($email,'Email Verification',$message);
        $kirim = true;
    
        if ($kirim) {
            return true;
        } else {
            return false;
        }
    }

    public function verify_email($token)
    {

        $userModel = new UserModel();

        $user = $userModel->where('email_token', $token)->where('email_token_expired >', date('Y-m-d H:i:s'))->first();

        if ($user) {
            $data = [
                'is_email_verified' => true,
                'email_token' => null,
                'email_token_expired' => null
            ];
            $userModel->where('uuid',$user['uuid'])->set($data)->update();
            return redirect()->to('/login')->with('success', 'Email berhasil diverifikasi. Menunggu validasi admin.');
        }

        return redirect()->to('/login')->with('error', 'Invalid or expired email token.');
    }

    public function profil()
    {
        $menu = getMenu();

        $model = new UserModel();
        $result = $model->where(['email' => session()->get('email')])->first();
        
        $data = [
			'title' => 'Form Pengajuan',
			'breadcrumb' => ['Profil'],
			'stringmenu' => $menu, 
			'validation' => \Config\Services::validation(),
            'result' => $result
        ];
        return view('user/v_profil',$data);
    }

    
    public function form_lupa_password()
	{
        
        $data = [
			'title' => 'Lupa Password',
			'validation' => \Config\Services::validation(), 
        ];
		return view('user/form_lupa_password',$data);
    }

    public function get_token_reset_password()
    {

        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $secretKey = env('secretKey'); // Masukkan Secret Key Anda

        // Verifikasi reCAPTCHA
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $response = file_get_contents($url . "?secret={$secretKey}&response={$recaptchaResponse}");
        $responseKeys = json_decode($response, true);

        if (!$responseKeys['success']) {
            return redirect()->back()->with('error', 'CAPTCHA salah. Silahkan coba lagi.');
        }
        
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        
        $user = $userModel->where('email', $email)->first();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        // dd($user);
    
        // Generate token reset password
        $token = bin2hex(random_bytes(32));
        $expired = date('Y-m-d H:i:s', strtotime('+1 hour'));
        

        // Simpan token ke database
        $data = [
            'reset_token' => $token,    
            'reset_expired' => $expired
        ];
        
        $update = $userModel->where('uuid',$user['uuid'])->set($data)->update();

        $message = "Klik link berikut untuk reset password Anda:\n\n";
        $message .= base_url("form_reset_password/$token");
        $message .= "\n\nLink ini akan kadaluarsa dalam 1 jam.";

        $kirim = sendMail($user['email'],'Reset Password',$message);
        $kirim = true;
    
        if ($kirim) {
            return redirect()->back()->with('success', 'Link reset password telah dikirim ke email Anda');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email reset password');
        }
    }

    public function form_reset_password($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)
                         ->where('reset_expired >', date('Y-m-d H:i:s'))
                         ->first();
                         
        if (!$user) {
            return redirect('form_lupa_password')->with('error', 'Token tidak valid atau sudah kadaluarsa');
        }

        $data = [
            'validation' => \Config\Services::validation(),
            'token' => $token
        ];
    
        return view('user/form_reset_password', $data);
    }

    public function proses_reset_password()
    {
        // Validasi input
        $rules = [
            'token' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Token tidak boleh kosong'
                ]
            ],
            'password' => [
                'rules' => 'required|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$#!%*?&])[A-Za-z\d@$#!%*?&]{8,}$]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'regex_match' => 'Password minimal 8 karakter, Minimal satu huruf besar, Minimal satu huruf kecil, Minimal satu angka, dan Minimal satu simbol @$#!%*?&'
                ]
            ],
            'password_confirm' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong',
                    'matches' => 'Konfirmasi password tidak sama dengan password'
                ]
            ]
        ];

        

        if (!$this->validate($rules)) {
            // dd($this->validator);
            // dd($this->validator->getError('password'));
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_confirm');

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)
                        ->where('reset_expired >', date('Y-m-d H:i:s'))
                        ->first();

        if (!$user) {
            return redirect('form_lupa_password')->with('error', 'Token tidak valid atau sudah kadaluarsa');
        }

        // Update password baru
        $userModel->where('uuid',$user['uuid'])->set([
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_expired' => null
        ])->update();

        return redirect('login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }
}
