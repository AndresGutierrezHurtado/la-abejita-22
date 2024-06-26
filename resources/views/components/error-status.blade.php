@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-lg font-semibold text-center py-2 px-4 rounded-md bg-red-100 border-2 border-red-500 text-red-700']) }}>
        {{ $status }}
    </div>
@endif
