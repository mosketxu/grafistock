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
                    <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">
                            Ref./Descrip.
                            @if($search!='')
                                <x-icon.filter-slash-a wire:click="$set('search', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <input type="text" wire:model="search" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Búsqueda Entidad/Factura" autofocus/>
                    </div>
                    <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">
                            Proveedor
                            @if($filtroproveedor!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroproveedor', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtroproveedor" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-3/12 text-xs">
                        <label class="px-1 text-gray-600">
                            Material
                            @if($filtromaterial!='')
                                <x-icon.filter-slash-a wire:click="$set('filtromaterial', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtromaterial" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($materiales as $mat)
                            <option value="{{ $mat->id }}">{{ $mat->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">
                            Acabado
                            @if($filtroacabado!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroacabado', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtroacabado" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($acabados as $acabado)
                            <option value="{{ $acabado->id }}">{{ $acabado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">
                            Grupo Producción
                            @if($filtrogrupoprod!='')
                                <x-icon.filter-slash-a wire:click="$set('filtrogrupoprod', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtrogrupoprod" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($gruposprod as $grupoprod)
                            <option value="{{ $grupoprod->id }}">{{ $grupoprod->nombre }}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
                        {{-- <x-table.heading class="pl-1 text-left">{{ __('Ubicación') }}</x-table.heading> --}}
                        <x-table.heading class="pl-1 text-left">{{ __('Tipo') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Material') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Grosor') }} <br> (mm)</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Ancho') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Alto') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Acabado') }}</x-table.heading>
                        {{-- <x-table.heading class="pl-1 text-left">{{ __('Grupo Producción') }}</x-table.heading> --}}
                        {{-- <x-table.heading class="pl-1 text-left">{{ __('Clase') }}</x-table.heading> --}}
                        <x-table.heading class="pl-1 text-left">{{ __('Familia') }}</x-table.heading>
                        <x-table.heading class="pr-2 text-right">{{ __('Coste Prov') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Ud Solic.') }}</x-table.heading>
                        <x-table.heading class="pr-2 text-right">{{ __('Coste Grafitex') }}</x-table.heading>
                        {{-- <x-table.heading class="pl-1 text-left">{{ __('Caja') }}</x-table.heading>
                        <x-table.heading class="pr-2 text-right">{{ __('Coste Caja') }}</x-table.heading> --}}
                        <x-table.heading class="pl-1 text-left">{{ __('Ficha') }}</x-table.heading>
                        {{-- <x-table.heading class="pl-1 text-left">{{ __('Obs') }}</x-table.heading> --}}
                        <x-table.heading colspan="2"/>
                    </x-slot>

                    <x-slot name="body">
                        @forelse ($productos as $producto)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->referencia }}</td>
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->descripcion }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->entidad->entidad }}</td >
                                {{-- <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->ubicacion_id}}</td > --}}
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->tipo->nombrecorto }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->material->nombre ?? '-' }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->grosor_mm }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->ancho}} {{ $producto->udancho_id }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->alto }} {{ $producto->udalto_id }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->acabado->nombre ?? '-' }}</td >
                                {{-- <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->grupoproduccion->nombre ?? '-' }}</td > --}}
                                {{-- <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->clase->nombre ?? '-'}}</td > --}}
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->familia->nombre  ?? '-' }}</td >
                                <td class="pr-2 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->costeprov }} {{ $producto->udproducto_id }}</td >
                                <td class="px-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->udsolicitud_id }}</td >
                                <td class="pr-2 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->costegrafitex }} {{ $producto->udcoste_id }}</td >
                                {{-- <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">{{ $producto->caja->nombre ?? '-' }}</td >
                                <td class="pr-2 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">{{ $producto->costecaja }}</td > --}}
                                <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">
                                    @if($producto->fichaproducto)
                                        <x-icon.pdf-a wire:click="presentaPDF({{ $producto }})" class="pt-2 ml-2" title="PDF"/>
                                    @else
                                        <x-icon.pdfc class="w-5 h-5 pt-2 ml-2 text-blue-100" title="PDF"/>
                                    @endif
                                </td>
                                <td  class="px-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <x-icon.edit-a href="{{ route('producto.edit',$producto) }}"  title="Editar"/>
                                        <x-icon.delete-a wire:click.prevent="delete({{ $producto->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
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
