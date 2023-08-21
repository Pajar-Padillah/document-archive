<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function login()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            $data = $model->where('username', $username)->first();

            if ($data !== null) {
                if (password_verify($password, $data['password'])) {
                    $sessionData = [
                        'user_id' => $data['id'],
                        'nip' => $data['nip'],
                        'nama' => $data['nama'],
                        'username' => $data['username'],
                        'email' => $data['email'],
                        'image' => $data['image'],
                        'role' => $data['role']
                    ];
                    session()->set($sessionData);
                    $flash = [
                        'title' => 'Login Berhasil!',
                        'message' => 'Selamat datang kembali ' . $data['nama'],
                        'icon' => 'success'
                    ];
                    session()->setFlashdata('flash_message', $flash);
                    return redirect()->to('/home');
                } else {
                    $flash = [
                        'title' => 'Error!',
                        'message' => 'Password salah!',
                        'icon' => 'error'
                    ];
                    session()->setFlashdata('flash_message', $flash);
                    return redirect()->to('/');
                }
            } else {
                $flash = [
                    'title' => 'Error!',
                    'message' => 'Akun tidak terdaftar!',
                    'icon' => 'error'
                ];
                session()->setFlashdata('flash_message', $flash);
                return redirect()->to('/');
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
