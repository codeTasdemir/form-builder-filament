<div>
    @if ($submitted)
        <div class="bg-green-100 border border-green-400 text-green-800 rounded-lg p-4">
            <h4 class="font-bold text-lg mb-1">Teşekkürler</h4>
            <p class="text-sm">Form gönderildi</p>
        </div>
    @else
        <form wire:submit="submit">
            @foreach ($form->fields as $field)
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        {{ $field->label }}
                        @if ($field->is_required)
                            <span class="text-red-500">*</span>
                        @endif
                    </label>

                    @if (in_array($field->type, ['text', 'email', 'tel', 'number', 'date']))
                        <input
                            type="{{ $field->type }}"
                            wire:model="formData.{{ $field->name }}"
                            placeholder="{{ $field->placeholder }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('formData.' . $field->name) border-red-500 @enderror"
                        >

                    @elseif ($field->type === 'textarea')
                        <textarea
                            wire:model="formData.{{ $field->name }}"
                            placeholder="{{ $field->placeholder }}"
                            rows="4"
                            class="w-full border rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('formData.' . $field->name) border-red-500 @enderror"
                        ></textarea>

                    @elseif ($field->type === 'select')
                        <select
                            wire:model="formData.{{ $field->name }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('formData.' . $field->name) border-red-500 @enderror"
                        >
                            <option value="">Seçiniz...</option>
                            @foreach ($field->options ?? [] as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </select>

                    @elseif ($field->type === 'radio')
                        @foreach ($field->options ?? [] as $option)
                            <div class="flex items-center gap-2 mb-1">
                                <input
                                    type="radio"
                                    wire:model="formData.{{ $field->name }}"
                                    value="{{ $option['value'] }}"
                                    id="{{ $field->name }}_{{ $loop->index }}"
                                    class="text-blue-600 focus:ring-blue-500"
                                >
                                <label for="{{ $field->name }}_{{ $loop->index }}" class="text-sm text-gray-700">
                                    {{ $option['label'] }}
                                </label>
                            </div>
                        @endforeach

                    @elseif ($field->type === 'checkbox')
                        @foreach ($field->options ?? [] as $option)
                            <div class="flex items-center gap-2 mb-1">
                                <input
                                    type="checkbox"
                                    wire:model="formData.{{ $field->name }}"
                                    value="{{ $option['value'] }}"
                                    id="{{ $field->name }}_{{ $loop->index }}"
                                    class="text-blue-600 focus:ring-blue-500"
                                >
                                <label for="{{ $field->name }}_{{ $loop->index }}" class="text-sm text-gray-700">
                                    {{ $option['label'] }}
                                </label>
                            </div>
                        @endforeach
                    @endif

                    @error('formData.' . $field->name)
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    @if ($field->help_text)
                        <p class="text-gray-400 text-xs mt-1">{{ $field->help_text }}</p>
                    @endif
                </div>
            @endforeach

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white text-sm font-medium py-2 px-6 rounded-lg"
            >
                <span wire:loading wire:target="submit">Gönderiliyor...</span>
                <span wire:loading.remove wire:target="submit">Gönder</span>
            </button>
        </form>
    @endif
</div>