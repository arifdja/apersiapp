<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PengajuanModel;
use App\Models\PengajuanDetailModel;


class DashboardModel extends Model
{
    
    public function getReportUnit()
    {
        if(session()->get('kdgrpuser')=='developer'){

            $uuidpt = $this->getUUIDPT(session()->get('uuid'));
            $uuidpt = array_column($uuidpt,'uuid');

            if(empty($uuidpt)){
                return [];
            } 

            $model = new PengajuanModel();
            $model->whereIn('uuidpt',$uuidpt);
            $pengajuan = $model->findAll();
            dd($pengajuan);
            $uuidheader = array_column($pengajuan,'uuid');

            $model = new PengajuanDetailModel();
            $model->whereIn('uuidheader',$uuidheader);
            $pengajuanDetail = $model->findAll();
            $uuid = array_column($pengajuanDetail,'uuid');
        }


        $sql="SELECT
            SUM(CASE WHEN statusvalidator = 1 THEN 1 ELSE 0 END) AS validoperator,
            SUM(CASE WHEN statussikumbang = 1 THEN 1 ELSE 0 END) AS validsikumbang,
            SUM(CASE WHEN statuseflpp= 1 THEN 1 ELSE 0 END) AS valideflpp,
            SUM(CASE WHEN statussp3k = 1 THEN 1 ELSE 0 END) AS validsp3k,
            SUM(CASE WHEN statusapprover = 1 THEN 1 ELSE 0 END) AS validapprover,
            count(*) AS totalunit,
            SUM(nilaikredit) AS totalkredit,
            SUM(harga) AS totalharga
            FROM trx_pengajuan_detail";
        if(session()->get('kdgrpuser')=='developer'){
            $sql .= " WHERE uuid IN ('".implode("','",$uuid)."')";
        }
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getReportUser()
    {
        $sql="SELECT count(*) AS totaluser FROM users where kdgrpuser='developer'";
        $query = $this->db->query($sql);
        return $query->getRow();
    }

    public function getReportPT()
    {
        if(session()->get('kdgrpuser')=='developer'){
            $uuidpt = $this->getUUIDPT(session()->get('uuid'));
            $uuidpt = array_column($uuidpt,'uuid');
            $sql="SELECT count(*) AS totalpt FROM ref_pt WHERE uuid IN ('".implode("','",$uuidpt)."')";
        } else {
            $sql="SELECT count(*) AS totalpt FROM ref_pt";
        }
        $query = $this->db->query($sql);
        
        return $query->getRow();
    }

    private function getUUIDPT($uuiddeveloper=null)
    {
        $sql="SELECT uuid FROM ref_pt WHERE 1";
        if($uuiddeveloper){
            $sql .= " AND uuiddeveloper = ?";
            $query = $this->db->query($sql,[$uuiddeveloper]);
        } else {
            $query = $this->db->query($sql);
        }
        return $query->getResultArray();
    }


}