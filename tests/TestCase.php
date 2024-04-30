<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected User $user;

    protected ?Tenant $tenant = null;

    //    protected bool $useTenant = false;

    protected function setUp(): void
    {
        parent::setUp();

        //        if ($this->useTenant && $this->tenant === null) {
        //            $this->initializeTenancy();
        //        }

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    //    public function initializeTenancy(): void
    //    {
    //        $this->tenant = Tenant::first();
    //        if ($this->tenant === null) {
    //            $this->tenant = Tenant::create(['id' => 'test']);
    //            $this->tenant->domains()->create(['domain' => $this->tenant->id . '.localhost']);
    //        }
    //
    //        tenancy()->initialize($this->tenant);
    //
    //        $this->app['config']->set('session.domain', $this->tenant->id . '.localhost');
    //        $this->app['url']->forceRootUrl('http://' . $this->tenant->id . '.localhost');
    //    }
}
