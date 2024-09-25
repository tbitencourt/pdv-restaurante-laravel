<?php

namespace App\Filament\Resources;

use App\Enums\MenuItemStatus;
use App\Enums\MenuStatus;
use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextArea::make('description')->required(),
                Select::make('status')
                    ->label('Status')
                    ->options(MenuStatus::options())
                    ->default(MenuStatus::DRAFT->value)
                    ->required(),
                Repeater::make('items')
                    ->relationship()
                    ->schema([
                        TextInput::make('name')->required(),
                        TextArea::make('description')->required(),
                        Select::make('status')
                            ->label('Status')
                            ->options(MenuItemStatus::options())
                            ->default(MenuItemStatus::DRAFT->value)
                            ->required(),
                    ])
                    ->addActionLabel(__('Add item to Menu'))
                    ->columns(3)
                    ->columnSpan('full')
                    ->reorderableWithButtons()
                    ->collapsible(),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
                TextColumn::make('status')
                    ->formatStateUsing(fn (MenuStatus $state) => $state->getText())
                    ->label('Status'),
                TextColumn::make('items.name')->limit(20),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
