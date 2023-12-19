<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\InvoiceResource\Pages;
use App\Filament\Company\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use App\Models\Items;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-pound';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\TextInput::make('invoice_number')
                            ->default('INV-'. random_int(100000, 999999))
                            ->required(),

                    Forms\Components\DatePicker::make('invoice_date')
                            ->default(now())
                            ->required(),

                    // Invoice items repeater
                    Repeater::make('InvoiceItems')
                        ->schema([
                            Forms\Components\Select::make('item_id')
                                ->label('Item/Service')
                                ->options(Items::query()->pluck('description', 'id'))
                                ->reactive()
                                ->callAfterStateUpdated(function ($state, callable $set) {
                                    $item = Items::find($state);
                                    if ($item) {
                                        $set('price', number_format($item->price / 100, 2));
                                        $set('item_price', $item->price);
                                    }
                                })
                                ->columnSpan([
                                    'md' => 4,
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('qty')
                                ->numeric()
                                ->default(1)
                                ->columnSpan([
                                    'md' => 2,
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('item_amount')
                                ->numeric()
                                ->default(1)
                                ->columnSpan([
                                    'md' => 2,
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('price')
                                ->disabled()
                                ->dehydrated(false)
                                ->numeric()
                                ->columnSpan([
                                    'md' => 2,
                                ])
                                ,
                            Forms\Components\Hidden::make('item_price')
                                ->disabled(),
                        ])
                         ->defaultItems(1)
                         ->columns([
                            'md' => 10
                         ])
                         ->relationship()
                         ->columnSpan('full')
            
                                  
    
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
