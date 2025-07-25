<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;

class RegisterCustom extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getNimNpmNisFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getNimNpmNisFormComponent(): Component
    {
        return TextInput::make('npm_nim_nis')
            ->label('NIM / NPM / NIS')
            ->required()
            ->maxLength(20)
            ->rules([
                'regex:/^[0-9]+$/',  // hanya angka
                'min:8',             // minimal 8 karakter
            ])
            ->unique(
                $this->getUserModel(), // model user
                'npm_nim_nis'          // kolom database
            )
            ->validationMessages([
                'required' => 'Kolom NIM / NPM / NIS wajib diisi.',
                'regex'    => 'Kolom ini hanya boleh berisi angka.',
                'min'      => 'Kolom ini harus terdiri dari minimal :min digit.',
                'unique'   => 'NIM / NPM / NIS ini sudah terdaftar.',
            ]);
    }
}
