<?php

namespace App\Filament\Actions\Pages;

use Filament\Facades\Filament;
use Filament\Pages\Actions\Action;

class BasePageAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-play')
            ->successNotificationMessage('Success!')
            ->failureNotificationMessage('Something went wrong...')
            ->successRedirectUrl(request()->header('Referer'));
    }
}
