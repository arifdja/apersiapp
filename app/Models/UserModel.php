<?php namespace App\Models;

use CodeIgniter\Model;

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

	function getDeveloper2()
	{
		$sql = "SELECT users.uuid, users.email, users.notelp, users.nama, users.alamatinput, users.kta, users.berkaskta, users.kodepos, users.statusvalidator, ref_pt.uuid as uuidpt
				FROM users left join ref_pt on ref_pt.uuiddeveloper = users.uuid
				WHERE users.kdgrpuser = 'developer' 
				AND users.statusvalidator = 1 	
				AND users.is_email_verified = 1";
		$query = $this->db->query($sql);
		return $query->getResultArray();
	}
}