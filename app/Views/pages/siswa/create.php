<?= $this->extend('layouts/base'); ?>
<?php $validation = \Config\Services::validation() ?>
<?= $this->section('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="mt-4 col-12 col-md-5 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">Tambah Siswa</h4>
                        <?= form_open('siswa/save') ?>
                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="number" name="nisn" class="form-control <?= ($validation->hasError('nisn')) ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nisn') ?></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
                        </div>
                        <div class="float-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <?= form_close() ?>
                        <div class="float-none">
                            <a href="<?= route_to('siswa') ?>" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>