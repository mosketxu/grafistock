<div class="">
    @livewire('menu')

    <div class="p-1 mx-2">
        @if($pedido->id)
            <h1 class="text-2xl font-semibold text-gray-900">Pedido {{ $pedido->id}} - {{ $pedido->pedido}}</h1>
        @else
            <h1 class="text-2xl font-semibold text-gray-900">Nuevo Pedido</h1>
        @endif
        <div class="flex justify-between">
            <div class="flex w-2/4 space-x-2">
                {{-- @if($showgenerar && !$pedido->pedido) --}}
                    {{-- <x-button.button  wire:click="creaPedido({{ $pedido }})" color="green">{{ __('Generar Pedido') }}</x-button.button> --}}
                {{-- @endif
                @if($showgenerar && $pedido->pedido) --}}
                    {{-- <x-button.button  wire:click="creaPedido({{ $pedido }})" color="green">{{ __('Actualiza Pedido') }}</x-button.button> --}}
                {{-- @endif
                @if(!$showgenerar) --}}
                    {{-- <x-icon.pdf-a wire:click="presentaPDF({{ $pedido }})" class="pt-2 ml-2" title="PDF"/> --}}
                {{-- @endif --}}
            </div>
            <x-button.button  onclick="location.href = '{{ route('pedido.create') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo Pedido') }}</x-button.button>
        </div>

        <div class="py-1 mx-4 space-y-4">
            @if ($message)
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                    <span class="inline-block mx-8 align-middle">
                        {{ $message }}
                    </span>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
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
            @endif
            {{-- <x-jet-validation-errors/> --}}

        </div>
        <div class="flex-col my-2 text-gray-500 rounded-lg">
            <form wire:submit.prevent="save" >
                <div class="flex">
                    <div class="flex-initial w-8/12 py-2 mr-1 bg-white rounded-lg shadow-md">
                        <div class="px-2 mx-2 my-1 bg-blue-100 rounded-md">
                            <h3 class="font-semibold ">Datos Pedido</h3>
                            <x-jet-input  wire:model.defer="pedido.id" type="hidden"  id="id" name="id" :value="old('id')"/>
                        </div>
                        <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-1">
                            <div class="form-item">
                                <x-jet-label for="entidad_id">{{ __('Proveedor') }}</x-jet-label>
                                <x-select wire:model.defer="pedido.entidad_id" selectname="entidad_id" class="w-full">
                                    <option value="">-- choose --</option>
                                    @foreach ($entidades as $entidad)
                                        <option value="{{ $entidad->id }}">{{ $entidad->entidad }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="form-item">
                                <x-jet-label for="pedido">{{ __('pedido') }}</x-jet-label>
                                <x-jet-input  wire:model.defer="pedido.pedido" type="text"  id="pedido" name="pedido" :value="old('pedido') " class="w-full bg-gray-100"/>
                                <x-jet-input-error for="pedido" class="mt-2" />
                            </div>
                            <div class="form-item">
                                <x-jet-label for="fechapedido">{{ __('F.Pedido') }}</x-jet-label>
                                <x-jet-input  wire:model.defer="pedido.fechapedido" type="date"  id="fechapedido" name="fechapedido" :value="old('fechapedido') "  class="w-full"/>
                                <x-jet-input-error for="fechapedido" class="mt-2" />
                            </div>
                            <div class="form-item">
                                <x-jet-label for="fecharecepcionprevista">{{ __('F.Recepcion Prev.') }}</x-jet-label>
                                <x-jet-input  wire:model.defer="pedido.fecharecepcionprevista" type="date"  id="fecharecepcionprevista" name="fecharecepcionprevista" :value="old('fecharecepcionprevista') "  class="w-full"/>
                                <x-jet-input-error for="fecharecepcionprevista" class="mt-2" />
                            </div>
                            <div class="form-item">
                                <x-jet-label for="fecharecepcion">{{ __('F.Recepcion') }}</x-jet-label>
                                <x-jet-input  wire:model.defer="pedido.fecharecepcion" type="date"  id="fecharecepcion" name="fecharecepcion" :value="old('fecharecepcion') "  class="w-full"/>
                                <x-jet-input-error for="fecharecepcion" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-1">
                            <div class="w-full form-item">
                                <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                                <x-jet-input  wire:model.defer="pedido.observaciones" type="text"  id="observaciones" name="observaciones" :value="old('observaciones') " class="w-full"/>
                                <x-jet-input-error for="observaciones" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex mt-2 ml-4 space-x-4">
                    {{-- @if($showgenerar) --}}
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
                    {{-- @endif --}}
                </div>
            </form>
        </div>

        <hr class="my-2">

        @livewire('pedido-detalle',['pedido'=>$pedido,'showcrear'=>''],key($pedido->id))

        <div class="flex mt-0 ml-4 space-x-4">
            <div class="space-x-3">
                <x-jet-secondary-button  onclick="location.href = '{{route('pedido.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
            </div>
        </div>

    </div>

</div>
