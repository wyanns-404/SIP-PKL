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
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\ImageEntry;

class LamaranMasuk extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static string $view = 'filament.pages.lamaran-masuk';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Lamaran Masuk';

    protected static ?string $navigationGroup = 'Admin';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                PelamarPkl::with('user', 'formasi', 'siswa', 'mahasiswa')
            )
            ->heading('Daftar Lamaran Masuk')
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
                        'dikirim' => 'gray',
                        'diproses' => 'info',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
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
                        ->color('primary')
                        ->modalHeading('Unduh Berkas Lamaran')
                        ->modalWidth(MaxWidth::FiveExtraLarge)
                        ->modalSubmitAction(false)
                        ->modalContent(function ($record) {
                            return Infolist::make()
                                ->schema([
                                    TextEntry::make('formasi.nama_formasi')
                                        ->label('Formasi'),
                                    TextEntry::make('user.name')
                                        ->label('Nama'),
                                    TextEntry::make('user.npm_nim_nis')
                                        ->label('NPM/NIM/NIS'),
                                    TextEntry::make('created_at')
                                        ->date('d M Y')
                                        ->label('Tanggal Masuk'),
                                    TextEntry::make('file')
                                        ->label('Berkas Lamaran')
                                        ->getStateUsing(function ($record) {
                                            return $record->file ? url($record->file) : 'Tidak ada berkas';
                                        })
                                        ->formatStateUsing(function ($state) {
                                            return $state ? '<a href="' . $state . '" target="_blank" class="text-blue-600 hover:underline">Unduh Berkas</a>' : 'Tidak ada berkas';
                                        })
                                        ->html(),
                                ])->record($record);
                        }),

                ])->icon('heroicon-o-bars-3'),
                
            ]);
    }
}
