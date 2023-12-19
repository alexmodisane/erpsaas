<?php

namespace App\Filament\Company\Resources;

use App\Filament\Company\Resources\CustomerResource\Pages;
use App\Filament\Company\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')->required(),
                Forms\Components\TextInput::make('last_name')->required(),
                Forms\Components\TextInput::make('company_name')->required(),
                Forms\Components\TextInput::make('customer_email')->email()->required(),
                Forms\Components\TextInput::make('customer_work_phone')->required(),
                Forms\Components\TextInput::make('customer_phone')->required(),
                Forms\Components\TextInput::make('customer_nickname')->required(),
                Forms\Components\Tabs::make('Account Specifications')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Address')
                                    ->icon('heroicon-o-credit-card')
                                    ->schema([
                                        Forms\Components\TextInput::make('address')
                                            ->localizeLabel()
                                            ->maxLength(100),
                                        Forms\Components\TextInput::make('city')
                                            ->localizeLabel()
                                            ->maxLength(20),
                                        Forms\Components\TextInput::make('state')
                                            ->localizeLabel()
                                            ->maxLength(20),
                                            Forms\Components\TextInput::make('zip_code')
                                            ->localizeLabel()
                                            ->maxLength(20),
                                    ])->columns(),
                    ])->columnSpan('full')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
