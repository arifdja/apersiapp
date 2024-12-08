<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PTModel;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;

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

        }elseif($type == 'surat_permohonan'){
            $model = new PengajuanModel();
            $file = $model->where('berkassuratpermohonan',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkassuratpermohonan'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkassuratpermohonan']);

        } elseif($type == 'site_plan'){
            $model = new PengajuanModel();
            $file = $model->where('berkassiteplan',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkassiteplan'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkassiteplan']);

        } elseif($type == 'sertifikat'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkassertifikat',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkassertifikat'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkassertifikat']);

        } elseif($type == 'pbb'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkaspbb',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspbb'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkaspbb']);

        } elseif($type == 'ktp_debitur'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkasktpdebitur',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasktpdebitur'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkasktpdebitur']);

        } elseif($type == 'rekening_debitur'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkasrekening',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasrekening'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkasrekening']);

        } elseif($type == 'sp3k'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkassp3k',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkassp3k'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName($file['berkassp3k']);

        }   else{
            return redirect()->back()->with('error', 'File not found.');
        }

       
    }
    
}
