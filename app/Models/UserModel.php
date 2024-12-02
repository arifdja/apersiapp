<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup = 'default';
	protected $table = 't_user';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
	protected $allowedFields = ['uuid','email','password','kdgrpuser','notelp','nama'];
   

	function getUser($userid,$source_id="lokal")
    {
		$db      = \Config\Database::connect('db2024');
		// var_dump($this->check_database($db));exit;
		// var_dump($db);exit;
		$sql = "SELECT a.*,b.* FROM t_user a LEFT JOIN t_user_role b ON (a.userid = b.userid) WHERE a.userid = ? AND a.source_id = ? AND b.base_role = ? ";
		$query = $db->query($sql,[$userid,$source_id,'1']);
		$result = $query->getRowArray();
        return $result;
	}

	
	function getUserAdmin()
    {
		$db      = \Config\Database::connect('db2024');
		$sql = "SELECT a.*,b.* FROM t_user a LEFT JOIN t_user_role b ON (a.userid = b.userid) WHERE a.userid = ? ";
		$query = $db->query($sql,['pegawai']);
		$result = $query->getRowArray();
        return $result;
	}

	public function check_database($database)
	{
		if ($database) 
		{
			// check if db exists:
			if($database->initialize()) {
				//db connection initialized
				var_dump('Koneksi Berhasil');
			} else {
				var_dump('Database tidak ada'); // db not exist
			}
		} else {
			//db connection  not initialized
			var_dump('Koneksi Gagal');
		}
	} 

	function getUserid($like)
    {
		$db      = \Config\Database::connect('db2024');
		$sql = "SELECT id,userid FROM t_user WHERE userid = '$like' and userid != 'pegawai' ";
		$query = $db->query($sql);
		$result = $query->getResultArray();
        return $result;
	}
	
	function getUserByID($like)
    {
		$start = ($like * 1000) - 999; 
		$end = ($like * 1000);
		$db      = \Config\Database::connect('db2024');
		$sql = "SELECT id,userid FROM t_user WHERE id between ? and ? and userid != 'pegawai' ";
		$query = $db->query($sql,[$start,$end]);
		$result = $query->getResultArray();
        return $result;
	}
	
	
	function getUserPerKL($like)
    {
		$db      = \Config\Database::connect('db2024');
		$sql = "SELECT id,userid FROM t_user WHERE kddept = ? and kdgrpuser = 'satker' and userid != 'pegawai' ";
		$query = $db->query($sql,[$like]);
		$result = $query->getResultArray();
        return $result;
	}
	
	function getUserEselonKL()
    {
		$db      = \Config\Database::connect('db2024');
		$sql = "SELECT id,userid FROM t_user WHERE kdgrpuser in ('unit','kl') and userid != 'pegawai' ";
		$query = $db->query($sql);
		$result = $query->getResultArray();
        return $result;
    }

	function resetPassword($like)
    {
		$db      = \Config\Database::connect('db2024');
		$query = $db->query('UPDATE t_user set password = $password WHERE userid = ?');
		$result = $query->getResultArray();
        return $result;
	}
	
	function akses_api($kddept)
    {
		$db      = \Config\Database::connect('db2024');
		$sql = "SELECT a.id,a.userid FROM t_user a LEFT JOIN t_user_role b ON (a.userid = b.userid) WHERE b.kddept = ? and b.kdgrpuser = 'api' and a.kdakses is null and a.userid != 'pegawai' ";
		$query = $db->query($sql,[$kddept]);
		$result = $query->getResultArray();
		if (count($result) > 0) {
			return TRUE;
		} 
		return FALSE;
    }
}