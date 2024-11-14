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

    public function tampil_produk()
    {
        $produk = $this->produkModel->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'produk' => $produk
        ]);
    }

    public function getProduk($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk) {
            return $this->response->setJSON(['status' => 'success', 'produk' => $produk]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan.']);
        }
    }

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

        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
        ];

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
        $this->produkModel->save($data);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil disimpan.'
        ]);
    }

    public function edit_produk($id)
    {
        $produk = $this->produkModel->find($id);
        if ($produk) {
            return $this->response->setJSON(['status' => 'success', 'produk' => $produk]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan.']);
        }
    }

    public function update_produk()
    {
        $id = $this->request->getVar('id');
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_produk' => 'required',
            'harga' => 'required|decimal',
            'stok' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_produk' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
        ];

        $this->produkModel->update($id, $data);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data berhasil diperbarui.'
        ]);
    }
    public function hapus_data($id) {
        $result = $this->produkModel->delete($id); 
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Produk berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus produk']);
        }
    }
}
