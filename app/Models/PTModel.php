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
        'penguruspt',
        'berkaspengurusptktp',
        'berkaspengurusptnpwp',
        'aktapendirian',
        'berkasaktapendirian',
        'berkasskkemenkumham',
        'rekening',
        'kodebank',
        'berkasrekening',
        'kodebankescrow',
        'rekeningescrow',
        'berkasrekeningescrow',
        'berkaslaporankeuangan',
        'dpd',
        'statusvalidator',
        'validated_at',
        'validated_by',
        'keteranganpenolakan'
    ];

    function getPengajuanPT($uuiddeveloper = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('ref_pt.*,ref_bank.namabank,rbb.namabank as namabankescrow,ref_provinsi.namaprovinsi,ref_kabupaten.namakabupaten,ref_kota.namakota,ref_kecamatan.namakecamatan,users.nama as namadeveloper');
        $builder->join('ref_provinsi','ref_provinsi.id = substr(ref_pt.alamatref,1,2)','left');
        $builder->join('ref_kabupaten','ref_kabupaten.id = substr(ref_pt.alamatref,1,4)','left');
        $builder->join('ref_kota','ref_kota.id = substr(ref_pt.alamatref,1,6)','left');
        $builder->join('ref_kecamatan','ref_kecamatan.id = substr(ref_pt.alamatref,1,10)','left');
        $builder->join('ref_bank','ref_bank.kodebank = ref_pt.kodebank','left');
        $builder->join('ref_bank rbb','rbb.kodebank = ref_pt.kodebankescrow','left');
        $builder->join('users','users.uuid = ref_pt.uuiddeveloper','left');
        if($uuiddeveloper != null){
            $builder->where('uuiddeveloper',$uuiddeveloper);
        }
        if(session()->get('kdgrpuser') == "approver"){
            $builder->where('ref_pt.statusvalidator', 1);
        }
        $builder->orderBy('ref_pt.updated_at','DESC');
        return $builder->get()->getResultArray();
    }

    function getPTByPendana()
    {
		$pendanaModel = new PendanaModel();
		$pendana = $pendanaModel->getUUIDPendanaByUUIDUser(session()->get('uuid'));
		
		$sql = "SELECT a.*,ref_provinsi.namaprovinsi,ref_kabupaten.namakabupaten,ref_kota.namakota ,ref_kecamatan.namakecamatan ,ref_bank.namabank as namabank,rbb.namabank as namabankescrow,users.nama as namadeveloper FROM (
                    SELECT * 
                    FROM ref_pt t2
                    WHERE EXISTS (
                        SELECT 1 
                        FROM trx_pengajuan t3
                        WHERE t3.uuidpt = t2.uuid AND
                        t3.uuidpendana = ?
                    )
				) a
				left join ref_provinsi on (ref_provinsi.id = substr(a.alamatref,1,2))
				left join ref_kabupaten on (ref_kabupaten.id = substr(a.alamatref,1,4))
				left join ref_kota on (ref_kota.id = substr(a.alamatref,1,6))
				left join ref_kecamatan on (ref_kecamatan.id = substr(a.alamatref,1,10))
                left join ref_bank on (ref_bank.kodebank = a.kodebank)
                left join ref_bank rbb on (rbb.kodebank = a.kodebankescrow)
                left join users on (users.uuid = a.uuiddeveloper)

				";
		return $this->db->query($sql,$pendana)->getResultArray();
    }

    

}