<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2>Penambahan Data Petugas</h2>
<p>Silahkan gunakan form dibawah ini untuk mendata tamu baru.</p>
    <form method="POST" action="/kamar/simpan" enctype="multipart/form-data">
    <div class="form-group">
    <input type="hidden" name="txtInputId"
    class="form-control" placeholder="Masukan no kamar"autocomplete="off" autofocus required>
    <label class="font-weight-bold">No Kamar</label>
    <input type="text" name="txtInputNoKamar"
    class="form-control" placeholder="Masukan no kamar"autocomplete="off" autofocus required>
</div>
    <div class="form-group">
    <label class="font-weight-bold">Tipe Kamar</label>
    <input type="text" name="txtInputTipeKamar"
    class="form-control" placeholder="Masukan Tipe Kamar" autocomplete="off" autocomplete required>
</div>
<div class="form-group">
    <label class="font-weight-bold">deskripsi Kamar</label>
    <input type="text" name="txtInputDeskripsi"
    class="form-control" placeholder="Masukan Tipe Kamar" autocomplete="off" autocomplete required> 
</div>
    <div class="form-group">
    <label class="font-weight-bold">Foto Kamar</label>
    <input type="file" name="txtInputFoto" class="fore-control">
</div>
    <div class="form-group">
    <button class="btn btn-primary">Simpan Kamar</button>
</div>
    </form>
    <?= $this->endSection() ?>