<?php


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


//--------------------------------------------------------------------

if (! function_exists('getNamaDept'))
{
	
	function getNamaDept($kddept = "001",$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_dept');
        $builder->select('nmdept');
        $builder->where('kddept', $kddept);
        $querymm = $builder->get();
        $nmdept = $querymm->getRowArray();
        return isset($nmdept['nmdept']) ? $nmdept['nmdept'] : "" ;
    }
}


if (! function_exists('getNamaUnit'))
{
	
	function getNamaUnit($kddept = "001",$kdunit = "01",$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_unit');
        $builder->select('nmunit');
        $builder->where('kddept', $kddept);
        $builder->where('kdunit', $kdunit);
        $querymm = $builder->get();
        $nmdept = $querymm->getRowArray();
        return isset($nmdept['nmunit']) ? $nmdept['nmunit'] : "" ;
    }
}


if (! function_exists('getNamaSatker'))
{
	
	function getNamaSatker($kdsatker = "630931",$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_satker');
        $builder->select('nmsatker');
        $builder->where('kdsatker', $kdsatker);
        $querymm = $builder->get();
        $nmdept = $querymm->getRowArray();
        return isset($nmdept['nmsatker']) ? $nmdept['nmsatker'] : "" ;
    }
}


if (! function_exists('getNamaProgram'))
{
	
	function getNamaProgram($kddept,$kdunit,$kdprogram,$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_program');
        $builder->select('nmprogram');
        $builder->where('kddept', $kddept);
        $builder->where('kdunit', $kdunit);
        $builder->where('kdprogram', $kdprogram);
        $querymm = $builder->get();
        $nmdept = $querymm->getRowArray();
        return isset($nmdept['nmprogram']) ? $nmdept['nmprogram'] : "" ;
    }
}


if (! function_exists('getNamaGiat'))
{
	
	function getNamaGiat($kdgiat,$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_giat');
        $builder->select('nmgiat');
        $builder->where('kdgiat', $kdgiat);
        $querymm = $builder->get();
        $nmdept = $querymm->getRowArray();
        return isset($nmdept['nmgiat']) ? $nmdept['nmgiat'] : "" ;
    }
}


if (! function_exists('getNamaKRO'))
{
	
	function getNamaKRO($kdgiat,$kdoutput,$dbgroup = "default")
	{

        $db      = \Config\Database::connect($dbgroup);
        $builder = $db->table('t_output');
        $builder->select('nmoutput');
        $builder->where('kdgiat', $kdgiat);
        $builder->where('kdoutput', $kdoutput);
        $querymm = $builder->get();
        $nmdept = $querymm->getRowArray();
        return isset($nmdept['nmoutput']) ? $nmdept['nmoutput'] : "" ;
    }
}


if (! function_exists('diEncript'))
{
	
	function diEncript($param = "")
	{
        return base64_encode($param);
    }
}


if (! function_exists('diDecript'))
{
	
	function diDecript($param = "")
	{
        return base64_decode($param);
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