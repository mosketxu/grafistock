<x-app-layout>
    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                {{-- @livewire('stock-status',['tipo'=>'producto']) --}}
                @livewire('menu')
                Vista Stock de minimos por referencia y por material
            </div>
        </div>
    </div>
</x-app-layout>
