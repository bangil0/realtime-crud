<?= $this->extend('layouts/base'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="mt-4 col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4>Daftar Siswa</h4>
                    <div class="d-flex bd-highlight my-3">
                        <div class="p-2 flex-fill bd-highlight">
                            <a href="<?= site_url('siswa/create') ?>" class="btn btn-primary "><i class="fas fa-plus"></i></a>
                            <a href="<?= route_to('siswa/excel') ?>" class="btn btn-success"><i class="fas fa-file-excel"></i></a>
                            <a href="<?= route_to('siswa/pdf') ?>" class="btn btn-danger"><i class="fas fa-file-pdf"></i></a>
                        </div>
                        <div class="p-2 justify-content-end bd-highlight">
                            <form action="">
                                <input type="text" name="" id="" class="form-control">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped text-nowarp">
                            <thead class="">
                                <tr>
                                    <th>Nisn</th>
                                    <th>Nama Siswa</th>
                                    <th>Alamat</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody id="siswa"></tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
=

<?= $this->endSection(); ?>

<?= $this->section('script') ?>
    <script>
        $(document).ready(function(){
            // menampilkan daftar siswa
            showSiswa();
            // 21462231767a3927aeb6 ganti dengan key pusher channel anda 
            var pusher = new Pusher('21462231767a3927aeb6', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                if(data.message == 'success') {
                    showSiswa();
                }
            });

            function showSiswa() {
                $.ajax({
                    url:'<?= route_to("get-siswa") ?>',
                    type:'GET',
                    dataType:'json',
                    async:true,
                    success : function(data) {
                        
                        var html = '';

                        for (let i = 0; i < data['siswa'].length; i++) {
                            html += "<tr>"
                                html += `<td>${data['siswa'][i].nisn}</td>`
                                html += `<td>${data['siswa'][i].name}</td>`
                                html += `<td>${data['siswa'][i].address}</td>`
                                html += `<td><a href="<?= site_url('siswa/') ?>${data['siswa'][i]['nisn']}"><i class="fas fa-eye text-primary"></a>`
                            html += "</tr>"
                        }

                        $('#siswa').html(html);
                    }
                })
            }
        })
    </script>

<?= $this->endSection() ?>