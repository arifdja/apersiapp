<?php

use Ramsey\Uuid\Guid\Guid;
use Config\Services;


//--------------------------------------------------------------------

if (! function_exists('getMenu'))
{
	
	function getMenu($dbgroup = "default")
	{
        $stringMenu = '';

        $session = \Config\Services::session();
        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('menu');
        $builder->where('kdgrpuser', $session->get('kdgrpuser'));
        $builder->where('is_active', 1);
        $builder->where('is_main_menu', 0);
        $builder->orderBy('kode');
        $querymm = $builder->get();
        foreach ($querymm->getResultArray() as $mm) {
            $builder = $db->table('menu');
            $builder->where('kdgrpuser', $session->get('kdgrpuser'));
            $builder->where('is_active', 1);
            $builder->where('is_main_menu', $mm['kode']);
            $builder->orderBy('kode');
            $querysm = $builder->get();

            if (count($querysm->getResultArray()) > 0) {
                $stringMenu .= '
                <li class="nav-item has-treeview">
                <a href="'.$mm['link'].'" class="nav-link">
                '.$mm['icon'].'
                <p>
                '.$mm['judul'].' 
                '.$mm['label'].'
                </p>
                </a>
                <ul class="nav nav-treeview">';
                foreach ($querysm->getResultArray() as $sm) {
                    $stringMenu .= '
                    <li class="nav-item">
                        <a href="'.$sm['link'].'" class="nav-link">
                        '.$sm['icon'].'
                        <p>'.$sm['judul'].'</p>
                        </a>
                    </li>';
                }
                $stringMenu .= '</ul>
                </li>';
            } 
            else {
                $stringMenu .= 
                ' <li class="nav-item">
                    <a href="'.$mm['link'].'" class="nav-link">
                    '.$mm['icon'].'
                    <p>
                    '.$mm['judul'].'
                    '.$mm['label'].'
                    </p>
                    </a>
                </li>';
            }
        } 
        return $stringMenu;
    }
}



if (! function_exists('diencrypt'))
{
	
	function diencrypt($param = "")
	{
        $encrypter = Services::encrypter();
        return base64_encode($encrypter->encrypt($param));
    }
}


if (! function_exists('didecrypt'))
{
	
	function didecrypt($param = "")
	{
        $encrypter = Services::encrypter();
        try {
            return $encrypter->decrypt(base64_decode($param));
        } catch (\Exception $e) {
            return null;
        }
    }
}

if ( ! function_exists('tgl_indo'))
{
    function date_indo($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.' '.$bulan.' '.$tahun;
    }
}
  
if ( ! function_exists('bulan'))
{
    function bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}


if ( ! function_exists('nmtw'))
{
    function nmtw($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Triwulan I";
                break;
            case 2:
                return "Triwulan II";
                break;
            case 3:
                return "Triwulan III";
                break;
            case 4:
                return "Triwulan IV";
                break;
        }
    }
}


if ( ! function_exists('notw'))
{
    function notw($tw)
    {
        switch ($tw)
        {
            case 1:
                return 1;
                break;
            case 2:
                return 2;
                break;
            case 3:
                return 3;
                break;
            case 4:
                return 4;
                break;
        }
    }
}


if ( ! function_exists('notw_dr_bulan'))
{
    function notw_dr_bulan($bulan)
    {
        switch ($bulan)
        {
            case 1:
                return 1;
                break;
            case 2:
                return 1;
                break;
            case 3:
                return 1;
                break;
            case 4:
                return 2;
                break;
            case 5:
                return 2;
                break;
            case 6:
                return 2;
                break;
            case 7:
                return 3;
                break;
            case 8:
                return 3;
                break;
            case 9:
                return 3;
                break;
            case 10:
                return 4;
                break;
            case 11:
                return 4;
                break;
            case 12:
                return 4;
                break;
        }
    }
}

//Format Shortdate
if ( ! function_exists('shortdate_indo'))
{
    function shortdate_indo($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tanggal = $pecah[2];
        $bulan = short_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.'/'.$bulan.'/'.$tahun;
    }
}
  
if ( ! function_exists('short_bulan'))
{
    function short_bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "01";
                break;
            case 2:
                return "02";
                break;
            case 3:
                return "03";
                break;
            case 4:
                return "04";
                break;
            case 5:
                return "05";
                break;
            case 6:
                return "06";
                break;
            case 7:
                return "07";
                break;
            case 8:
                return "08";
                break;
            case 9:
                return "09";
                break;
            case 10:
                return "10";
                break;
            case 11:
                return "11";
                break;
            case 12:
                return "12";
                break;
        }
    }
}

//Format Medium date
if ( ! function_exists('mediumdate_indo'))
{
    function mediumdate_indo($tgl)
    {
        $ubah = gmdate($tgl, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tanggal = $pecah[2];
        $bulan = medium_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal.'-'.$bulan.'-'.$tahun;
    }
}
  
if ( ! function_exists('medium_bulan'))
{
    function medium_bulan($bln)
    {
        switch ($bln)
        {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Ags";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
}
 
//Long date indo Format
if ( ! function_exists('longdate_indo'))
{
    function longdate_indo($tanggal)
    {
        $ubah = gmdate($tanggal, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];
        $bulan = bulan($pecah[1]);
  
        $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
        $nama_hari = "";
        if($nama=="Sunday") {$nama_hari="Minggu";}
        else if($nama=="Monday") {$nama_hari="Senin";}
        else if($nama=="Tuesday") {$nama_hari="Selasa";}
        else if($nama=="Wednesday") {$nama_hari="Rabu";}
        else if($nama=="Thursday") {$nama_hari="Kamis";}
        else if($nama=="Friday") {$nama_hari="Jumat";}
        else if($nama=="Saturday") {$nama_hari="Sabtu";}
        return $nama_hari.','.$tgl.' '.$bulan.' '.$thn;
    }
}


//Validate dept
if ( ! function_exists('validDept'))
{
    function validDept($kddept = '',$dbgroup = 'default')
    {
        
        $kddept = trim($kddept);
        $kddept = htmlspecialchars(trim($kddept), ENT_QUOTES, "UTF-8");

        if (strlen($kddept) != 3) {
            return [
                'status' => false,
                'value' => ''
            ];
            die;
        }
        
        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_dept');
        $builder->where('kddept', $kddept);
        $query = $builder->get();
        $result = $query->getRowArray();
        
        if(empty($result)){
            return [
                'status' => false,
                'value' => ''
            ];
            die;
        } 
        
        return [
            'status' => true,
            'value' => $result
        ];

    }
}


//Validate unit
if ( ! function_exists('validUnit'))
{
    function validUnit($kdunit = '',$kddept = '',$dbgroup = 'default')
    {
        
        $kdunit = trim($kdunit);
        $kdunit = htmlspecialchars(trim($kdunit), ENT_QUOTES, "UTF-8");

        if (strlen($kdunit) != 2) {
            return [
                'status' => false,
                'value' => ''
            ];
            die;
        }

        $kddept = trim($kddept);
        $kddept = htmlspecialchars(trim($kddept), ENT_QUOTES, "UTF-8");
        
        if (strlen($kddept) != 4) {
            return [
                'status' => false,
                'value' => ''
            ];
            die;
        }
        
        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_unit');
        $builder->where('kddept', $kddept);
        $builder->where('kdunit', $kdunit);
        $query = $builder->get();
        $result = $query->getRowArray();
        
        if(empty($result)){
            return [
                'status' => false,
                'value' => ''
            ];
            die;
        } 
        
        return [
            'status' => true,
            'value' => $result
        ];

    }
}


//Validate satker
if ( ! function_exists('validSatker'))
{
    function validSatker($kdsatker = '',$dbgroup = 'default')
    {
        
        $kdsatker = trim($kdsatker);
        $kdsatker = htmlspecialchars(trim($kdsatker), ENT_QUOTES, "UTF-8");

        if (strlen($kdsatker) != 6) {
            return [
                'status' => false,
                'value' => ''
            ];
            die;
        }
        
        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_satker');
        $builder->where('kdsatker', $kdsatker);
        $query = $builder->get();
        $result = $query->getRowArray();
        
        if(empty($result)){
            return [
                'status' => false,
                'value' => ''
            ];
            die;
        } 
        
        return [
            'status' => true,
            'value' => $result
        ];

    }
}


if (! function_exists('division'))
{
	
	function division($a, $b) {
        if($b == 0) {
          return 0;
        } else {
          return @($a/$b);
        }
    }
}


//--------------------------------------------------------------------

if (! function_exists('getNamaNawacita'))
{
	
	function getNamaNawacita($kd = "00",$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_nawacita');
        $builder->select('nmnawacita');
        $builder->where('kdnawacita', $kd);
        $querymm = $builder->get();
        $result = $querymm->getRowArray();
        return $result['nmnawacita'];
    }
}


//--------------------------------------------------------------------

if (! function_exists('getUserRole'))
{
	
	function getUserRole($userid ,$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_user_role');
        $builder->select('*');
        $builder->where('userid', $userid);
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

//--------------------------------------------------------------------

if (! function_exists('getKL'))
{
	
	function getKL($dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_dept');
        $builder->select('*');
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

//--------------------------------------------------------------------

if (! function_exists('getUnit'))
{
	
	function getUnit($kddept,$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_unit');
        $builder->select('*');
        $builder->where('kddept', $kddept);
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

//--------------------------------------------------------------------

if (! function_exists('getSatker'))
{
	
	function getSatker($kddept,$kdunit,$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_satker');
        $builder->select('*');
        $builder->where('kddept', $kddept);
        $builder->where('kdunit', $kdunit);
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}


//--------------------------------------------------------------------

if (! function_exists('getOptionBulan'))
{
    
    function getOptionBulan()
    {
        $option = [
            '1'  => 'Januari',
            '2'    => 'Februari',
            '3'    => 'Maret',
            '4'    => 'April',
            '5'    => 'Mei',
            '6'    => 'Juni',
            '7'    => 'Juli',
            '8'    => 'Agustus',
            '9'    => 'September',
            '10'    => 'Oktober',
            '11'    => 'November',
            '12'    => 'Desember',
        ];
        return $option; 
    }
}


//--------------------------------------------------------------------

// if (! function_exists('getRole'))
// {
	
// 	function getRole($dbgroup = "default")
// 	{
//         $session = \Config\Services::session();
//         $db      = \Config\Database::connect($dbgroup);
//         $builder = $db->table('t_user_role');
//         $builder->where('userid', $session->get('userid'));
//         $querymm = $builder->get();
//         return $querymm->getResultArray();
//     }
// }


if (! function_exists('hitungEfisiensiPerROSBK'))
{
    
    function hitungEfisiensiPerROSBK($sbk_indeks,$ra_indeks,$jenis_sbk)
    {
        if ($sbk_indeks == 0) {
            $option = 0;
        } else {
            $option = (($sbk_indeks-$ra_indeks) / $sbk_indeks)*100;
        }
        if ($jenis_sbk == "1") {
            if ($option >= 20) {
                $option = 0;
            }
            if($option < 0)
            {
                $option = 0;
            }
        } elseif ($jenis_sbk == "2")
        {

            if ($option >= 20) {
                $option = 20;
            }
            if($option < 0)
            {
                $option = 0;
            }
        }
        return $option; 
    }
}


if (! function_exists('efisiensiDiperhitungkan'))
{
    
    function efisiensiDiperhitungkan($tvro,$rvro,$sbk_indeks,$ra_indeks,$jenis_sbk,$sbknmsoutput)
    {
        $keterangan = "";
        if ($sbknmsoutput == "") {
            $keterangan = "Pilih SBKU yang sesuai terlebih dahulu pada menu penandaan.";
        } else {
            if($rvro < $tvro){
                $keterangan = "Tidak diperhitungkan (0%). RO tidak mencapai target yang ditetapkan (RVRO < TVRO).";
            } else {

                if ($sbk_indeks == 0) {
                    $option = 0;
                } else {
                    $option = (($sbk_indeks-$ra_indeks) / $sbk_indeks)*100;
                }
                if ($jenis_sbk == "1") {
                    if ($option >= 20) {
                        $keterangan = "Tidak diperhitungkan (0%). Indeks realisasi anggaran lebih dari 20% di bawah indeks SBKK.";
                    }
                    if($option < 0)
                    {
                        $keterangan = "Tidak ada efisiensi (0%). Alokasi anggaran terserap maksimal sesuai indeks SBK.";
                    }
                } elseif ($jenis_sbk == "2")
                {

                    if ($option >= 20) {
                       $keterangan = "Diperhitungkan maksimal (max = 20%). Indeks realisasi anggaran lebih dari 20% di bawah indeks SBKU.";
                    }
                    if($option < 0)
                    {
                        $keterangan = "Tidak ada efisiensi (0%). Alokasi anggaran terserap maksimal sesuai indeks SBK.";
                    }
                }

            }
        }

        return $keterangan;
    }
}


//--------------------------------------------------------------------

if (! function_exists('getAllDept'))
{
    
    function getAllDept($dbgroup = "default")
    {

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_dept');
        $builder->select('kddept,nmdept');
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

//--------------------------------------------------------------------

if (! function_exists('getAllUnit'))
{
    
    function getAllUnit($dbgroup = "default")
    {

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_unit');
        $builder->select('kddept,kdunit,nmunit');
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

//--------------------------------------------------------------------

if (! function_exists('getAllRO'))
{
    
    function getAllRO($dbgroup = "default")
    {

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_soutput');
        $builder->select('kddept,kdunit,kdprogram,kdgiat,kdoutput,kdsoutput,nmsoutput,sat');
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

//--------------------------------------------------------------------

if (! function_exists('getAllKRO'))
{
    
    function getAllKRO($dbgroup = "default")
    {

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_output');
        $builder->select('kdgiat,kdoutput,nmoutput,sat');
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

//--------------------------------------------------------------------

if (! function_exists('getAllProgram'))
{
    
    function getAllProgram($dbgroup = "default")
    {

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_program');
        $builder->select('kddept,kdunit,kdprogram,nmprogram');
        $querymm = $builder->get();
        return $querymm->getResultArray(); 
    }
}

if (!function_exists('create_dropdown')) {
    /**
     * Generate an HTML dropdown menu
     *
     * @param string $name Name attribute of the select element
     * @param array $options Array of options in the format [value => label]
     * @param mixed $selected Value of the option to be selected
     * @param array $attributes Additional attributes for the select element
     * @return string HTML string for the dropdown menu
     */
    function create_dropdown($name, $options = [], $selected = null, $attributes = [])
    {
        // Start the select element
        $attrString = '';
        foreach ($attributes as $key => $value) {
            $attrString .= $key . '="' . htmlspecialchars($value, ENT_QUOTES) . '" ';
        }
        
        $html = '<select name="' . htmlspecialchars($name, ENT_QUOTES) . '" ' . $attrString . '>';
        
        // Add options
        foreach ($options as $value => $label) {
            $isSelected = ($value == $selected) ? 'selected' : '';
            $html .= '<option value="' . htmlspecialchars($value, ENT_QUOTES) . '" ' . $isSelected . '>' . htmlspecialchars($label, ENT_QUOTES) . '</option>';
        }
        
        // Close the select element
        $html .= '</select>';
        
        return $html;
    }
}

if (!function_exists('generate_uuid')) {
    function generate_uuid()
    {
        $uuid = Guid::uuid4();
        return $uuid->toString();
    }
}


if (!function_exists('sendMail')) {

    function sendMail($recipient,$subject,$message)
    {
        $email = \Config\Services::email();

        $email->setFrom('admin@sirakyat.id', SITE_NAME);
        $email->setTo($recipient);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}


if (!function_exists('delete_file')) {

    function delete_file(string $filePath): bool
    {
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false; // File tidak ditemukan
    }
}

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($tanggal) {
        try {
            if ($tanggal === null) {
                return null;
            }
            
            $bulan = array (
                1 => 'Januari',
                'Februari',
                'Maret', 
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            
            $split = explode('-', $tanggal);
            
            // Format tanggal jadi 2 Januari 2024
            return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
        } catch (\Exception $e) {
            return null;
        }
    }
}

if (!function_exists('hari_indo')) {
    function hari_indo($tanggal) {
        $hari = array ( 
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat', 
            'Saturday' => 'Sabtu'
        );
        
        $nama_hari = date('l', strtotime($tanggal));
        
        return $hari[$nama_hari];
    }
}

if (!function_exists('tanggal_hari_indo')) {
    function tanggal_hari_indo($tanggal) {
        $hari = hari_indo($tanggal);
        $tanggal = tanggal_indo($tanggal);
        
        return "$hari, $tanggal";
    }
}

if (!function_exists('setNotifikasi')) {
    function setNotifikasi($user_uuid, $label, $isi, $url) {
        try {
            $notifikasiModel = new \App\Models\NotifikasiModel();
            
            $data = [
                'uuid' => $user_uuid,
                'label' => $label,
                'isi' => $isi,
                'status' => 0,
                'url' => $url
            ];
            
            if($notifikasiModel->insert($data)) {
                return true;
            }
            return true; // tetap lanjut meskipun error
            
        } catch (\Exception $e) {
            return true; // tetap lanjut meskipun error
        }
    }
}

if (!function_exists('getNotifikasi')) {
    function getNotifikasi($user_uuid, $unreadonly = true,$limit = null) {
        try {
            $notifikasiModel = new \App\Models\NotifikasiModel();
            
            $query = $notifikasiModel->where('uuid', $user_uuid);
            
            if ($unreadonly) {
                $query->where('status', 0);
            }
            if($limit != null){
                $query->limit($limit);
            }
            
            $data = $query->orderBy('created_at', 'DESC')
                         ->findAll();
            
            return $data;
            
        } catch (\Exception $e) {
            return [];
        }
    }
}


if (! function_exists('getDropdownDPD'))
{
    function getDropdownDPD($id = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_dpd');
        $builder->select('id, namadpd');

        if ($id !== null) {
            $builder->where('id', $id);
            $query = $builder->get();
            $result = $query->getRowArray();
            return isset($result['namadpd']) ? $result['namadpd'] : "";
        }
        
        $builder->orderBy('id', 'ASC');
        $query = $builder->get()->getResultArray();
        $dropdowndpd['dpd'] = ['' => 'Pilih DPD'];
        foreach ($query as $dpd) {
            $dropdowndpd['dpd'][$dpd['id']] = $dpd['namadpd'];
        }
        return $dropdowndpd;
    }
}

if (! function_exists('getProvinsi'))
{
    function getProvinsi($kdprovinsi = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode as id, nama as namaprovinsi');
        $builder->where('LENGTH(kode)', 2);
        
        if ($kdprovinsi !== null) {
            $builder->where('kode', $kdprovinsi);
            $query = $builder->get();
            $result = $query->getRowArray();
            return isset($result['nama']) ? $result['nama'] : "";
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}


if (! function_exists('getDropdownProvinsi'))
{
    function getDropdownProvinsi($kdprovinsi = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode, nama');
        $builder->where('LENGTH(kode)', 2);
        
        if ($kdprovinsi !== null) {
            $builder->where('kode', $kode);
            $query = $builder->get();
            $result = $query->getRowArray();
            return isset($result['nama']) ? $result['nama'] : "";
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        $dropdownprovinsi['provinsi'] = ['' => 'Pilih Provinsi'];
        foreach ($query as $prov) {
            $dropdownprovinsi['provinsi'][$prov['kode']] = $prov['nama'];
        }
        return $dropdownprovinsi;
    }
}

if (! function_exists('getKabupaten'))
{
    function getKabupaten($kdkabupaten = null, $kdprovinsi = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode as id, nama as namakabupaten');
        $builder->where('LENGTH(kode)', 5);
        
        if ($kdkabupaten !== null) {
            $builder->where('kode', $kdkabupaten);
            $query = $builder->get();
            $result = $query->getRowArray();
            return isset($result['nama']) ? $result['nama'] : "";
        }

        if ($kdprovinsi !== null) {
            $builder->where('LEFT(kode,2)', $kdprovinsi);
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}

if (! function_exists('getDropdownKabupaten'))
{
    function getDropdownKabupaten($kdprovinsi = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode, nama');
        $builder->where('LENGTH(kode)', 5);
        
        if ($kdprovinsi !== null) {
            $builder->where('LEFT(kode,2)', $kdprovinsi);
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        $dropdownkabupaten['kabupaten'] = ['' => 'Pilih Kabupaten'];
        foreach ($query as $kab) {
            $dropdownkabupaten['kabupaten'][$kab['kode']] = $kab['nama'];
        }
        return $dropdownkabupaten;
    }
}


if (! function_exists('getKota'))
{
    function getKota($kdkota = null, $kdkabupaten = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode as id, nama as namakota');
        $builder->where('LENGTH(kode)', 8);
        
        if ($kdkota !== null) {
            $builder->where('kode', $kdkota);
            $query = $builder->get();
            $result = $query->getRowArray();
            return isset($result['nama']) ? $result['nama'] : "";
        }

        if ($kdkabupaten !== null) {
            $builder->where('LEFT(kode,5)', $kdkabupaten);
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}

if (! function_exists('getDropdownKota'))
{
    function getDropdownKota($kdkabupaten = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode, nama');
        $builder->where('LENGTH(kode)', 8);
        
        if ($kdkabupaten !== null) {
            $builder->where('LEFT(kode,5)', $kdkabupaten);
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        $dropdownkota['kota'] = ['' => 'Pilih Kota'];
        foreach ($query as $kota) {
            $dropdownkota['kota'][$kota['kode']] = $kota['nama'];
        }
        return $dropdownkota;
    }
}


if (! function_exists('getKecamatan'))
{
    function getKecamatan($kdkecamatan = null, $kdkota = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode as id, nama as namakecamatan');
        $builder->where('LENGTH(kode)', 13);
        
        if ($kdkecamatan !== null) {
            $builder->where('kode', $kdkecamatan);
            $query = $builder->get();
            $result = $query->getRowArray();
            return isset($result['nama']) ? $result['nama'] : "";
        }

        if ($kdkota !== null) {
            $builder->where('LEFT(kode,8)', $kdkota);
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}

if (! function_exists('getDropdownKecamatan'))
{
    function getDropdownKecamatan($kdkota = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');
        $builder->select('kode, nama');
        $builder->where('LENGTH(kode)', 13);
        
        if ($kdkota !== null) {
            $builder->where('LEFT(kode,8)', $kdkota);
        }
        
        $builder->orderBy('kode', 'ASC');
        $query = $builder->get()->getResultArray();
        $dropdownkecamatan['kecamatan'] = ['' => 'Pilih Kecamatan'];
        foreach ($query as $kecamatan) {
            $dropdownkecamatan['kecamatan'][$kecamatan['kode']] = $kecamatan['nama'];
        }
        return $dropdownkecamatan;
    }
}

if (! function_exists('getBank'))
{
    function getBank($kodebank = null, $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_bank');
        $builder->select('kodebank, namabank');
        
        if ($kodebank !== null) {
            $builder->where('kodebank', $kodebank);
            $query = $builder->get();
            $result = $query->getRowArray();
            return isset($result['namabank']) ? $result['namabank'] : "";
        }
        
        $builder->orderBy('namabank', 'ASC');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}



if (! function_exists('getDropdownBank'))
{
    function getDropdownBank($dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_bank');
        $builder->select('kodebank, namabank');
        $builder->orderBy('namabank', 'ASC');
        $bank = $builder->get()->getResultArray();

        $dropdownbank['bank'] = ['' => 'Pilih Bank'];
        foreach ($bank as $b) {
            $dropdownbank['bank'][$b['kodebank']] = $b['kodebank'].' - '.$b['namabank'];
        }

        return $dropdownbank;
    }
}


if (! function_exists('addNamaWilayah'))
{
    function addNamaWilayah($data, $varalamat = "alamatref", $dbgroup = "default") 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_wilayah');

        $provinsi = $builder->select('kode,nama')->where('LENGTH(kode)', 2)->get()->getResultArray();
        $kabupaten = $builder->select('kode,nama')->where('LENGTH(kode)', 5)->get()->getResultArray();
        $kota = $builder->select('kode,nama')->where('LENGTH(kode)', 8)->get()->getResultArray();
        $kecamatan = $builder->select('kode,nama')->where('LENGTH(kode)', 13)->get()->getResultArray();

        // dd($provinsi);

        foreach ($data as $key => $row) {
            if (!empty($row[$varalamat])) {

                // Tambahkan nama wilayah ke array data
                foreach ($provinsi as $prov) {
                    if ($prov['kode'] == substr($row[$varalamat], 0, 2)) {
                        $data[$key]['provinsi'] = $prov['nama'];
                    }
                }

                foreach ($kabupaten as $kab) {
                    if ($kab['kode'] == substr($row[$varalamat], 0, 5)) {
                        $data[$key]['kabupaten'] = $kab['nama'];
                    }
                }

                foreach ($kota as $kot) {
                    if ($kot['kode'] == substr($row[$varalamat], 0, 8)) {
                        $data[$key]['kota'] = $kot['nama'];
                    }
                }

                foreach ($kecamatan as $kec) {
                    if ($kec['kode'] == substr($row[$varalamat], 0, 13)) {
                        $data[$key]['kecamatan'] = $kec['nama'];
                    }
                }
            } else {
                $data[$key]['provinsi'] = '';
                $data[$key]['kabupaten'] = '';
                $data[$key]['kota'] = '';
                $data[$key]['kecamatan'] = '';
            }
        }

        return $data;
    }
}

if (!function_exists('addNamaDPD')) {
    function addNamaDPD($data, $dbgroup = 'default') 
    {
        $db = \Config\Database::connect($dbgroup);
        $builder = $db->table('ref_dpd');

        $dpd = $builder->select('id,namadpd')->get()->getResultArray();

        foreach ($data as $key => $row) {
            if (!empty($row['dpd'])) {
                foreach ($dpd as $d) {
                    if ($d['id'] == $row['dpd']) {
                        $data[$key]['namadpd'] = $d['namadpd'];
                    }
                }
            } else {
                $data[$key]['namadpd'] = '';
            }
        }

        return $data;
    }
}












