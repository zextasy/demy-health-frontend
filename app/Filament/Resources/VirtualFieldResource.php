<?php

namespace App\Filament\Resources;

use App\Enums\FieldTypeEnum;
use Filament\Forms\Components\Select;
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
                    TextInput::make('name')
                        ->required()->unique()
                        ->helperText('This is the internal name. It should be all lowercase with underscores instead of spaces')
                        ->maxLength(255),
                        TextInput::make('label')
                            ->required()->unique()
                            ->helperText('This is how the field will be displayed to users')
                            ->maxLength(255),
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
                Tables\Actions\DeleteBulkAction::make(),
            ])->defaultSort('id', 'desc');
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
