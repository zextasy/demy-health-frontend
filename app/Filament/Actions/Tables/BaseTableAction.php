<?php

namespace App\Filament\Actions\Tables;

use Filament\Tables\Actions\Action;

class BaseTableAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-play')
            ->successNotificationMessage('Success!')
            ->failureNotificationMessage('Something went wrong...');
    }
}
