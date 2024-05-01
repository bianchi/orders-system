<?php

declare(strict_types=1);

namespace App\Filament;

use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;

class EditRecord extends \Filament\Resources\Pages\EditRecord
{
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->before(
                    function ($record, DeleteAction $action) {
                        $accountOwnerId = User::first()->id;
                        if ($record->id === $accountOwnerId) {
                            Notification::make()
                                ->title(__('Error'))
                                ->body(__('The account owner cannot be deleted.'))
                                ->status('danger')
                                ->send();

                            // todo change to cancel if discover how to test cancel
                            $action->halt();
                        }
                    }),
        ];
    }
}
