<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\ItemsResource\Pages;
use App\Filament\Company\Resources\ItemsResource\RelationManagers;
use App\Models\Items;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ItemsResource extends Resource
{
    protected static ?string $model = Items::class;

    protected static ?string $navigationIcon = 'heroicon-s-gift-top';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sku')->required(),
                Forms\Components\Textarea::make('description')->required(),
                Forms\Components\TextInput::make('brand_name')->required(),
                //Forms\Components\Select::make('status')
                                    //->options([
                                        //'in-stock' => 'In-Stock',
                                        //'out-of-stock' => 'Out-of-Stock',
                                    //]),
                Forms\Components\TextInput::make('item_price')->required(),
                Forms\Components\TextInput::make('item_amount')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItems::route('/create'),
            'edit' => Pages\EditItems::route('/{record}/edit'),
        ];
    }
}
