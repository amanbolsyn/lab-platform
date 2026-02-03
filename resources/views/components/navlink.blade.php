@props(['active' => false])

<a 
{{ $attributes->merge([
    'class' => ($active ? 'bg-black text-white ' : 'hover:bg-[#e9ebef] ') . 'm-2 p-2 rounded-md'])}} >
    {{ $slot }}
</a> 
