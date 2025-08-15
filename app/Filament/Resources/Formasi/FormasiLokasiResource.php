<?php

namespace App\Filament\Resources\Formasi;

use App\Filament\Resources\Formasi\FormasiLokasiResource\Pages;
use App\Filament\Resources\Formasi\FormasiLokasiResource\RelationManagers;
use App\Models\Formasi\FormasiLokasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormasiLokasiResource extends Resource
{
    protected static ?string $model = FormasiLokasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Lokasi Penempatan';

    protected static ?string $slug = 'formasi/lokasi-penempatan';

    protected static ?string $breadcrumb = 'Lokasi Penempatan';

    protected static ?string $pluralLabel = 'Lokasi Penempatan';

    protected static ?string $navigationParentItem = 'Formasi PKL';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lokasi')
                    ->label('Nama Lokasi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lokasi')
                    ->label('Nama Lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFormasiLokasis::route('/'),
        ];
    }
}
