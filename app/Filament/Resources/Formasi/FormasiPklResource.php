<?php

namespace App\Filament\Resources\Formasi;

use App\Filament\Resources\Formasi\FormasiPklResource\Pages;
use App\Filament\Resources\Formasi\FormasiPklResource\RelationManagers;
use App\Models\Formasi\FormasiPkl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Carbon\Carbon;

class FormasiPklResource extends Resource
{
    protected static ?string $model = FormasiPkl::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Data PKL';

    protected static ?string $label = 'Formasi PKL';

    protected static ?string $slug = 'formasi-pkl';

    protected static ?string $breadcrumb = 'Formasi PKL';

    protected static ?string $pluralLabel = 'Formasi PKL';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Split::make([
                    // Kiri: Informasi Formasi & Persyaratan
                    Forms\Components\Group::make([
                        Forms\Components\Section::make('Informasi Formasi')
                            ->schema([
                                Forms\Components\TextInput::make('nama_formasi')
                                    ->label('Nama Formasi')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull()
                                    ->autofocus(),
                                Forms\Components\Select::make('posisi_id')
                                    ->label('Posisi')
                                    ->relationship('posisi', 'nama_posisi')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Select::make('lokasi_id')
                                    ->label('Lokasi Penempatan')
                                    ->relationship('lokasi', 'nama_lokasi')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi')
                                    ->rows(2)
                                    ->nullable()
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Forms\Components\Section::make('Persyaratan')
                            ->schema([
                                Forms\Components\Select::make('jenjang')
                                    ->label('Jenjang Pendidikan')
                                    ->multiple()
                                    ->relationship('jenjang', 'nama_jenjang')
                                    ->placeholder('Pilih jenjang')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Select::make('jurusan')
                                    ->label('Jurusan')
                                    ->multiple()
                                    ->relationship('jurusan', 'nama_jurusan')
                                    ->placeholder('Pilih jurusan')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                            ])->columns(2),
                    ]),
                    // Kanan: Detail Jadwal & Kuota
                    Forms\Components\Section::make('Detail Jadwal & Kuota')
                        ->schema([
                            Forms\Components\DatePicker::make('tanggal_mulai')
                                ->label('Mulai PKL')
                                ->displayFormat('d/m/Y')
                                ->native(false)
                                ->placeholder(now()->startOfMonth())
                                ->defaultFocusedDate(now()->startOfMonth())
                                ->closeOnDateSelection()
                                ->required(),
                            Forms\Components\DatePicker::make('tanggal_selesai')
                                ->label('Selesai PKL')
                                ->displayFormat('d/m/Y')
                                ->native(false)
                                ->placeholder(now()->startOfMonth())
                                ->defaultFocusedDate(now()->startOfMonth())
                                ->closeOnDateSelection()
                                ->required(),
                            Forms\Components\DatePicker::make('deadline_pendaftaran')
                                ->label('Deadline Pendaftaran')
                                ->displayFormat('d/m/Y')
                                ->native(false)
                                ->placeholder(now()->startOfMonth())
                                ->defaultFocusedDate(now()->startOfMonth())
                                ->closeOnDateSelection()
                                ->required(),
                            Forms\Components\DatePicker::make('tanggal_pengumuman')
                                ->label('Tanggal Pengumuman')
                                ->displayFormat('d/m/Y')
                                ->native(false)
                                ->placeholder(now()->startOfMonth())
                                ->defaultFocusedDate(now()->startOfMonth())
                                ->closeOnDateSelection()
                                ->required(),
                            Forms\Components\TextInput::make('kuota_penerimaan')
                                ->label('Kuota Penerimaan')
                                ->numeric()
                                ->default(0),
                        ])->grow(false),
                ])->from('md')->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_formasi')
                    ->label('Formasi')
                    ->description(fn ($record): ?string => \Illuminate\Support\Str::limit($record->deskripsi, 30))
                    ->tooltip(fn ($record): ?string => $record->deskripsi)
                    ->sortable()
                    ->searchable()
                    ->wrap()
                    ->limit(30),

                Tables\Columns\TextColumn::make('posisi.nama_posisi')
                    ->label('Posisi & Penempatan')
                    ->description(fn ($record): ?string => $record->lokasi?->nama_lokasi),
                
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
                    }),
                
                Tables\Columns\TextColumn::make('tanggal_pengumuman')
                    ->label('Tanggal Pengumuman')
                    ->date('d M Y')
                    ->badge()
                    ->color('info')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TagsColumn::make('jenjang')
                    ->label('Jenjang')
                    ->getStateUsing(fn ($record) => $record->jenjang->pluck('nama_jenjang')->toArray())
                    ->colors(['info'])
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TagsColumn::make('jurusan')
                    ->label('Jurusan')
                    ->getStateUsing(fn ($record) => $record->jurusan->pluck('nama_jurusan')->toArray())
                    ->colors(['primary'])
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('kuota_penerimaan')
                    ->label('Kuota')
                    ->badge()
                    ->color('info'),
                
                // Tables\Columns\TextColumn::make('status')
                //     ->label('Status')
                //     ->badge()
                //     ->getStateUsing(function ($record) {
                //         $now = Carbon::now();
                //         if ($now->lt(Carbon::parse($record->deadline_pendaftaran))) {
                //             return 'Active';
                //         } elseif ($now->between(Carbon::parse($record->tanggal_mulai), Carbon::parse($record->tanggal_selesai))) {
                //             return 'On Progress';
                //         }
                //         return 'Archive';
                //     })
                //     ->colors([
                //         'success' => 'Active',
                //         'warning' => 'On Progress',
                //         'danger' => 'Archive',
                //     ]),
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
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-o-bars-3'),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormasiPkls::route('/'),
            'create' => Pages\CreateFormasiPkl::route('/create'),
            'view' => Pages\ViewFormasiPkl::route('/{record}'),
            'edit' => Pages\EditFormasiPkl::route('/{record}/edit'),
        ];
    }
}
