<?= $this->extend('layouts/base'); ?>

<?= $this->section('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-4 mt-3">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="card-body">
                        <h4><?= $siswa["name"] ?></h4>
                        <div class="user-info">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="user-info-title"><?= $siswa['nisn'] ?></div>
                                    <div class="user-info-lead">NISN</div>
                                </div>
                                <div class="col-6">
                                    <div class="user-info-title"><?= $siswa['address'] ?></div>
                                    <div class="user-info-lead">Alamat</div>
                                </div>
                            </div>
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div class="p-2 bd-highlight">
                                    <?= form_open('siswa/delete/'.$siswa['nisn']) ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    <?= form_close() ?>
                                </div>
                                <div class="p-2 bd-highlight"><a href="<?= site_url('siswa/edit/'.$siswa['nisn'])  ?>" class="btn btn-primary btn-sm ">Edit</a></div>
                            </div>
                            
                            
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>