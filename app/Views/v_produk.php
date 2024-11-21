<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('bootstrap-5.2.3-dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('fontawesome-free-6.6.0-web/css/all.min.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container mt-3">
        <div class="col">
            <h2 class="text-center">
                <i class="fa-solid fa-cat"></i> PetShop
            </h2>
        </div>

        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">Tambah Data</button>

            <table class="table table-bordered mt-3" id="produkTable">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nama Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Gambar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <!-- Modal Tambah Produk -->
        <div class="modal fade" id="modalTambahProduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formProduk" enctype="multipart/form-data"></form>
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
                        <div class="row mb-3">
                            <label for="gambarProduk" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="gambarProduk" name="gambarProduk">
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
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="modalEditProdukLabel">Edit Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditProduk" enctype="multipart/form-data">
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
                                <div class="row mb-3">
                                    <label for="editGambarProduk" class="col-sm-2 col-form-label">Gambar</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="editGambarProduk" name="gambar">
                                        <div id="previewGambar" class="mt-2"></div>
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

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>
            <script>
                function tampilProduk() {
                    $.ajax({
                        url: '<?= base_url('produk/tampil') ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function(hasil) {
                            if (hasil.status === 'success') {
                                var produkTable = $('#produkTable tbody');
                                produkTable.empty();
                                var produk = hasil.produk;
                                var no = 1;

                                produk.forEach(function(item) {
                                    var gambar = item.gambar ?
                                        '<img src="<?= base_url('assets/images/produk/'); ?>' + item.gambar + '" alt="Gambar Produk" style="width: 50px; height: 50px; object-fit: cover;">' :
                                        'Tidak ada gambar';
                                    var row = '<tr>' +
                                        '<td class="text-center">' + no + '</td>' +
                                        '<td class="text-center">' + item.nama_produk + '</td>' +
                                        '<td class="text-center">' + item.harga + '</td>' +
                                        '<td class="text-center">' + item.stok + '</td>' +
                                        '<td class="text-center">' + gambar + '</td>' +
                                        '<td class="text-center">' +
                                        '<button class="btn btn-warning btn-sm editProduk" data-bs-toggle="modal" data-bs-target="#modalEditProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                                        '<button class="btn btn-danger btn-sm hapusProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button>' +
                                        '</td>' +
                                        '</tr>';
                                    produkTable.append(row);
                                    no++;
                                });

                            } else {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Gagal menampilkan data",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "Gagal mengambil data",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }

                $(document).ready(function() {
                    tampilProduk();

                    // Handle save button
                    $("#simpanProduk").on("click", function() {
                        var formData = new FormData(); // Buat objek FormData

                        // Tambahkan data ke dalam FormData
                        formData.append('nama_produk', $('#namaProduk').val());
                        formData.append('harga', $('#hargaProduk').val());
                        formData.append('stok', $('#stokProduk').val());
                        var gambarFile = $('#gambarProduk')[0].files[0];
                        if (gambarFile) {
                            formData.append('gambar', gambarFile);
                        }

                        $.ajax({
                            url: '<?= base_url('produk/simpan'); ?>',
                            type: 'POST',
                            data: formData,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function(hasil) {
                                if (hasil.status === 'success') {
                                    $('#modalTambahProduk').modal('hide');
                                    $('#formProduk')[0].reset();
                                    tampilProduk();
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Produk berhasil disimpan",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else {
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Gagal menyimpan produk",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    position: "top-end",
                                    icon: "error",
                                    title: "Terjadi kesalahan",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        });
                    });

                    $(document).ready(function() {
                        tampilProduk(); // Memanggil fungsi tampil data produk

                        // Handle tombol edit
                        $('#produkTable').on('click', '.editProduk', function() {
                            var produkId = $(this).data('id');

                            $.ajax({
                                url: '<?= base_url('produk/edit/'); ?>' + produkId,
                                type: 'GET',
                                dataType: 'json',
                                success: function(data) {
                                    if (data.status === 'success') {
                                        var produk = data.produk;
                                        $('#editProdukId').val(produk.produk_id);
                                        $('#editNamaProduk').val(produk.nama_produk);
                                        $('#editHargaProduk').val(produk.harga);
                                        $('#editStokProduk').val(produk.stok);

                                        // Tampilkan preview gambar
                                        if (produk.gambar) {
                                            $('#previewGambar').html(`
                            <img src="<?= base_url('assets/images/produk/'); ?>${produk.gambar}" 
                                 alt="Preview Gambar" 
                                 style="max-width: 200px; max-height: 200px; margin-top: 10px;">
                        `);
                                        } else {
                                            $('#previewGambar').html('Tidak ada gambar');
                                        }

                                        // $('#modalEditProduk').modal('show');

                                    } else {
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Gagal mendapatkan data produk",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Terjadi kesalahan",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                        });

                        // Handle tombol update
                        $('#updateProduk').on('click', function() {
                            var formData = new FormData();

                            // Tambahkan data ke FormData
                            formData.append('id', $('#editProdukId').val());
                            formData.append('nama_produk', $('#editNamaProduk').val());
                            formData.append('harga', $('#editHargaProduk').val());
                            formData.append('stok', $('#editStokProduk').val());

                            // Tambahkan file gambar jika dipilih
                            var gambarFile = $('#editGambarProduk')[0].files[0];
                            if (gambarFile) {
                                formData.append('gambar', gambarFile);
                            }

                            $.ajax({
                                url: '<?= base_url('produk/update'); ?>',
                                type: 'POST',
                                data: formData,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                success: function(hasil) {
                                    if (hasil.status === 'success') {
                                        $('#modalEditProduk').modal('hide');
                                        tampilProduk();
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: "Produk berhasil diperbarui",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    } else {
                                        Swal.fire({
                                            position: "center",
                                            icon: "error",
                                            title: "Gagal memperbarui produk",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Terjadi kesalahan",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                        });
                    });


                });

                let idHapus;

                function showModalHapus(id) {
                    idHapus = id;
                    $('#modalHapus').modal('show');
                }

                $('#produkTable').on('click', '.hapusProduk', function() {
                    var id = $(this).data('id');

                    Swal.fire({
                        title: "Anda yakin?",
                        text: "Ingin menghapus data ini",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Hapus"
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                url: '<?= base_url('produk/delete'); ?>/' + id,
                                type: 'DELETE',
                                success: function(response) {
                                    Swal.fire({
                                        title: "Sukses",
                                        text: "Produk ini berhasil dihapus",
                                        icon: "success",
                                        position: "center",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    tampilProduk();
                                },
                                error: function(xhr, status, error) {

                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Produk gagal dihapus",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                        }
                    });
                });
            </script>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>