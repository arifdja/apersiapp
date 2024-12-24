<?php namespace App\Models;

use CodeIgniter\Model;

class PendanaModel extends Model
{
    protected $table = 'ref_pendana';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $allowedFields = ['uuid','nama'];

	function getPendanaByUUID($uuidpendana)
	{
		$builder = $this->db->table('ref_pendana');
		$builder->where('uuid', $uuidpendana);
		return $builder->get()->getRowArray();
	}

	function getUUIDPendanaByUUIDUser($uuiduser)
	{
		$userModel = new UserModel();
		$user = $userModel->where('uuid', $uuiduser)->first();
		return $user['uuidpendana'];
	}
    

}