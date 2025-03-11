<?php

namespace App\Filament\Admin\Resources\VaccineResource\Pages;

use App\Filament\Admin\Resources\VaccineResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVaccine extends CreateRecord
{
    protected static string $resource = VaccineResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
