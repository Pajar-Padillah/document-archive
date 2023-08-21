<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LumpsumModel;

class LumpsumController extends BaseController
{
    protected $lumpsumModel;
    public function __construct()
    {
        $this->lumpsumModel = new LumpsumModel();
    }

    public function index()
    {
        $tahun = $this->request->getVar('tahun');
        if ($tahun) {
            if (!$this->validate([
                'tahun' => 'required|max_length[4]|min_length[4]',
            ])) {
                return redirect()->to('/lumpsum')->withInput();
            }
            $data = [
                'title' => 'Data Dokumen Lumpsum Tahun ' . $tahun,
                'lumpsums' => $this->lumpsumModel->like('tanggal', $tahun)->orderBy('id', 'desc')->findAll(),
                'userdata' => $this->userdata(),
                'validation' => \Config\Services::validation(),
                'tahun' => $tahun
            ];
        } else {
            $data = [
                'title' => 'Data Dokumen Lumpsum',
                'lumpsums' => $this->lumpsumModel->orderBy('id', 'desc')->findAll(),
                'userdata' => $this->userdata(),
                'validation' => \Config\Services::validation()
            ];
        }
        $data['tahun'] = isset($tahun) ? $tahun : '';
        return view('pages/lumpsum/index', $data);
    }

    public function create()
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Tambah Dokumen Lumpsum',
            'validation' => \Config\Services::validation(),
            'userdata' => $this->userdata()
        ];
        return view('pages/lumpsum/tambah_lumpsum', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'no_spm' => 'required|is_unique[lumpsum.no_spm]',
            'box' => 'required',
            'uraian' => 'required',
            'tanggal' => 'required',
            'file_lumpsum' => 'uploaded[file_lumpsum]|max_size[file_lumpsum,5120]|mime_in[file_lumpsum,application/pdf]|ext_in[file_lumpsum,pdf]'
        ])) {
            return redirect()->back()->withInput();
        }
        $file_lumpsum = $this->request->getFile('file_lumpsum');
        $file_lumpsumName = 'lumpsum-' . time() . '.' . $file_lumpsum->getExtension();
        $file_lumpsum->move('upload/lumpsum', $file_lumpsumName);
        $this->lumpsumModel->save([
            'no_spm' =>  trim($this->request->getVar('no_spm')),
            'box' =>  trim($this->request->getVar('box')),
            'uraian' =>  trim($this->request->getVar('uraian')),
            'tanggal' =>  $this->request->getVar('tanggal'),
            'user_id' => session()->get('user_id'),
            'file_lumpsum' => $file_lumpsumName
        ]);
        $flash = [
            'title' => 'Success!',
            'message' => 'Tambah dokumen lumpsum berhasil!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->to('/lumpsum');
    }

    public function edit($id)
    {
        if (session()->get('role') != 'admin') {
            return redirect()->to('/home');
        }
        $data = [
            'title' => 'Edit Dokumen Lumpsum',
            'validation' => \Config\Services::validation(),
            'lumpsum' => $this->lumpsumModel->find($id),
            'userdata' => $this->userdata()
        ];
        return view('pages/lumpsum/edit_lumpsum', $data);
    }

    public function update($id)
    {
        $lumpsum_old = $this->lumpsumModel->find($id);
        if ($lumpsum_old['no_spm'] == $this->request->getVar('no_spm')) {
            $rules_no_spm = 'required';
        } else {
            $rules_no_spm = 'required|is_unique[lumpsum.no_spm]';
        }
        if (!$this->validate([
            'no_spm' => $rules_no_spm,
            'box' => 'required',
            'uraian' => 'required|trim',
            'tanggal' => 'required',
            'file_lumpsum' => 'max_size[file_lumpsum,5120]|mime_in[file_lumpsum,application/pdf]|ext_in[file_lumpsum,pdf]'
        ])) {
            return redirect()->back()->withInput();
        }
        $data = [
            'no_spm' =>  trim($this->request->getVar('no_spm')),
            'box' =>  trim($this->request->getVar('box')),
            'uraian' =>  trim($this->request->getVar('uraian')),
            'tanggal' =>  $this->request->getVar('tanggal')
        ];
        $file_lumpsum = $this->request->getFile('file_lumpsum');
        if ($file_lumpsum->isValid()) {
            $lumpsum = $this->lumpsumModel->find($id);
            $oldFile = $lumpsum['file_lumpsum'];
            if (!empty($oldFile)) {
                unlink('upload/lumpsum/' . $oldFile);
            }
            $file_lumpsumName = 'lumpsum-' . time() . '.' . $file_lumpsum->getExtension();
            $file_lumpsum->move('upload/lumpsum', $file_lumpsumName);
            $data['file_lumpsum'] = $file_lumpsumName;
        }
        $this->lumpsumModel->where('id', $id)->set($data)->update();
        $flash = [
            'title' => 'Success!',
            'message' => 'Edit dokumen lumpsum berhasil!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->to('/lumpsum');
    }

    public function delete($id)
    {
        $lumpsum = $this->lumpsumModel->find($id);
        $oldFile = $lumpsum['file_lumpsum'];
        if (!empty($oldFile)) {
            unlink('upload/lumpsum/' . $oldFile);
        }
        $this->lumpsumModel->delete($id);
        $this->userModel->delete($id);
        $flash = [
            'title' => 'Success!',
            'message' => 'Dokumen lumpsum berhasil dihapus!',
            'icon' => 'success'
        ];
        session()->setFlashdata('flash_message', $flash);
        return redirect()->back();
    }
}
