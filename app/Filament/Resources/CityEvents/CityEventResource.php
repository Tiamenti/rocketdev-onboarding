<?php

namespace App\Filament\Resources\CityEvents;

use App\Enums\CityEventStatus;
use App\Filament\Resources\CityEvents\Pages\CreateCityEvent;
use App\Filament\Resources\CityEvents\Pages\EditCityEvent;
use App\Filament\Resources\CityEvents\Pages\ListCityEvents;
use App\Models\CityEvent;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CityEventResource extends Resource
{
    protected static ?string $model = CityEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'событие';

    protected static ?string $pluralModelLabel = 'события';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Название')
                    ->required(),
                TextInput::make('place')
                    ->label('Место')
                    ->required(),
                DateTimePicker::make('start_at')
                    ->label('Начало в')
                    ->required(),
                DateTimePicker::make('end_at')
                    ->label('Окончание в')
                    ->required(),
                TagsInput::make('tags')
                    ->label('Теги')
                    ->required(),
                TextInput::make('capacity')
                    ->label('Кол-во мест')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->native(false)
                    ->label('Статус')
                    ->options(CityEventStatus::class)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),
                TextColumn::make('place')
                    ->label('Место')
                    ->searchable(),
                TextColumn::make('start_at')
                    ->label('Начало в')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_at')
                    ->label('Окончание в')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('capacity')
                    ->label('Кол-во мест')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Статус')
                    ->badge()
                    ->searchable(),
                TextColumn::make('popularity')
                    ->label('Популярность')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('change_number')
                    ->label('Кол-во изменений')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => ListCityEvents::route('/'),
            'create' => CreateCityEvent::route('/create'),
            'edit' => EditCityEvent::route('/{record}/edit'),
        ];
    }
}
