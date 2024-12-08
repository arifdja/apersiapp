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

    function getPengajuanPT()
    {
        $builder = $this->db->table($this->table);
        $builder->select('ref_pt.*,ref_bank.namabank,ref_provinsi.namaprovinsi,ref_kabupaten.namakabupaten,ref_kota.namakota,ref_kecamatan.namakecamatan');
        $builder->join('ref_provinsi','ref_provinsi.id = substr(ref_pt.alamatref,1,2)');
        $builder->join('ref_kabupaten','ref_kabupaten.id = substr(ref_pt.alamatref,1,4)');
        $builder->join('ref_kota','ref_kota.id = substr(ref_pt.alamatref,1,6)');
        $builder->join('ref_kecamatan','ref_kecamatan.id = substr(ref_pt.alamatref,1,10)');
        $builder->join('ref_bank','ref_bank.kodebank = ref_pt.kodebank');
        return $builder->get()->getResultArray();
    }
    

}