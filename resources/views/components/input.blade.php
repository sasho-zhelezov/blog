<div class="mb-4">
    <label for="{{ $name }}" class="block text-gray-700 font-medium mb-2">
        {{ ucfirst($name) }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-3 py-2 border rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500']) }}
    />
    @error($name)
        <span class="text-sm text-red-500">{{ $message }}</span>
    @enderror
</div>
