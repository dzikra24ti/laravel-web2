<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon untuk operasi tanggal dan waktu

class PegawaiController extends Controller
{
    /**
     * Menampilkan data pegawai dengan ketentuan yang diminta.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1. Data input atau data yang akan diproses
        $namaLengkap = "Budi Hartono";
        $tglLahir = Carbon::createFromDate(2003, 5, 10); // Tanggal Lahir: 10 Mei 2003
        $tglWisudaTarget = Carbon::createFromDate(2027, 8, 20); // Tanggal Harus Wisuda: 20 Agustus 2027
        $semesterSaatIni = 5; // Contoh semester saat ini
        $citaCita = "Data Scientist di Google";
        $hobiArray = [
            'Coding',
            'Bermain Game',
            'Membaca Komik',
            'Olahraga Basket',
            'Traveling'
        ]; // Minimal 5 item

        // 2. Perhitungan menggunakan Carbon
        $today = Carbon::now();

        // Hitung Umur (dihitung dari tanggal lahir hingga hari ini)
        $umur = $tglLahir->age; // Carbon memiliki method 'age'

        // Hitung Jarak hari dari tgl_harus_wisuda dengan hari ini
        // Menggunakan diffInDays() untuk mendapatkan selisih hari. Nilai absolut (true)
        // digunakan agar hasilnya selalu positif.
        $jarakHariWisuda = $tglWisudaTarget->diffInDays($today, false);

        // Cek jika tgl_harus_wisuda sudah lewat, jadikan 0 atau biarkan negatif sebagai indikator
        // Karena konteksnya "Jarak hari dari tgl_harus_wisuda dengan hari ini", kita asumsikan
        // yang diminta adalah sisa hari menuju wisuda.
        $timeToStudyLeft = max(0, $jarakHariWisuda);
        $waktuStudiSisa = ($jarakHariWisuda < 0) ? 'Telah Terlewat' : $timeToStudyLeft . ' hari';


        // 3. Logika bersyarat untuk informasi semester
        $infoSemester = '';
        if ($semesterSaatIni < 3) {
            $infoSemester = "Masih Awal, Kejar TAK";
        } elseif ($semesterSaatIni > 3) {
            $infoSemester = "Jangan main-main, kurang-kurangi main game!";
        } else {
            // Untuk semester 3 (jika tidak kurang dari 3 dan tidak lebih dari 3)
            $infoSemester = "Semester Tengah, Tetap Semangat!";
        }

        // 4. Susun data dalam bentuk array sesuai permintaan
        $dataPegawai = [
            'name' => $namaLengkap,
            'my_age' => $umur,
            'hobbies' => $hobiArray,
            'tgl_harus_wisuda' => $tglWisudaTarget->toDateString(), // Format tanggal menjadi string 'Y-m-d'
            'time_to_study_left' => $waktuStudiSisa, // Bisa berupa angka hari atau string 'Telah Terlewat'
            'current_semester' => $semesterSaatIni,
            'info_semester' => $infoSemester, // Hasil dari logika bersyarat
            'future_goal' => $citaCita,
        ];

        // 5. Mengembalikan data (misalnya dalam bentuk JSON atau ke View)

        // Contoh: Mengembalikan sebagai respons JSON (Cocok untuk API)
        return response()->json($dataPegawai);

        // Atau: Mengembalikan ke Blade View (Cocok untuk aplikasi web)
        // return view('pegawai.index', $dataPegawai);
    }
}
