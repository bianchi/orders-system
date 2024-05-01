<?php

declare(strict_types=1);

namespace Tests\Feature\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;

use function Pest\Livewire\livewire;

beforeEach(function () {
    $this->users = User::factory()->count(7)->create();
    $this->users->add($this->user);
    $this->users->add(User::factory()->create(['name' => 'John White', 'email' => 'john.white@example.com']));
    $this->users->add(User::factory()->create(['name' => 'John Doe', 'email' => 'john.doe@example.com']));
});

it('can render page', function () {
    $this->get(UserResource::getUrl('index'));
    $this->get(UserResource::getUrl('index'))->assertSuccessful();
});

it('can list users', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->assertCanSeeTableRecords($this->users)
        ->assertCanRenderTableColumn('name')
        ->assertCanRenderTableColumn('email')
        ->assertTableColumnExists('email_verified_at')
        ->assertCanNotRenderTableColumn('email_verified_at')
        ->assertTableColumnExists('created_at')
        ->assertCanNotRenderTableColumn('created_at')
        ->assertTableColumnExists('updated_at')
        ->assertCanNotRenderTableColumn('updated_at');
});

it('can sort users by name', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->sortTable('name')
        ->assertCanSeeTableRecords($this->users->sortBy('name'), inOrder: true)
        ->sortTable('name', 'desc')
        ->assertCanSeeTableRecords($this->users->sortByDesc('name'), inOrder: true);
});

it('can sort users by email', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->sortTable('email')
        ->assertCanSeeTableRecords($this->users->sortBy('email'), inOrder: true)
        ->sortTable('email', 'desc')
        ->assertCanSeeTableRecords($this->users->sortByDesc('email'), inOrder: true);
});

it('can sort users by email_verified_at', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->sortTable('email_verified_at')
        ->assertCanSeeTableRecords($this->users->sortBy('email_verified_at'), inOrder: true)
        ->sortTable('email_verified_at', 'desc')
        ->assertCanSeeTableRecords($this->users->sortByDesc('email_verified_at'), inOrder: true);
});

it('can sort users by created_at', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->sortTable('created_at')
        ->assertCanSeeTableRecords($this->users->sortBy('created_at'), inOrder: true)
        ->sortTable('created_at', 'desc')
        ->assertCanSeeTableRecords($this->users->sortByDesc('created_at'), inOrder: true);
});

it('can sort users by updated_at', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->sortTable('updated_at')
        ->assertCanSeeTableRecords($this->users->sortBy('updated_at'), inOrder: true)
        ->sortTable('updated_at', 'desc')
        ->assertCanSeeTableRecords($this->users->sortByDesc('updated_at'), inOrder: true);
});

it('can search users by exact name', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->searchTable('John Doe')
        ->assertCanSeeTableRecords($this->users->where('name', 'John Doe'))
        ->assertCanNotSeeTableRecords($this->users->where('name', '!=', 'John Doe'));
});

it('can search users by partial name', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->searchTable('John')
        ->assertCanSeeTableRecords($this->users->filter(fn ($user) => str_contains($user->name, 'John')))
        ->assertCanNotSeeTableRecords($this->users->filter(fn ($user) => ! str_contains($user->name, 'John')));
});

it('can search users by exact email', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->searchTable('john.doe@example.com')
        ->assertCanSeeTableRecords($this->users->where('email', 'john.doe@example.com'))
        ->assertCanNotSeeTableRecords($this->users->where('email', '!=', 'john.doe@example.com'));
});

it('can search users by partial email', function () {
    livewire(UserResource\Pages\ListUsers::class)
        ->searchTable('john@')
        ->assertCanSeeTableRecords($this->users->filter(fn ($user) => str_contains($user->email, 'john@')))
        ->assertCanNotSeeTableRecords($this->users->filter(fn ($user) => ! str_contains($user->email, 'john@')));
});
