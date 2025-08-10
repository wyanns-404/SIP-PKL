<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Infolists\Infolist;
use App\Models\Formasi\FormasiPkl;
use App\Models\Pelamar\PelamarPkl;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\ImageEntry;

class StatusLamaran extends Page implements HasTable
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.status-lamaran';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Status Lamaran';

    protected static ?string $navigationGroup = 'Mahasiswa/Siswa';

    use Tables\Concerns\InteractsWithTable;

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                PelamarPkl::query()
                    ->where('user_id', Auth::id())
                    ->with(['formasi.posisi', 'formasi.lokasi', 'user', 'siswa', 'mahasiswa'])
            )
            ->heading('Status Lamaran')
            ->columns([
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->alignCenter()
                    ->color('gray'),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray' => 'dikirim',
                        'info' => 'diproses',
                        'success' => 'diterima',
                        'danger' => 'ditolak',
                    ])
                    ->alignCenter()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                Tables\Columns\TextColumn::make('formasi.nama_formasi')
                    ->label('Formasi')
                    ->description(fn ($record): ?string => \Illuminate\Support\Str::limit($record->formasi->deskripsi ?? '', 30))
                    ->tooltip(fn ($record): ?string => $record->formasi->deskripsi ?? '')
                    ->alignCenter()
                    ->limit(30),
                
                Tables\Columns\TextColumn::make('formasi.posisi.nama_posisi')
                    ->label('Posisi & Penempatan')
                    ->description(fn ($record): ?string => $record->formasi->lokasi?->nama_lokasi)
                    ->alignCenter(),

            ])
            ->actions([
                Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-o-eye')
                    ->button()
                    ->color('info')
                    ->modalHeading('Detail Lamaran PKL')
                    ->modalWidth(MaxWidth::FiveExtraLarge)
                    ->modalSubmitAction(false)
                    ->modalContent(function ($record) {
                        return Infolist::make()
                            ->record($record)
                            ->schema([
                                Tabs::make('Detail Lamaran')
                                    ->tabs([
                                        Tab::make('Detail Formasi')
                                            ->schema([
                                                TextEntry::make('formasi.nama_formasi')
                                                    ->label('Nama Formasi')
                                                    ->color('info'),
                                                TextEntry::make('formasi.deskripsi')
                                                    ->label('Deskripsi')
                                                    ->color('info'),
                                                TextEntry::make('formasi.posisi.nama_posisi')
                                                    ->label('Posisi')
                                                    ->color('info'),
                                                TextEntry::make('formasi.lokasi.nama_lokasi')
                                                    ->label('Lokasi Penempatan')
                                                    ->color('info'),
                                                TextEntry::make('formasi.kuota_penerimaan')
                                                    ->label('Kuota')
                                                    ->badge()
                                                    ->color('gray'),
                                            ]),
                                        
                                        Tab::make('Data Diri')
                                            ->schema([
                                                Section::make('')
                                                    ->schema([
                                                        TextEntry::make('user.name')
                                                            ->label('Nama')
                                                            ->color('info')
                                                            ->columnSpan(6),

                                                        TextEntry::make('user.npm_nim_nis')
                                                            ->label('NPM/NIM/NIS')
                                                            ->color('info')
                                                            ->columnSpan(6),

                                                        TextEntry::make('user.email')
                                                            ->label('Email')
                                                            ->color('info')
                                                            ->columnSpan(6),

                                                        TextEntry::make('tanggal_lahir')
                                                            ->label('Tanggal Lahir')
                                                            ->date('d M Y')
                                                            ->color('info')
                                                            ->columnSpan(6),

                                                        TextEntry::make('jenis_kelamin')
                                                            ->label('Jenis Kelamin')
                                                            ->color('info')
                                                            ->columnSpan(6),

                                                        TextEntry::make('nomor_handphone')
                                                            ->label('Nomor Handphone')
                                                            ->color('info')
                                                            ->columnSpan(6),

                                                        TextEntry::make('alamat_lengkap')
                                                            ->label('Alamat')
                                                            ->color('info')
                                                            ->columnSpan(12),
                                                    ])->columns(12),

                                                Section::make('')
                                                    ->schema([
                                                        TextEntry::make('siswa.nama_sekolah')
                                                            ->label('Nama Sekolah')
                                                            ->color('info')
                                                            ->columnSpan(6)
                                                            ->visible(fn ($record) => $record->kategori_pelamar === 'siswa'),

                                                        TextEntry::make('mahasiswa.nama_universitas')
                                                            ->label('Nama Universitas')
                                                            ->color('info')
                                                            ->columnSpan(6)
                                                            ->visible(fn ($record) => $record->kategori_pelamar === 'mahasiswa'),

                                                        TextEntry::make('mahasiswa.fakultas')
                                                            ->label('Fakultas')
                                                            ->color('info')
                                                            ->columnSpan(6)
                                                            ->visible(fn ($record) => $record->kategori_pelamar === 'mahasiswa'),

                                                        TextEntry::make('mahasiswa.jurusan')
                                                            ->label('Jurusan')
                                                            ->color('info')
                                                            ->columnSpan(6)
                                                            ->visible(fn ($record) => $record->kategori_pelamar === 'mahasiswa'),

                                                        TextEntry::make('siswa.jurusan')
                                                            ->label('Jurusan')
                                                            ->color('info')
                                                            ->columnSpan(6)
                                                            ->visible(fn ($record) => $record->kategori_pelamar === 'siswa'),

                                                        TextEntry::make('mahasiswa.semester')
                                                            ->label('Semester')
                                                            ->color('info')
                                                            ->columnSpan(6)
                                                            ->visible(fn ($record) => $record->kategori_pelamar === 'mahasiswa'),
                                                    ])->columns(12)
                                                
                                            ])->columns(12),
                                            
                                        Tab::make('File')
                                            ->schema([
                                                ImageEntry::make('pas_foto')
                                                    ->label('Pas Foto')
                                                    ->square() // atau ->circular()
                                                    ->height(200)
                                                    ->columnSpan(12)
                                                    ->visible(fn($record) => $record->pas_foto !== null),
                                                
                                                ViewEntry::make('surat_permohonan')
                                                    ->label('Surat Permohonan')
                                                    ->view('filament.components.pdf-preview')
                                                    ->columnSpan(6)
                                                    ->visible(fn($record) => $record->surat_permohonan !== null),
                                                
                                                ViewEntry::make('cv')
                                                    ->label('CV')
                                                    ->view('filament.components.pdf-preview')
                                                    ->columnSpan(6)
                                                    ->visible(fn($record) => $record->cv !== null),
                                                
                                                ViewEntry::make('portofolio')
                                                    ->label('Portofolio')
                                                    ->view('filament.components.pdf-preview')
                                                    ->columnSpan(6)
                                                    ->visible(fn($record) => $record->portofolio !== null),

                                            ])->columns(12)
                                    ])
                            ]);
                    }),


            //     Action::make('lihat_berkas')
            //         ->label('Lihat Berkas')
            //         ->icon('heroicon-o-document-text')
            //         ->color('success')
            //         ->visible(fn ($record) => $record->status === 'diterima')
            //         ->modalHeading('Berkas Pelamar')
            //         ->modalWidth(MaxWidth::Large)
            //         ->modalContent(function ($record) {
            //             // kirim URL yang bisa dibuka langsung (Storage::url)
            //             return view('filament.pages.modals.berkas', [
            //                 'record' => $record,
            //                 'pas_foto' => $record->pas_foto ? Storage::url($record->pas_foto) : null,
            //                 'surat_permohonan' => $record->surat_permohonan ? Storage::url($record->surat_permohonan) : null,
            //                 'portofolio' => $record->portofolio ? Storage::url($record->portofolio) : null,
            //                 'cv' => $record->cv ? Storage::url($record->cv) : null,
            //             ]);
            //         }),

            //     Action::make('unduh_semua')
            //         ->label('Unduh Semua')
            //         ->icon('heroicon-o-arrow-down-tray')
            //         ->color('primary')
            //         ->visible(fn ($record) => $record->status === 'diterima')
            //         ->openUrlInNewTab(),
            ])


            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }

}
