@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Formlar</h1>

@if($forms->isEmpty())
    <p class="text-gray-500">Henüz aktif form bulunmuyor.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($forms as $form)
            <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between">
                <div>
                    <h5 class="text-lg font-semibold mb-2">{{ $form->title }}</h5>
                    @if($form->description)
                        <p class="text-gray-500 text-sm mb-4">{{ $form->description }}</p>
                    @endif
                </div>
                <a href="{{ route('form.show', $form->slug) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded">
                    Formu Doldur
                </a>
            </div>
        @endforeach
    </div>
@endif
@endsection