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
     * - pinjaman_kyg: Berkas Pinjaman KYG dari PTModel
     * - pinjaman_lain: Berkas Pinjaman Lain dari PTModel
     *
     * @param string $type Tipe file yang akan didownload
     * @param string $berkas Nama berkas yang akan didownload
     * @return mixed Response download file jika berhasil, redirect dengan error jika gagal
     */
    public function download($type,$berkas,$view=null)
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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaskta'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaskta']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasaktapendirian'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasaktapendirian']);
            }


        }elseif($type == 'sk_kemenkumham'){

            $model = new PTModel();
            $file = $model->where('berkasskkemenkumham',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasskkemenkumham'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasskkemenkumham'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasskkemenkumham']);
            }


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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasrekening'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasrekening']);
            }

        }elseif($type == 'rekening_escrow'){
            $model = new PTModel();
            $file = $model->where('berkasrekeningescrow',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkasrekeningescrow'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasrekeningescrow'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasrekeningescrow']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasnpwp'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasnpwp']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasktppj'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasktppj']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasnpwppj'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasnpwppj']);
            }

        }elseif($type == 'ktp_pengurus'){
            $model = new PTModel();
            $file = $model->where('berkaspengurusptktp',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspengurusptktp'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaspengurusptktp'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaspengurusptktp']);
            }

        }elseif($type == 'laporan_keuangan'){
            $model = new PTModel();
            $file = $model->where('berkaslaporankeuangan',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaslaporankeuangan'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaslaporankeuangan'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaslaporankeuangan']);
            }

        }elseif($type == 'npwp_pengurus'){
            $model = new PTModel();
            $file = $model->where('berkaspengurusptnpwp',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspengurusptnpwp'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaspengurusptnpwp'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaspengurusptnpwp']);
            }
        }   
        elseif($type == 'pbgimb'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkaspbgimb',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspbgimb'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaspbgimb'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaspbgimb']);
            }

        }elseif($type == 'pinjaman_kpl'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkaspinjamankpl',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspinjamankpl'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaspinjamankpl'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaspinjamankpl']);
            }

        }elseif($type == 'pinjaman_kyg'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkaspinjamankyg',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspinjamankyg'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaspinjamankyg'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaspinjamankyg']);
            }

        }elseif($type == 'pinjaman_lain'){
            $model = new PengajuanDetailModel();
            $file = $model->where('berkaspinjamanlain',$berkas)->first();
            $filePath = WRITEPATH . 'uploads/' . $type . '/' . $file['berkaspinjamanlain'];
            if (!$file) {
                return redirect()->back()->with('error', 'File not found.');
            }
    
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaspinjamanlain'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaspinjamanlain']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkassuratpermohonan'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkassuratpermohonan']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkassiteplan'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkassiteplan']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkassertifikat'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkassertifikat']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkaspbb'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkaspbb']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasktpdebitur'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasktpdebitur']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkasrekening'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkasrekening']);
            }

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
            if($view == 'pdf'){
                return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $file['berkassp3k'] . '"')
                ->setBody(file_get_contents($filePath));
            }else{
                return $this->response->download($filePath, null)->setFileName($file['berkassp3k']);
            }

        }   else{
            return redirect()->back()->with('error', 'File not found.');
        }

       
    }

    public function form_pengajuan_kredit(){
       
            $filePath = WRITEPATH . 'uploads/template/form_kredit.docx';

            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File not found on the server.');
            }
            return $this->response->download($filePath, null)->setFileName('form_kredit.docx');
           
    }
    
}
