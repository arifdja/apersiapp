<?php

namespace App\ValidationByArdevpro;
use App\Models\UserModel;
use App\Models\PengajuanModel;
use App\Models\PTModel;
use App\Models\PengajuanDetailModel;

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

    public function checkUniqueNamaPT(string $str, string $field = null, array $data = null): bool
    {
        session();
        $model = new PTModel();
        $result = $model->where('namapt',$str)->where('uuiddeveloper',session('uuid'))->first();
        if ($result) {
            $error = "Nama PT sudah terdaftar";
            return false;
        }
        return true;
    } 

    
    public function checkUniqueUnit(string $str, string $field = null, array $data = null): bool
    {
        session();
        $model = new PengajuanDetailModel();
        $db = \Config\Database::connect();
        $result = $db->query("SELECT * FROM trx_pengajuan_detail WHERE CONCAT(sertifikat,nomordokumensp3k) = ?", [$data['sertifikat'].$data['sp3k']])->getRow();
        if ($result) {
            $error = "Dilihat dari Nomor Sertifikat dan Nomor Dokumen SP3K, unit sudah terdaftar pada sistem";
            return false;
        }
        return true;
    } 
    

    public function checkNPWPPT(string $str, string &$error = null): bool
    {
        session();
        $model = new PTModel();
        $data = $model->where('npwppt', $str)->first();
        if ($data) {
            $error = "Melihat data NPWP PT, PT sudah terdaftar pada sistem";
            return false;
        }
        return true;
    } 
    

    public function checkDanaTalangan(string $str, string $field = null, array $data = null): bool
    {
        //$data adalah data yang diinputkan
        //$field adalah field yang diinputkan
        //$str adalah value dari field yang diinputkan

        if((int)($data['harga']*0.7) < (int)$data['nilaikredit']){
            $error = "Nilai Dana Talangan tidak boleh lebih besar dari 70% dari harga sesuai persetujuan kredit (SP3K)";
            return false;
        }
        return true;
    } 

    
    public function checkDanaByKPL(string $str, string $field = null, array $data = null): bool
    {
        //$data adalah data yang diinputkan
        //$field adalah field yang diinputkan
        //$str adalah value dari field yang diinputkan

        if(((int)$data['pinjaman_kpl'] + (int)$data['pinjaman_kyg'] + (int)$data['pinjaman_lain']) >= (int)$data['nilaikredit']){
            $error = "Total Potongan KPL, KYG, dan Lain tidak boleh lebih besar dari Nilai Dana Talangan";
            return false;
        }
        return true;
    } 

    public function checkMaxDanaTalangan(string $str, string &$error = null): bool
    {
        // var_dump($str);exit;
        if((int)$str > 150000000){
            $error = "Invalid Nilai Dana Talangan";
            return false;
        }
        return true;
    } 

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