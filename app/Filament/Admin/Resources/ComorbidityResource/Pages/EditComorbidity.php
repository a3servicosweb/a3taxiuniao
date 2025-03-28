<?php

namespace App\Filament\Admin\Resources\UserComorbidityResource\Pages;

use App\Filament\Admin\Resources\ComorbidityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComorbidity extends EditRecord
{
    protected static string $resource = ComorbidityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
//            Actions\DeleteAction::make(),
        ];
    }
}
