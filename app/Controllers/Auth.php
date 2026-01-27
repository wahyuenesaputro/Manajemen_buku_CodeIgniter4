<?php 
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login'); 
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessData = [
                    'user_id'      => $user['id'],
                    'user_name'    => $user['name'],
                    'user_email'   => $user['email'],
                    'is_logged_in' => true
                ];
                $session->set($sessData);
                return redirect()->to('/dashboard'); 
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Email tidak ditemukan.');
            return redirect()->to('/login');
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    public function register()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function processRegister()
    {
        $rules = [
            'name'          => 'required|min_length[3]|max_length[50]',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]',
            'password_conf' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();

        $data = [
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $model->save($data);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}