<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\CreateRecord;
use App\Filament\Resources\UserResource;

// todo add tests
// @see https://filamentphp.com/docs/3.x/forms/testing
class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
