<?php

use Illuminate\Support\Facades\Route;
use App\Models\Form;

Route::get('/', function () {
    $forms = Form::where('is_active', true)->get();
    return view('forms.index', compact('forms'));
});

Route::get('/form/{slug}', function (string $slug) {
    $form = Form::where('slug', $slug)
        ->where('is_active', true)
        ->with('fields')
        ->firstOrFail();

    return view('forms.show', compact('form'));
})->name('form.show');
