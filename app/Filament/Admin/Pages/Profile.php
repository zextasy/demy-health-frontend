<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use App\Jobs\ResolvePatientEmailIssueJob;
use App\Jobs\ResolveUnprocessedPaymentsJob;
use App\Jobs\ResolveOrdersWithoutInvoicesJob;
use App\Jobs\ResolveTestBookingsWithoutOrdersJob;
use Filament\Pages\Page as BaseProfile;

class Profile extends BaseProfile
{
    protected static ?string $navigationGroup = null;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('update system')
                ->action(function (): void {
                    ResolveTestBookingsWithoutOrdersJob::dispatch();
                    ResolveOrdersWithoutInvoicesJob::dispatch();
                    ResolvePatientEmailIssueJob::dispatch();
                    ResolveUnprocessedPaymentsJob::dispatch();
                    $this->redirect(Profile::getUrl());
                })->visible(auth()->user()->isFilamentAdmin())
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('General')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Username')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Address')
                        ->disabled(),
                ]),
            Section::make('Update Password')
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label('Current Password')
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }
}
