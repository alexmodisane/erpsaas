<?php

namespace App\Filament\Company\Resources\ItemsResource\Pages;

use App\Filament\Company\Resources\ItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItems extends EditRecord
{
    protected static string $resource = ItemsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
