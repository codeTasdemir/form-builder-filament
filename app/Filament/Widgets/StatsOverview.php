<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Form;
use App\Models\FormSubmission;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Toplam Form', Form::count()),
            Stat::make('Aktif Form', Form::where('is_active', true)->count()),
            Stat::make('Toplam Gönderi', FormSubmission::count()),
        ];
    }
}
