<?php

namespace App\Http\Controllers;

use App\Models\Formasi\FormasiPkl;
use App\Models\Pelamar\PelamarPkl;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Total Peserta PKL (semua pelamar yang statusnya diterima)
        $totalPeserta = PelamarPkl::where('status', 'Lamaran Diterima')->count();

        // Sedang PKL (status diterima dan tanggal aktif)
        $sedangPkl = PelamarPkl::where('status', 'Lamaran Diterima')
            ->whereHas('formasi', function ($query) use ($now) {
                $query->whereDate('tanggal_mulai', '<=', $now)
                      ->whereDate('tanggal_selesai', '>=', $now);
            })
            ->count();

        // Lowongan Tersedia (deadline > hari ini)
        $lowonganTersedia = FormasiPkl::whereDate('deadline_pendaftaran', '>', $now)->count();

        return view('landing-page', [
            'totalPeserta' => $totalPeserta,
            'sedangPkl' => $sedangPkl,
            'lowonganTersedia' => $lowonganTersedia,
        ]);
    }
}
