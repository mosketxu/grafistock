<div class="">
    @livewire('menu',['entidad'=>$entidad],key($entidad->id))

    <div class="p-1 mx-2">

        <h1 class="text-2xl font-semibold text-gray-900"> {{ $clipro_id=='1' ? 'Clientes' : 'Proveedores' }}</h1>
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
                @if($clipro_id=='1')
                    <x-button.button  onclick="location.href = '{{ route('entidad.nueva','Cliente') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo Cliente') }}</x-button.button>
                @else
                    <x-button.button  onclick="location.href = '{{ route('entidad.nueva','Proveedor') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo Proveedor') }}</x-button.button>
                @endif
            </div>
            {{-- tabla entidades --}}
            <div class="flex-col space-y-4">
                <x-table>
                    <x-slot name="head">
                        {{-- <x-table.heading class="p-0 m-0 text-right w-min">{{ __('#') }}</x-table.heading> --}}
                        <x-table.heading class="pl-4 text-left" >{{ __('Proveedor') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Nif') }} </x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Dirección') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('CP') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Localidad') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Tfno.') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Email.') }}</x-table.heading>
                        <x-table.heading colspan="2"/>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($entidades as $entidad)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <x-table.cell>
                                    <input type="text" value="{{ $entidad->entidad }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $entidad->nif }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $entidad->direccion }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $entidad->cp }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $entidad->localidad }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $entidad->tfno }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $entidad->emailgral }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </x-table.cell>
                                <x-table.cell class="px-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <x-icon.edit-a href="{{ route('entidad.edit',$entidad) }}"  title="Editar"/>
                                        <x-icon.delete-a wire:click.prevent="delete({{ $entidad->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado proveedores...
                                        </span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>
                <div>
                    {{ $entidades->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
