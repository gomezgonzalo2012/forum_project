@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'w-100 d-block border= 0 border-bottom-only px-3 py-2 font-poppins box-sizing-border']) !!} 
