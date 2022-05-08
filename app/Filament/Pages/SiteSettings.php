<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;

class SiteSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = GeneralSettings::class;

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Name')->schema([
                TextInput::make('site_name')->label('Site Name')->required()->disabled(),
            ])->columns(1),
            Fieldset::make('Prefixes')->schema([
                TextInput::make('default_prefix')
                    ->label('Default Prefix')
                    ->helperText('This text will be prefixed to auto-generated documents and files')
                    ->required(),
                TextInput::make('test_booking_prefix')
                    ->label('Test Booking Prefix')
                    ->helperText('This text will be prefixed to auto-generated test Bookings')
                    ->required(),
                TextInput::make('specimen_sample_prefix')
                    ->label('Specimen Sample Prefix')
                    ->helperText('This text will be prefixed to auto-generated samples')
                    ->required(),
            ])->columns(3),
        ];
    }
}
