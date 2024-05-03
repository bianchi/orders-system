<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    public const string CREATE_USER = 'Create users';
    public const string VIEW_USER = 'View users';
    public const string EDIT_USER = 'Edit users';
    public const string DELETE_USER = 'Delete users';
    public const string CRATE_ROLE = 'Create roles';
    public const string VIEW_ROLE = 'View roles';
    public const string EDIT_ROLE = 'Edit roles';
    public const string DELETE_ROLE = 'Delete roles';
}
