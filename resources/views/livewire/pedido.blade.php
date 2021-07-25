<div class="">
    @livewire('menu')

    <div class="p-1 mx-2">
        @if($pedido->id)
            @if ($pedido->pedido)
                <h1 class="ml-2 text-2xl font-semibold text-gray-900">Pedido {{ $pedido->pedido}}</h1>
            @else
                <h1 class="ml-2 text-2xl font-semibold text-gray-900">Pre-Pedido {{ $pedido->id}}</h1>
            @endif
        @else
            <h1 class="ml-2 text-2xl font-semibold text-gray-900">Nuevo Pedido</h1>
        @endif
        <div class="flex justify-between">
            <div class="flex items-center w-2/4 space-x-2">
                @if($pedido->bloqueado!=null)
                    <x-jet-label for="bloqueado" title="Bloqueado" class="ml-3">Pulsa &nbsp;&nbsp;<x-icon.lock-a wire:click="desbloquear"/>para desbloquear el pedido</x-jet-label>
                @else
                    @if($showgenerar && !$pedido->pedido)
                        <x-button.button  wire:click="creaPedido({{ $pedido }})" color="green">{{ __('Generar Pedido') }}</x-button.button>
                    @endif
                    @if($showgenerar && $pedido->pedido)
                        <x-button.button  wire:click="creaPedido({{ $pedido }})" color="green">{{ __('Actualiza Pedido') }}</x-button.button>
                    @endif
                    @if(!$showgenerar && $pedido->pedido)
                        <x-icon.pdf-a wire:click="presentaPDF({{ $pedido }})" class="pt-2 ml-2" title="PDF"/>
                    @endif
                @endif
            </div>
            <x-button.button  onclick="location.href = '{{ route('pedido.create') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo') }}</x-button.button>
        </div>

        {{-- mensajes y errores --}}
        @if ($message)
            <div class="py-1 mx-4 space-y-4">
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                    <span class="inline-block mx-8 align-middle">
                        {{ $message }}
                    </span>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="py-1 mx-4 space-y-4">
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                    <x-jet-label class="text-red">Verifica los errores</x-jet-label>
                    <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            </div>
        @endif
        {{-- <x-jet-validation-errors/> --}}

        {{-- formulario --}}

        <div class="flex-col text-gray-500 rounded-lg">
            <form wire:submit.prevent="save" >
                <div class="flex">
                    <div class="flex-initial w-full py-2 mr-1 bg-white rounded-lg shadow-md">
                        <div class="px-2 mx-2 my-1 bg-blue-100 rounded-md">
                            <h3 class="font-semibold ">Datos Pedido</h3>
                            <x-jet-input  wire:model.defer="pedido.id" type="hidden"  id="id" name="id" :value="old('id')"/>
                        </div>
                        {{-- <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-1 md:flex-justify-between"> --}}
                        <div class="flex flex-col justify-between ml-3 space-x-3 md:flex-row">
                            <div class="w-3/12 form-item">
                                @if($pedido->bloqueado!=1)
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ __('Proveedor') }}
                                        @if($pedido->entidad_id!='')
                                            <x-icon.filter-slash-a wire:click="$set('pedido.entidad_id', '')" class="pb-1" title="reset"/>
                                        @endif
                                    </label>
                                    <x-select wire:model="pedido.entidad_id" selectname="entidad_id" class="w-full" autofocus >
                                        <option value="">-- choose --</option>
                                        @foreach ($entidades as $entidad)
                                            <option value="{{ $entidad->id }}">{{ $entidad->entidad }}</option>
                                        @endforeach
                                    </x-select>
                                @else
                                    <x-jet-label>{{ __('Proveedor') }}</x-jet-lab>
                                    <input  value="{{ $pedido->entidad->entidad }}" type="text" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ $deshabilitado }}/>
                                @endif
                            </div>
                            <div class="w-1/12 form-item">
                                <x-jet-label for="pedido">{{ __('Pedido') }}</x-jet-label>
                                <input  wire:model.defer="pedido.pedido" type="text" class="w-full text-xs bg-gray-100 border-gray-100 rounded-md shadow-sm " disabled/>
                            </div>
                            <div class="w-1/12 form-item">
                                <x-jet-label for="fechapedido">{{ __('F.Pedido') }}</x-jet-label>
                                <input  wire:model.defer="pedido.fechapedido" type="date" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ $deshabilitado }}/>
                            </div>
                            <div class="w-1/12 form-item">
                                <x-jet-label for="fecharecepcionprevista">{{ __('F.Recepcion Prev.') }}</x-jet-label>
                                <input  wire:model.defer="pedido.fecharecepcionprevista" type="date" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ $deshabilitado }}/>
                            </div>
                            <div class="w-1/12 form-item">
                                <x-jet-label for="fecharecepcion">{{ __('F.Recepcion') }}</x-jet-label>
                                <input  wire:model.defer="pedido.fecharecepcion" type="date"  class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ $deshabilitado }}/>
                            </div>
                            <div class="w-5/12 form-item">
                                <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                                <textarea  wire:model.defer="pedido.observaciones" rows="1" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ $deshabilitado }}></textarea>
                            </div>
                            @if(!$pedido->bloqueado)
                                @if($showgenerar)
                                <div class="w-1/12 pr-3 text-right form-item">
                                    {{-- <x-jet-button class="mt-5 bg-blue-600">{{ __('Guardar') }}</x-jet-button> --}}
                                    <x-button.button type="submit" color="blue" class="mt-4">{{ __('Guardar') }}</x-button.button>
                                        <span
                                            x-data="{ open: false }"
                                            x-init="
                                                @this.on('notify-saved', () => {
                                                    if (open === false) setTimeout(() => { open = false }, 2500);
                                                    open = true;
                                                })
                                            "
                                            x-show.transition.out.duration.1000ms="open"
                                            style="display: none;"
                                            class="p-2 m-2 text-gray-500 rounded-lg bg-green-50"
                                            >Saved!</span>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                {{-- <div class="flex mt-2 ml-4 space-x-4">
                    @if($showgenerar)
                        <div class="space-x-3">
                            <x-jet-button class="bg-blue-600">{{ __('Guardar') }}</x-jet-button>
                            <span
                                x-data="{ open: false }"
                                x-init="
                                    @this.on('notify-saved', () => {
                                        if (open === false) setTimeout(() => { open = false }, 2500);
                                        open = true;
                                    })
                                "
                            x-show.transition.out.duration.1000ms="open"
                            style="display: none;"
                            class="p-2 m-2 text-gray-500 rounded-lg bg-green-50"
                            >Saved!</span>
                        </div>
                    @endif
                </div> --}}
            </form>
        </div>

        <hr class="my-2">

        @livewire('pedido-detailed',['pedido'=>$pedido,'showcrear'=>''],key($pedido->id))
        <div class="flex mt-0 ml-4 space-x-4">
            <div class="space-x-3">
                <x-jet-secondary-button  onclick="location.href = '{{route('pedido.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
            </div>
        </div>
    </div>
</div>
