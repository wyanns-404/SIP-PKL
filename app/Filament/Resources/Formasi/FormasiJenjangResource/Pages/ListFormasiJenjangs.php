<?php

namespace App\Filament\Resources\Formasi\FormasiJenjangResource\Pages;

use App\Filament\Resources\Formasi\FormasiJenjangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormasiJenjangs extends ListRecords
{
    protected static string $resource = FormasiJenjangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
