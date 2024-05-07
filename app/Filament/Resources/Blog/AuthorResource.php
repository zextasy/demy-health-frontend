<?php

namespace App\Filament\Resources\Blog;

use Filament\Forms;
use App\Models\Blog\Author;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use App\Traits\Blog\HasContentEditor;
use App\Filament\Resources\Blog\AuthorResource\Pages;

class AuthorResource extends Resource
{
    use HasContentEditor;

    protected static ?string $model = Author::class;

    protected static ?string $slug = 'blog/authors';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentBackendUser(), 403);
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('blog.name'))
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label(__('blog.email'))
                            ->required()
                            ->email()
                            ->unique(Author::class, 'email', fn ($record) => $record),
                        Forms\Components\FileUpload::make('photo')
                            ->label(__('blog.photo'))
                            ->image()
                            ->maxSize(5120)
                            ->directory('blog')
                            ->disk('public')
                            ->columnSpan([
                                'sm' => 2,
                            ]),
                        self::getContentEditor('bio'),
                        Forms\Components\TextInput::make('github_handle')
                            ->label(__('blog.github')),
                        Forms\Components\TextInput::make('twitter_handle')
                            ->label(__('blog.twitter')),
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan(2),
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label(__('blog.created_at'))
                            ->content(fn (
                                ?Author $record
                            ): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label(__('blog.last_modified_at'))
                            ->content(fn (
                                ?Author $record
                            ): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label(__('blog.photo'))
                    ->rounded(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('blog.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('blog.email'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('github_handle')
                    ->label(__('blog.github')),
                Tables\Columns\TextColumn::make('twitter_handle')
                    ->label(__('blog.twitter')),
            ])
            ->filters([
                //
            ]);
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }

    public static function getPluralModelLabel(): string
    {
        return __('blog.authors');
    }

    public static function getModelLabel(): string
    {
        return __('blog.author');
    }
}
