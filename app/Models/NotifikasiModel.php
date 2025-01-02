<?php namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'trx_notifikasi';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $allowedFields = ['uuid','user_uuid','label','isi','status','url','email'];
    

}