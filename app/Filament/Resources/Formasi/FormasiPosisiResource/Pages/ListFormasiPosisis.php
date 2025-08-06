<?php

namespace App\Filament\Resources\Formasi\FormasiPosisiResource\Pages;

use App\Filament\Resources\Formasi\FormasiPosisiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormasiPosisis extends ListRecords
{
    protected static string $resource = FormasiPosisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
