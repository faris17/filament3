<?php

namespace App\Filament\Resources\StudentHasClassResource\Pages;

use App\Filament\Resources\StudentHasClassResource;
use App\Models\Classroom;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListStudentHasClasses extends ListRecords
{
    protected static string $resource = StudentHasClassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $data = [];

        $classrooms = Classroom::orderBy('name')->get();

        foreach($classrooms as $class){
            $data[$class->name] = Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->where('classrooms_id', $class->id)->where('is_open', true));
        }
        return $data;
    }
}
