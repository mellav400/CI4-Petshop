<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('bootstrap-5.2.3-dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('fontawesome-free-6.6.0-web/css/all.min.css'); ?>">
</head>
<body>
    <div class="container mt-3">
        <div class="col">
            <h2 class="text-center">Data Produk</h2>
        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">Tambah Data</button>
        </div>
        <table class="table table-bordered mt-3" id="produkTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="modalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formProduk">
                        <div class="row mb-3">
                            <label for="namaProduk" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaProduk" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="hargaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stokProduk" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="stokProduk">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="simpanProduk">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Produk -->
    <div class="modal fade" id="modalEditProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditProdukLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalEditProdukLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditProduk">
                        <input type="hidden" id="editProdukId">
                        <div class="row mb-3">
                            <label for="editNamaProduk" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editNamaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editHargaProduk" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editHargaProduk">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editStokProduk" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editStokProduk">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="updateProduk">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tampilProduk() {
            $.ajax({
                url: '<?=base_url('produk/tampil')?>',
                type: 'GET',
                dataType: 'json',
                success: function(hasil) {
                    if (hasil.status === 'success') {
                        var produkTable = $('#produkTable tbody');
                        produkTable.empty();
                        var produk = hasil.produk;
                        var no = 1;

                        produk.forEach(function(item) {
                            var row = '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + item.nama_produk + '</td>' +
                                '<td>' + item.harga + '</td>' +
                                '<td>' + item.stok + '</td>' +
                                '<td>' +
                                '<button class="btn btn-warning btn-sm editProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                                '<button class="btn btn-danger btn-sm hapusProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button>' +
                                '</td>' +
                                '</tr>';
                            produkTable.append(row);
                            no++;
                        });
                    } else {
                        alert('Gagal menampilkan data.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal mengambil data');
                }
            });
        }

        $(document).ready(function() {
            tampilProduk();

            // Handle save button
            $("#simpanProduk").on("click", function() {
                var formData = {
                    nama_produk: $('#namaProduk').val(),
                    harga: $('#hargaProduk').val(),
                    stok: $('#stokProduk').val()
                };

                $.ajax({
                    url: '<?=base_url('produk/simpan');?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambahProduk').modal('hide');
                            $('#formProduk')[0].reset();
                            tampilProduk();
                        } else {
                            alert('Gagal: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            // Handle edit button click
            $('#produkTable').on('click', '.editProduk', function() {
                var produkId = $(this).data('id');

                $.ajax({
                    url: '<?=base_url('produk/getProduk/');?>' + produkId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.status === 'success') {
                            var produk = data.produk;
                            $('#editProdukId').val(produk.produk_id);
                            $('#editNamaProduk').val(produk.nama_produk);
                            $('#editHargaProduk').val(produk.harga);
                            $('#editStokProduk').val(produk.stok);
                            $('#modalEditProduk').modal('show');
                        } else {
                            alert('Gagal mendapatkan data produk.');
                        }
                    }
                });
            });

            // Handle update button click
            $('#updateProduk').on('click', function() {
                var formData = {
                    id: $('#editProdukId').val(),
                    nama_produk: $('#editNamaProduk').val(),
                    harga: $('#editHargaProduk').val(),
                    stok: $('#editStokProduk').val()
                };

                $.ajax({
                    url: '<?=base_url('produk/update');?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalEditProduk').modal('hide');
                            tampilProduk();
                        } else {
                            alert('Gagal: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
