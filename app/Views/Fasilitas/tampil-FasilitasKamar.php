<?= $this->extend('Dashboard') ?>
<?= $this->section('content') ?>
<h2>Data Kamar</h2>
<p>Berikut ini daftar fasilitas kamar yang sudah terdaftar dalam database </p>
<P>
    <a href="/fasilitas-kamar/tambah" class="btn btn-primary btn-sm">Tambah Fasilitas Kamar</a>
</p>
<?php if (!empty(session()->getFlashdata('berhasil'))) : ?>
    <div class="alert aler-success">
        <?php echo session()->getFlashdata('berhasil'); ?>
    </div>
<?php endif ?>
<table class="table table-sm table-hover">
    <thead class="bg-light text-center">
        <tr>
            <th>Tipe Kamar</th>
            <th>Nama Fasilitas Kamar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($ListFasilitasKamar as $row) : ?>
            <tr>
                <td><?= $row['tipe_kamar'] ?></td>
                <td><?= $row['nama_fasilitas'] ?></td>
                <td class="text-center">
                    <a href="/fasilitas-kamar/edit/<?= $row['id_fasilitaskamar'] ?>" class="btn btn-info btn-sm mr-1">Update</a>
                    <a href="/fasilitas-kamar/hapus/<?= $row['id_fasilitaskamar'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= $this->endSection() ?>