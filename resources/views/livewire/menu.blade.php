<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full px-4 mx-auto">
        <div class="flex justify-between h-14">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('dashboard')}}">
                        <x-jet-application-mark class="block mx-auto h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @can('entidad.index')
                    <div class="relative mt-3 ">
                        <x-jet-dropdown align="center" width="50" >
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md bg-blu hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-blue-700">
                                        Contactos
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-44">
                                    <x-jet-dropdown-link href="{{ route('entidad.tipo','1') }}" class="text-center">
                                        {{ __('Clientes') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('entidad.tipo','4') }}" class="text-center">
                                        {{ __('Prospección') }}
                                    </x-jet-dropdown-link>
                                    @if(Auth::user()->hasRole('Gestion')==true || Auth::user()->hasRole('Admin')==true )
                                        <x-jet-dropdown-link href="{{ route('entidad.tipo','2') }}" class="text-center">
                                            {{ __('Proveedores') }}
                                        </x-jet-dropdown-link>
                                        <x-jet-dropdown-link href="{{ route('entidad.tipo','0') }}" class="text-center">
                                            {{ __('Todos') }}
                                        </x-jet-dropdown-link>
                                    @endif
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    @endcan
                    @can('presupuesto.index')
                    <x-jet-nav-link href="{{ route('presupuesto.index') }}" :active="request()->routeIs('presupuesto.index')">
                        {{ __('Presupuestos') }}
                    </x-jet-nav-link>
                    @endcan
                    @can('producto.index')
                    <x-jet-nav-link href="{{ route('producto.index') }}" :active="request()->routeIs('producto.index')">
                        {{ __('Productos') }}
                    </x-jet-nav-link>
                    @endcan
                    @can('pedido.index')
                    <x-jet-nav-link href="{{ route('pedido.index') }}" :active="request()->routeIs('pedido.index')">
                        {{ __('Compras') }}
                    </x-jet-nav-link>
                    @endcan
                    @can('stock.index')
                    <div class="relative mt-3 ">
                        <x-jet-dropdown align="right" width="60" >
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md bg-blu hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-blue-700">
                                        Stock
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-44">
                                    @can('stockpeticion.index')
                                    <x-jet-dropdown-link href="{{ route('stockpeticion.index') }}">
                                        {{ __('Peticiones Stock') }}
                                    </x-jet-dropdown-link>
                                    @endcan
                                    <x-jet-dropdown-link href="{{ route('stock.movimientos') }}">
                                        {{ __('Movimientos') }}
                                    </x-jet-dropdown-link>
                                    <x-jet-dropdown-link href="{{ route('stock.producto') }}">
                                        {{ __('Por Referencia') }}
                                    </x-jet-dropdown-link>
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                    @endcan
                    @can('dashboard.index')
                    <div class="relative mt-3 ">
                        <x-jet-dropdown align="right" width="60" >
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md bg-blu hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-blue-700">
                                        Dashboard
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-44">
                                    @can('dashboard.presupuestos')
                                    <x-jet-dropdown-link href="{{ route('dashboard.presupuestos') }}">
                                        {{ __('Presupuestos ') }}
                                    </x-jet-dropdown-link>
                                    @endcan
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>

                    @endcan
                </div>
            </div>

            <div class="hidden space-x-2 sm:flex sm:items-center sm:ml-6">
                @can('administracion')
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="60" >
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md bg-blu hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-blue-700">
                                    Mantenimiento
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>
                        <x-slot name="content">
                                @can('administracion')
                                <x-jet-dropdown-link href="{{ route('administracion.index') }}" >
                                    {{ __('Administración') }}
                                </x-jet-dropdown-link>
                                @endcan
                                @can('user.index')
                                <x-jet-dropdown-link href="{{ route('users.index') }}" >
                                    {{ __('Usuarios') }}
                                </x-jet-dropdown-link>
                                @endcan
                                @can('accion.index')
                                <x-jet-dropdown-link href="{{ route('accion.index') }}" >
                                    {{ __('Acciones') }}
                                </x-jet-dropdown-link>
                                @endcan
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            @endcan
                <!-- Settings Dropdown -->
                <div class="relative ml-3">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition border border-blue-900 rounded-md bg-blue-50 hover:text-gray-700 focus:outline-none">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 ">
            @can('entidad.index')
            <div class="relative mt-3 ml-3">
                <x-jet-dropdown align="right" width="60" >
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md bg-blu hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-blue-700">
                                Contactos
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <div class="w-44">
                            <x-jet-dropdown-link href="{{ route('entidad.tipo','1') }}" class="text-right">
                                {{ __('Clientes') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('entidad.tipo','4') }}" class="text-right">
                                {{ __('Prospección') }}
                            </x-jet-dropdown-link>
                            @if(Auth::user()->hasRole('Comercial')==false)
                            <x-jet-dropdown-link href="{{ route('entidad.tipo','2') }}" class="text-right">
                                {{ __('Proveedores') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('entidad.tipo','0') }}" class="text-right">
                                {{ __('Todos') }}
                            </x-jet-dropdown-link>
                            @endif
                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            @endcan
            @can('presupuesto.index')
            <div class="relative mt-3 ml-3">
                <x-jet-nav-link href="{{ route('presupuesto.index') }}" :active="request()->routeIs('presupuesto.index')">
                    {{ __('Presupuestos') }}
                </x-jet-nav-link>
            </div>
            @endcan
            @can('producto.index')
            <div class="relative mt-3 ml-3">
                <x-jet-nav-link href="{{ route('producto.index') }}" :active="request()->routeIs('producto.index')">
                    {{ __('Productos') }}
                </x-jet-nav-link>
            </div>
            @endcan
            @can('pedido.index')
            <div class="relative mt-3 ml-3">
                <x-jet-nav-link href="{{ route('pedido.index') }}" :active="request()->routeIs('pedido.index')">
                    {{ __('Compras') }}
                </x-jet-nav-link>
            </div>
            @endcan
            @can('administracion')
            <div class="relative mt-3 ml-3">
                <x-jet-nav-link href="{{ route('administracion.index') }}" :active="request()->routeIs('administracion.index')">
                    {{ __('Administración') }}
                </x-jet-nav-link>
            </div>
            @endcan
            @can('user.index')
            <div class="relative mt-3 ml-3">
                <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                    {{ __('Usuarios') }}
                </x-jet-nav-link>
            </div>
            @endcan
            @can('stock.index')
            <div class="relative mt-3 ml-3">
                <x-jet-dropdown align="right" width="60" >
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md bg-blu hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-blue-700">
                                Stock
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <div class="w-44">
                            @can('stockpeticion.index')
                            <x-jet-dropdown-link href="{{ route('stockpeticion.index') }}">
                                {{ __('Peticiones Stock') }}
                            </x-jet-dropdown-link>
                            @endcan
                            <x-jet-dropdown-link href="{{ route('stock.movimientos') }}">
                                {{ __('Movimientos') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('stock.producto') }}">
                                {{ __('Por Referencia') }}
                            </x-jet-dropdown-link>
                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            @endcan
            @can('dashboard.index')
            <div class="relative mt-3 ml-3">
                <x-jet-dropdown align="right" width="60" >
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md bg-blu hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-blue-700">
                                Dashboard
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <div class="w-44">
                            @can('dashboard.presupuestos')
                            <x-jet-dropdown-link href="{{ route('dashboard.presupuestos') }}">
                                {{ __('Presupuestos') }}
                            </x-jet-dropdown-link>
                            @endcan
                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div>
                    <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
