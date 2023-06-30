<header>

<!-- Navbar -->
<nav class="navbar bg-base-200">
    <div class="lg:container w-full mx-auto items-center lg:justify-end">
        <div class="flex-none lg:hidden">
            <label for="selvah-drawer" class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current md:h-6 md:w-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </label>
        </div>
        <div class="navbar-start flex items-center justify-center w-full lg:hidden ">
            <a class="font-light text-3xl font-selvah" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('images/logos/selvah_192x110.png') }}" alt="Selvah Logo" class="block mx-auto" width="80px">
                    <span class="block">SELVAH</span>
            </a>
        </div>

        <div class="navbar-end hidden lg:flex justify-end gap-2">
            @if (Auth::guest())
                <a href="{{ route('auth.login') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Login
                </a>
            @else
                {{-- User Notifications Menu --}}
                {{-- @include('partials._notifications') --}}

                {{-- User Avatar and Menu --}}
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img src="{{ asset(Auth::user()->avatar) }}"  alt="User avatar" />
                        </div>
                    </label>
                    <ul tabindex="0" class="menu dropdown-content z-[1] mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <div class="tooltip tooltip-top" data-tip="A plus tard !">
                                <a href="{{ route('auth.logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-4 text-red-500">
                                    <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>Déconnexion</span>
                                </a>
                                <x-form.form method="post" action="{{ route('auth.logout') }}" id="logout-form" style="display:none;">
                                </x-form.form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="my-auto font-bold">
                    {{ Auth::user()->full_name }}
                </div>
            @endif
        </div>
    </div>

</nav>
</header>
