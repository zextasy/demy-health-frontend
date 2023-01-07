<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResultTemplateResource\Pages;
use App\Filament\Resources\TestResultTemplateResource\RelationManagers;
use App\Models\TestResultTemplate;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResultTemplateResource extends Resource
{
    protected static ?string $model = TestResultTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Tests';

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
                Forms\Components\TextInput::make('name')
                    ->required()->unique()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VirtualFieldsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestResultTemplates::route('/'),
            'create' => Pages\CreateTestResultTemplate::route('/create'),
            'view' => Pages\ViewTestResultTemplate::route('/{record}'),
            'edit' => Pages\EditTestResultTemplate::route('/{record}/edit'),
        ];
    }
}
