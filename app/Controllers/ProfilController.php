<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfilController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $userID = session()->get('user_id');
        $data = [
            'title' => 'My Profile',
            'user' => $this->userModel->find($userID),
            'userdata' => $this->userdata(),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/profil/index', $data);
    }

    public function update($id)
    {
        $user_old = $this->userModel->find($id);
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
        if (!$this->validate([
            'nip' => $rules_nip,
            'nama' => 'required',
            'username' => $rules_username,
            'email' => $rules_email,
            'image' => 'max_size[image,2048]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput();
        }
        $image = $this->request->getFile('image');
        if ($image->isValid()) {
            $oldImage = $user_old['image'];
            if (!empty($oldImage)) {
                unlink('user-images/' . $oldImage);
            }
            $newimgName = 'user-' . time() . '.' . $image->getExtension();
            $image->move('user-images', $newimgName);
            $data = [
                'nip' => $this->request->getVar('nip'),
                'nama' => $this->request->getVar('nama'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'image' => $newimgName
            ];
        } else {
            $data = [
                'nip' => $this->request->getVar('nip'),
                'nama' => $this->request->getVar('nama'),
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email')
            ];
        }

        $this->userModel->where('id', $id)->set($data)->update();
        $flash = [
            'title' => 'Success!',
            'message' => 'Edit profil berhasil!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->back();
    }

    public function change_password($id)
    {
        $currentPassword = $this->request->getPost('password');
        $newPassword = $this->request->getPost('new_password');
        $rules = [
            'password' => 'required',
            'new_password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[new_password]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $user = $this->userModel->find($id);
        if (password_verify($currentPassword, $user['password'])) {
            $data = [
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            ];
            $this->userModel->where('id', $id)->set($data)->update();
            $flash = [
                'title' => 'Success!',
                'message' => 'Ubah password berhasil!',
                'icon' => 'success'
            ];
            session()->setFlashdata('flash_message', $flash);
            return redirect()->back();
        }

        $flash = [
            'title' => 'Error!',
            'message' => 'Password lama tidak sama!',
            'icon' => 'error'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->back();
    }
}
