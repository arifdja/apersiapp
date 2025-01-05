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
        if(session()->get('kdgrpuser') == "approver"){
            $where = "AND t3.submited_status IN (3,4,5,6,7,8)";
        } 
		if(session()->get('kdgrpuser') == "operator"){
			$where = "AND t3.submited_status IN (1,2,3,4,5,6,7,8)";
		}

		$sql = "SELECT a.* FROM (
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

			";
		$result = $this->db->query($sql)->getResultArray();
		$result = addNamaWilayah($result);
		$result = addNamaDPD($result);
		return $result;
	}

	function getDeveloperForApproval()
	{
		$builder = $this->db->table('users');
		$builder->select('users.uuid,users.email,users.notelp,users.nama,users.alamatinput,users.alamatref,users.kta,users.berkaskta,users.kodepos,users.statusvalidator,users.dpd');
		$builder->where('users.kdgrpuser', 'developer');
		$builder->where('users.is_email_verified', 1);
		$result = $builder->get()->getResultArray();

		$result = addNamaWilayah($result);
		$result = addNamaDPD($result);

		return $result;
	}

	function getDeveloperByPendana()
	{

		$pendanaModel = new PendanaModel();
		$pendana = $pendanaModel->getUUIDPendanaByUUIDUser(session()->get('uuid'));
		
		$sql = "SELECT a.* FROM (
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

				";
		$result = $this->db->query($sql,$pendana)->getResultArray();
		$result = addNamaWilayah($result,'alamatref');
		$result = addNamaDPD($result);
		return $result;
	}

	function getDeveloperByUUIDPengajuan($uuid)
	{
		$builder = $this->db->table('users');
		$builder->select('users.*');
		$builder->join('ref_pt','ref_pt.uuiddeveloper = users.uuid','left');
		$builder->join('trx_pengajuan','trx_pengajuan.uuidpt = ref_pt.uuid','left');
		$builder->where('trx_pengajuan.uuid',$uuid);
		$builder->where('users.statusvalidator',1);
		$builder->where('users.is_email_verified',1);
		return $builder->get()->getRowArray();
	}

	function getUUIDUserByUUIDPendana($uuidpendana)
	{
		$builder = $this->db->table('users');
		$builder->select('users.uuid');
		$builder->join('ref_pendana','ref_pendana.uuid = users.uuidpendana','left');
		$builder->where('users.uuidpendana',$uuidpendana);
		return $builder->get()->getRowArray();
	}
}