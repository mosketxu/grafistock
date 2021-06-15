<div class="">
    @livewire('menu',['producto'=>$producto],key($producto->id))

    <div class="p-1 mx-2">

        <h1 class="text-2xl font-semibold text-gray-900">Productos</h1>

        <div class="py-1 space-y-4">
            @if (session()->has('message'))
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                    <span class="inline-block mx-8 align-middle">
                        {{ session('message') }}
                    </span>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif
            <x-jet-validation-errors></x-jet-validation-errors>
            <div class="flex justify-between">
                <div class="flex w-2/4 space-x-2">
                    <input type="text" wire:model="search" class="py-1 border border-blue-100 rounded-lg" placeholder="Búsqueda..." autofocus/>
                </div>
                <x-button.button  onclick="location.href = '{{ route('producto.create') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo Producto') }}</x-button.button>
            </div>
            {{-- tabla entidades --}}
            <div class="flex-col space-y-4">
                <x-table>
                    <x-slot name="head">
                        {{-- <x-table.heading class="p-0 m-0 text-right w-min">{{ __('#') }}</x-table.heading> --}}
                        <x-table.heading >{{ __('Referencia') }}</x-table.heading>
                        <x-table.heading >{{ __('Material') }} </x-table.heading>
                        <x-table.heading >{{ __('Grosor') }}</x-table.heading>
                        <x-table.heading >{{ __('Ud/Grosor') }}</x-table.heading>
                        <x-table.heading >{{ __('Seccion') }}</x-table.heading>
                        <x-table.heading >{{ __('Ancho x Ancho') }}</x-table.heading>
                        <x-table.heading >{{ __('Ud/Tamaño') }}</x-table.heading>
                        <x-table.heading >{{ __('Ubicación') }}</x-table.heading>
                        <x-table.heading >{{ __('Coste') }}</x-table.heading>
                        <x-table.heading >{{ __('Ud/Coste') }}</x-table.heading>
                        <x-table.heading >{{ __('Unidad') }}</x-table.heading>
                        <x-table.heading >{{ __('PDF Ficha') }}</x-table.heading>
                        <x-table.heading colspan="2"/>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($productos as $producto)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <x-table.cell>
                                    <input type="text" value="{{ $producto->referencia }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <span class="text-sm text-gray-500 ">{{ $producto->material->nombre }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span class="text-sm text-gray-500 ">{{ $producto->grosor }}</span>
                                </x-table.cell>
                                <x-table.cell>
                                    <span class="text-sm text-gray-500 ">{{ $producto->ud_grosor }}</span>
                                </x-table.cell>
                                <x-table.cell class="text-center">
                                    <span class="text-sm text-gray-500 ">{{$producto->seccion}}</span>
                                </x-table.cell>
                                <x-table.cell class="text-center">
                                    <span class="text-sm text-gray-500 ">{{$producto->ancho}} x {{$producto->ancho}} {{ $producto->ud_tamanyo }} </span>
                                </x-table.cell>
                                <x-table.cell class="text-center">
                                    <span class="text-sm text-gray-500 ">{{$producto->ubicacion}}</span>
                                </x-table.cell>
                                <x-table.cell class="text-center">
                                    <span class="text-sm text-gray-500 ">{{$producto->coste}}</span>
                                </x-table.cell>
                                <x-table.cell class="text-center">
                                    <span class="text-sm text-gray-500 ">{{$producto->ud_coste}}</span>
                                </x-table.cell>
                                <x-table.cell class="text-center">
                                    <span class="text-sm text-gray-500 ">{{$producto->ud_compra}}</span>
                                </x-table.cell>
                                <x-table.cell class="text-center">
                                    <span class="text-sm text-gray-500 ">{{$producto->pdf}}</span>
                                </x-table.cell>
                                <x-table.cell class="px-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <x-icon.edit-a href="{{ route('producto.edit',$producto) }}"  title="Editar"/>
                                        <x-icon.delete-a wire:click.prevent="delete({{ $producto->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado prodcutos...
                                        </span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>
                <div>
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
