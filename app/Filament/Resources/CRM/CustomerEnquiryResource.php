<?php

namespace App\Filament\Resources\CRM;

use App\Enums\CRM\CustomerEnquiries\EnquiryTypeEnum;
use App\Filament\Resources\CRM\CustomerEnquiryResource\Pages;
use App\Filament\Resources\CRM\CustomerEnquiryResource\RelationManagers;
use App\Models\CRM\CustomerEnquiry;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CustomerEnquiryResource extends Resource
{
    protected static ?string $model = CustomerEnquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'customer_message';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Customer Details')->schema([
                    Forms\Components\TextInput::make('customer_name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('customer_email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('customer_phone')
                        ->required()
                        ->maxLength(255),
                ])->columns(3),
                Forms\Components\Fieldset::make('Message Details')->schema([
                    Forms\Components\Textarea::make('customer_message')
                        ->required()
                        ->maxLength(255),
                ])->columns(1),
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\Select::make('type')
                        ->options(EnquiryTypeEnum::optionsAsSelectArray())
                        ->disabled(),
                    Forms\Components\TextInput::make('status')->disabled(),
                ])->columns(2),
                Forms\Components\Fieldset::make('Resolution Details')->schema([
                    Forms\Components\Textarea::make('resolution_notes')
                        ->required()
                        ->maxLength(255),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer_email')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('status')->sortable(),
                Tables\Columns\BadgeColumn::make('type')
                    ->enum(EnquiryTypeEnum::optionsAsSelectArray())->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerEnquiries::route('/'),
            'create' => Pages\CreateCustomerEnquiry::route('/create'),
            'view' => Pages\ViewCustomerEnquiry::route('/{record}'),
            //            'edit' => Pages\EditCustomerEnquiry::route('/{record}/edit'),
        ];
    }
}
