<?php

namespace App\Controllers;

use App\Models\BookModel;

class Book extends BaseController
{
    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $model = new BookModel();
        $data = [
            'title' => 'DATA BUKU',
            'books' => $model->findAll() // Ambil semua data buku
        ];
        
        // Arahkan ke view 'book/index', JANGAN ke 'dashboard/index'
        return view('book/index', $data);
    }

    public function store()
    {
        $model = new BookModel();

        // Simpan data dari Form (Modal)
        $model->save([
            'title'       => $this->request->getPost('title'),
            'author'      => $this->request->getPost('author'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ]);

        // Redirect kembali ke halaman buku
        return redirect()->to('/book')->with('success', 'Data berhasil disimpan!');
    }

    public function delete($id)
    {
        $model = new BookModel();
        
        // Hapus berdasarkan ID
        $model->delete($id);
        
        // Redirect kembali ke halaman buku
        return redirect()->to('/book')->with('success', 'Data berhasil dihapus!');
    }
}