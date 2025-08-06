<?php

namespace App\Filament\Resources\Formasi;

use App\Filament\Resources\Formasi\FormasiPosisiResource\Pages;
use App\Filament\Resources\Formasi\FormasiPosisiResource\RelationManagers;
use App\Models\Formasi\FormasiPosisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormasiPosisiResource extends Resource
{
    protected static ?string $model = FormasiPosisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Data PKL';

    protected static ?string $label = 'Posisi Penempatan';

    protected static ?string $slug = 'formasi/posisi-penempatan';

    protected static ?string $breadcrumb = 'Posisi Penempatan';

    protected static ?string $pluralLabel = 'Posisi Penempatan';

    protected static ?string $navigationParentItem = 'Formasi PKL';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_posisi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_posisi')
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
            'index' => Pages\ListFormasiPosisis::route('/'),
            // 'create' => Pages\CreateFormasiPosisi::route('/create'),
            // 'edit' => Pages\EditFormasiPosisi::route('/{record}/edit'),
        ];
    }
}
