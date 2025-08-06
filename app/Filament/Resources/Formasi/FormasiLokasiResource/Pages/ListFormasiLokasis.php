<?php

namespace App\Filament\Resources\Formasi\FormasiLokasiResource\Pages;

use App\Filament\Resources\Formasi\FormasiLokasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormasiLokasis extends ListRecords
{
    protected static string $resource = FormasiLokasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
