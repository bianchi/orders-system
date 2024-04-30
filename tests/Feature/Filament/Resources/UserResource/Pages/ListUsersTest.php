<?php

declare(strict_types=1);

namespace Tests\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;

it('can render page', function () {
    //    $this->withoutExceptionHandling();
    $this->get(UserResource::getUrl('index'));
    $this->get(UserResource::getUrl('index'))->assertSuccessful();
});
