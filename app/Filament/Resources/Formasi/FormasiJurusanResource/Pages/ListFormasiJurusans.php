<?php

namespace App\Filament\Resources\Formasi\FormasiJurusanResource\Pages;

use App\Filament\Resources\Formasi\FormasiJurusanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormasiJurusans extends ListRecords
{
    protected static string $resource = FormasiJurusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
