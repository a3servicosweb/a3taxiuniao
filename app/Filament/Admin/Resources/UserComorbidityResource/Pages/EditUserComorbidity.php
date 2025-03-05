<?php

namespace App\Filament\Admin\Resources\UserComorbidityResource\Pages;

use App\Filament\Admin\Resources\UserComorbidityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserComorbidity extends EditRecord
{
    protected static string $resource = UserComorbidityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
