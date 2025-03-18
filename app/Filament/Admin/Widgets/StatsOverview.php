<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

//    protected ?string $heading = 'Analytics';
//
//    protected ?string $description = 'An overview of some analytics.';
    protected function getStats(): array
    {
        // Get active interns count
        $usersCount = User::count();

        return [
            Stat::make('Pessoas Cadastradas', $usersCount)
                ->descriptionIcon('heroicon-m-users')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, $usersCount])
                ->icon('heroicon-m-user-circle')
                ->extraAttributes([
                    'class' => 'border-2 border-gray-200 rounded-xl', // Aumenta a espessura da borda
                ]),


            Stat::make('Taxistas Ativos', $usersCount)
                ->descriptionIcon('heroicon-m-users')
                ->color('warning')
                ->chart([2, 3, 3, 4, 3, $usersCount])
                ->icon('heroicon-m-academic-cap')
                ->extraAttributes([
                    'class' => 'border-2 border-gray-200 rounded-xl', // Aumenta a espessura da borda
                ]),
        ];
    }
}
