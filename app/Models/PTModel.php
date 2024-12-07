<?php namespace App\Models;

use CodeIgniter\Model;

class PTModel extends Model
{
    protected $table = 'ref_pt';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $useSoftDeletes = true; 
    protected $allowedFields = 
    [
        'uuid',
        'uuiddeveloper',
        'namapt',
        'alamatref',
        'alamatinput',
        'npwppt',
        'berkasnpwp',
        'namapj',
        'ktppj',
        'berkasktppj',
        'npwppj',
        'berkasnpwppj',
        'aktapendirian',
        'berkasaktapendirian',
        'rekening',
        'kodebank',
        'berkasrekening',
        'pinjamankpl',
        'berkaspinjamankpl',
        'pinjamankpg',
        'berkaspinjamankpg',
        'pinjamanlain',
        'berkaspinjamanlain',
        'statusvalidator',
        'validated_at',
        'validated_by',
        'keteranganpenolakan'
    ];
    

}