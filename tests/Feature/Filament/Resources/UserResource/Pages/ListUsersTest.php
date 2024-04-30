<?php

declare(strict_types=1);

namespace Tests\Feature\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;

use function Pest\Livewire\livewire;

it('can render page', function () {
    $this->get(UserResource::getUrl('index'));
    $this->get(UserResource::getUrl('index'))->assertSuccessful();
});

it('can list records', function () {
    $users = User::factory()->count(9)->create();
    $users->add($this->user);

    livewire(UserResource\Pages\ListUsers::class)
        ->assertCanSeeTableRecords($users)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('email');
});
