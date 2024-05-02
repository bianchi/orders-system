<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\User;
use App\Policies\PermissionPolicy;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('allows view any', function () {
    $this->assertFalse((new PermissionPolicy)->viewAny($this->user));
});

it('allows view', function () {
    $permissionToView = User::factory()->create();
    $this->assertFalse((new PermissionPolicy)->view($this->user, $permissionToView));
});

it('allows create', function () {
    $this->assertFalse((new PermissionPolicy)->create($this->user));
});

it('allows update', function () {
    $permissionToUpdate = User::factory()->create();
    $this->assertFalse((new PermissionPolicy)->update($this->user, $permissionToUpdate));
});

it('allows delete', function () {
    $permissionToDelete = User::factory()->create();
    $this->assertFalse((new PermissionPolicy)->delete($this->user, $permissionToDelete));
});

it('disallows force delete', function () {
    $permissionToDelete = User::factory()->create();
    $this->assertFalse((new PermissionPolicy)->forceDelete($this->user, $permissionToDelete));
});

it('disallows restore', function () {
    $permissionToRestore = User::factory()->create();
    $this->assertFalse((new PermissionPolicy)->restore($this->user, $permissionToRestore));
});
