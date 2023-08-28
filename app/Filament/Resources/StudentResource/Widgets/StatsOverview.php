<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Students', Student::count())->url('coba', true),
            Stat::make('Teachers', Teacher::count()),
            Stat::make('Subjects', Subject::count()),
        ];
    }
}
