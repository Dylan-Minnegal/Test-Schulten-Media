<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Task;
use App\Models\Project;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;



class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->label('Project')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->required(),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->nullable(),

                Checkbox::make('completed')
                    ->label('Completed')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('title')->label('Title'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('project.name')->label('Project')->sortable(),
                BooleanColumn::make('completed')->label('Completed')->sortable(),
                TextColumn::make('created_at')->label('Creation Date')->dateTime(),
            ])
            ->filters([
                Filter::make('title')
                    ->label('Search by title')
                    ->form([
                        Forms\Components\TextInput::make('title')
                            ->label('Enter title')
                            ->placeholder('Enter title to search')
                    ])
                    ->query(
                        fn(Builder $query, array $data) =>
                        $query->when($data['title'], fn($q) => $q->where('title', 'like', "%{$data['title']}%"))
                    ),

                Filter::make('description')
                    ->label('Search by Description')
                    ->form([
                        Forms\Components\TextInput::make('description')
                            ->label('Enter description')
                            ->placeholder('Enter description to search')
                    ])
                    ->query(
                        fn(Builder $query, array $data) =>
                        $query->when($data['description'], fn($q) => $q->where('description', 'like', "%{$data['description']}%"))
                    ),
                Filter::make('completed')
                    ->label('Task Status')
                    ->form([
                        Forms\Components\Select::make('completed')
                            ->label('Select status')
                            ->options([
                                '1' => 'Completed',
                                '0' => 'Pending',
                            ])
                            ->placeholder('Select status')
                    ])
                    ->query(
                        fn(Builder $query, array $data) =>
                        $query->when(
                            isset($data['completed']),
                            fn($q) => $q->where('completed', $data['completed'])
                        )
                    ),

                Filter::make('created_at')
                    ->label('Filter by Date')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('From'),
                        Forms\Components\DatePicker::make('created_until')->label('Until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['created_from'], fn($q) => $q->whereDate('created_at', '>=', $data['created_from']))
                            ->when($data['created_until'], fn($q) => $q->whereDate('created_at', '<=', $data['created_until']));
                    }),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
