@props(['label', 'name', 'options'])

<select id="{{ $name }}" name="{{ $name }}"
    {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!} >
    <option selected disabled value="">{{ __($label) }}</option>
    @if(is_array($options))
        @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ __($text) }}</option>
        @endforeach
    @else
        @foreach($options as $option)
            <option value="{{ $option->id }}">{{ __($option->name) }}</option>
        @endforeach
    @endif
</select>
