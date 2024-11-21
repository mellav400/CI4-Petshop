<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    public function index()
    {
        return view('v_pelanggan');  
    }

    
    public function tampil_pelanggan()
    {
        $pelanggan = $this->pelangganModel->findAll();  
        return $this->response->setJSON([
            'status' => 'success',
            'pelanggan' => $pelanggan
        ]);
    }

   
    public function getPelanggan($id)
    {
        $pelanggan = $this->pelangganModel->find($id);  
        if ($pelanggan) {
            return $this->response->setJSON(['status' => 'success', 'pelanggan' => $pelanggan]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pelanggan tidak ditemukan.']);
        }
    }

    
    public function simpan_pelanggan()
    {
        $validation = \Config\Services::validation();

       
        // $validation->setRules([
        //     'nama_pelanggan' => 'required',
        //     'alamat' => 'required|text',
        //     'telepon' => 'required|varchar',
        // ]);

     
        // if (!$validation->withRequest($this->request)->run()) {
        //     return $this->response->setJSON([
        //         'status' => 'error',
        //         'errors' => $validation->getErrors(),
        //     ]);
        // }

       
        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'telepon' => $this->request->getVar('telepon'),
        ];

        
        $this->pelangganModel->save($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Pelanggan berhasil disimpan',
        ]);
    }

   
    public function edit_pelanggan($id)
    {
        $pelanggan = $this->pelangganModel->find($id);
        if ($pelanggan) {
            return $this->response->setJSON(['status' => 'success', 'pelanggan' => $pelanggan]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pelanggan tidak ditemukan.']);
        }
    }

    public function update_pelanggan($id)
    {
        // $id = $this->request->getVar('id');
        // $validation = \Config\Services::validation();
        // $validation->setRules([
        //     'nama_pelanggan' => 'required',
        //     'alamat' => 'required|text',
        //     'telepon' => 'required|varchar',
        // ]);

        // if (!$validation->withRequest($this->request)->run()) {
        //     return $this->response->setJSON([
        //         'status' => 'error',
        //         'errors' => $validation->getErrors(),
        //     ]);
        // }

        // Ambil data yang dikirim dari frontend
        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'telepon' => $this->request->getVar('telepon'),
        ];

      
        $this->pelangganModel->update($id, $data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data pelanggan berhasil diperbarui.'
        ]);
    }

    public function hapus_data($id) {
        $result = $this->pelangganModel->delete($id); 
        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Produk berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus produk']);
        }
    }
    
}
