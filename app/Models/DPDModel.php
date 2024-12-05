<?php namespace App\Models;

use CodeIgniter\Model;

class DPDModel extends Model
{
    protected $table = 'ref_dpd';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $allowedFields = ['id','namadpd'];
    

}