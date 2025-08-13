<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Admin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament-panels::pages/auth/register.form.name.label'))
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),
                Forms\Components\TextInput::make('email')
                    ->label(__('filament-panels::pages/auth/register.form.email.label'))
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(User::class, ignoreRecord: true),
                Forms\Components\TextInput::make('npm_nim_nis')
                    ->label('NPM / NIM / NIS')
                    ->required()
                    ->maxLength(20)
                    ->rules([
                        'regex:/^[0-9]+$/',
                        'min:8',    
                    ])
                    ->unique(User::class, ignoreRecord: true)
                    ->validationMessages([
                        'required' => 'Kolom NIM / NPM / NIS wajib diisi.',
                        'regex'    => 'Kolom ini hanya boleh berisi angka.',
                        'min'      => 'Kolom ini harus terdiri dari minimal :min digit.',
                        'unique'   => 'NIM / NPM / NIS ini sudah terdaftar.',
                    ])
                    ->validationAttribute('NIM / NPM / NIS'),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At')
                    ->default(null)
                    ->nullable()
                    ->seconds(false),
                Forms\Components\TextInput::make('password')
                    ->label(fn ($record) => $record ? 'New Password (Opsional)' : __('filament-panels::pages/auth/register.form.password.label'))
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->required(fn ($record) => $record === null)
                    ->rule(Password::default())
                    ->dehydrated(fn ($state) => filled($state))
                    ->same('passwordConfirmation')
                    ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute')),
                Forms\Components\TextInput::make('passwordConfirmation')
                    ->label(__('filament-panels::pages/auth/register.form.password_confirmation.label'))
                    ->password()
                    ->revealable(filament()->arePasswordsRevealable())
                    ->required(fn ($record) => $record === null)
                    ->dehydrated(false),
                    // Tambah manajemen role
                    Forms\Components\MultiSelect::make('roles')
                        ->label('Role')
                        ->helperText('Pilih satu atau lebih role untuk user ini.')
                        ->options(\Spatie\Permission\Models\Role::all()->pluck('name', 'id'))
                        ->relationship('roles', 'name')
                        ->preload()
                        ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('npm_nim_nis')
                    ->label('NPM/NIM/NIS')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('avatar_url')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    // Kolom role
                    Tables\Columns\TextColumn::make('roles.name')
                        ->label('Role')
                        ->badge()
                        ->separator(', ')
                        ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
