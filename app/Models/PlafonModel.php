<?php namespace App\Models;

use CodeIgniter\Model;

class PlafonModel extends Model
{
    protected $table = 'ref_plafon';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $useSoftDeletes = true; 
    protected $allowedFields = ['id','plafon','tanggalpenetapan'];
    

}