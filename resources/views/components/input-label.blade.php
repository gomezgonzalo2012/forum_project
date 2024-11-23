@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300 form-control form-control-user']) }} style="width: 80%; max-width: 300px;">
    {{ $value ?? $slot }}
    
</label>
