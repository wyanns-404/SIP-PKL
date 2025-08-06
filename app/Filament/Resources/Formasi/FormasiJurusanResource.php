<?php

namespace App\Filament\Resources\Formasi;

use App\Filament\Resources\Formasi\FormasiJurusanResource\Pages;
use App\Filament\Resources\Formasi\FormasiJurusanResource\RelationManagers;
use App\Models\Formasi\FormasiJurusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormasiJurusanResource extends Resource
{
    protected static ?string $model = FormasiJurusan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Data PKL';

    protected static ?string $label = 'Kualifikasi Jurusan';

    protected static ?string $slug = 'formasi/kualifikasi-jurusan';

    protected static ?string $breadcrumb = 'Kualifikasi Jurusan';

    protected static ?string $pluralLabel = 'Kualifikasi Jurusan';

    protected static ?string $navigationParentItem = 'Formasi PKL';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_jurusan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_jurusan')
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
            'index' => Pages\ListFormasiJurusans::route('/'),
            // 'create' => Pages\CreateFormasiJurusan::route('/create'),
            // 'edit' => Pages\EditFormasiJurusan::route('/{record}/edit'),
        ];
    }
}
