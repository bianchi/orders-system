<?php

declare(strict_types=1);

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\EditRecord;
use App\Filament\Resources\UserResource;

// todo add tests (remember to test if deletes halt)
// @see https://filamentphp.com/docs/3.x/forms/testing
class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
}
