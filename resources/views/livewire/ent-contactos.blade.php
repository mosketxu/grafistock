<div class="">
    @livewire('menu')

    <div class="p-1 mx-2">

        <h1 class="text-2xl font-semibold text-gray-900">Contactos de {{ $entidad->entidad }}
        <div class="py-1 space-y-4">
            <div class="flex justify-between">
                <div class="flex w-2/4 space-x-2">
                    <input type="text" wire:model="search" class="py-1 border border-blue-100 rounded-lg" placeholder="Búsqueda..." autofocus/>
                </div>
                    <x-button.button  onclick="location.href = '{{ route('entidadcontacto.nuevo',$entidad) }}'" color="blue"><x-icon.plus/>Nuevo contacto</x-button.button>
            </div>
            {{-- tabla contactos --}}
            <div class="flex-col space-y-4">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading class="pl-4 text-left" >{{ __('Contacto') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Cargo') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Teléfono') }} </x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Móvil') }}</x-table.heading>
                        <x-table.heading class="pl-4 text-left" >{{ __('Email') }}</x-table.heading>
                        <x-table.heading colspan="2"/>
                    </x-slot>
                    <x-slot name="body">
                        @forelse ($contactos as $contacto)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <x-table.cell>
                                    <input type="text" value="{{ $contacto->contacto }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"
                                        readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $contacto->cargo}}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"
                                        readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $contacto->telefono }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"
                                        readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="text" value="{{ $contacto->movil}}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"
                                        readonly/>
                                </x-table.cell>
                                <x-table.cell>
                                    <input type="email" value="{{ $contacto->email }}" class="w-full text-sm font-thin text-gray-500 truncate border-0 rounded-md"
                                        readonly/>
                                </x-table.cell>
                                <x-table.cell class="px-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <x-icon.edit-a href="{{ route('entidadcontacto.edit',$contacto->id) }}"  title="Editar"/>
                                        <x-icon.delete-a wire:click.prevent="delete({{ $contacto->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado contactos...
                                        </span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>
                <div>
                    {{ $contactos->links() }}
                </div>
            </div>
            <div class="flex pl-2 mt-2 mb-2 ml-2 space-x-4">
                <div class="space-x-3">
                    {{-- <x-jet-button class="bg-blue-600">
                        {{ __('Guardar') }}
                    </x-jet-button> --}}
                    <x-jet-secondary-button  onclick="location.href = '{{route('entidad.edit',$entidad )}}'">{{ __('Volver') }}</x-jet-secondary-button>
                </div>
            </div>

        </div>
    </div>
</div>
