<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\SelectInput;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer','name')
                    ->required(),
                // Forms\Components\TextInput::make('order_number')
                //     ->required()
                //     ->maxLength(255),
                Forms\Components\DateTimePicker::make('order_date') 
                    ->required(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('order_status')
                    ->required()
                    ->options(OrderStatus::class),
                Forms\Components\Select::make('payment_method')
                    ->required()
                    ->options(PaymentMethod::class),
                Forms\Components\Repeater::make('orderItem')
                    ->relationship()
                    ->schema([
                        // Forms\Components\Select::make('order_id')
                        //     ->required()
                        //     ->relationship('order'. 'id'),
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('qty')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('unit_price')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('discount')
                            ->required()
                            ->numeric(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Preview Invoice')
                    ->url(fn (Order $record): string => route('invoice.stream-pdf', $record->id))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('Download Invoice')
                    ->url(fn (Order $record): string => route('invoice.download-pdf', $record->id))
                    ->openUrlInNewTab(),   
                Tables\Actions\Action::make('send email as invoice')
                    ->url(fn (Order $record): string => route('invoice.send-email', $record->id))
                    ->openUrlInNewTab(),
            
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
