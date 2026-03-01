<?php

namespace App\Filament\Resources\FormSubmissions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FormSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('form_id')
                    ->relationship('form', 'title')
                    ->required(),
                TextInput::make('data')
                    ->required(),
            ]);
    }
}
