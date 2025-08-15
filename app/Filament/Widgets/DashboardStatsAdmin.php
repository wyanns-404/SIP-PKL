<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Formasi\FormasiPkl;
use App\Models\Pelamar\PelamarPkl;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class DashboardStatsAdmin extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static bool $isLazy = false; 

    protected function getStats(): array
    {
        $now = Carbon::now();

        $lowonganTersedia = FormasiPkl::whereDate('deadline_pendaftaran', '>', $now)->count();
        $totalPermohonan = PelamarPkl::count();
        $menungguVerifikasi = PelamarPkl::where('status', 'Menunggu Verifikasi')->count();
        $sedangPkl = PelamarPkl::where('status', 'Lamaran Diterima')
            ->whereHas('formasi', function ($query) use ($now) {
                $query->whereDate('tanggal_mulai', '<=', $now)
                      ->whereDate('tanggal_selesai', '>=', $now);
            })
            ->count();

        return [
            Stat::make('Lowongan Tersedia', $lowonganTersedia)
                ->description('Formasi PKL masih dibuka')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('success'),

            Stat::make('Total Permohonan', $totalPermohonan)
                ->description('Semua lamaran yang masuk')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary'),

            Stat::make('Menunggu Verifikasi', $menungguVerifikasi)
                ->description('Lamaran menunggu verifikasi')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Sedang PKL', $sedangPkl)
                ->description('Pelamar sedang menjalani PKL')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('info'),
        ];
    }

    public static function canView(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $user->hasRole('admin') || $user->hasRole('super_admin');
    }
}
