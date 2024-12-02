<?php

namespace App\Controllers;

use App\Models\UserModel;

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

    public function form_register()
	{
        $menu = "";
        
        $data = [
			'title' => 'Register',
			'breadcrumb' => ['Home','Profil'],
			'stringmenu' => $menu, 
			'validation' => \Config\Services::validation(), 
        ];
		return view('user/form_register',$data);
    }

    public function register()
	{
        if (!$this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules' => 'trim|required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'telp' => [
                'label' => 'Telepon',
                'rules' => 'trim|required|numeric',
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

            $data = [
                "email" => $this->request->getVar('email'),
                "password" => password_hash($this->request->getVar('pbru'), PASSWORD_DEFAULT),
                "kdgrpuser" => 'developer',
                "nama" => $this->request->getVar('nama'),
                "notelp" => $this->request->getVar('telp'),
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
