<header>
    <!-- Navbar -->
    <nav class="navbar bg-base-200">
            <div class="navbar-start lg:hidden">
                <label for="selvah-drawer" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-8 w-8 stroke-current md:h-6 md:w-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </label>
            </div>
            <div class="navbar-start hidden lg:block"></div>
            <div class="navbar-center lg:hidden">
                <a class="font-light text-3xl font-selvah" href="{{ route('dashboard.index') }}">
                    <img src="{{ asset('images/logos/selvah_570x350.png') }}" alt="Selvah Logo" class="block mx-auto w-20">
                        <span class="block">SELVAH</span>
                </a>
            </div>
            <div class="navbar-start hidden lg:block"></div>
            <div class="navbar-end lg:hidden">
                <x-notifications/>
            </div>

            @auth
                <div class="navbar-end hidden lg:flex justify-end gap-2">
                    {{-- User Notifications Menu --}}
                    <x-notifications/>

                    {{-- User Avatar and Menu --}}
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ asset(Auth::user()->avatar) }}"  alt="User avatar" />
                            </div>
                        </label>
                        <ul tabindex="0" class="menu dropdown-content z-[1] mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                            <li>
                                <div data-tip="Gérer les paramètre de votre compte." class="tooltip tooltip-top">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="h-6 w-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                        <span>Mon Profil</span>
                                    </a>
                                </div>
                            </li>
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
                </div>
            @endauth

    </nav>
</header>
