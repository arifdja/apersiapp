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
        'pinjamankyg',
        'berkaspinjamankyg',
        'pinjamanlain',
        'berkaspinjamanlain',
        'validator',
        'alamatperumahanref',
        'alamatperumahaninput',
        'berkassiteplan',
        'jumlahunit',
        'statusvalidator',
        'validated_at',
        'validated_by',
        'keteranganpenolakan'
    ];

    function getPengajuanDana()
    {
        $sql = "SELECT trx_pengajuan.*, ref_pt.namapt, ref_dpd.namadpd, 
                ref_provinsi.namaprovinsi, ref_kabupaten.namakabupaten, 
                ref_kota.namakota, ref_kecamatan.namakecamatan, COUNT(trx_pengajuan_detail.uuid) AS jumlahunitinput,
		        SUM(trx_pengajuan_detail.nilaikredit) AS totalnilaikredit
                FROM trx_pengajuan
                JOIN ref_pt ON ref_pt.uuid = trx_pengajuan.uuidpt
                JOIN ref_dpd ON ref_dpd.id = trx_pengajuan.dpd
                JOIN ref_provinsi ON ref_provinsi.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,2)
                JOIN ref_kabupaten ON ref_kabupaten.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,4)
                JOIN ref_kota ON ref_kota.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,6)
                JOIN ref_kecamatan ON ref_kecamatan.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,10)
                LEFT JOIN trx_pengajuan_detail ON trx_pengajuan_detail.uuidheader = trx_pengajuan.uuid
                GROUP BY trx_pengajuan.uuid, ref_pt.namapt, ref_dpd.namadpd, 
                ref_provinsi.namaprovinsi, ref_kabupaten.namakabupaten,
                ref_kota.namakota, ref_kecamatan.namakecamatan,
                trx_pengajuan.suratpermohonan, trx_pengajuan.berkassuratpermohonan,
                trx_pengajuan.uuidpt, trx_pengajuan.dpd, trx_pengajuan.namapj,
                trx_pengajuan.ktppj, trx_pengajuan.berkasktppj, trx_pengajuan.npwppj,
                trx_pengajuan.berkasnpwppj, trx_pengajuan.pinjamankpl, trx_pengajuan.berkaspinjamankpl,
                trx_pengajuan.pinjamankyg, trx_pengajuan.berkaspinjamankyg, trx_pengajuan.pinjamanlain,
                trx_pengajuan.berkaspinjamanlain, trx_pengajuan.validator, trx_pengajuan.alamatperumahanref,
                trx_pengajuan.alamatperumahaninput, trx_pengajuan.berkassiteplan, trx_pengajuan.jumlahunit,
                trx_pengajuan.statusvalidator, trx_pengajuan.validated_at, trx_pengajuan.validated_by,
                trx_pengajuan.keteranganpenolakan, trx_pengajuan.updated_at
                ORDER BY trx_pengajuan.updated_at DESC";
        return $this->db->query($sql)->getResultArray();
    }

}