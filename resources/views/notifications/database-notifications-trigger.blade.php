<div class="w-10">
    <button type="button" class="w-10">
        @if($unreadNotificationsCount)
            <sup class="inline-flex items-center justify-center p-1 text-xs leading-none text-white bg-danger-600 rounded-full">
                {{ $unreadNotificationsCount }}
            </sup>
        @endif
        <x-heroicon-o-bell class="w-10 align-text-top origin-top"/>
    </button>
</div>
