@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'd-block border-bottom-only px-3 py-2 font-poppins box-sizing-border']) !!}
    style="width: 80%; max-width: 300px;" />
