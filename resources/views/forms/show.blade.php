@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold">{{ $form->title }}</h2>
                @if($form->description)
                    <p class="text-gray-500 text-sm mt-1">{{ $form->description }}</p>
                @endif
            </div>
            <div class="px-6 py-6">
                @livewire('form-renderer', ['form' => $form])
            </div>
        </div>
    </div>
</div>
@endsection