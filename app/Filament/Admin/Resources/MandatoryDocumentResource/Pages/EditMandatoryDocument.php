<?php

namespace App\Filament\Admin\Resources\MandatoryDocumentResource\Pages;

use App\Filament\Admin\Resources\MandatoryDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMandatoryDocument extends EditRecord
{
    protected static string $resource = MandatoryDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
