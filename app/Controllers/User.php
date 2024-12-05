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

    public function hashpassword($password)
    {
        echo password_hash($password, PASSWORD_DEFAULT);
    }

    public function validateUser()
    {

        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $secretKey = '6LdGWZAqAAAAAHT8Jkxwyuku7rvXuVFwP1Piz7pQ'; // Masukkan Secret Key Anda

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
        $data = $model->where(['email' => $username])->first();
       
        
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'uuid' => $data['uuid'],
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'notelp' => $data['notelp'],
                    'kdgrpuser' => $data['kdgrpuser'],
                    // 'nmgrpuser' => $data[s'nmgrpuser'],
                    'logged_in' => true
                ];
                session()->set($ses_data);
                session()->setFlashdata('type','Success');
                session()->setFlashdata('msg',$data['nama'].' Berhasil Login');
                if(substr($data['kdgrpuser'],0,3) == 'dja') {
                    return redirect()->to("/".substr($data['kdgrpuser'],0,3));
                } else {
                    return redirect()->to("/".$data['kdgrpuser']);
                }
            } else {
                session()->setFlashdata('type','Warning');
                session()->setFlashdata('msg','Password yang anda masukkan salah');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('type','Warning');
            session()->setFlashdata('msg','Userid tidak terdaftar');
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
		return view('user/form_register2',$data);
    }

    public function register()
	{

        // Get uploaded file
        // $fileberkaskta = $this->request->getFile('berkaskta');    

        if (!$this->validate([
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
                'label' => 'Kartu Tanda Anggota (KTA)',
                'rules' => 'uploaded[berkaskta]|max_size[berkaskta,10000]|ext_in[berkaskta,pdf]',
                'errors' => [
                    'uploaded' => '{field} harus diisi',
                    'ext_in' => '{field} harus berformat pdf',
                    'max_size' => '{field} maksimal 2 MB'
                ]
            ],
            'pbru' => [
                'label' => 'Password',
                'rules' => 'required|regex_match[^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'regex_match' => '{field} Panjang minimal 8 karakter, Minimal satu huruf besar, Minimal satu huruf kecil, Minimal satu angka, dan Minimal satu simbol'
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
            ])) {
                
            $validation = \Config\Services::validation();
            return redirect()->to('/form_register')->withInput()->with('validation',  $this->validator);
        } else {

            $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
            $secretKey = '6LdGWZAqAAAAAHT8Jkxwyuku7rvXuVFwP1Piz7pQ'; // Masukkan Secret Key Anda

            // Verifikasi reCAPTCHA
            $url = "https://www.google.com/recaptcha/api/siteverify";
            $response = file_get_contents($url . "?secret={$secretKey}&response={$recaptchaResponse}");
            $responseKeys = json_decode($response, true);

            if (!$responseKeys['success']) {
                return redirect()->back()->withInput()->with('captcha_error', 'Invalid CAPTCHA. Please try again.');
            }

            $fileberkaskta = $this->request->getFile('berkaskta');

            if ($fileberkaskta->isValid() && !$fileberkaskta->hasMoved()) {
                // Move the file to a permanent location
                $newFileName = $fileberkaskta->getRandomName();
                $fileberkaskta->move(WRITEPATH . 'uploads', $newFileName);
                session()->set('uploaded_file', $newFileName);


                $data = [
                    "email" => $this->request->getVar('email'),
                    "password" => password_hash($this->request->getVar('pbru'), PASSWORD_DEFAULT),
                    "kdgrpuser" => 'developer',
                    "nama" => $this->request->getVar('nama'),
                    "alamatref" => $this->request->getVar('lokasiref'),
                    "alamatinput" => $this->request->getVar('detail_alamat'),
                    "notelp" => $this->request->getVar('telp'),
                    "kodepos" => $this->request->getVar('kode_pos'),
                    "kta" => $this->request->getVar('kta'),
                    "berkaskta" => $fileberkaskta->getName()
                ];
    
                $user = new UserModel();
                $save = $user->save($data);
                if ($save) {
                    session()->setFlashdata('type','Success');
                    session()->setFlashdata('msg','Berhasil Register, Silahkan login');
                } else {
                    session()->setFlashdata('type','Success');
                    session()->setFlashdata('msg',$user->errors());
                }
                return redirect()->to('/login');

            } else {
                session()->setFlashdata('type','Warning');
                session()->setFlashdata('msg','There was an issue uploading the file.');
                return redirect()->to('/form_register');
            }


        }
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
}
