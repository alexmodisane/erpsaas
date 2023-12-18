<?php

namespace App\Filament\Company\Resources\ItemsResource\Pages;

use App\Filament\Company\Resources\ItemsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItems extends CreateRecord
{
    protected static string $resource = ItemsResource::class;
}
