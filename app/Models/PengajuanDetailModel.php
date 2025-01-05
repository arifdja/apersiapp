<?php namespace App\Models;

use CodeIgniter\Model;

class PengajuanDetailModel extends Model
{
    protected $table = 'trx_pengajuan_detail';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
    protected $allowedFields = [
        'uuidheader',
        'uuid',
        'sertifikat',
        'berkassertifikat',
        'berkaspbgimb',
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
        'rekening',
        'alamatref',
        'alamatinput',
        'berkasrekening',
        'pinjamankpl',
        'berkaspinjamankpl',
        'pinjamankyg',
        'berkaspinjamankyg',
        'pinjamanlain',
        'berkaspinjamanlain',
        'submited_status',
        'submited_time',
        'submited_by',
        'statusvalidator',
        'validated_at',
        'validated_by',
        'statussikumbang',
        'validated_sikumbang_at',
        'validated_sikumbang_by',  
        'kettolaksikumbang',
        'statuseflpp',
        'validated_eflpp_at',
        'validated_eflpp_by',
        'kettolakeflpp',
        'statussp3k',
        'validated_sp3k_at',
        'validated_sp3k_by',
        'kettolaksp3k',
        'statusapprover',
        'approved_at',
        'approved_by',
        'kettolakapprover',
        'keteranganpenolakan',
    ];

    
    function getPengajuanUnit($uuid=null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('trx_pengajuan_detail.*');
        if($uuid) $builder->where('uuidheader',$uuid);
        $result = $builder->get()->getResultArray();
        $result = addNamaWilayah($result,'alamatref');
        return $result;
    }
    

}