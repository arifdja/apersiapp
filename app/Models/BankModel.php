<?php namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table = 'ref_bank';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $useSoftDeletes = true; 
    protected $allowedFields = ['kodebank','namabank'];
    

}