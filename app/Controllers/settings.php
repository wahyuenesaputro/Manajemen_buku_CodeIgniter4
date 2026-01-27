<?php

namespace App\Controllers;
use App\Models\UserModel;

class Settings extends BaseController
{
    public function index()
    {

        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $model = new UserModel();
        $userId = session()->get('user_id');
        $user = $model->find($userId);

        $data = [
            'title' => 'PENGATURAN',
            'user' => $user
        ];

        return view('settings/index', $data);
    }
}