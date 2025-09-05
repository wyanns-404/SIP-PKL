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
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\ImageEntry;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Dom\Text;

class StatusLamaran extends Page implements HasTable
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationGroup = 'Tampilan User';

    protected static string $view = 'filament.pages.status-lamaran';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Status Lamaran';

    use Tables\Concerns\InteractsWithTable, HasPageShield;

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
                        'gray' => 'Menunggu Verifikasi',
                        'info' => 'Sedang Diproses',
                        'success' => 'Lamaran Diterima',
                        'danger' => 'Lamaran Ditolak',
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
                                        Tab::make('Umum')
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

                                                        TextEntry::make('tanggal_lahir')
                                                            ->label('Tanggal Lahir')
                                                            ->date('d M Y')
                                                            ->color('info')
                                                            ->columnSpan(6)
                                                            ->visible(fn ($record) => $record->tanggal_lahir !== null),

                                                        TextEntry::make('alamat_lengkap')
                                                            ->label('Alamat Lengkap')
                                                            ->color('info')
                                                            ->columnSpan(12)
                                                            ->visible(fn ($record) => $record->alamat_lengkap !== null),
                                                        
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

                                            ]),
                                            
                                        Tab::make('Berkas Lamaran')
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
                                    ])
                            ]);
                    }),


                Action::make('lihat_berkas')
                    ->label('Lihat Surat Balasan')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->button()
                    ->visible(fn ($record) => $record->status === 'Lamaran Diterima' && $record->surat_balasan)
                    ->modalHeading('Surat Balasan')
                    ->modalSubmitAction(false)
                    ->modalWidth(MaxWidth::Large)
                    ->modalContent(function ($record) {
                        return Infolist::make()
                            ->record($record)
                            ->schema([
                                ViewEntry::make('surat_balasan')
                                    ->label('Surat Balasan')
                                    ->view('filament.components.pdf-preview')
                                    ->visible(fn($record) => $record->surat_balasan !== null),
                            ]);
                    }),

                Action::make('lihat_nilai_dan_sertifikat')
                    ->label('Nilai & Sertifikat')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->button()
                    ->visible(fn ($record) => $record->status === 'Lamaran Diterima' && optional($record->nilaiDanSertifikat)->nilai && optional($record->nilaiDanSertifikat)->sertifikat)
                    ->modalHeading('Nilai & Sertifikat')
                    ->modalSubmitAction(false)
                    ->modalWidth(MaxWidth::Large)
                    ->modalContent(function ($record) {
                        return Infolist::make()
                            ->record($record)
                            ->schema([
                                ViewEntry::make('nilaiDanSertifikat.nilai')
                                    ->label('File Nilai')
                                    ->view('filament.components.pdf-preview')
                                    ->visible(fn($record) => optional($record->nilaiDanSertifikat)->nilai !== null),
                                ViewEntry::make('nilaiDanSertifikat.sertifikat')
                                    ->label('File Sertifikat')
                                    ->view('filament.components.pdf-preview')
                                    ->visible(fn($record) => optional($record->nilaiDanSertifikat)->sertifikat !== null),
                            ]);
                    })
            ])


            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }

}
