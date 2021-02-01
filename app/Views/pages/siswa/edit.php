<?= $this->extend('layouts/base') ?>
<?php $validation = \Config\Services::validation() ?>
<?= $this->section('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-lg-5 mt-3">
                <div class="card">
                    <div class="card-body">
                        <?php var_dump( $validation->getErrors()) ?>
                        <h4>Edit </h4>
                        <?= form_open('siswa/update/'.$siswa['nisn']) ?>
                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="number" name="nisn" value="<?= $siswa['nisn'] ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama" value="<?= $siswa['name'] ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" value="<?= $siswa['address'] ?>" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary float-end">Edit</button>
                        </div>
                        <?= form_close() ?>
                        <a href="<?= site_url('siswa/'.$siswa['nisn']) ?>" class="btn btn-danger float-none">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>