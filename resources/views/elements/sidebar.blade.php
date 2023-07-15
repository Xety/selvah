<aside class="drawer-side">
    <label for="selvah-drawer" class="drawer-overlay"></label>
    <!--Website Menu-->
    <div class="menu w-80 min-h-full bg-base-200">
        <ul class="hidden lg:block">
            <li>
                <a class="flex flex-col items-center justify-center font-light text-3xl font-selvah  hover:!bg-transparent focus:!bg-transparent active:!bg-transparent" href="{{ route('dashboard.index') }}">
                    <img src="{{ asset('images/logos/selvah_570x350.png') }}" alt="Selvah Logo" class="inline-block" width="80px">
                    <span class="block">SELVAH</span>
                </a>
            </li>
        </ul>

        <div class="hidden lg:block divider px-4 my-0"></div>

        <ul class="p-4" role="list">
            <li class="menu-title">
                <span>Administration</span>
            </li>
            <li>
                {!! Menu::{'dashboard'}() !!}
            </li>

            @can('Gérer les Maintenances')
                <li class="menu-title">
                    <span>Maintenances</span>
                </li>
                <li>
                    {!! Menu::{'maintenance'}() !!}
                </li>
            @endcan

            @can('Gérer les Pièces')
                <li class="menu-title">
                    <span>Pièces Détachées</span>
                </li>
                <li>
                    {!! Menu::{'part'}() !!}
                </li>
            @endcan

            @can('Gérer les Matériels')
                <li class="menu-title">
                    <span>Matériels</span>
                </li>
                <li>
                    {!! Menu::{'material'}() !!}
                </li>
            @endcan

            <li class="menu-title">
                <span>Incidents</span>
            </li>
            <li>
                {!! Menu::{'incident'}() !!}
            </li>

            @can('Gérer les Zones')
                <li class="menu-title">
                    <span>Zones</span>
                </li>
                <li>
                    {!! Menu::{'zone'}() !!}
                </li>
            @endcan

            @can('Gérer les Utilisateurs')
                <li class="menu-title">
                    <span>Utilisateurs</span>
                </li>
                <li>
                    {!! Menu::{'user'}() !!}
                </li>
            @endcan

            @can('Gérer les Rôles')
                <li class="menu-title">
                    <span>Rôles & Permissions</span>
                </li>
                <li>
                    {!! Menu::{'role'}() !!}
                </li>
            @endcan

            @can('Gérer les Paramètres')
                <li class="menu-title">
                    <span>Paramètres</span>
                </li>
                <li>
                    {!! Menu::{'setting'}() !!}
                </li>
            @endcan
        </ul>


        <div class="divider px-4 my-0 lg:hidden"></div>

            <!-- User Menu-->
        <div class="group flex items-center lg:hidden px-4 w-full h-16 min-h-16 mt-auto shadow-md bg-slate-300">
            <div class="dropdown dropdown-hover dropdown-right dropdown-top">
                <label tabindex="0" class="avatar btn btn-ghost btn-circle">
                    <div class="w-10 rounded-full">
                        <img src="{{ asset(Auth::user()->avatar) }}"  alt="Avatar de l'utilisateur" class="rounded-full" />
                    </div>
                </label>
                <ul tabindex="0" class="menu dropdown-content p-2 shadow bg-base-100 rounded-box w-52 mt-4">
                    <li>
                        <a href="{{ route('auth.logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="hover:shadow text-red-500 active:text-[color:hsl(var(--pc))] active:bg-red-500 rounded-[var(--rounded-btn)]">
                            <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Déconnexion</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="flex flex-col text-left items-center justify-center">
                <span class="-ml-7 font-bold text-primary">{{ Auth::user()->full_name }}</span>
                <small class="">{{  Auth::user()->email }}</small>
            </div>
        </div>

    </div>
</aside>