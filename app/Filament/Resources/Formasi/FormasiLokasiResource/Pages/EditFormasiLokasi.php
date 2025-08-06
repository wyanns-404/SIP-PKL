<?php

namespace App\Filament\Resources\Formasi\FormasiLokasiResource\Pages;

use App\Filament\Resources\Formasi\FormasiLokasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormasiLokasi extends EditRecord
{
    protected static string $resource = FormasiLokasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
