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
        'uuid',
        'suratpermohonan',
        'berkassuratpermohonan',
        'uuidpt',
        'dpd',
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

    function getPengajuanDana()
    {
        $builder = $this->db->table($this->table);
        $builder->select('trx_pengajuan.*,ref_pt.namapt,ref_dpd.namadpd,ref_provinsi.namaprovinsi,ref_kabupaten.namakabupaten,ref_kota.namakota,ref_kecamatan.namakecamatan');
        $builder->join('ref_pt','ref_pt.uuid = trx_pengajuan.uuidpt');
        $builder->join('ref_dpd','ref_dpd.id = trx_pengajuan.dpd');      
        $builder->join('ref_provinsi','ref_provinsi.id = substr(trx_pengajuan.alamatperumahanref,1,2)');
        $builder->join('ref_kabupaten','ref_kabupaten.id = substr(trx_pengajuan.alamatperumahanref,1,4)');
        $builder->join('ref_kota','ref_kota.id = substr(trx_pengajuan.alamatperumahanref,1,6)');
        $builder->join('ref_kecamatan','ref_kecamatan.id = substr(trx_pengajuan.alamatperumahanref,1,10)');
        return $builder->get()->getResultArray();
    }

}