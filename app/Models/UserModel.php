<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup = 'default';
	protected $table = 'users';
	protected $primariKey = 'uuid';
	protected $returnType = 'array';
	protected $useTimestamps = true;
	protected $allowedFields = ['uuid','email','password','kdgrpuser','kodepos','notelp','nama','alamatref','alamatinput','kta','berkaskta','statusvalidator','validated_at','validated_by'];
   
	function getDeveloper()
	{
		return $this->select('users.uuid,users.email,users.notelp,users.nama,users.alamatinput,users.kta,users.berkaskta,users.kodepos,users.statusvalidator,ref_provinsi.namaprovinsi as provinsi,ref_kabupaten.namakabupaten as kabupaten,ref_kota.namakota as kota,ref_kecamatan.namakecamatan as kecamatan')
		->join('ref_provinsi','ref_provinsi.id = substr(users.alamatref,1,2)')
		->join('ref_kabupaten','ref_kabupaten.id = substr(users.alamatref,1,4)')
		->join('ref_kota','ref_kota.id = substr(users.alamatref,1,6)')
		->join('ref_kecamatan','ref_kecamatan.id = substr(users.alamatref,1,10)')
		->where('users.kdgrpuser','developer')->findAll();
	}
}