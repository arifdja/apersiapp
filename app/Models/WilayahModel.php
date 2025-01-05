<?php namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'ref_wilayah';
	protected $primariKey = 'kode';
	protected $returnType = 'array';
	protected $useTimestamps = false;
    protected $allowedFields = ['kode','nama'];
    

}