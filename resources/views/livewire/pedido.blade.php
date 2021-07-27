<div class="">
    @livewire('menu')

    <div class="p-1 mx-2 ">
        <div class="flex flex-row">
            <h1 class="mx-2 text-2xl font-semibold text-gray-900"> {{ $pedido->pedido ? 'Pedido: ' : 'Nuevo Pedido' }} <input  wire:model.lazy="pedido.pedido" type="text" class="text-2xl font-semibold text-gray-900 border-transparent "/></h1>
        </div>
        <div class="flex justify-between">
            <div class="flex items-center w-2/4 space-x-2">
                @if($pedido->id)
                    <a href="{{ route('pedido.show',$pedido) }}" target="_blank" class="w-6 h-6 ml-2" title="Imprimir Pedido"><x-icon.printer></x-icon.printer></a>
                @endif
            </div>
            <div class="mr-10">
                <x-button.button  onclick="location.href = '{{ route('pedido.create') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo') }}</x-button.button>
            </div>
        </div>

        {{-- mensajes y errores --}}
        @if (Session::has('message'))
            <div class="py-1 mx-4 space-y-4" id="mimensaje">
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-green-200 border-green-500 rounded border-1">
                    <span class="inline-block mx-8 align-middle">
                        {{ $message }} {{ Session::get('message') }}
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
                            <x-jet-input  wire:model.defer="pedido.id" type="hidden"/>
                        </div>
                        {{-- <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-1 md:flex-justify-between"> --}}
                        <div class="flex flex-col justify-between ml-3 space-x-3 md:flex-row">
                            <div class="w-full form-item lg:w-3/12">
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
                            </div>
                            {{-- <div class="w-full form-item lg:w-1/12">
                                <x-jet-label for="pedido">{{ __('Pedido') }}</x-jet-label>
                                <input  wire:model.lazy="pedido.pedido" type="text" class="w-full text-xs bg-gray-100 border-gray-100 rounded-md shadow-sm "/>
                            </div> --}}
                            <div class="w-full form-item lg:w-1/12">
                                <x-jet-label for="fechapedido">{{ __('F.Pedido') }}</x-jet-label>
                                <input  wire:model.defer="pedido.fechapedido" type="date" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            </div>
                            <div class="w-full form-item lg:w-1/12">
                                <x-jet-label for="fecharecepcionprevista">{{ __('F.Recepcion Prev.') }}</x-jet-label>
                                <input  wire:model.defer="pedido.fecharecepcionprevista" type="date" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                            </div>
                            <div class="w-full form-item lg:w-1/12">
                                <x-jet-label for="fecharecepcion">{{ __('F.Recepcion') }}</x-jet-label>
                                <input  wire:model.defer="pedido.fecharecepcion" type="date"  class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                            </div>
                            <div class="w-full form-item lg:w-5/12">
                                <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                                <textarea  wire:model.defer="pedido.observaciones" rows="1" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                            </div>
                            <div class="w-1/12 pr-3 text-center form-item">
                                <x-button.button type="submit" color="blue" class="mt-4 focus:bg-blue-900">{{ __('Guardar') }}</x-button.button>
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
                                    >Saved!
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <hr class="my-2">

        @livewire('pedido-detailed',['pedido'=>$pedido,'showcrear'=>''],key($pedido->id))

        <div class="flex mt-2 ml-2 space-x-4">
            <div class="space-x-3">
                <x-jet-secondary-button  onclick="location.href = '{{route('pedido.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            getElementById('#mimensaje').fadeOut('fast');
                }, 3000); // <-- time in milliseconds
    </script>
</div>
