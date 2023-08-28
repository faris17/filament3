<?php

namespace App\Filament\Resources\ClassroomResource\Pages;

use App\Filament\Resources\ClassroomResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateClassroom extends CreateRecord
{
    protected static string $resource = ClassroomResource::class;

    public function getTitle(): string|Htmlable
    {
        return "Class Room";
    }
}
