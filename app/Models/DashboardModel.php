<?php namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    
    public function getReportUnit()
    {
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
        $sql="SELECT count(*) AS totalpt FROM ref_pt";
        $query = $this->db->query($sql);
        return $query->getRow();
    }


}