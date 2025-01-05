<?php if($p['submited_status']=='' || $p['submited_status']==null) : ?>
    <span class="badge badge-warning">Draft</span>
<?php elseif($p['submited_status']==1) : ?> 
    <span class="badge badge-warning">Proses Pengecekan</span>
<?php elseif($p['submited_status']==2) : ?>
    <span class="badge badge-danger">Dikembalikan</span>
<?php elseif($p['submited_status']==3) : ?>
    <span class="badge badge-success">Proses Persetujuan</span>
<?php elseif($p['submited_status']==4) : ?>
    <span class="badge badge-success">Disetujui Approver</span>
<?php elseif($p['submited_status']==5) : ?>
    <span class="badge badge-success">Dipilihkan Pendana dan<br> Proses Upload Surat Permohonan</span>
<?php elseif($p['submited_status']==6) : ?>
    <span class="badge badge-success">Dikirim ke Pendana</span>
<?php elseif($p['submited_status']==7) : ?>
    <span class="badge badge-danger">Dikembalikan Pendana</span>
<?php elseif($p['submited_status']==8) : ?>
    <span class="badge badge-success">Disetujui Pendana</span>
<?php endif; ?>