<x-app-layout>
    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="">
                    @livewire('menu')
                    <div class="p-1 mx-2">
                        <h1 class="text-2xl font-semibold text-gray-900">Administración comercial</h1>
                        {{-- Cards --}}
                        {{-- <div class="mx-auto "> --}}
                            <div class="w-full px-2 mb-4">
                                @livewire('acciones')
                            </div>
                            <div class="flex">
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/2">
                                    @livewire('accion-tipos')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/2">
                                    @livewire('empresa-tipos')
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
