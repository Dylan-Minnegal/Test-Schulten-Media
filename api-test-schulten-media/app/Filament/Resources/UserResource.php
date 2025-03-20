<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\PasswordInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => $state ? \Illuminate\Support\Facades\Hash::make($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->nullable(),

                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrated(false),

                Select::make('rol')
                    ->label('Role')
                    ->options([
                        'user' => 'User',
                        'admin' => 'Admin',
                    ])
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('rol')->label('Role'),
                TextColumn::make('created_at')->label('Creation Date')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->filters([
                Filter::make('name')
                    ->label('Search by name')
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

            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
