<?php $tgl = strtotime($p['tanggalsp3k']); ?>
<?php $tgl = date('Y-m-d', strtotime('+11 weeks', $tgl)); ?>
<?php if(strtotime($tgl) > strtotime(date('Y-m-d'))) : ?>
    <span class="badge badge-danger">Segera Perbaharui</span>
<?php elseif(strtotime($tgl) < strtotime(date('Y-m-d'))) : ?> 
    <span class="badge badge-success">Masih Aman</span>
<?php else : ?>
    -
<?php endif; ?>