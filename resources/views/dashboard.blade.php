<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div> --}}

    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @if (Auth::user()->hasRole('Operario'))
                    @livewire('stock-movimientos')
                @else
                    {{-- @livewire('ents') --}}
                    @livewire('ents',['entidadtipo_id'=>$entidadtipo_id])
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
