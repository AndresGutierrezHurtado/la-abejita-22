@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-lg font-semibold text-center py-2 px-4 rounded-md bg-green-100 border-2 border-green-500 text-green-700']) }}>
        {{ $status }}
    </div>
@endif
