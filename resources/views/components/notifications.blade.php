<notifications></notifications>

<div class="dropdown dropdown-end">
    <!-- Toggle notification menu -->
    <label tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ auth()->user()->unreadNotifications->isEmpty() ? '' : 'animate-ringing' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
            @if (auth()->user()->unreadNotifications->isNotEmpty())
                <span class="indicator-item badge badge-sm badge-primary">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </div>
    </label>

    <div tabindex="0" class="mt-3 card card-compact dropdown-content w-96 bg-base-100 shadow z-50">
        <div class="card-body">
            <h3 class="card-title  justify-center">
                Notifications
            </h3>

            <div class="divider my-0"></div>

            <ul>
                @forelse (auth()->user()->notifications as $notification)
                    <li class="hover:bg-slate-200 cursor-pointer flex rounded mb-3">
                        <div class="indicator w-full">
                            <a href="#" class="p-3 flex items-center">
                                <!-- Image -->
                                <i class="fa-solid fa-triangle-exclamation text-3xl text-primary mr-3" aria-hidden="true"></i>

                                <!-- Message -->
                                <span class="w-full">
                                    {!! vsprintf($notification->data['message'], $notification->data['message_key']) !!}
                                </span>

                                <!-- Badge new -->
                                <span class="indicator-item badge badge-sm badge-primary right-3">New</span>
                            </a>
                        </div>
                    </li>
                @empty
                    <li>
                        <p class="m-2 text-center">
                            Vous n'avez pas de notifications.
                        </p>
                    </li>
                @endforelse
            </ul>

            @if (auth()->user()->unreadNotifications->isNotEmpty())
                <!-- Mark all as read -->
                <div class="mb-1">
                    <button class="btn btn-primary btn-block">
                            Marquer les notifications comme lues
                    </button>
                </div>
            @endif

            <div class="divider my-0"></div>

            <!-- Go to User Notification panel-->
            <div class="card-actions">
                <a href="#" class="btn btn-ghost btn-block text-primary">
                    Toutes les Notifications
                </a>
            </div>
        </div>
    </div>

</div>