@php
    $record = $getState();
@endphp

<div style="display: flex; gap: 8px; align-items: center; justify-content: center;"
    title="{{ $record->{config('filamentblog.user.columns.name')} }}">
    <img src="{{ $record->avatar }}" alt="{{ $record->{config('filamentblog.user.columns.name')} }}"
        style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
</div>
