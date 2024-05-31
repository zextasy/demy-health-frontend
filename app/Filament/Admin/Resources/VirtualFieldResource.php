<?php

namespace App\Filament\Admin\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Enums\FieldTypeEnum;
use App\Models\VirtualField;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use App\Filament\Admin\Resources\VirtualFieldResource\Pages;
use App\Filament\Admin\Resources\VirtualFieldResource\RelationManagers;


class VirtualFieldResource extends Resource
{
    protected static ?string $model = VirtualField::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $recordTitleAttribute = 'label';

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
                Forms\Components\Fieldset::make('Details')->schema([
                    TextInput::make('label')
                        ->afterStateUpdated(function (\Filament\Forms\Get $get, Closure $set, ?string $state) {
                            if (! $get('is_slug_changed_manually') && filled($state)) {
                                $set('name', Str::snake($state));
                            }
                        })
                        ->reactive()
                        ->required()
	                    ->unique('virtual_fields', 'label', fn ($record) => $record)
                        ->helperText('This is how the field will be displayed to users')
                        ->maxLength(255),
                    TextInput::make('name')
                        ->afterStateUpdated(function (Closure $set) {
                            $set('is_slug_changed_manually', true);
                        })
                        ->required()
	                    ->unique('virtual_fields', 'name', fn ($record) => $record)
                        ->helperText(HelpTextMessageHelper::NAME_SLUG_TEXT)
                        ->maxLength(255),
                    Hidden::make('is_slug_changed_manually')
                        ->default(false)
                        ->dehydrated(false),
                        Select::make('field_type')
                            ->options(FieldTypeEnum::class)
                            ->required(),
                        ])->columns(3),
                Repeater::make('options')
                    ->schema([
                        TextInput::make('option'),
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('field_type')->label('Field Type')
                ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListVirtualFields::route('/'),
            'create' => Pages\CreateVirtualField::route('/create'),
            'view' => Pages\ViewVirtualField::route('/{record}'),
            'edit' => Pages\EditVirtualField::route('/{record}/edit'),
        ];
    }
}
