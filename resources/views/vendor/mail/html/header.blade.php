@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                <img src="{{ asset('images/logos/selvah_570x350.png') }}" class="logo" alt="Selvah Logo">
                <span class="title">{{ $slot }}</span>
            @endif
        </a>
    </td>
</tr>
