<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2>Data Kamar</h2>
<p>Berikut ini daftar kamar yang sudah terdaftar dalam database.</p>
<p>
    <a href="/kamar/tambah" class="btn btn-primary
    btn-sm">Tambah Kamar</a>
</p>
<table class="table table-sm table-hovered">
<thead class="bg-light text-center">
    <tr>
    <th>No</th>
    <th>tipe Kamar</th>
    <th>deskripsi</th>
    <th>foto</th>
    <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    <?php
$htmlData=null;
$nomor=null;
foreach ($ListKamar as $row){
$nomor++;
$htmlData ='<tr>';

$htmlData .='<td>'.$row['no_kamar'].'</td>';
$htmlData .='<td>'.$row['type_kamar'].'</td>';
$htmlData .='<td>'.$row['deskripsi'].'</td>';
$htmlData .='<td>'.'<img src="'.base_url("gambar/".$row['foto']).'" width="150">'.'</td>';
$htmlData .='<td class="text-center">';
$htmlData .='<a href="/kamar/edit/'. $row['id_kamar'] . '" class="btn btn-info btn-sm mr-1">Update</a>';
$htmlData .='<a href="/kamar/edit-foto/'.$row['id_kamar'].'" class="btn btn-info btn-sm mr-2">Foto</a>';
$htmlData .='<a href="/kamar/hapus/'.$row['id_kamar'].'" class="btn btn-danger btn-sm">Hapus</a>';
$htmlData .='</td>';
$htmlData .='</tr>';
echo $htmlData;
}
?>
</tbody>
</table>
<?= $this->endSection() ?>