<?php

namespace App\Filament\Resources\Formasi\FormasiPklResource\Pages;

use App\Filament\Resources\Formasi\FormasiPklResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormasiPkl extends EditRecord
{
    protected static string $resource = FormasiPklResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
