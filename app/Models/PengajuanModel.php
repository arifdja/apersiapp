<?php namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table = 'trx_pengajuan';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $useSoftDeletes = true; 
    protected $allowedFields = [
        'suratpermohonan',
        'berkassuratpermohonan',
        'uuidpt',
        'namapj',
        'ktppj',
        'berkasktppj',
        'npwppj',
        'berkasnpwppj',
        'pinjamankpl',
        'berkaspinjamankpl',
        'pinjamankpg',
        'berkaspinjamankpg',
        'pinjamanlain',
        'berkaspinjamanlain',
        'validator',
        'alamatperumahanref',
        'alamatperumahaninput',
        'berkassiteplan',
        'jumlahunit'
    ];
    

}