<?php

namespace App\Filament\Admin\Pages;

use App\Constants\NavigationGroupConstants;
use App\Models\Order;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;

class MyOrders extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = NavigationGroupConstants::PERSONAL;

    protected static string $view = 'filament.pages.my-orders';

    public function getTableQuery(): Builder
    {
        return Order::query()->where('customer_email', auth()->user()->email);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('status')->badge()
                ->label('Booking status')->sortable(),
            TextColumn::make('reference')->sortable(),
            TextColumn::make('created_at')
                ->label('Ordered on')
                ->date()
                ->sortable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('View')
                ->url(fn (Order $record): string => $record->filament_url)
                ->hidden(fn (Order $record): bool => $record->user()->doesntExist()),
        ];
    }
}
