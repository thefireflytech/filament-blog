<div>
    @php
        $record = $getState();
    @endphp

    <div style="display: flex; gap: 8px; align-items: center;">
        <img src="{{ $record->avatar }}" alt="{{ $record->{config('filamentblog.user.columns.name')} }}"
            style="width: 30px; height: 30px; border-radius: 50%;">
        <p style="font-size: 14px; font-weight: 600; color: #008000;">
            {{ $record->{config('filamentblog.user.columns.name')} }}</p>
    </div>
</div>
