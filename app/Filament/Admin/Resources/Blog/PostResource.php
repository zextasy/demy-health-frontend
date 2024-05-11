<?php

namespace App\Filament\Admin\Resources\Blog;

use Filament\Forms;
use App\Models\Blog\Post;
use App\Traits\Blog\HasContentEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Filament\Forms\Components\SpatieTagsInput;
use function now;


use App\Filament\Admin\Resources\Blog\PostResource\Pages;


class PostResource extends Resource
{
    use HasContentEditor;

    protected static ?string $model = Post::class;

    protected static ?string $slug = 'blog/posts';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 0;

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
                        Forms\Components\TextInput::make('title')
                            ->label(__('blog.title'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        Forms\Components\TextInput::make('slug')
                            ->label(__('blog.slug'))
                            ->disabled()
                            ->required()
                            ->unique(Post::class, 'slug', fn ($record) => $record),

                        Forms\Components\Textarea::make('excerpt')
                            ->label(__('blog.excerpt'))
                            ->rows(2)
                            ->minLength(50)
                            ->maxLength(1000)
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        Forms\Components\FileUpload::make('banner')
                            ->label(__('blog.banner'))
                            ->image()
                            ->maxSize(5120)
                            ->imageCropAspectRatio('16:9')
                            ->directory('blog')
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        self::getContentEditor('content'),

                        Forms\Components\Select::make('blog_author_id')
                            ->label(__('blog.author'))
                            ->relationship('author', 'name')
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('blog_category_id')
                            ->label(__('blog.category'))
                            ->relationship('category', 'name')
                            ->searchable()
                            ->required(),

                        Forms\Components\DatePicker::make('published_at')
                            ->label(__('blog.published_date')),
                        SpatieTagsInput::make('tags')
                            ->label(__('blog.tags'))
                            ->required(),
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
                                ?Post $record
                            ): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label(__('blog.last_modified_at'))
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->updated_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('public_url')
                            ->label("Public Url")
                            ->content(fn (
                                ?Post $record
                            ): string => $record ? $record->public_url : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner')
                    ->label(__('blog.banner'))
                    ->rounded(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('blog.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('blog.author_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('blog.category_name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('blog.published_at'))
                    ->date(),
            ])
            ->filters([
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->placeholder(fn ($state): string => 'Dec 18, '.now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('published_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['author', 'category']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'author.name', 'category.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->author) {
            $details['Author'] = $record->author->name;
        }

        if ($record->category) {
            $details['Category'] = $record->category->name;
        }

        return $details;
    }

    public static function getPluralModelLabel(): string
    {
        return __('blog.posts');
    }

    public static function getModelLabel(): string
    {
        return __('blog.post');
    }
}
