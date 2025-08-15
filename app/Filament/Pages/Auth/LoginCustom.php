<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Validation\ValidationException;

class LoginCustom extends BaseLogin
{
    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.identitas' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        // $this->getEmailFormComponent(),
                        $this->getIdentitasFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getIdentitasFormComponent(): Component
    {
        return TextInput::make('identitas')
            ->label('Email atau NIM / NPM / NIS')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }
    
    protected function getCredentialsFromFormData(array $data): array
    {
        $identitas_type = filter_var($data['identitas'], FILTER_VALIDATE_EMAIL) ? 'email' : 'npm_nim_nis';
        return [
            $identitas_type => $data['identitas'],
            'password' => $data['password'],
        ];
    }
}
