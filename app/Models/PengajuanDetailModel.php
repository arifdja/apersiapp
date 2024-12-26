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

    
    function getPengajuanUnit($uuid)
    {
        $builder = $this->db->table($this->table);
        $builder->select('trx_pengajuan_detail.*,ref_provinsi.namaprovinsi,ref_kabupaten.namakabupaten,ref_kota.namakota,ref_kecamatan.namakecamatan');
        $builder->join('ref_provinsi','ref_provinsi.id = SUBSTR(trx_pengajuan_detail.alamatref,1,2)','left');
        $builder->join('ref_kabupaten','ref_kabupaten.id = SUBSTR(trx_pengajuan_detail.alamatref,1,4)','left');
        $builder->join('ref_kota','ref_kota.id = SUBSTR(trx_pengajuan_detail.alamatref,1,6)','left');
        $builder->join('ref_kecamatan','ref_kecamatan.id = SUBSTR(trx_pengajuan_detail.alamatref,1,10)','left');
        $builder->where('uuidheader',$uuid);
        return $builder->get()->getResultArray();
    }
    

}