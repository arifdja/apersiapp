<?php namespace App\Models;

use CodeIgniter\Model;

class PengajuanDetailModel extends Model
{
    protected $table = 'trx_pengajuan_detail';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $useSoftDeletes = true; 
    protected $allowedFields = [
        'uuidheader',
        'sertifikat',
        'berkassertifikat',
        'pbb',
        'berkaspbb',
        'harga',
        'nilaikredit',
        'nomordokumensp3k',
        'tanggalsp3k',
        'berkassp3k',
        'namadebitur',
        'berkasktpdebitur',
        'bank',
        'statusvalidator',
        'statussikumbang',
        'statuseflpp',
        'statussp3k',
        'statusapprover'
    ];
    

}