<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $nama = "Dzikra Rizqullah";
        $tanggalLahirStr = '2007-05-15';
        $tanggalHarusWisudaStr = '2028-07-20';
        $semesterSaatIni = 3;


        $tanggalLahir = new \DateTime($tanggalLahirStr);
        $today = new \DateTime();
        $selisihUmur = $tanggalLahir->diff($today);
        $umur = $selisihUmur->y;


        $tanggalHarusWisuda = new \DateTime($tanggalHarusWisudaStr);
        $selisihHari = $today->diff($tanggalHarusWisuda);

        $jarakHari = $selisihHari->days;


        if ($today > $tanggalHarusWisuda) {
            $jarakHari = -$jarakHari;
        }

        $jarakHariBulat = round($jarakHari);

        $pesanSemester = '';
        if ($semesterSaatIni < 3) {
            $pesanSemester = 'Masih Awal, Kejar TAK';
        } else {
            $pesanSemester = 'Jangan main-main, kurang-kurangi main game!';
        }

        $dataPegawai = [
            'name' => $nama,
            'my_age' => $umur,
            'hobbies' => [
                'Futsal', 'Coding', 'Jogging', 'Tidur', 'Game'
            ],
            'tgl_harus_wisuda' => $tanggalHarusWisudaStr,

            'time_to_study_left' => $jarakHariBulat,
            'current_semester' => $semesterSaatIni,
            'semester_info' => $pesanSemester,
            'future_goal' => 'Menjadi Data Analyst'
        ];

    return view('halaman-pegawai-data', [
    'data' => $dataPegawai
]);
    }
}
