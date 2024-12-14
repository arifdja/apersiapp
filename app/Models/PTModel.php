<?php namespace App\Models;

use CodeIgniter\Model;

class PTModel extends Model
{
    protected $table = 'ref_pt';
	protected $primariKey = 'id';
	protected $returnType = 'array';
	protected $useTimestamps = true;
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
        'statusvalidator',
        'validated_at',
        'validated_by',
        'keteranganpenolakan'
    ];

    function getPengajuanPT($uuiddeveloper = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('ref_pt.*,ref_bank.namabank,ref_provinsi.namaprovinsi,ref_kabupaten.namakabupaten,ref_kota.namakota,ref_kecamatan.namakecamatan');
        $builder->join('ref_provinsi','ref_provinsi.id = substr(ref_pt.alamatref,1,2)','left');
        $builder->join('ref_kabupaten','ref_kabupaten.id = substr(ref_pt.alamatref,1,4)','left');
        $builder->join('ref_kota','ref_kota.id = substr(ref_pt.alamatref,1,6)','left');
        $builder->join('ref_kecamatan','ref_kecamatan.id = substr(ref_pt.alamatref,1,10)','left');
        $builder->join('ref_bank','ref_bank.kodebank = ref_pt.kodebank','left');
        if($uuiddeveloper != null){
            $builder->where('uuiddeveloper',$uuiddeveloper);
        }
        if(session()->get('kdgrpuser') == "approver"){
            $builder->where('statusvalidator', 1);
        }
        $builder->orderBy('ref_pt.updated_at','DESC');
        return $builder->get()->getResultArray();
    }

    

}