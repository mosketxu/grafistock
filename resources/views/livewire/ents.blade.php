<div class="">
    @livewire('menu')

    <div class="p-1 mx-2">

        <h1 class="text-2xl font-semibold text-gray-900">{{ $entidadtipo->nombreplural }}
        <div class="py-1 ">
            @if (session()->has('message'))
                <div id="alert" class="relative px-6 py-2 mb-2 text-white border-red-500 rounded border-1">
                    <span class="inline-block mx-8 align-middle">
                        {{ session('message') }}
                    </span>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif
            <x-jet-validation-errors></x-jet-validation-errors>
            <div class="flex-none w-full xl:flex xl:space-x-2">
                <div class="w-full pb-2 text-xs xl:w-4/12">
                    <input type="text" wire:model="search" class="w-full py-1 border border-blue-100 rounded-lg" placeholder="Búsqueda por nombre o nif..." autofocus/>
                </div>
                <div class="items-center w-full pb-2 text-xs xl:w-4/12 xl:flex">
                    {{-- <div class="items-center flex-none xl:flex "> --}}
                        <label class="items-center mr-1 text-base">F.Alta</label>
                        <input type="date" wire:model="Fini" class="py-1 mr-1 border border-blue-100 rounded-lg "/>
                        <input type="date" wire:model="Ffin" class="py-1 border border-blue-100 rounded-lg "/>
                    {{-- </div> --}}
                </div>
                <div class="w-full pb-2 text-xs xl:w-2/12">
                    @if(Auth::user()->hasRole('Admin'))
                        <div class="flex">
                            <label class="items-center mx-2 mt-1 text-base">Comercial</label>
                            <select wire:model="filtrocomercial" class="w-full py-1 border border-blue-100 rounded-lg" >
                                <option value=""></option>
                                @foreach ($comerciales as $comercial)
                                <option value="{{ $comercial->id }}">{{ $comercial->name }}</option>
                                @endforeach
                            </select>
                            @if($filtrocomercial!='')
                            <x-icon.filter-slash-a wire:click="$set('filtrocomercial', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="flex flex-row-reverse items-center w-2/12">
                    <x-button.button  onclick="location.href = '{{ route('entidad.nueva',$entidadtipo->id) }}'" color="blue" class="h-8">Nuevo</x-button.button>
                </div>
            </div>
            {{-- tabla entidades --}}
            <div class="flex items-center py-1 pl-4 text-sm font-bold text-gray-600 bg-blue-50 rounded-t-md">
                <div class="w-5/12 xl:w-2/12" >{{ __('Entidad') }}</div>
                <div class="w-2/12 xl:w-2/12" >{{ __('Tipo') }}</div>
                <div class="w-2/12" >{{ __('Nif') }} </div>
                @if(in_array($entidadtipo->nombrecorto,['Cli','CliPro','Prop']))
                    <div class="hidden xl:w-1/12 xl:flex" >{{ __('Cat.Empresa') }}  </div>
                    <div class="hidden xl:w-1/12 xl:flex" >{{ __('F.Alta') }}  </div>
                @endif
                @if(in_array($entidadtipo->nombrecorto,['Cli','CliPro']) && Auth::user()->hasRole(['Admin','Gestor']))
                    <div class="hidden xl:w-1/12 xl:flex" >{{ __('I.A.') }}</div>
                @endif
                <div class="w-2/12 xl:w-1/12 xl:flex" >{{ __('Comercial') }}</div>
                <div class="hidden xl:w-1/12 xl:flex" >{{ __('Localidad') }}</div>
                <div class="hidden xl:w-1/12 xl:flex" >{{ __('Tfno.') }}</div>
                <div class="hidden xl:w-1/12 xl:flex" >{{ __('Email.') }}</div>
                <div class="w-1/12"></div>
            </div>
            @forelse ($entidades as $entidad)
            <div class="flex hover:bg-gray-100" wire:loading.class.delay="opacity-50" >
                <div class="w-5/12 xl:w-2/12"><input type="text" value="{{ $entidad->entidad }}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/></div>
                <div class="w-2/12 xl:w-2/12"><input type="text" value="{{ $entidad->entidadtipo->nombre ?? '-'}}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/></div>
                <div class="w-2/12"><input type="text" value="{{ $entidad->nif }}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/></div>
                @if(in_array($entidadtipo->nombrecorto,['Cli','CliPro','Prop']))
                <div class="hidden py-0.5 xl:w-1/12 xl:flex">
                    @if(Auth::user()->hasRole(['Admin', 'Gestion']))
                        <select   wire:change="changeValor({{ $entidad }},'empresatipo_id',$event.target.value)"
                            class="w-full py-0.5 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @foreach ($empresatipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ $tipo->id== $entidad->empresatipo_id? 'selected' : '' }}>{{ $tipo->nombrecorto }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" value="{{ $entidad->empresatipo->nombrecorto }}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/>
                    @endif
                </div>
                <div class="hidden xl:w-1/12 xl:flex">
                    <input type="text" value="{{ $entidad->fechacli }}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/>
                </div>
                @endif
                @if(in_array($entidadtipo->nombrecorto,['Cli','CliPro']) && Auth::user()->hasRole(['Admin','Gestor']))
                <div class="items-center hidden xl:w-1/12 xl:flex">
                    <input type="checkbox" {{ $entidad->incrementoanual==true ? 'checked' : '' }}
                        wire:change="changeIA({{ $entidad }},$event.target.value)"
                    class="" />
                </div>
                @endif
                <div class="w-2/12 py-0.5 xl:w-1/12 xl:flex">
                    @if(Auth::user()->hasRole(['Admin']))
                        <select wire:change="changeValor({{ $entidad }},'comercial_id',$event.target.value)"
                            class="w-full text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm hover:border-gray-400 focus:outline-none">
                        @foreach ($comerciales as $comercial)
                            <option value="{{ $comercial->id }}" {{ $comercial->id== $entidad->comercial_id? 'selected' : '' }}>{{ $comercial->name }}</option>
                        @endforeach
                    </select>
                    @else
                        <input type="text" value="{{ $entidad->comercial->name ?? 'no def'}}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/>
                    @endif
                </div>
                <div class="hidden xl:w-1/12 xl:flex"><input type="text" value="{{ $entidad->localidad }}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/></div>
                <div class="hidden xl:w-1/12 xl:flex"><input type="text" value="{{ $entidad->tfno }}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/></div>
                <div class="hidden xl:w-1/12 xl:flex"><input type="text" value="{{ $entidad->emailgral }}" class="w-full py-1 text-sm font-thin text-gray-500 truncate bg-transparent border-0 rounded-md"  readonly/></div>
                <div class="flex items-center justify-center w-1/12 py-1">
                    <x-icon.edit-a href="{{ route('entidad.edit',$entidad) }}"  title="Editar"/>
                    <x-icon.usergroup href="{{ route('entidadcontacto.show',$entidad->id) }}"  title="Contactos"/>
                    <x-icon.delete-a wire:click.prevent="delete({{ $entidad->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
                </div>
            </div>
            @empty
                <div class="flex items-center justify-center">
                    <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                    <span class="py-5 text-xl font-medium text-gray-500">
                        No se han encontrado proveedores...
                    </span>
                </div>
            @endforelse
            <div>
                {{ $entidades->links() }}
            </div>
        </div>
    </div>
</div>
