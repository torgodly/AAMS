@props(['label', 'name', 'options'])

<select id="{{ $name }}" name="{{ $name }}"
    {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!} >
    <option selected disabled value="">{{ __($label) }}</option>
    @foreach($options as $value)
        <option value="{{ $value->id }}">{{ __($value->name) }}</option>
    @endforeach
</select>

