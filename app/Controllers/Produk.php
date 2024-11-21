<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        return view('v_produk');
    }

    // Untuk menampilkan produk
    public function tampil_produk()
    {
        $produk = $this->produkModel->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'produk' => $produk
        ]);
    }

    // Untuk mengambil detail produk berdasarkan ID
    public function getProduk($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk) {
            return $this->response->setJSON(['status' => 'success', 'produk' => $produk]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan.']);
        }
    }

    // Untuk menyimpan produk baru
    public function simpan_produk()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_produk' => 'required',
            'harga' => 'required|decimal',
            'stok' => 'required|integer',
            'gambar' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png,image/gif]|max_size[gambar,2048]', // Validasi gambar
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        // Data produk
        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
        ];

        // Proses upload gambar
        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $path = 'assets/images/produk/';
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $fileName = $gambar->getRandomName();
            $gambar->move($path, $fileName);
            $data['gambar'] = $fileName;
        }

        // Simpan data produk ke database
        $this->produkModel->save($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
    }

    // Untuk mengambil data produk untuk diedit
    public function edit_produk($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk) {
            return $this->response->setJSON(['status' => 'success', 'produk' => $produk]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan.']);
        }
    }

    // Untuk memperbarui data produk
    public function update()
{
    $id = $this->request->getPost('id');
    $nama_produk = $this->request->getPost('nama_produk');
    $harga = $this->request->getPost('harga');
    $stok = $this->request->getPost('stok');

    $produkModel = new ProdukModel();
    $produk = $produkModel->find($id);

    if (!$produk) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
    }

    $data = [
        'nama_produk' => $nama_produk,
        'harga' => $harga,
        'stok' => $stok,
    ];

    // Proses upload gambar baru
    $fileGambar = $this->request->getFile('gambar');
    if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
        $newName = $fileGambar->getRandomName();
        $fileGambar->move(WRITEPATH . 'uploads', $newName);

        // Hapus gambar lama jika ada
        if (!empty($produk['gambar'])) {
            $oldPath = WRITEPATH . 'uploads/' . $produk['gambar'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $data['gambar'] = $newName;
    }

    $produkModel->update($id, $data);

    return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil diperbarui']);
}

    // Untuk menghapus data produk
    public function hapus_data($id)
    {
       
        $produk = $this->produkModel->find($id);
        

        $result = $this->produkModel->delete($id);
        if ($result) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus produk']);
        }
    }
}
