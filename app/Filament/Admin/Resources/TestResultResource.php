<?php

namespace App\Filament\Admin\Resources;

use App\Constants\NavigationGroupConstants;
use App\Helpers\HelpTextMessageHelper;
use App\Filament\Admin\Resources\TestResultResource\Pages;
use App\Models\TestResult;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;


class TestResultResource extends Resource
{
    protected static ?string $model = TestResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $recordTitleAttribute = 'reference';

    protected static ?string $navigationGroup = NavigationGroupConstants::TESTS;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->hasPermissionTo('backend'), 403);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('reference')
                        ->maxLength(255)
                        ->helperText(HelpTextMessageHelper::DEFAULT_REFERENCE_SUFFIX),
                ])->columns(1),
                Forms\Components\Fieldset::make('Result File')->schema([
                    SpatieMediaLibraryFileUpload::make('result')
                        ->multiple()
                        ->collection('result')
                        ->enableReordering()->enableOpen()
                        ->helperText('Please click the square icon with an arrow to view the result'),
                ])->columns(1),
                Forms\Components\Fieldset::make('Customer Details')->schema([
                    Forms\Components\TextInput::make('customer_email')
                        ->email()
                        ->maxLength(255)
                        ->helperText('Leave this blank and the system will use the customer email from the booking'),
                    Forms\Components\TextInput::make('user.name')
                        ->label('User')
                        ->placeholder('')
                        ->disabled()->dehydrated(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer_email')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Uploaded On')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([

            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestResults::route('/'),
            //            'create' => Pages\CreateTestResult::route('/create'),
            'view' => Pages\ViewTestResult::route('/{record}'),
            //            'edit' => Pages\EditTestResult::route('/{record}/edit'),
        ];
    }
}
