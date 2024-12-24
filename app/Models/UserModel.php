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
	protected $allowedFields = ['uuid','email','password','kdgrpuser','kodepos','notelp','nama','alamatref','alamatinput','kta','berkaskta','statusvalidator','validated_at','validated_by','reset_token','reset_expired','keteranganpenolakan','is_email_verified','email_token','email_token_expired'];
   
	function getDeveloper()
	{
		$builder = $this->db->table('users');
		$builder->select('users.uuid,users.email,users.notelp,users.nama,users.alamatinput,users.kta,users.berkaskta,users.kodepos,users.statusvalidator,ref_provinsi.namaprovinsi as provinsi,ref_kabupaten.namakabupaten as kabupaten,ref_kota.namakota as kota,ref_kecamatan.namakecamatan as kecamatan');
		$builder->join('ref_provinsi','ref_provinsi.id = substr(users.alamatref,1,2)');
		$builder->join('ref_kabupaten','ref_kabupaten.id = substr(users.alamatref,1,4)');
		$builder->join('ref_kota','ref_kota.id = substr(users.alamatref,1,6)');
		$builder->join('ref_kecamatan','ref_kecamatan.id = substr(users.alamatref,1,10)');
		$builder->where('users.kdgrpuser', 'developer');
		if(session()->get('kdgrpuser') == "approver"){
			$builder->where('users.statusvalidator', 1);
		}
		$builder->where('users.is_email_verified', 1);
		return $builder->get()->getResultArray();
	}

	function getDeveloperByPendana()
	{

		$pendanaModel = new PendanaModel();
		$pendana = $pendanaModel->getUUIDPendanaByUUIDUser(session()->get('uuid'));
		
		$sql = "SELECT a.*,ref_provinsi.namaprovinsi as provinsi,ref_kabupaten.namakabupaten as kabupaten,ref_kota.namakota as kota,ref_kecamatan.namakecamatan as kecamatan FROM (
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

				";
		return $this->db->query($sql,$pendana)->getResultArray();
	}
}