<?php

namespace App\Filament\Resources\FormSubmissions\Pages;

use App\Filament\Resources\FormSubmissions\FormSubmissionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewFormSubmission extends ViewRecord
{
    protected static string $resource = FormSubmissionResource::class;

    

    public function infolist(Schema $infolist): Schema
    {
        $record = $this->record;
        $fields = $record->form->fields;
        $data   = $record->data;

        $entries = $fields->map(function ($field) use ($data) {
            $value = $data[$field->name] ?? '-';
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            return TextEntry::make($field->name)
                ->label($field->label)
                ->state($value);
        })->toArray();

        return $infolist->schema([
            Section::make('Gönderim Verileri')->schema($entries),
            Section::make('Meta')->schema([
                TextEntry::make('created_at')->label('Tarih')->dateTime(),
            ]),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
