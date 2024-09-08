<?php

namespace App\Filament\Resources\EntiteResource\Pages;

use App\Filament\Resources\EntiteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntite extends EditRecord
{
    protected static string $resource = EntiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
