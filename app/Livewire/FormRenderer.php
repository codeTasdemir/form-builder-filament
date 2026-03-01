<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Form;
use App\Models\FormSubmission;

class FormRenderer extends Component
{
    public Form $form;
    public array $formData = [];
    public bool $submitted = false;

    public function mount(Form $form): void
    {
        $this->form = $form;

        foreach ($form->fields as $field) {
            $this->formData[$field->name] = $field->type === 'checkbox' ? [] : '';
        }
    }

    protected function rules(): array
    {
        $rules = [];
        foreach ($this->form->fields as $field) {
            $rules['formData.' . $field->name] = $field->getValidationRulesArray();
        }
        return $rules;
    }

    protected function validationAttributes(): array
    {
        $attributes = [];
        foreach ($this->form->fields as $field) {
            $attributes['formData.' . $field->name] = $field->label;
        }
        return $attributes;
    }

    public function submit(): void
    {
        $this->validate();

        FormSubmission::create([
            'form_id'    => $this->form->id,
            'data'       => $this->formData,
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.form-renderer');
    }
}
