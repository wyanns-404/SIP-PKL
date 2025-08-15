<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Infolists\Infolist;
use App\Models\Formasi\FormasiPkl;
use App\Models\Pelamar\PelamarPkl;
use Filament\Forms\Components\Radio;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;

use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Action as PageAction;
use Filament\Forms\Components\Wizard\Step;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Concerns\InteractsWithForms;

use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\Action as TableAction;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;



class LowonganTersedia extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms, HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.lowongan-tersedia';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Lowongan';

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         PageAction::make('kembali')
    //             ->label('Kembali')
    //             ->icon('heroicon-o-arrow-left')
    //             ->color('secondary'),
    //     ];
    // }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                FormasiPkl::query()
                    ->whereDate('deadline_pendaftaran', '>=', now())
                    ->with(['posisi', 'lokasi'])
            )
            ->heading('Lowongan')
            ->description('Berikut formasi yang tersedia.')
            ->columns([
                Tables\Columns\TextColumn::make('nama_formasi')
                    ->label('Formasi')
                    ->description(fn ($record): ?string => \Illuminate\Support\Str::limit($record->deskripsi, 30))
                    ->tooltip(fn ($record): ?string => $record->deskripsi)
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('posisi.nama_posisi')
                    ->label('Posisi & Penempatan')
                    ->description(fn ($record): ?string => $record->lokasi?->nama_lokasi)
                    ->searchable(),
                Tables\Columns\TextColumn::make('periode')
                    ->label('Periode')
                    ->getStateUsing(function ($record) {
                        $mulai = $record->tanggal_mulai;
                        $selesai = $record->tanggal_selesai;
                        if ($mulai && !($mulai instanceof \Carbon\Carbon)) {
                            $mulai = \Carbon\Carbon::parse($mulai);
                        }
                        if ($selesai && !($selesai instanceof \Carbon\Carbon)) {
                            $selesai = \Carbon\Carbon::parse($selesai);
                        }
                        return ($mulai ? $mulai->format('d M Y') : '-') . ' - ' . ($selesai ? $selesai->format('d M Y') : '-');
                    })
                    ->badge()
                    ->color(function ($record) {
                        $today = Carbon::today();
                        $mulai = $record->tanggal_mulai;
                        $selesai = $record->tanggal_selesai;

                        if ($mulai && !($mulai instanceof Carbon)) {
                            $mulai = Carbon::parse($mulai);
                        }
                        if ($selesai && !($selesai instanceof Carbon)) {
                            $selesai = Carbon::parse($selesai);
                        }

                        if ($today->lt($mulai)) {
                            return 'success'; // Belum mulai
                        } elseif ($today->between($mulai, $selesai)) {
                            return 'warning'; // Dalam periode
                        } else {
                            return 'gray'; // Sudah lewat
                        }
                    }),
                Tables\Columns\TextColumn::make('deadline_pendaftaran')
                    ->label('Batas Pendaftaran')
                    ->date('d M Y')
                    ->badge()
                    ->color(function ($record) {
                        $today = Carbon::today();
                        $deadline = $record->deadline_pendaftaran;

                        if ($deadline && !($deadline instanceof Carbon)) {
                            $deadline = Carbon::parse($deadline);
                        }

                        return $today->lte($deadline) ? 'success' : 'gray';
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pengumuman')
                    ->label('Tanggal Pengumuman')
                    ->date('d M Y')
                    ->badge()
                    ->color('info')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TagsColumn::make('jenjang')
                    ->label('Jenjang')
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->getStateUsing(fn ($record) => $record->jenjang->pluck('nama_jenjang')->toArray())
                    ->colors(['info'])
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TagsColumn::make('jurusan')
                    ->label('Jurusan')
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->getStateUsing(fn ($record) => $record->jurusan->pluck('nama_jurusan')->toArray())
                    ->colors(['primary'])
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('kuota_penerimaan')
                    ->label('Kuota')
                    ->badge()
                    ->color('info'),
            ])
            ->actions([
                TableAction::make('detail')
                    ->label('Detail')
                    ->button()
                    ->icon('heroicon-o-eye')
                    ->modalHeading('Detail Formasi PKL')
                    ->modalWidth(MaxWidth::FiveExtraLarge)
                    ->modalSubmitAction(false)
                    ->modalContent(function ($record) {
                        return Infolist::make()
                            ->record($record)
                            ->schema([
                                Tabs::make('Detail Tabs')
                                    ->tabs([
                                        Tab::make('Informasi Umum')
                                            ->schema([
                                                    TextEntry::make('nama_formasi')
                                                        ->label('Nama Formasi')
                                                        ->color('info')
                                                        ->size(TextEntry\TextEntrySize::Medium),
                                                    TextEntry::make('deskripsi')
                                                        ->label('Deskripsi')
                                                        ->color('info')
                                                        ->size(TextEntry\TextEntrySize::Medium),
                                                    TextEntry::make('posisi.nama_posisi')
                                                        ->label('Posisi')
                                                        ->color('info')
                                                        ->size(TextEntry\TextEntrySize::Medium),
                                                    TextEntry::make('lokasi.nama_lokasi')
                                                        ->label('Lokasi Penempatan')
                                                        ->color('info')
                                                        ->size(TextEntry\TextEntrySize::Medium),
                                                    TextEntry::make('kuota_penerimaan')
                                                        ->label('Kuota')
                                                        ->badge()
                                                        ->color('gray'),
                                            ]),

                                        Tab::make('Persyaratan')
                                            ->schema([
                                                    TextEntry::make('jenjang')
                                                        ->label('Jenjang Pendidikan')
                                                        ->formatStateUsing(fn ($record) => $record->jenjang->pluck('nama_jenjang')->implode(', '))                                                        
                                                        ->color('info'),
                                                    TextEntry::make('jurusan')
                                                        ->label('Jurusan')
                                                        ->formatStateUsing(fn ($record) => $record->jurusan->pluck('nama_jurusan')->implode(', '))                                                        
                                                        ->color('info'),
                                                    TextEntry::make('dokumen')
                                                        ->label('Dokumen')
                                                        ->default('Pas Foto, Surat Permohonan, dan CV')
                                                        ->color('info'),
                                            ]),

                                        Tab::make('Tanggal Penting')
                                            ->schema([
                                                    TextEntry::make('periode')
                                                        ->label('Periode PKL')
                                                        ->getStateUsing(function ($record) {
                                                            $mulai = $record->tanggal_mulai;
                                                            $selesai = $record->tanggal_selesai;
                                                            if ($mulai && !($mulai instanceof \Carbon\Carbon)) {
                                                                $mulai = \Carbon\Carbon::parse($mulai);
                                                            }
                                                            if ($selesai && !($selesai instanceof \Carbon\Carbon)) {
                                                                $selesai = \Carbon\Carbon::parse($selesai);
                                                            }
                                                            return ($mulai ? $mulai->format('d M Y') : '-') . ' - ' . ($selesai ? $selesai->format('d M Y') : '-');
                                                        })
                                                        ->badge()
                                                        ->color(function ($record) {
                                                            $today = Carbon::today();
                                                            $mulai = $record->tanggal_mulai;
                                                            $selesai = $record->tanggal_selesai;

                                                            if ($mulai && !($mulai instanceof Carbon)) {
                                                                $mulai = Carbon::parse($mulai);
                                                            }
                                                            if ($selesai && !($selesai instanceof Carbon)) {
                                                                $selesai = Carbon::parse($selesai);
                                                            }

                                                            if ($today->lt($mulai)) {
                                                                return 'success'; // Belum mulai
                                                            } elseif ($today->between($mulai, $selesai)) {
                                                                return 'warning'; // Dalam periode
                                                            } else {
                                                                return 'gray'; // Sudah lewat
                                                            }
                                                        }),
                                                    TextEntry::make('deadline_pendaftaran')
                                                        ->label('Batas Pendaftaran')
                                                        ->date('d M Y')
                                                        ->badge()
                                                        ->color('warning'),
                                                    TextEntry::make('tanggal_pengumuman')
                                                        ->label('Pengumuman Penerimaan')
                                                        ->date('d M Y')
                                                        ->badge()
                                                        ->color('warning'),
                                            ]),
                                    ]),
                            ]);
                    }),

                TableAction::make('Apply')
                    ->label('Apply')
                    ->button()
                    ->color('warning')
                    ->icon('heroicon-o-pencil-square')
                    ->steps([
                        Step::make('Data Pribadi')
                            ->schema([
                                TextInput::make('nama')
                                    ->label('Nama')
                                    ->default(fn () => Auth::user()->name)
                                    ->columnSpan(6)
                                    ->disabled(),

                                TextInput::make('npm_nim_nis')
                                    ->label('NPM / NIM / NIS')
                                    ->default(fn () => Auth::user()->npm_nim_nis)
                                    ->dehydrated(true)
                                    ->columnSpan(6)
                                    ->disabled(),

                                TextInput::make('email')
                                    ->label('Email')
                                    ->default(fn () => Auth::user()->email)
                                    ->columnSpan(6)
                                    ->disabled(),

                                TextInput::make('nomor_handphone')
                                    ->label('Nomor HP')
                                    ->prefix('+62')
                                    ->tel()
                                    ->required()
                                    ->rule('regex:/^[0-9]{10,15}$/') // hanya angka, 10-15 digit
                                    ->helperText('Masukkan nomor tanpa spasi atau tanda hubung.')
                                    ->columnSpan(6),

                                DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->native(false)
                                    ->closeOnDateSelection()
                                    ->displayFormat('d/m/Y')
                                    ->columnSpan(6)
                                    ->placeholder('DD/MM/YYYY')
                                    ->required(),

                                Select::make('kategori_pelamar')
                                    ->label('Jenjang Pendidikan')
                                    ->options([
                                        'siswa' => 'Siswa',
                                        'mahasiswa' => 'Mahasiswa',
                                    ])
                                    ->columnSpan(6)
                                    ->required(),
                                
                                Radio::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                    ])
                                    ->columnSpan(6)
                                    ->required(),
                                    
                                Textarea::make('alamat_lengkap')
                                    ->label('Alamat Lengkap')
                                    ->rows(3)
                                    ->columnSpan(6)
                                    ->required(),

                            ])
                            ->columns(12),

                        Step::make('Data Pendidikan')
                            ->schema([
                                TextInput::make('nama_sekolah')
                                    ->label('Nama Sekolah')
                                    ->columnSpan(6)
                                    ->required(fn ($get) => $get('kategori_pelamar') === 'siswa')
                                    ->visible(fn ($get) => $get('kategori_pelamar') === 'siswa'),
                                TextInput::make('nama_universitas')
                                    ->label('Nama Universitas')
                                    ->columnSpan(6)
                                    ->required(fn ($get) => $get('kategori_pelamar') === 'mahasiswa')
                                    ->visible(fn ($get) => $get('kategori_pelamar') === 'mahasiswa'),
                                TextInput::make('fakultas')
                                    ->label('Fakultas')
                                    ->columnSpan(6)
                                    ->required(fn ($get) => $get('kategori_pelamar') === 'mahasiswa')
                                    ->visible(fn ($get) => $get('kategori_pelamar') === 'mahasiswa'),
                                TextInput::make('jurusan')
                                    ->label('Jurusan')
                                    ->columnSpan(6)
                                    ->required(),
                                TextInput::make('semester')
                                    ->label('Semester')
                                    ->numeric()
                                    ->columnSpan(6)
                                    ->required(fn ($get) => $get('kategori_pelamar') === 'mahasiswa')
                                    ->visible(fn ($get) => $get('kategori_pelamar') === 'mahasiswa'),
                            ])
                            ->columns(12),

                        Step::make('Dokumen')
                            ->schema([

                                FileUpload::make('pas_foto')
                                    ->label('Pas Foto')
                                    ->directory(fn ($get) => 'pelamar/' . $get('npm_nim_nis') . '/foto')
                                    ->image()
                                    ->maxSize(1024) // 2MB
                                    ->imagePreviewHeight('150')
                                    ->preserveFilenames(false)
                                    ->getUploadedFileNameForStorageUsing(fn ($file) => 
                                        'pas_foto_' . now()->timestamp . '.' . $file->getClientOriginalExtension()
                                    )
                                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                                    ->required()
                                    ->columnSpan(6),

                                FileUpload::make('surat_permohonan')
                                    ->label('Surat Permohonan')
                                    ->directory(fn ($get) => 'pelamar/' . $get('npm_nim_nis') . '/surat_permohonan')
                                    ->maxSize(1024) // 3MB
                                    ->preserveFilenames(false)
                                    ->getUploadedFileNameForStorageUsing(fn ($file) => 
                                        'surat_permohonan_' . now()->timestamp . '.' . $file->getClientOriginalExtension()
                                    )
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->required()
                                    ->columnSpan(6),

                                FileUpload::make('cv')
                                    ->label('Curriculum Vitae (CV)')
                                    ->directory(fn ($get) => 'pelamar/' . $get('npm_nim_nis') . '/cv')
                                    ->maxSize(1024) // 3MB
                                    ->preserveFilenames(false)
                                    ->getUploadedFileNameForStorageUsing(fn ($file) => 
                                        'cv_' . now()->timestamp . '.' . $file->getClientOriginalExtension()
                                    )
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->required()
                                    ->columnSpan(6),

                                FileUpload::make('portofolio')
                                    ->label('Portofolio')
                                    ->directory(fn ($get) => 'pelamar/' . $get('npm_nim_nis') . '/portofolio')
                                    ->maxSize(1024) // 5MB
                                    ->preserveFilenames(false)
                                    ->getUploadedFileNameForStorageUsing(fn ($file) => 
                                        'portofolio_' . now()->timestamp . '.' . $file->getClientOriginalExtension()
                                    )
                                    ->acceptedFileTypes([
                                        'application/pdf',
                                        'image/jpeg', 'image/png'
                                    ])
                                    ->nullable()
                                    ->columnSpan(6),

                                Textarea::make('motivasi')
                                    ->label('Motivasi')
                                    ->rows(3)
                                    ->columnSpan('full')
                                    ->required(),
                            ])
                            ->columns(12),
                    ])
                    ->action(function (array $data, $record) {
                        $pelamar = PelamarPkl::create([
                            'formasi_id'       => $record->id,
                            'user_id'          => Auth::id(),
                            'kategori_pelamar' => $data['kategori_pelamar'],
                            'tanggal_lahir'    => $data['tanggal_lahir'],
                            'jenis_kelamin'    => $data['jenis_kelamin'],
                            'nomor_handphone'  => $data['nomor_handphone'],
                            'alamat_lengkap'   => $data['alamat_lengkap'],
                            'motivasi'         => $data['motivasi'],
                            'pas_foto'         => $data['pas_foto'],
                            'surat_permohonan' => $data['surat_permohonan'],
                            'portofolio'       => $data['portofolio'] ?? null,
                            'cv'               => $data['cv'],
                        ]);

                        if ($data['kategori_pelamar'] === 'siswa') {
                            $pelamar->siswa()->create([
                                'nama_sekolah' => $data['nama_sekolah'],
                                'jurusan'      => $data['jurusan'],
                            ]);
                        } else {
                            $pelamar->mahasiswa()->create([
                                'nama_universitas' => $data['nama_universitas'],
                                'fakultas'         => $data['fakultas'],
                                'jurusan'          => $data['jurusan'],
                                'semester'         => $data['semester'],
                            ]);
                        }

                        Notification::make()
                            ->title('Lamaran berhasil dikirim!')
                            ->success()
                            ->send();
                    }),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('posisi_id')
                    ->label('Filter Posisi')
                    ->relationship('posisi', 'nama_posisi'),

                Tables\Filters\SelectFilter::make('lokasi_id')
                    ->label('Filter Lokasi')
                    ->relationship('lokasi', 'nama_lokasi'),
            ])
            ->defaultSort('deadline_pendaftaran', 'desc')
            ->paginated(false);
    }
}
