<?php if($p['submited_status']=='' || $p['submited_status']==null) : ?>
    <span class="badge badge-warning">Draft</span>
<?php elseif($p['submited_status']==1) : ?> 
    <span class="badge badge-warning">Proses Pengecekan</span>
<?php elseif($p['submited_status']==2) : ?>
    <span class="badge badge-danger">Dikembalikan</span>
<?php elseif($p['submited_status']==3) : ?>
    <span class="badge badge-success">Proses Persetujuan</span>
<?php elseif($p['submited_status']==4) : ?>
    <span class="badge badge-success">Disetujui Ketum</span>
<?php elseif($p['submited_status']==5) : ?>
    <span class="badge badge-success">Terkirim ke Pendana</span>
<?php elseif($p['submited_status']==6) : ?>
    <span class="badge badge-success">Disetujui Pendana</span>
<?php endif; ?>