<?php

namespace App\Filament\Resources\Forms\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Grid;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FieldsRelationManager extends RelationManager
{
    protected static string $relationship = 'fields';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)->schema([
                TextInput::make('label')
                    ->label('Alan Etiketi')
                    ->required(),

                TextInput::make('name')
                    ->label('Alan Adı (key)')
                    ->required()
                    ->helperText('Boşluksuz, küçük harf. Örn: ad-soyad'),

                Select::make('type')
                    ->label('Alan Tipi')
                    ->options([
                        'text'     => 'Metin',
                        'textarea' => 'Uzun Metin',
                        'email'    => 'E-posta',
                        'number'   => 'Sayı',
                        'tel'      => 'Telefon',
                        'date'     => 'Tarih',
                        'select'   => 'Seçim Kutusu',
                        'radio'    => 'Radyo Buton',
                        'checkbox' => 'Onay Kutusu',
                    ])
                    ->required()
                    ->live(),

                TextInput::make('placeholder')
                    ->label('Placeholder'),

                TextInput::make('order')
                    ->label('Sıra')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_required')
                    ->label('Zorunlu Alan'),

                Textarea::make('help_text')
                    ->label('Yardım Metni')
                    ->columnSpanFull(),

                Repeater::make('options')
                    ->label('Seçenekler (select/radio/checkbox için)')
                    ->schema([
                        TextInput::make('value')->label('Değer')->required(),
                        TextInput::make('label')->label('Etiket')->required(),
                    ])
                    ->columnSpanFull()
                    ->visible(fn($get) => in_array($get('type'), ['select', 'radio', 'checkbox'])),

                TagsInput::make('validation_rules')
                    ->label('Validasyon Kuralları')
                    ->placeholder('Kural ekle: min:3, max:255, email...')
                    ->helperText('Validasyon kuralları. Örn: min:3 | max:500 | email | numeric')
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                TextColumn::make('order')->label('Sıra')->sortable(),
                TextColumn::make('label')->label('Etiket'),
                TextColumn::make('name')->label('Alan Adı'),
                TextColumn::make('type')->label('Tip')->badge(),
                IconColumn::make('is_required')->label('Zorunlu')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
