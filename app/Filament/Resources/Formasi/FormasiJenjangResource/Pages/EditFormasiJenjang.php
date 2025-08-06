<?php

namespace App\Filament\Resources\Formasi\FormasiJenjangResource\Pages;

use App\Filament\Resources\Formasi\FormasiJenjangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormasiJenjang extends EditRecord
{
    protected static string $resource = FormasiJenjangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
