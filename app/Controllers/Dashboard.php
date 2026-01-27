<?php

namespace App\Controllers;

use App\Models\BookModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }
        $bookModel = new BookModel();
        $totalBuku      = $bookModel->countAllResults(); 
        $bukuPublished  = $bookModel->where('status', 'published')->countAllResults();
        $data = [
            'title'         => 'DASHBOARD',
            'user_name'     => session()->get('user_name'),
            'total_buku'    => $totalBuku,
            'jml_published' => $bukuPublished
        ];
        return view('dashboard/index', $data);
    }
}