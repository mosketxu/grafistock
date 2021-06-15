<div class="">
    @livewire('menu',['producto'=>$producto],key($producto->id))

    <div class="p-1 mx-2">
        @if($producto->id)
            <h1 class="text-2xl font-semibold text-gray-900">Producto: {{ $producto->referencia }}</h1>
        @else
            <h1 class="text-2xl font-semibold text-gray-900">Nuevo Producto</h1>
        @endif
    </div>
    <div class="px-2 py-1 space-y-4" >
        @if ($errors->any())
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                <x-jet-label class="text-red-600">Verifica los errores</x-jet-label>
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
        <div class="flex items-center justify-center pb-3 ">
            <div class="grid w-11/12 bg-gray-100 rounded-lg shadow-xl md:w-9/12 lg:w-1/2">
                <div class="px-2 mx-2 my-2 rounded-md bg-blue-50">
                    <h3 class="font-semibold ">Datos del producto</h3>
                    <x-jet-input  wire:model.defer="producto.id" type="hidden"/>
                    <hr>
                </div>
                <form wire:submit.prevent="save" class="text-sm">
                    <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-6 md:gap-2 mx-7">
                        <div class="col-span-2">
                            <x-jet-label for="referencia">{{ __('Referencia') }}</x-jet-label>
                            <x-jet-input wire:model.defer="producto.referencia" type="text" class="w-full text-sm" id="referencia" name="referencia" :value="old('referencia') "/>
                            <x-jet-input-error for="referencia" class="mt-2" />
                        </div>
                        <div class="col-span-2">
                            <x-jet-label for="material_id">{{ __('Material') }}</x-jet-label>
                            <x-select wire:model.defer="producto.material_id" selectname="material_id" class="w-full">
                                <option value="">-- Selecciona --</option>
                                @foreach ($materiales as $material)
                                <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="grid grid-cols-1">
                            <x-jet-label for="grosor">{{ __('Grosor') }}</x-jet-label>
                            <x-jet-input  wire:model.defer="producto.grosor" type="number" step="all" id="grosor" name="grosor" :value="old('grosor')" class="w-full"/>
                            <x-jet-input-error for="grosor" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-1">
                            <x-jet-label for="ud_grosor">{{ __('Ud/Grosor') }}</x-jet-label>
                            <x-select wire:model.defer="producto.ud_grosor" selectname="ud_grosor" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-6 md:gap-2 mx-7">
                        <div class="col-span-3">
                            <x-jet-label for="seccion">{{ __('Seccion') }}</x-jet-label>
                            <x-select wire:model.defer="producto.seccion" selectname="seccion" class="w-full">
                                <option value="">-- Selecciona --</option>
                                @foreach ($secciones as $seccion)
                                <option value="{{ $seccion->nombre }}">{{ $seccion->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="grid grid-cols-1">
                            <x-jet-label for="alto">{{ __('Alto') }}</x-jet-label>
                            <x-jet-input  wire:model.defer="producto.alto" type="number" step="any" id="alto" name="alto" :value="old('alto')" class="w-full"/>
                            <x-jet-input-error for="alto" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-1">
                            <x-jet-label for="ancho">{{ __('ancho') }}</x-jet-label>
                            <x-jet-input  wire:model.defer="producto.ancho" type="number" step="any" id="ancho" name="ancho" :value="old('ancho')" class="w-full"/>
                            <x-jet-input-error for="ancho" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-1">
                            <x-jet-label for="ud_tamanyo">{{ __('Ud/Tamaño') }}</x-jet-label>
                            <x-select wire:model.defer="producto.ud_tamanyo" selectname="ud_tamanyo" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-4 md:gap-2 mx-7">
                        <div class="grid grid-cols-1">
                            <x-jet-label for="coste">{{ __('Coste') }}</x-jet-label>
                            <x-jet-input  wire:model.defer="producto.coste" type="number" step="any" id="coste" name="coste" :value="old('coste')" class="w-full"/>
                            <x-jet-input-error for="coste" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-1">
                            <x-jet-label for="ud_coste">{{ __('Ud/coste') }}</x-jet-label>
                            <x-select wire:model.defer="producto.ud_coste" selectname="ud_coste" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-span-2">
                            <x-jet-label for="ud_compra">{{ __('Unidad') }}</x-jet-label>
                            <x-select wire:model.defer="producto.ud_compra" selectname="ud_compra" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-5 mx-7">
                        <label class="mb-1 text-xs font-semibold text-gray-500 md:text-sm text-light">Ficha producto</label>
                        <div class='flex items-center justify-center w-full'>
                            <label class='flex flex-col w-full h-20 border-4 border-dashed hover:bg-gray-100 hover:border-purple-300 group'>
                                <div class='flex flex-col items-center justify-center pt-3'>
                                    <x-icon.pdf class="w-7 h-7"></x-icon.pdf>
                                    <p class='pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-purple-600'>Selecciona un pdf</p>
                                </div>
                                <input wire:model.defer="producto.pdf" type='file' class="hidden" />
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-5 mx-7">
                        <div class="w-full form-item">
                            <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                            <textarea wire:model.defer="producto.observaciones" class="w-full text-xs border-gray-300 rounded-md" rows="3">{{ old('observaciones') }} </textarea>
                            <x-jet-input-error for="observaciones" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 my-5 mx-7">
                        <div class="space-x-3">
                            <x-jet-button class="bg-blue-600">
                                {{ __('Guardar') }}
                            </x-jet-button>
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
                            <x-jet-secondary-button  onclick="location.href = '{{route('producto.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
