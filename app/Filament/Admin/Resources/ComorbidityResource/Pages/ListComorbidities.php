<?php

namespace App\Filament\Admin\Resources\UserComorbidityResource\Pages;

use App\Filament\Admin\Resources\ComorbidityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComorbidities extends ListRecords
{
    protected static string $resource = ComorbidityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
