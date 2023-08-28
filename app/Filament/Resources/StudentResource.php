<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use App\Models\StudentHasClass;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Academic';

    protected static ?string $navigationLabel = 'Students';

    protected static ?int $navigationSort = 22;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('nis')
                            ->label('NIS'),
                        TextInput::make('name')
                            ->label('Nama Student')
                            ->required(),
                        Select::make('gender')
                            ->options([
                                "Male" => "Male",
                                "Female" => "Female"
                            ]),
                        DatePicker::make('birthday')
                            ->label("Birthday"),
                        Select::make('religion')
                            ->options([
                                'Islam' => "Islam",
                                'Katolik' => "Katolik",
                                'Protestan' => "Protestan",
                                'Hindu' => 'Hindu',
                                'Buddha' => "Buddha",
                                'Khonghucu' => "Khonghucu"
                            ]),
                        TextInput::make('contact'),
                        FileUpload::make('profile')
                            ->directory("students")
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) ($rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * ($livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('nis')
                    ->label('NIS')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nama Student')
                    ->searchable(),
                TextColumn::make('gender'),
                TextColumn::make('birthday')
                    ->label("Birthday")
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gender')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('contact'),
                ImageColumn::make('profile')->circular(),
                TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(fn (string $state): string => ucwords("{$state}"))
            ])
            ->filters([
                SelectFilter::make('status')
                    ->multiple()
                    ->options([
                        'accept' => 'Accept',
                        'off' => 'Off',
                        'move' => 'Move',
                        'grade' => 'Grade'
                    ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('Change Status')
                        ->icon('heroicon-m-check')
                        ->requiresConfirmation()
                        ->form([
                            Select::make('Status')
                                ->label('Status')
                                ->options(['accept' => 'Accept', 'off' => 'Off', 'move' => 'Move', 'grade' => 'Grade'])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data) {
                            $records->each(function ($record) use ($data) {
                                Student::where('id', $record->id)->update(['status' => $data['Status']]);
                            });
                        }),

                    Tables\Actions\DeleteBulkAction::make(),
                ]),

            ])
            // ->headerActions([
            //     Tables\Actions\CreateAction::make(),
            // ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
            'view' => Pages\ViewStudent::route('/{record}')
        ];
    }

    public static function getLabel(): ?string
    {
        $locale = app()->getLocale();

        if ($locale == 'id') {
            return "Murid";
        } else
            return "Students";
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Fieldset::make('Biodata')
                            ->schema([
                                Components\Split::make([
                                    Components\ImageEntry::make('profile')
                                        ->hiddenLabel()
                                        ->grow(false),
                                    Components\Grid::make(2)
                                        ->schema([
                                            Components\Group::make([
                                                Components\TextEntry::make('nis'),
                                                Components\TextEntry::make('name'),
                                                Components\TextEntry::make('gender'),
                                                Components\TextEntry::make('birthday'),

                                            ])
                                            ->inlineLabel()
                                            ->columns(1),

                                            Components\Group::make([
                                                Components\TextEntry::make('religion'),
                                                Components\TextEntry::make('contact'),
                                                Components\TextEntry::make('status')
                                                ->badge()
                                                ->color(fn (string $state): string => match ($state) {
                                                    'accept' => 'success',
                                                    'off' => 'danger',
                                                    'grade' => 'success',
                                                    'move' => 'warning',
                                                    'wait' => 'gray'
                                                }),
                                                Components\ViewEntry::make('QRCode')
                                                ->view('filament.resources.students.qrcode'),
                                            ])
                                            ->inlineLabel()
                                            ->columns(1),
                                    ])

                                ])->from('lg')
                            ])->columns(1)
                    ])->columns(2)
            ]);
    }
}
