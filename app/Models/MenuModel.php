<?php namespace App\Models\m2024;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 't_menu';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $allowedFields = ['kode','judul','usersatker','link','icon','is_main_menu','is_active'];
    
	function getKdgrpuser()
    {
		// $db      = \Config\Database::connect('db2024');
		// $sql = "SELECT distinct kdgrpuser FROM t_menu ";
		// $query = $db->query($sql);
		// $result = $query->getResultArray();
        // return $result;

		 $result = [
						'satker' => "Satuan Kerja" , 
						'unit' => "Unit Eselon I" , 
						'kl' => "Kementerian Lembaga" , 
		 			];
		return $result;
	}

}