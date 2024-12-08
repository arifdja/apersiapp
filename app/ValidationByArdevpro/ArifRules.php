<?php

namespace App\ValidationByArdevpro;
use App\Models\UserModel;
use App\Models\PengajuanModel;
class ArifRules
{
    // public function checkOldPassword(string $str, string &$error = null): bool
    // {
    //     session();
    //     $model = new UserModel();
    //     $data = $model->where('userid', session('userid'))->first();
    //     $verify_pass = password_verify($str,$data['password']);
    //     if (! $verify_pass) {
    //         $error = "Password Lama salah";
    //         return false;
    //     }
    //     return true;
    // } 

    public function checkUUIDHeader(string $str, string &$error = null): bool
    {
        session();
        $model = new PengajuanModel();
        $data = $model->where([
            'uuidheader' => $str, 
            'status' => 1
            ])->first();
        if (!$data) {
            $error = "UUID Header tidak valid";
            return false;
        }
        return true;
    } 

    public function checkEmail(string $str, string &$error = null): bool
    {
        session();
        $model = new UserModel();
        $data = $model->where('email', $str)->first();
        if ($data) {
            $error = "Email sudah terdaftar";
            return false;
        }
        return true;
    } 
    
    public function strengthPassword(string $str, string &$error = null): bool
    {
        $password = $str;

        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            // echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            $error = "Password minimal 8 karakter, kombinasi huruf besar, angka, dan special character";
            return false;
        }
        return true;
         
    } 

}