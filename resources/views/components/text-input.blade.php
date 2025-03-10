@props(['disabled' => false])

<input 
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => '
            border-gray-300
            bg-white
            text-gray-700
            focus:border-red-400
            focus:ring-red-400
            rounded-md
            shadow-sm
        '
    ]) }}
>
