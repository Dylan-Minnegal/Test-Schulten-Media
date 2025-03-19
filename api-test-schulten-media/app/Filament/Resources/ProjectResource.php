<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\DateFilter;




class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(4)
                    ->maxLength(1000),

                DatePicker::make('created_at')
                    ->label('Fecha de Creación')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Name'),
                TextColumn::make('description')->label('Description'),
                TextColumn::make('created_at')->label('Creation Date')->dateTime(),
            ])
            ->filters([
                Filter::make('name')
                    ->label('Search by Name')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Enter name')
                            ->placeholder('Enter name to search')
                    ])
                    ->query(
                        fn(Builder $query, array $data) =>
                        $query->when($data['name'], fn($q) => $q->where('name', 'like', "%{$data['name']}%"))
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
