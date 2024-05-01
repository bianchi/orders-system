<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Tables\Columns\Column;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Column::configureUsing(static function (Column $column): void {
            $column->toggleable()
                ->translateLabel();
        });
    }
}
