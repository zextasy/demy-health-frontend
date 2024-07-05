<?php

namespace App\Filament\Admin\Pages;

use App\Constants\NavigationGroupConstants;
use Filament\Pages\Page;
use App\Models\TestResult;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;

class MyTestResults extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = NavigationGroupConstants::PERSONAL;

    protected static string $view = 'filament.pages.my-test-results';

    public function getTableQuery(): Builder
    {
        return TestResult::query()->where('customer_email', auth()->user()->email);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('status')->badge()
                ->label('Result status')->sortable(),
            TextColumn::make('reference')->sortable(),
            TextColumn::make('created_at')
                ->label('Date')
                ->date()
                ->sortable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('View')
                ->url(fn (TestResult $record): string => $record->filament_url)
                ->hidden(fn (TestResult $record): bool => $record->user()->doesntExist()),
        ];
    }
}
