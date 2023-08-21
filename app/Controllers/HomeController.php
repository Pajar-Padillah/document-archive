<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LumpsumModel;
use App\Models\GUPModel;

class HomeController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $lumpsumModel = new LumpsumModel();
        $gupModel = new GUPModel();

        $tahun = date('Y');
        $data_grafik_lumpsum = $lumpsumModel->select('MONTH(tanggal) as bulan, COUNT(id) as jumlah, tanggal as tanggal')
            ->where('YEAR(tanggal) = ' . $tahun)
            ->groupBy('MONTH(tanggal)')
            ->get();
        $data_grafik_gup = $gupModel->select('MONTH(tanggal) as bulan, COUNT(id) as jumlah, tanggal as tanggal')
            ->where('YEAR(tanggal) = ' . $tahun)
            ->groupBy('MONTH(tanggal)')
            ->get();

        $data = [
            'title' => 'Dashboard',
            'userdata' => $this->userdata(),
            'total_user' => $userModel->countAllResults(),
            'total_lumpsum' => $lumpsumModel->countAllResults(),
            'total_gup' => $gupModel->countAllResults(),
            'data_grafik_lumpsum' => $data_grafik_lumpsum,
            'data_grafik_gup' => $data_grafik_gup,
            'validation' => \Config\Services::validation(),
            'tahun' => $tahun
        ];
        return view('pages/dashboard', $data);
    }
}
