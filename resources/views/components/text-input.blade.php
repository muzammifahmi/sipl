@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-diamond-500 focus:ring-diamond-500 rounded-md shadow-sm']) }}>
