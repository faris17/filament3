<?php

namespace App\Filament\Resources\StudentHasClassResource\Pages;

use App\Filament\Resources\StudentHasClassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentHasClasses extends ListRecords
{
    protected static string $resource = StudentHasClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
