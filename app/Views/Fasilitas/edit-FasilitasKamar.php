<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>

<h2>Penambahan Data Fasilitas Kamar</h2>
<p>Silahkan Masukan data fasilitas kamar baru pada form dibawah ini.</p>

    <form method="POST" action="/fasilitas-kamar/update">
    <div class="form-group">
    <label class="font-weight-bold">Tipe Kamar</label>
    <input type="text" name="txtInputNoKamar" class="form-control" placeholder="Masukan nomor kamar" value="<?=$detailfasilitaskamar[0]['id_kamar'];?>">
    <input type="hidden" name="id_fkamar" class="form-control" placeholder="Masukan nomor kamar" value="<?=$detailfasilitaskamar[0]['id_fasilitaskamar'];?>">
    </div>

    <div class="form-group">
    <label class="font-weight-bold">Nama Fasilitas Kamar</label>
    <input type="text" name="txtInputnamafasilitas"class="form-control" placeholder="Masukan  tipe kamar" 
    value="<?=$detailfasilitaskamar[0]['nama_fasilitas'];?>"
    autocomplete="off" autofocous reaquire>
    </div>

<div class="form-group ">
<button class="btn btn-primary" type="submit">Update Kamar</button>
</div>
</form>
<?= $this->endSection() ?>