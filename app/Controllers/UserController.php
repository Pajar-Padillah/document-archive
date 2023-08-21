<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Seeds\User;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Data User',
            'users' => $this->userModel->orderBy('id', 'desc')->findAll(),
            'userdata' => $this->userdata()
        ];
        return view('pages/user/index', $data);
    }

    public function create()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Tambah User',
            'validation' => \Config\Services::validation(),
            'userdata' => $this->userdata()
        ];
        return view('pages/user/tambah_user', $data);
    }

    public function save()
    {
        $session = session();
        $rules = [
            'nip' => 'required|is_unique[users.nip]',
            'nama' => 'required',
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'role' => 'required',
            'password' => 'required|min_length[6]',
            'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }
        $image = $this->request->getFile('image');
        $newimgName = 'user-' . time() . '.' . $image->getExtension();
        $image->move('user-images', $newimgName);

        $passwordHash = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $this->userModel->save([
            'nip' =>  $this->request->getVar('nip'),
            'nama' =>  $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role'),
            'password' =>  $passwordHash,
            'image' => $newimgName
        ]);
        $flash = [
            'title' => 'Success!',
            'message' => 'Tambah user berhasil!',
            'icon' => 'success'
        ];
        $session->setFlashdata('flash_message', $flash);
        return redirect()->to('/user');
    }

    public function edit($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Edit User',
            'validation' => \Config\Services::validation(),
            'user' => $this->userModel->find($id),
            'userdata' => $this->userdata()
        ];
        return view('pages/user/edit_user', $data);
    }

    public function update($id)
    {
        $user_old = $this->userModel->find($id);
        $password = $this->request->getVar('password');
        if ($user_old['nip'] == $this->request->getVar('nip')) {
            $rules_nip = 'required';
        } else {
            $rules_nip = 'required|is_unique[users.nip]';
        }
        if ($user_old['username'] == $this->request->getVar('username')) {
            $rules_username = 'required';
        } else {
            $rules_username = 'required|is_unique[users.username]';
        }
        if ($user_old['email'] == $this->request->getVar('email')) {
            $rules_email = 'required';
        } else {
            $rules_email = 'required|is_unique[users.email]';
        }
        if (!empty($password)) {
            $rules_password = 'min_length[6]';
        } else {
            $rules_password = 'min_length[0]';
        }
        if (!$this->validate([
            'nip' => $rules_nip,
            'nama' => 'required',
            'username' => $rules_username,
            'email' => $rules_email,
            'role' => 'required',
            'password' => $rules_password,
            'image' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput();
        }
        $data = [
            'nip' =>  $this->request->getVar('nip'),
            'nama' =>  $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'role' => $this->request->getVar('role')
        ];
        if (!empty($password)) {
            $passwordHash = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $data['password'] = $passwordHash;
        }
        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $oldImage = $user_old['image'];
            if (!empty($oldImage)) {
                unlink('user-images/' . $oldImage);
            }
            $image = $this->request->getFile('image');
            $newimgName = 'user-' . time() . '.' . $image->getExtension();
            $image->move('user-images', $newimgName);
            $data['image'] = $newimgName;
        }

        $this->userModel->where('id', $id)->set($data)->update();
        $flash = [
            'title' => 'Success!',
            'message' => 'Edit data user berhasil!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        $oldImage = $user['image'];
        if (!empty($oldImage)) {
            unlink('user-images/' . $oldImage);
        }
        $this->userModel->delete($id);
        $flash = [
            'title' => 'Success!',
            'message' => 'Data user berhasil dihapus!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->back();
    }
}
