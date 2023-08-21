<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GUPModel;

class GUPController extends BaseController
{
    protected $gupModel;
    public function __construct()
    {
        $this->gupModel = new GUPModel();
    }

    public function index()
    {
        $tahun = $this->request->getVar('tahun');
        if ($tahun) {
            if (!$this->validate([
                'tahun' => 'required|max_length[4]|min_length[4]',
            ])) {
                return redirect()->to('/gup')->withInput();
            }
            $data = [
                'title' => 'Data Dokumen GUP Tahun ' . $tahun,
                'gups' => $this->gupModel->like('tanggal', $tahun)->orderBy('id', 'desc')->findAll(),
                'userdata' => $this->userdata(),
                'validation' => \Config\Services::validation(),
                'tahun' => $tahun
            ];
        } else {
            $data = [
                'title' => 'Data Dokumen GUP',
                'gups' => $this->gupModel->orderBy('id', 'desc')->findAll(),
                'userdata' => $this->userdata(),
                'validation' => \Config\Services::validation()
            ];
        }
        $data['tahun'] = isset($tahun) ? $tahun : '';
        return view('pages/gup/index', $data);
    }

    public function create()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Tambah Dokumen GUP',
            'validation' => \Config\Services::validation(),
            'userdata' => $this->userdata()
        ];
        return view('pages/gup/tambah_gup', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'no_spm' => 'required|is_unique[gup.no_spm]',
            'box' => 'required',
            'uraian' => 'required',
            'tanggal' => 'required',
            'file_gup' => 'uploaded[file_gup]|max_size[file_gup,5120]|mime_in[file_gup,application/pdf]|ext_in[file_gup,pdf]'
        ])) {
            return redirect()->back()->withInput();
        }
        $file_gup = $this->request->getFile('file_gup');
        $file_gupName = 'gup-' . time() . '.' . $file_gup->getExtension();
        $file_gup->move('upload/gup', $file_gupName);
        $this->gupModel->save([
            'no_spm' =>  trim($this->request->getVar('no_spm')),
            'box' =>  trim($this->request->getVar('box')),
            'uraian' =>  trim($this->request->getVar('uraian')),
            'tanggal' =>  $this->request->getVar('tanggal'),
            'user_id' => session()->get('user_id'),
            'file_gup' => $file_gupName
        ]);

        $flash = [
            'title' => 'Success!',
            'message' => 'Tambah dokumen GUP berhasil!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->to('/gup');
    }

    public function edit($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Edit Dokumen GUP',
            'validation' => \Config\Services::validation(),
            'gup' => $this->gupModel->find($id),
            'userdata' => $this->userdata()
        ];
        return view('pages/gup/edit_gup', $data);
    }

    public function update($id)
    {
        $gup_old = $this->gupModel->find($id);
        if ($gup_old['no_spm'] == $this->request->getVar('no_spm')) {
            $rules_no_spm = 'required';
        } else {
            $rules_no_spm = 'required|is_unique[gup.no_spm]';
        }
        if (!$this->validate([
            'no_spm' => $rules_no_spm,
            'box' => 'required',
            'uraian' => 'required',
            'tanggal' => 'required',
            'file_gup' => 'max_size[file_gup,5120]|mime_in[file_gup,application/pdf]|ext_in[file_gup,pdf]'
        ])) {
            return redirect()->back()->withInput();
        }
        $data = [
            'no_spm' =>  trim($this->request->getVar('no_spm')),
            'box' =>  trim($this->request->getVar('box')),
            'uraian' =>  trim($this->request->getVar('uraian')),
            'tanggal' =>  $this->request->getVar('tanggal')
        ];
        $file_gup = $this->request->getFile('file_gup');
        if ($file_gup->isValid()) {
            $gup = $this->gupModel->find($id);
            $oldFile = $gup['file_gup'];
            if (!empty($oldFile)) {
                unlink('upload/gup/' . $oldFile);
            }
            $file_gupName = 'gup-' . time() . '.' . $file_gup->getExtension();
            $file_gup->move('upload/gup', $file_gupName);
            $data['file_gup'] = $file_gupName;
        }
        $this->gupModel->where('id', $id)->set($data)->update();

        $flash = [
            'title' => 'Success!',
            'message' => 'Dokumen GUP berhasil di update!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->to('/gup');
    }

    public function delete($id)
    {
        $gup = $this->gupModel->find($id);
        $oldFile = $gup['file_gup'];
        if (!empty($oldFile)) {
            unlink('upload/gup/' . $oldFile);
        }
        $this->gupModel->delete($id);
        $flash = [
            'title' => 'Success!',
            'message' => 'Dokumen GUP berhasil dihapus!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->back();
    }
}
