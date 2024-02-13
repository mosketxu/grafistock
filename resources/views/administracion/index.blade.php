<x-app-layout>
    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="">
                    @livewire('menu')
                    <div class="p-1 mx-2">
                        <h1 class="text-2xl font-semibold text-gray-900">Administración</h1>
                        {{-- Cards --}}
                        <div class="mx-auto ">
                            <div class="flex flex-row flex-wrap -mx-2">
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('familias')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('producto-tipos')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('materiales')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('acabados')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('grupos-produccion')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('unidades-coste')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('unidades')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('solicitantes')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('cajas')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('ubicaciones')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    @livewire('metodo-pagos')
                                </div>
                                <div class="w-full px-2 mb-4 md:w-1/3 lg:w-1/4">
                                    {{-- @livewire('configuraciones') --}}
                                </div>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
