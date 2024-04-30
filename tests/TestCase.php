<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Tenant;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected ?Tenant $tenant = null;

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->tenant === null) {
            $this->initializeTenancy();
        }
    }

    public function initializeTenancy(): void
    {
        $this->tenant = Tenant::first();
        if ($this->tenant === null) {
            $this->tenant = Tenant::create(['id' => 'tenant-test']);
            $this->tenant->domains()->create(['domain' => $this->tenant->id . '.localhost']);
        }

        tenancy()->initialize($this->tenant);
        $this->actingAs(User::factory()->create());

        $this->app['config']->set('session.domain', $this->tenant->id . '.localhost');
        $this->app['url']->forceRootUrl('http://' . $this->tenant->id . '.localhost');
        //        Filament::setTenant($this->tenant);
    }
}
