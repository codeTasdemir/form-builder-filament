<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    protected $fillable = [
        'form_id',
        'label',
        'name',
        'type',
        'options',
        'validation_rules',
        'order',
        'is_required',
        'placeholder',
        'help_text',
    ];

    protected $casts = [
        'options'          => 'array',
        'validation_rules' => 'array',
        'is_required'      => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function getValidationRulesArray(): array
    {
        $rules = $this->validation_rules ?? [];

        if ($this->is_required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }

        return $rules;
    }
}
