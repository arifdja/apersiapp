<?php namespace App\Models;

use CodeIgniter\Model;

class PendanaModel extends Model
{
    protected $table = 'ref_pendana';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $allowedFields = ['uuid','nama'];
    

}