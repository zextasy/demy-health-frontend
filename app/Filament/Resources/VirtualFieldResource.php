<?php

namespace App\Filament\Resources;

use Closure;
use Illuminate\Support\Str;
use App\Enums\FieldTypeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\VirtualFieldResource\Pages;
use App\Filament\Resources\VirtualFieldResource\RelationManagers;
use App\Models\VirtualField;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class VirtualFieldResource extends Resource
{
    protected static ?string $model = VirtualField::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'label';

    protected static function shouldRegisterNavigation(): bool
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
                        ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
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
                            ->options(FieldTypeEnum::optionsAsSelectArray())
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
                Tables\Columns\BadgeColumn::make('field_type')->label('Field Type')
                ->enum(FieldTypeEnum::optionsAsSelectArray()),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
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
