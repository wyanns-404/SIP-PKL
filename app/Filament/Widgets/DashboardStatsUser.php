<?php

namespace App\Filament\Widgets;

use App\Models\Pelamar\PelamarPkl;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardStatsUser extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static bool $isLazy = false; 
    
    protected function getStats(): array
    {
        $now = Carbon::now();
        $userId = Auth::id();

        $totalLamaran = PelamarPkl::where('user_id', $userId)->count();
        $menungguVerifikasi = PelamarPkl::where('user_id', $userId)
            ->where('status', 'Menunggu Verifikasi')
            ->count();
        $sedangPkl = PelamarPkl::where('user_id', $userId)
            ->where('status', 'Lamaran Diterima')
            ->whereHas('formasi', function ($query) use ($now) {
                $query->whereDate('tanggal_mulai', '<=', $now)
                      ->whereDate('tanggal_selesai', '>=', $now);
            })
            ->count();
        $ditolak = PelamarPkl::where('user_id', $userId)
            ->where('status', 'Lamaran Ditolak')
            ->count();

        return [
            Stat::make('Total Lamaran Saya', $totalLamaran)
                ->description('Semua lamaran yang diajukan')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary'),

            Stat::make('Menunggu Verifikasi', $menungguVerifikasi)
                ->description('Lamaran menunggu verifikasi')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Sedang PKL', $sedangPkl)
                ->description('PKL sedang berlangsung')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Lamaran Ditolak', $ditolak)
                ->description('Lamaran yang ditolak')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }

    public static function canView(): bool
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return $user->hasRole('user');
    }
}
