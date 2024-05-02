<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\Role;
use App\Policies\PermissionPolicy;
use Filament\Tables\Columns\Column;
use Illuminate\Support\Facades\Gate;
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

        Gate::after(static function ($user, $ability) {
            return $user->hasRole(Role::SuperAdmin);
        });

        Gate::policy(\Spatie\Permission\Models\Permission::class, PermissionPolicy::class);
    }
}
