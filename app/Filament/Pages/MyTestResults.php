<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\TestBooking;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;

class MyTestResults extends Page  implements HasTable
{
    use InteractsWithTable;

    public function getTableQuery(): Builder
    {
        return TestBooking::query()->where('customer_email', auth()->user()->email);
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Personal';

    protected static string $view = 'filament.pages.my-test-results';

}
