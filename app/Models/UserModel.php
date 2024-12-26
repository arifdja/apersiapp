<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PendanaModel;

class UserModel extends Model
{
	protected $DBGroup = 'default';
	protected $table = 'users';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
	protected $allowedFields = ['uuid','email','password','kdgrpuser','kodepos','notelp','nama','alamatref','alamatinput','kta','berkaskta','dpd','statusvalidator','validated_at','validated_by','reset_token','reset_expired','keteranganpenolakan','is_email_verified','email_token','email_token_expired'];
   
	function getDeveloper()
	{

		$where = '';
		if(session()->get('kdgrpuser') == "operator"){
            $where = "AND t3.submited_status IN (1,2,3,4,5)";
        } 
        if(session()->get('kdgrpuser') == "approver"){
            $where = "AND t3.submited_status IN (3,4,5)";
        } 

		$sql = "SELECT a.*,ref_provinsi.namaprovinsi as provinsi,ref_kabupaten.namakabupaten as kabupaten,ref_kota.namakota as kota,ref_kecamatan.namakecamatan as kecamatan,ref_dpd.namadpd as namadpd FROM (
				SELECT * 
				FROM users t1
				WHERE t1.statusvalidator = 1 AND t1.is_email_verified = 1 AND EXISTS (
					SELECT 1 
					FROM ref_pt t2
					WHERE t2.uuiddeveloper = t1.uuid
					AND EXISTS (
						SELECT 1 
						FROM trx_pengajuan t3
						WHERE t3.uuidpt = t2.uuid $where
					)
				)
			) a
			left join ref_provinsi on (ref_provinsi.id = substr(a.alamatref,1,2))
			left join ref_kabupaten on (ref_kabupaten.id = substr(a.alamatref,1,4))
			left join ref_kota on (ref_kota.id = substr(a.alamatref,1,6))
			left join ref_kecamatan on (ref_kecamatan.id = substr(a.alamatref,1,10))
			left join ref_dpd on (ref_dpd.id = a.dpd)

			";
		return $this->db->query($sql)->getResultArray();
	}

	function getDeveloperByPendana()
	{

		$pendanaModel = new PendanaModel();
		$pendana = $pendanaModel->getUUIDPendanaByUUIDUser(session()->get('uuid'));
		
		$sql = "SELECT a.*,ref_provinsi.namaprovinsi as provinsi,ref_kabupaten.namakabupaten as kabupaten,ref_kota.namakota as kota,ref_kecamatan.namakecamatan as kecamatan,ref_dpd.namadpd as namadpd FROM (
					SELECT * 
					FROM users t1
					WHERE EXISTS (
						SELECT 1 
						FROM ref_pt t2
						WHERE t2.uuiddeveloper = t1.uuid
						AND EXISTS (
							SELECT 1 
							FROM trx_pengajuan t3
							WHERE t3.uuidpt = t2.uuid AND
							t3.uuidpendana = ?
						)
					)
				) a
				left join ref_provinsi on (ref_provinsi.id = substr(a.alamatref,1,2))
				left join ref_kabupaten on (ref_kabupaten.id = substr(a.alamatref,1,4))
				left join ref_kota on (ref_kota.id = substr(a.alamatref,1,6))
				left join ref_kecamatan on (ref_kecamatan.id = substr(a.alamatref,1,10))
				left join ref_dpd on (ref_dpd.id = a.dpd)

				";
		return $this->db->query($sql,$pendana)->getResultArray();
	}
}