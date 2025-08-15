<?php

namespace App\Filament\Widgets;

use Filament\Widgets\AccountWidget as BaseAccountWidget;

class AccountWidget extends BaseAccountWidget
{
    protected static ?int $sort = -3;

    protected static bool $isLazy = false;

    protected static string $view = 'filament-panels::widgets.account-widget';

    public function getColumnSpan(): int|string|array
    {
        return 'full'; // Biar widget ini melebar penuh
    }
}
