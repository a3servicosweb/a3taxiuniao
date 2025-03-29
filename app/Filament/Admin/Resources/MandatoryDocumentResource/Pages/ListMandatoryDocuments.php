<?php

namespace App\Filament\Admin\Resources\MandatoryDocumentResource\Pages;

use App\Filament\Admin\Resources\MandatoryDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMandatoryDocuments extends ListRecords
{
    protected static string $resource = MandatoryDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
