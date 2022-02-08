<div class="">
    @livewire('menu',['producto'=>$producto],key($producto->id))

    <div class="h-full p-1 mx-2">

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
                <div class="flex w-10/12 space-x-3">
                    @include('producto.productofilters')
                </div>
                <div class="flex flex-row-reverse w-2/12">
                    <div class="pt-3">
                        <x-button.button  onclick="location.href = '{{ route('producto.create') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo') }}</x-button.button>
                    </div>
                </div>
            </div>
            {{-- tabla entidades --}}
            <div class="flex-col space-y-4">
                <x-table>
                    <x-slot name="head">
                        {{-- <x-table.heading class="p-0 m-0 text-right w-min">{{ __('#') }}</x-table.heading> --}}
                        <x-table.heading class="pl-1 text-left">{{ __('Referencia') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Descripcion') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Proveedor') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Familia') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Tipo') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Material') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Grosor') }} <br> (mm)</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Ancho') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Alto') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Acabado') }}</x-table.heading>
                        <x-table.heading class="pr-2 text-right">{{ __('€ Coste') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-center">{{ __('Ud Solic.') }}</x-table.heading>
                        <x-table.heading class="pr-2 text-right">{{ __('€ Compra') }}</x-table.heading>
                        {{-- <x-table.heading class="pl-1 text-left">{{ __('Ficha') }}</x-table.heading> --}}
                        <x-table.heading colspan="2"/>
                    </x-slot>

                    <x-slot name="body">
                        @forelse ($productos as $producto)
                            <x-table.row wire:loading.class.delay="opacity-50">

                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->referencia }}</td>
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->descripcion }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->entidad->entidad ?? '-'}}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->familia->nombre  ?? '-' }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->tipo->nombrecorto ?? '-' }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->material->nombre ?? '-' }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->grosor_mm }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->ancho}} {{ $producto->unidadancho->nombrecorto ?? '-' }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->alto }} {{ $producto->unidadalto->nombrecorto ?? '-' }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->acabado->nombre ?? '-' }}</td >
                                <td class="pr-2 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->preciocoste }} {{ $producto->unidadpreciocoste->nombrecorto ?? '-' }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-center text-gray-600 whitespace-no-wrap">{{ $producto->unidadsolicitud->nombrecorto ?? '-' }}</td >
                                <td class="pr-2 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->preciocompra }} {{ $producto->unidadpreciocompra->nombrecorto ?? '-' }}</td >
                                <td  class="px-1">
                                    <div class="flex">
                                        @if($producto->fichaproducto)
                                            <x-icon.pdf-a wire:click="presentaPDF({{ $producto }})" title="PDF"/>
                                        @else
                                            <x-icon.pdf-b class="text-blue-100 " title="PDF"/>
                                        @endif

                                        @can('producto.edit')
                                            <x-icon.edit-a href="{{ route('producto.edit',$producto) }}"  title="Editar"/>
                                        @endcan
                                        @can('producto.delete')
                                            <x-icon.delete-a wire:click.prevent="delete({{ $producto->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
                                        @endcan
                                    </div>
                                </td >

                            </x-table.row>
                        @empty
                            <x-table.row>
                                <td  colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado productos...
                                        </span>
                                    </div>
                                </td >
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
@push('scripts')
    <script>
    </script>
@endpush
