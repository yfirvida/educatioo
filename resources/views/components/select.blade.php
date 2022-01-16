@props(['options'])

<select {!! $attributes->merge(['class' => 'form-control' ]) !!}>
   <option value="">{{__('Choose an option')}}</option>
        @if(!empty($options))
            @foreach($options as $option)
                <option value="{{ $option->id }}">{{ $option->name }}</option>
            @endforeach
        @endif
</select>
