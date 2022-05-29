<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>

<h2>Penambahan Data Petugas</h2>
<p>Silahkan gunakan form dibawah ini untuk mendata petugas
baru.</p>

    <form method="POST" action="/kamar/update">
    <div class="form-group">
    <label class="font-weight-bold">No Kamar</label>
    <input type="text" name="txtInputNoKamar"
    class="form-control" placeholder="Masukan nomor kamar"
    value="<?=$detailKamar[0]['id_kamar'];?>">
    </div>

    <div class="form-group">
    <label class="font-weight-bold">Tipe Kamar</label>
    <input type="text" name="txtInputTipeKamar"class="form-control" placeholder="Masukan  tipe kamar" 
    value="<?=$detailKamar[0]['type_kamar'];?>"
    autocomplete="off" autofocous reaquire>
    </div>

    <div class="form-group">
    <label class="font-weight-bold">Deskripsi Kamar</label>
    <input type="text" name="txtInputDeskripsiKamar"
    class="form-control" placeholder="Masukan deskripsi kamar" value="<?=$detailKamar[0]["deskripsi"];?>">
    </div>

    <div class="form-group">
    <label class="font-weight-bold">Foto Kamar</label>
    <?php
    if (!empty($detailKamar[0]['foto'])){
    echo'<img src="' .base_url("/gambar/".$detailKamar[0]['foto']).'"width="150">';
}
?>
</div>
<div class="form-group">
<button class="btn btn-primary" type="submit">Update Kamar</button>
</div>
</form>
<?= $this->endSection() ?>