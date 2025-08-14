<?php

namespace App\Filament\Pages;

use Dom\Text;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Infolists\Infolist;
use App\Models\Pelamar\PelamarPkl;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Infolists\Components\Group;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\ImageEntry;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class LamaranMasuk extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable, HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static string $view = 'filament.pages.lamaran-masuk';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Pelamar PKL';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                PelamarPkl::with('user', 'formasi', 'siswa', 'mahasiswa')
            )
            ->heading('Daftar Pelamar PKL')
            ->columns([
                TextColumn::make('formasi.nama_formasi')
                    ->label('Formasi')
                    ->description(fn ($record): ?string => \Illuminate\Support\Str::limit($record->formasi->deskripsi, 30))
                    ->tooltip(fn ($record): ?string => $record->formasi->deskripsi)
                    ->limit(30),
                TextColumn::make('user.name')
                    ->label('Nama & NPM/NIM/NIS')
                    ->alignCenter()
                    ->description(fn ($record): ?string => $record->user->npm_nim_nis),
                
                TextColumn::make('universitas_sekolah_jurusan')
                    ->label('Universitas/Sekolah & Jurusan')
                    ->alignCenter()
                    ->getStateUsing(function ($record) {
                        if ($record->kategori_pelamar === 'mahasiswa' && $record->mahasiswa) {
                            return $record->mahasiswa->nama_universitas;
                        } elseif ($record->kategori_pelamar === 'siswa' && $record->siswa) {
                            return $record->siswa->nama_sekolah;
                        }
                        return '-';
                    })
                    ->description(function ($record) {
                        if ($record->kategori_pelamar === 'mahasiswa' && $record->mahasiswa) {
                            return $record->mahasiswa->jurusan;
                        } elseif ($record->kategori_pelamar === 'siswa' && $record->siswa) {
                            return $record->siswa->jurusan;
                        }
                        return null;
                    }),

                TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->date('d M Y')
                    ->alignCenter()
                    ->badge()
                    ->color('info'),

                TextColumn::make('status')
                    ->label('Status')
                    ->alignCenter()
                    ->badge()
                    ->color(fn ($record) => match ($record->status) {
                        'Menunggu Verifikasi' => 'gray',
                        'Sedang Diproses' => 'info',
                        'Lamaran Diterima' => 'success',
                        'Lamaran Ditolak' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')
                        ->label('Lihat')
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->modalHeading('Umum')
                        ->modalWidth(MaxWidth::FiveExtraLarge)
                        ->modalSubmitAction(false)
                        ->modalContent(function ($record) {
                            return Infolist::make()
                                ->schema([
                                    Tabs::make()
                                        ->tabs([
                                            Tabs\Tab::make('Umum')
                                                ->icon('heroicon-o-information-circle')
                                                ->schema([
                                                    Section::make('')
                                                        ->schema([
                                                            ImageEntry::make('pas_foto')
                                                                ->label('')
                                                                ->height(250)
                                                                ->columnSpan(4),
                                                            Group::make([
                                                                TextEntry::make('status')
                                                                ->label('')
                                                                ->badge()
                                                                ->colors([
                                                                    'gray' => 'Menunggu Verifikasi',
                                                                    'info' => 'Sedang Diproses',
                                                                    'success' => 'Lamaran Diterima',
                                                                    'danger' => 'Lamaran Ditolak',
                                                                ]),
                                                                TextEntry::make('user.name')
                                                                    ->label('')
                                                                    ->size(TextEntry\TextEntrySize::Large)
                                                                    ->weight(FontWeight::Bold),
                                                                TextEntry::make('motivasi')
                                                                    ->label(''),
                                                            ])->columnSpan(8),
                                                        ])->columns(12),
                                                    
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

                                                            TextEntry::make('nomor_handphone')
                                                                ->label('Nomor Handphone')
                                                                ->color('info')
                                                                ->columnSpan(6),
                                                            
                                                            TextEntry::make('alamat_lengkap')
                                                                ->label('Alamat Lengkap')
                                                                ->color('info')
                                                                ->columnSpan(6)
                                                                ->visible(fn ($record) => $record->alamat_lengkap !== null),

                                                            TextEntry::make('jenis_kelamin')
                                                                ->label('Jenis Kelamin')
                                                                ->color('info')
                                                                ->columnSpan(6)
                                                                ->visible(fn ($record) => $record->jenis_kelamin !== null)
                                                                ->formatStateUsing(function ($state) {
                                                                    return match ($state) {
                                                                        'L' => 'Laki-laki',
                                                                        'P' => 'Perempuan',
                                                                        default => $state,
                                                                    };
                                                                }),

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
                                                        ])->columns(12),
                                                    Section::make('')
                                                        ->schema([
                                                            TextEntry::make('formasi.nama_formasi')
                                                                ->label('Nama Formasi')
                                                                ->columnSpan(6)
                                                                ->color('info'),
                                                            TextEntry::make('formasi.deskripsi')
                                                                ->label('Deskripsi')
                                                                ->columnSpan(6)
                                                                ->color('info'),
                                                            TextEntry::make('formasi.posisi.nama_posisi')
                                                                ->label('Posisi')
                                                                ->columnSpan(6)
                                                                ->color('info'),
                                                            TextEntry::make('formasi.lokasi.nama_lokasi')
                                                                ->label('Lokasi Penempatan')
                                                                ->columnSpan(6)
                                                                ->color('info'),
                                                        ])->columns(12),
                                                ])->columns(12),
                                            Tabs\Tab::make('Berkas Lamaran')
                                                ->icon('heroicon-o-document-text')
                                                ->schema([
                                                    Section::make('Surat Permohonan')
                                                        ->schema([                                                            
                                                            ViewEntry::make('surat_permohonan')
                                                                ->label('Surat Permohonan')
                                                                ->view('filament.components.pdf-preview')
                                                                ->visible(fn($record) => $record->surat_permohonan !== null),
                                                        ])->columnSpan(6),
                                                    
                                                    Section::make('CV')
                                                        ->schema([
                                                            ViewEntry::make('cv')
                                                                ->label('CV')
                                                                ->view('filament.components.pdf-preview')
                                                                ->visible(fn($record) => $record->cv !== null),
                                                        ])->columnSpan(6),
                                                    
                                                    Section::make('Portofolio')
                                                        ->schema([
                                                            ViewEntry::make('portofolio')
                                                                ->label('Portofolio')
                                                                ->view('filament.components.pdf-preview')
                                                                ->visible(fn($record) => $record->portofolio !== null),
                                                        ])->columnSpan(6)->visible(fn($record) => $record->portofolio !== null),

                                                ])->columns(12),
                                        ]),
                                ])->record($record);
                        }),
                    
                    Action::make('status')
                        ->label('Edit Status')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->form([
                            \Filament\Forms\Components\Select::make('status')
                                ->label('Status')
                                ->options([
                                    'Sedang Diproses' => 'Sedang Diproses',
                                    'Lamaran Diterima' => 'Lamaran Diterima',
                                    'Lamaran Ditolak' => 'Lamaran Ditolak',
                                ])
                                ->required()
                                ->reactive()
                                ->default(fn ($record) => $record->status),
                            \Filament\Forms\Components\FileUpload::make('surat_balasan')
                                ->label('Surat Balasan')
                                ->default(fn ($record) => $record->surat_balasan)
                                ->visible(fn ($get) => $get('status') === 'Lamaran Diterima')
                                ->directory(function ($get, $record) {
                                    $npm = $record->user->npm_nim_nis ?? 'unknown';
                                    return 'pelamar/'. $npm . '/surat-balasan';
                                })
                                ->acceptedFileTypes(['application/pdf'])
                                ->maxSize(2048)
                                ->required(fn ($get) => $get('status') === 'Lamaran Diterima')
                                ->getUploadedFileNameForStorageUsing(function ($file) {
                                    $date = now()->format('Ymd');
                                    return 'surat-balasan-' . $date . '.' . $file->getClientOriginalExtension();
                                }),
                        ])
                        ->action(function ($data, $record) {
                            $record->status = $data['status'];
                            if ($data['status'] === 'Lamaran Diterima' && isset($data['surat_balasan'])) {
                                $record->surat_balasan = $data['surat_balasan'];
                            }
                            $record->save();
                            \Filament\Notifications\Notification::make()
                                ->title('Status berhasil diperbarui')
                                ->success()
                                ->send();
                        })
                        ->modalHeading('Ubah Status Lamaran')
                        ->modalWidth(MaxWidth::ThreeExtraLarge),
                    
                    Action::make('Beri Penilaian')
                        ->label('Beri Penilaian')
                        ->icon('heroicon-o-star')
                        ->color('warning')
                        ->visible(fn ($record) => $record->status === 'Lamaran Diterima')
                        ->form([
                            FileUpload::make('nilai')
                                ->default(fn($record) => optional($record->nilaiDanSertifikat)->nilai)
                                ->label('File Nilai (PDF)')
                                ->acceptedFileTypes(['application/pdf'])
                                ->maxSize(2048)
                                ->directory(fn($get, $record) => 'pelamar/' . ($record->user->npm_nim_nis ?? 'unknown') . '/nilai_dan_sertifikat')
                                ->getUploadedFileNameForStorageUsing(function ($file, $get, $record) {
                                    $date = now()->format('Ymd');
                                    $npm = $record?->user?->npm_nim_nis ?? 'unknown';
                                    return 'nilai_' . $npm . '_' . $date . '.' . $file->getClientOriginalExtension();
                                })
                                ->required(),
                            FileUpload::make('sertifikat')
                                ->default(fn($record) => optional($record->nilaiDanSertifikat)->sertifikat)
                                ->label('File Sertifikat (PDF)')
                                ->acceptedFileTypes(['application/pdf'])
                                ->maxSize(2048)
                                ->directory(fn($get, $record) => 'pelamar/' . ($record->user->npm_nim_nis ?? 'unknown') . '/nilai_dan_sertifikat')
                                ->getUploadedFileNameForStorageUsing(function ($file, $get, $record) {
                                    $date = now()->format('Ymd');
                                    $npm = $record?->user?->npm_nim_nis ?? 'unknown';
                                    return 'sertifikat_' . $npm . '_' . $date . '.' . $file->getClientOriginalExtension();
                                })
                                ->required(),
                        ])
                        ->action(function ($data, $record) {
                            $record->nilaiDanSertifikat()->updateOrCreate(
                                [ 'pelamar_pkl_id' => $record->id ],
                                [
                                    'nilai' => $data['nilai'],
                                    'sertifikat' => $data['sertifikat'],
                                ]
                            );
                            \Filament\Notifications\Notification::make()
                                ->title('Nilai dan Sertifikat berhasil diunggah')
                                ->success()
                                ->send();
                        })
                        ->modalHeading('Upload Nilai & Sertifikat')
                        ->modalWidth(MaxWidth::ThreeExtraLarge),

                ])->icon('heroicon-o-bars-3'),
                
            ]);
    }
}
