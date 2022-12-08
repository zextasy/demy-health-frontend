<?php

namespace App\Filament\Pages;

use Illuminate\Support\Carbon;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\ComponentContainer;
use App\Actions\Tasks\AssignTaskAction;
use Filament\Forms\Components\TextInput;
use App\Jobs\ResolvePatientEmailIssueJob;
use App\Jobs\ResolveOrdersWithoutInvoicesJob;
use App\Jobs\ResolveTestBookingsWithoutOrdersJob;
use RyanChandler\FilamentProfile\Pages\Profile as BaseProfile;

class Profile extends BaseProfile
{
    protected static ?string $navigationGroup = null;

    protected function getActions(): array
    {
        return [
            Action::make('update system')
                ->action(function (): void {
                    ResolveTestBookingsWithoutOrdersJob::dispatch();
                    ResolveOrdersWithoutInvoicesJob::dispatch();
                    ResolvePatientEmailIssueJob::dispatch();
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
