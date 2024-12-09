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
        'uuid',
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
        'rekening',
        'berkasrekening',
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

    
    function getPengajuanUnit($uuid)
    {
        $builder = $this->db->table($this->table);
        $builder->select('trx_pengajuan_detail.*,ref_bank.namabank');
        $builder->join('ref_bank','ref_bank.kodebank = trx_pengajuan_detail.bank');
        $builder->where('uuidheader',$uuid);
        $builder->where('trx_pengajuan_detail.deleted_at',null);
        return $builder->get()->getResultArray();
    }
    

}