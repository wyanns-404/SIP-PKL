<?php

namespace App\Filament\Resources\Formasi\FormasiJurusanResource\Pages;

use App\Filament\Resources\Formasi\FormasiJurusanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormasiJurusan extends EditRecord
{
    protected static string $resource = FormasiJurusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
