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
        $builder->select('ref_pt.*,ref_bank.namabank,rbb.namabank as namabankescrow,users.nama as namadeveloper');
        $builder->join('ref_bank','ref_bank.kodebank = ref_pt.kodebank','left');
        $builder->join('ref_bank rbb','rbb.kodebank = ref_pt.kodebankescrow','left');
        $builder->join('users','users.uuid = ref_pt.uuiddeveloper','left');
        if($uuiddeveloper != null){
            $builder->where('ref_pt.uuiddeveloper',$uuiddeveloper);
        }
        $builder->orderBy('ref_pt.updated_at','DESC');
        $result = $builder->get()->getResultArray();
        $result = addNamaWilayah($result,'alamatref');
        return $result;
    }

    function getPTByPendana()
    {
		$pendanaModel = new PendanaModel();
		$pendana = $pendanaModel->getUUIDPendanaByUUIDUser(session()->get('uuid'));
		
		$sql = "SELECT a.*,ref_bank.namabank as namabank,rbb.namabank as namabankescrow,users.nama as namadeveloper FROM (
                    SELECT * 
                    FROM ref_pt t2
                    WHERE EXISTS (
                        SELECT 1 
                        FROM trx_pengajuan t3
                        WHERE t3.uuidpt = t2.uuid AND
                        t3.uuidpendana = ?
                    )
				) a
                left join ref_bank on (ref_bank.kodebank = a.kodebank)
                left join ref_bank rbb on (rbb.kodebank = a.kodebankescrow)
                left join users on (users.uuid = a.uuiddeveloper)

				";
		$result = $this->db->query($sql,$pendana)->getResultArray();
		$result = addNamaWilayah($result,'alamatref');
		return $result;
    }

    

}