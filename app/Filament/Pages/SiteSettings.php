<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;

class SiteSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = GeneralSettings::class;

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentAdmin(), 403);
        parent::mount();
    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Name')->schema([
                TextInput::make('site_name')->label('Site Name'),
            ])->columns(1),
            Fieldset::make('Prefixes')->schema([
                TextInput::make('default_prefix')
                    ->label('Default Prefix')
                    ->helperText('This text will be prefixed to auto-generated documents and files'),
                TextInput::make('test_booking_prefix')
                    ->label('Test Booking Prefix')
                    ->helperText('This text will be prefixed to auto-generated test Bookings'),
                TextInput::make('specimen_sample_prefix')
                    ->label('Specimen Sample Prefix')
                    ->helperText('This text will be prefixed to auto-generated samples'),
                TextInput::make('product_sku_prefix')
                    ->label('Product SKU Prefix')
                    ->helperText('This text will be prefixed to product SKUs'),
            ])->columns(3),
            Fieldset::make('Time')->schema([
                TimePicker::make('business_start_hour')->label('Business Start'),
                TimePicker::make('business_end_hour')->label('Business End'),
            ])->columns(2),
//            Fieldset::make('Time')->schema([
//
//            ])->columns(1),
        ];
    }
}
