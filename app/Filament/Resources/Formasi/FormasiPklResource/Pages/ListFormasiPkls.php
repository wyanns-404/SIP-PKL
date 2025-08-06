<?php

namespace App\Filament\Resources\Formasi\FormasiPklResource\Pages;

use App\Filament\Resources\Formasi\FormasiPklResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class ListFormasiPkls extends ListRecords
{
    protected static string $resource = FormasiPklResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $now = Carbon::now();

        return [
            'All' => Tab::make(),

            'Active' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereDate('deadline_pendaftaran', '>', $now)
                ),

            'On Progress' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereDate('tanggal_mulai', '<=', $now)
                        ->whereDate('tanggal_selesai', '>=', $now)
                ),

            'Archive' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) =>
                    $query->whereDate('tanggal_selesai', '<', $now)
                ),
        ];
    }
}
