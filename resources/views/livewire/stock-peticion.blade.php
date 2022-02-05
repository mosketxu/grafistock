<div class="">
    @livewire('menu')

    <div class="p-1 mx-2">
        <div class="flex flex-row space-x-3" >
            @if($stockpeticion->id)
                <h1 class="text-2xl font-semibold text-gray-900">Peticion de Stock: {{ $stockpeticion->peticion }}</h1>
            @else
                <h1 class="text-2xl font-semibold text-gray-900">Nueva Peticion de Stock</h1>
            @endif
            <x-button.button  onclick="location.href = '{{ route('stockpeticion.create') }}'" color="blue" >{{ __('Nuevo') }}</x-button.button>
        </div>
    </div>

    {{-- zona errores y mensajes --}}

    <div class="px-2 py-1 space-y-4" >
        @if ($errors->any())
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                    <span>×</span>
                </button>
            </div>
        @endif
        @if (session()->has('message'))
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-green-200 border-green-500 rounded border-1" >
                <span class="inline-block mx-8 align-middle" >
                    {{ session('message') }}
                </span>
                <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                    <span>×</span>
                </button>
            </div>
        @endif
    </div>
    {{-- <x-jet-validation-errors/> --}}

    <div class="h-screen">
        <div class="flex-col space-y-4 text-gray-500">
            {{-- formulario datos --}}
            <form wire:submit.prevent="save" class="text-sm">
                <div class="p-2 m-2 border border-blue-300 rounded shadow-md ">
                    <input  wire:model.defer="stockpeticion.id" type="hidden"/>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-2/12 form-item">
                            <x-jet-label for="solicitante_id">{{ __('Solicitante') }}</x-jet-label>
                            <x-select wire:model.defer="stockpeticion.solicitante_id" selectname="entidad_id" class="w-full" required>
                                <option value="">-- Selecciona Solicitante --</option>
                                @foreach ($solicitantes as $solicitante)
                                <option value="{{ $solicitante->id }}">{{ $solicitante->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-2/12 form-item">
                            <x-jet-label for="fechasolicitud">{{ __('Fecha Solicitud') }}</x-jet-label>
                            <input wire:model.defer="stockpeticion.fechasolicitud" type="date" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                        </div>

                        <div class="w-8/12 form-item">
                            <x-jet-label for="peticion">{{ __('Petición') }}</x-jet-label>
                            <textarea wire:model.defer="stockpeticion.peticion" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></textarea>
                            {{-- <textarea wire:model="stockpeticion.peticion" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required></
                            <input wire:model="stockpeticion.peticion" type="text" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/> --}}
                        </div>

                    </div>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-2/12 form-item">
                            <label class="px-1 text-gray-600">
                                {{ __('Fecha Realizado') }}

                            </label>
                            <div class="flex">
                                <input wire:model="stockpeticion.fecharealizado" type="date" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                                @if($stockpeticion->fecharealizado)
                                    <x-icon.cross-a wire:click="borrafecharealizado" class="m-2" title="reset fecha"/>
                                @endif
                            </div>
                        </div>
                        <div class="w-2/12 form-item">
                            <x-jet-label for="estado">{{ __('Estado') }}</x-jet-label>
                            <x-select wire:model.defer="stockpeticion.estado" selectname="estado" class="w-full" required>
                                <option value="{{ 0 }}">Pendiente</option>
                                <option value="{{ 1 }}">Curso</option>
                                <option value="{{ 2 }}">Finalizado</option>
                            </x-select>
                        </div>
                        <div class="w-8/12 form-item">
                            <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                            <textarea wire:model="stockpeticion.observaciones" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex mt-2 mb-2 ml-2 space-x-4">
                    <div class="space-x-3">
                        <x-jet-button class="bg-blue-600">{{ __('Guardar') }}</x-jet-button>
                        <x-jet-secondary-button  onclick="location.href = '{{route('stockpeticion.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
