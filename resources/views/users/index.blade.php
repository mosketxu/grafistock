<x-app-layout>
    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="">
                    @livewire('menu')
                    <div class="p-1 mx-2">
                        <h1 class="text-2xl font-semibold text-gray-900">Usuarios y Seguridad</h1>
                        <div class="flex flex-row flex-wrap -mx-2">
                            @livewire('usuarios')
                            @livewire('roles')
                            @livewire('permisos')
                            @livewire('configuraciones')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
