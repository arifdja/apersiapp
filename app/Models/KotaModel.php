<?php namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table = 'ref_kota';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $allowedFields = ['id','namakota','idkabupaten'];
    

}