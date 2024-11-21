<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('bootstrap-5.2.3-dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('fontawesome-free-6.6.0-web/css/all.min.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container mt-3">
        <div class="col">
            <h2 class="text-center"><i class="fa-solid fa-users"></i> Data Pelanggan PetShop</h2>
        </div>
    </div>

    <div class="col text-end">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan"> <i class="fas fa-user-plus"></i>Tambah Pelanggan</button>
        <table class="table table-bordered mt-3" id="PelangganTable">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Alamat</th>
                    <th class="text-center">No Telepon</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Modal Tambah Pelanggan -->
    <div class="modal fade" id="modalTambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="staticBackdropLabel"> Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPelanggan" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <label for="namaPelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamatPelanggan" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamatPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="teleponPelanggan" class="col-sm-2 col-form-label">No Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="teleponPelanggan">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="simpanPelanggan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pelanggan -->
    <div class="modal fade" id="modalEditPelanggan" tabindex="-1" aria-labelledby="modalEditPelangganLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalEditPelangganLabel">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditPelanggan" enctype="multipart/form-data">
                        <input type="hidden" id="editPelangganId">
                        <div class="row mb-3">
                            <label for="editNamaPelanggan" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editNamaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editAlamatPelanggan" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editAlamatPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editTeleponPelanggan" class="col-sm-2 col-form-label">No Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="editTeleponPelanggan">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" id="updatePelanggan">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Pelanggan -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="hapusModalLabel">Hapus Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus pelanggan ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="hapusPelangganButton">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>

    <script>
        function tampilPelanggan() {
            $.ajax({
                url: '<?= base_url('pelanggan/tampil'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(hasil) {
                    if (hasil.status === 'success') {
                        var pelangganTable = $('#PelangganTable tbody');
                        pelangganTable.empty();
                        var pelanggan = hasil.pelanggan;
                        var no = 1;

                        pelanggan.forEach(function(item) {
                            var row = '<tr>' +
                                '<td class="text-center">' + no + '</td>' +
                                '<td class="text-center">' + item.nama_pelanggan + '</td>' +
                                '<td class="text-center">' + item.alamat + '</td>' +
                                '<td class="text-center">' + item.telepon + '</td>' +
                                '<td class="text-center">' +
                                '<button class="btn btn-warning btn-sm editPelanggan" data-id="' + item.pelanggan_id + '"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                                '<button class="btn btn-danger btn-sm hapusPelanggan" data-id="' + item.pelanggan_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button>' +
                                '</td>' +
                                '</tr>';
                            pelangganTable.append(row);
                            no++;
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
            tampilPelanggan();

            // Simpan pelanggan
            $("#simpanPelanggan").on("click", function() {
                var formData = new FormData();
                formData.append('nama_pelanggan', $('#namaPelanggan').val());
                formData.append('alamat', $('#alamatPelanggan').val());
                formData.append('telepon', $('#teleponPelanggan').val());

                $.ajax({
                    url: '<?= base_url('pelanggan/simpan'); ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            $('#modalTambahPelanggan').modal('hide');
                            $('#formPelanggan')[0].reset();
                            tampilPelanggan();
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Pelanggan berhasil disimpan",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "Gagal menyimpan pelanggan",
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
            $(document).ready(function() {
                $('#PelangganTable').on('click', '.editPelanggan', function() {
                    var pelangganId = $(this).data('id'); // Capture ID from data-id attribute
                    console.log('pelangganId:', pelangganId); // Debug log to confirm it's correct

                    $.ajax({
                        url: '<?= base_url('pelanggan/edit_pelanggan/'); ?>' + pelangganId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.status === 'success') {
                                var pelanggan = data.pelanggan;
                                $('#editNamaPelanggan').val(pelanggan.nama_pelanggan);
                                $('#editAlamatPelanggan').val(pelanggan.alamat);
                                $('#editTeleponPelanggan').val(pelanggan.telepon);
                                $('#modalEditPelanggan').modal('show');
                                $('#updatePelanggan').on('click', function() {
                                    var formData = {
                                        // id: $('#editPelangganId').val(),
                                        nama_pelanggan: $('#editNamaPelanggan').val(),
                                        alamat: $('#editAlamatPelanggan').val(),
                                        telepon: $('#editTeleponPelanggan').val()
                                    };

                                    $.ajax({
                                        url: '<?= base_url('pelanggan/update/'); ?>' + pelangganId,
                                        type: 'POST',
                                        data: formData,
                                        dataType: 'json',
                                        success: function(hasil) {
                                            if (hasil.status === 'success') {
                                                $('#modalEditPelanggan').modal('hide');
                                                tampilPelanggan();
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "success",
                                                    title: "Pelanggan berhasil diperbarui",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            } else {
                                                Swal.fire({
                                                    position: "center",
                                                    icon: "error",
                                                    title: "Gagal memperbarui pelanggan",
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
                            } else {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Gagal mendapatkan data pelanggan",
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

            let idHapus;

            function showModalHapus(id) {
                idHapus = id;
                $('#modalHapus').modal('show');
            }

            $('#PelangganTable').on('click', '.hapusPelanggan', function() {
                var id = $(this).attr('data-id');
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
                            url: `http://localhost:8080/pelanggan/delete/${id}`,
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
                                tampilPelanggan();
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



        });
    </script>

    <!-- Bootstrap JS & Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>