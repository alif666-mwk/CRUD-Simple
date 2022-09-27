<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/datatable/dataTables.min.css" rel="stylesheet">

</head>

<body>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CRUD Codeigniter 3</title>

    <body>
        <div class="container">
            <h4 class="mt-3">CRUD Simpel</h4>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
            </button>

            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penduduk</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">No.</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th style="width: 70px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($penduduk as $p) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $p['nama_penduduk']; ?></td>
                                    <td><?= $p['nik']; ?></td>
                                    <td><?= $p['provinsi']; ?></td>
                                    <td><?= $p['kabupaten']; ?></td>
                                    <td><?= $p['kecamatan']; ?></td>
                                    <td><?= $p['desa']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal<?= $p['id_penduduk']; ?>">
                                            Edit
                                        </button>
                                        <a href="<?= base_url(); ?>select/hapus/<?= $p['id_penduduk']; ?>"
                                            class="btn btn-danger btn-sm" onclick="return confirm('Yakin?');">
                                            Hapus
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal ADD -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url(); ?>select/tambah">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik">
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-control provinsi" id="provinsi" name="provinsi">
                                    <option value="">--Pilih Provinsi--</option>
                                    <?php foreach ($provinsi as $prov) : ?>
                                    <option value="<?= $prov['id']; ?>"><?= $prov['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kabupaten">Kabupaten</label>
                                <select class="form-control" id="kabupaten" name="kabupaten">
                                    <option value="">--Pilih Kabupaten--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kecamatan">Kecamatan</label>
                                <select class="form-control" id="kecamatan" name="kecamatan">
                                    <option value="">--Pilih Kecamatan--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <select class="form-control" id="desa" name="desa">
                                    <option value="">--Pilih Kabupaten--</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal EDIT -->
        <?php foreach ($penduduk as $p) : ?>
        <div class="modal fade" id="editModal<?= $p['id_penduduk']; ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url(); ?>select/edit/<?= $p['id_penduduk']; ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= $p['nama_penduduk']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    value="<?= $p['alamat']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik" value="<?= $p['nik']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="<?= $p['provinsi']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Kabupaten</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="<?= $p['kabupaten']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Kecamatan</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="<?= $p['kecamatan']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="provinsi">Desa</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="<?= $p['desa']; ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="<?= base_url(); ?>/assets/jquery/jquery.slim.min.js"></script>
        <script src="<?= base_url(); ?>/assets/datatable/datatables.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#provinsi').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('select/getKabupaten') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#kabupaten').html(response);
                    }
                });
            });

            $('#kabupaten').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('select/getKecamatan') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#kecamatan').html(response);
                    }
                });
            });

            $('#kecamatan').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('select/getDesa') ?>",
                    data: {
                        id: id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#desa').html(response);
                    }
                });
            });
        });
        </script>
    </body>

</html>