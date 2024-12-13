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
        'keteranganpenolakan',
        'submited_status',
        'submited_time',
        'submited_by',
    ];

    function getPengajuanDana($uuiddeveloper = null)
    {
        //kondisi ketika kdgrpuser 
        if(session()->get('kdgrpuser') == "developer"){
            $uuiddeveloper = session()->get('uuid');
        } else {
            $uuiddeveloper = $uuiddeveloper;
        }
        
        $builder = $this->db->table('ref_pt');
        $builder->select('ref_pt.uuid');
        if(!empty($uuiddeveloper)){
            $builder->where('uuiddeveloper',$uuiddeveloper);
        }
        $uuidpt = $builder->get()->getResultArray();
        $uuidpt = array_column($uuidpt, 'uuid');

        $builder = $this->db->table($this->table);
        $builder->select('trx_pengajuan.*, ref_pt.namapt, ref_dpd.namadpd, ref_provinsi.namaprovinsi, ref_kabupaten.namakabupaten, ref_kota.namakota, ref_kecamatan.namakecamatan, COUNT(trx_pengajuan_detail.uuid) AS jumlahunitinput, SUM(trx_pengajuan_detail.nilaikredit) AS totalnilaikredit, SUM(trx_pengajuan_detail.pinjamankpl) AS totalpinjamankpl, SUM(trx_pengajuan_detail.pinjamankyg) AS totalpinjamankyg, SUM(trx_pengajuan_detail.pinjamanlain) AS totalpinjamanlain, SUM(trx_pengajuan_detail.nilaikredit) AS totaldanatalangan, SUM(trx_pengajuan_detail.harga) AS totalhargasp3k,COUNT(CASE WHEN trx_pengajuan_detail.statusapprover = 1 THEN 1 END) AS totaldisetujui');
        $builder->join('ref_pt','ref_pt.uuid = trx_pengajuan.uuidpt','left');
        $builder->join('ref_dpd','ref_dpd.id = trx_pengajuan.dpd','left');
        $builder->join('ref_provinsi','ref_provinsi.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,2)','left');
        $builder->join('ref_kabupaten','ref_kabupaten.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,4)','left');
        $builder->join('ref_kota','ref_kota.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,6)','left');
        $builder->join('ref_kecamatan','ref_kecamatan.id = SUBSTR(trx_pengajuan.alamatperumahanref,1,10)','left');
        $builder->join('trx_pengajuan_detail','trx_pengajuan_detail.uuidheader = trx_pengajuan.uuid','left');
        if(!empty($uuidpt)){
            $builder->whereIn('uuidpt',$uuidpt);
            $builder->groupBy('trx_pengajuan.uuid, ref_pt.namapt, ref_dpd.namadpd, ref_provinsi.namaprovinsi, ref_kabupaten.namakabupaten, ref_kota.namakota, ref_kecamatan.namakecamatan, trx_pengajuan.suratpermohonan, trx_pengajuan.berkassuratpermohonan, trx_pengajuan.uuidpt, trx_pengajuan.dpd, trx_pengajuan.namapj, trx_pengajuan.ktppj, trx_pengajuan.berkasktppj, trx_pengajuan.npwppj, trx_pengajuan.berkasnpwppj, trx_pengajuan.pinjamankpl, trx_pengajuan.berkaspinjamankpl, trx_pengajuan.pinjamankyg, trx_pengajuan.berkaspinjamankyg, trx_pengajuan.pinjamanlain, trx_pengajuan.berkaspinjamanlain, trx_pengajuan.validator, trx_pengajuan.alamatperumahanref, trx_pengajuan.alamatperumahaninput, trx_pengajuan.berkassiteplan, trx_pengajuan.jumlahunit, trx_pengajuan.statusvalidator, trx_pengajuan.validated_at, trx_pengajuan.validated_by, trx_pengajuan.keteranganpenolakan, trx_pengajuan.updated_at');
            $builder->orderBy('trx_pengajuan.updated_at','DESC');
            $pengajuandana = $builder->get()->getResultArray();
        } else {
            $pengajuandana = [];
        }
        
        return $pengajuandana; 

    }

}