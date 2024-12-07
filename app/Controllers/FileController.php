<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PTModel;

class FileController extends Controller
{
    /**
     * Fungsi untuk mendownload file berdasarkan tipe dan nama berkas
     * 
     * Fungsi ini akan menghandle download file dengan beberapa tipe:
     * - kta: Kartu Tanda Anggota dari UserModel
     * - akta_pendirian: Akta Pendirian PT dari PTModel  
     * - rekening: Rekening bank dari PTModel
     * - npwp_pt: NPWP PT dari PTModel
     * - ktp_penanggung_jawab: KTP Penanggung Jawab dari PTModel
     * - npwp_penanggung_jawab: NPWP Penanggung Jawab dari PTModel
     * - pinjaman_kpl: Berkas Pinjaman KPL dari PTModel
     * - pinjaman_kpg: Berkas Pinjaman KPG dari PTModel
     * - pinjaman_lain: Berkas Pinjaman Lain dari PTModel
     *
     * @param string $type Tipe file yang akan didownload
     * @param string $berkas Nama berkas yang akan didownload
     * @return mixed Response download file jika berhasil, redirect dengan error jika gagal
     */
    public function download($type,$berkas)
    {
        if($type == 'kta'){

            $model = new UserModel();
            $file = $model->where('berkaskta',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaskta'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkaskta']);

        }elseif($type == 'akta_pendirian'){

            $model = new PTModel();
            $file = $model->where('berkasaktapendirian',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasaktapendirian'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkasaktapendirian']);


        }elseif($type == 'rekening'){
            $model = new PTModel();
            $file = $model->where('berkasrekening',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasrekening'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkasrekening']);

        }elseif($type == 'npwp_pt'){
            $model = new PTModel();
            $file = $model->where('berkasnpwp',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasnpwp'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkasnpwp']);

        }elseif($type == 'ktp_penanggungjawab'){
            $model = new PTModel();
            $file = $model->where('berkasktppj',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasktppj'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkasktppj']);

        }elseif($type == 'npwp_penanggungjawab'){
            $model = new PTModel();
            $file = $model->where('berkasnpwppj',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasnpwppj'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkasnpwppj']);

        }elseif($type == 'pinjaman_kpl'){
            $model = new PTModel();
            $file = $model->where('berkaspinjamankpl',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspinjamankpl'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkaspinjamankpl']);

        }elseif($type == 'pinjaman_kpg'){
            $model = new PTModel();
            $file = $model->where('berkaspinjamankpg',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspinjamankpg'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkaspinjamankpg']);

        }elseif($type == 'pinjaman_lain'){
            $model = new PTModel();
            $file = $model->where('berkaspinjamanlain',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspinjamanlain'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkaspinjamanlain']);

        }else{
            return redirect()->back()->with('error', 'File not found.');
        }

       
    }
    
}
