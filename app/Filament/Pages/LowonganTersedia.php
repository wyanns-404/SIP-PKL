<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Pages\Page;
use App\Models\Formasi\FormasiPkl;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\Action;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Support\Enums\MaxWidth;

class LowonganTersedia extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.lowongan-tersedia';

    protected static ?string $title = '';

    protected static ?string $navigationLabel = 'Lowongan';

    protected static ?string $navigationGroup = 'Mahasiswa/Siswa';

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
                Action::make('detail')
                    ->label('Detail')
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
                                                        ->color('primary'),
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
