<div class="">
    @livewire('menu',['producto'=>$producto],key($producto->id))

    <div class="p-1 mx-2">
        @if($producto->id)
            <h1 class="text-2xl font-semibold text-gray-900">Producto: {{ $producto->referencia }}</h1>
        @else
            <h1 class="text-2xl font-semibold text-gray-900">Nuevo Producto</h1>
        @endif
    </div>

    {{-- zona errores y mensajes --}}

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
        <div class="flex-col space-y-4 text-gray-500">
            {{-- formulario datos --}}
            <form wire:submit.prevent="save" class="text-sm">
                <div class="p-2 m-2 border border-blue-300 rounded shadow-md ">
                    <div class="p-1 rounded-md bg-blue-50">
                        <h3 class="pl-1 font-semibold">Producto</h3>
                        <input  wire:model.defer="producto.id" type="hidden"/>
                    </div>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-2/12 form-item">
                            <x-jet-label for="referencia">{{ __('Referencia') }}</x-jet-label>
                            <input wire:model.defer="producto.referencia" type="text" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                        </div>
                        <div class="w-10/12 form-item">
                            <x-jet-label for="descripcion">{{ __('Descripción') }}</x-jet-label>
                            <input wire:model="producto.descripcion" type="text" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" autofocus/>
                        </div>
                    </div>
                </div>
                <div class="p-2 m-2 border border-blue-300 rounded shadow-md ">
                    <div class="p-1 rounded-md bg-blue-50">
                        <h3 class="pl-1 font-semibold">Especificaciones</h3>
                    </div>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-full form-item">
                            <x-jet-label for="tipo_id">{{ __('Tipo') }} </x-jet-label>
                            <x-select wire:model="producto.tipo_id" selectname="tipo_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->sigla }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="material_id">{{ __('Material') }} {{ $producto->material_id }}</x-jet-label>
                            <x-select wire:model="producto.material_id" selectname="material_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($materiales as $material)
                                <option value="{{ $material->sigla }}">{{ $material->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="acabado_id">{{ __('Acabado') }} </x-jet-label>
                            <x-select wire:model="producto.acabado_id" selectname="acabado_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($acabados as $acabado)
                                <option value="{{ $acabado->sigla }}">{{ $acabado->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="grupoproduccion_id">{{ __('Grupo.Prod') }} </x-jet-label>
                            <x-select wire:model="producto.grupoproduccion_id" selectname="grupoproduccion_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($gruposprod as $grupo)
                                <option value="{{ $grupo->sigla }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="clase_id">{{ __('Clase') }} </x-jet-label>
                            <x-select wire:model="producto.clase_id" selectname="clase_id" class="w-full" >
                                <option value="">-- Selecciona --</option>
                                @foreach ($clases as $clase)
                                <option value="{{ $clase->sigla }}">{{ $clase->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="calidad_id">{{ __('Calidad') }} </x-jet-label>
                            <x-select wire:model="producto.calidad_id" selectname="calidad_id" class="w-full" >
                                <option value="">-- Selecciona --</option>
                                @foreach ($calidades as $calidad)
                                <option value="{{ $calidad->sigla }}">{{ $calidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </div>
                <div class="p-2 m-2 border border-blue-300 rounded shadow-md ">
                    <div class="p-1 rounded-md bg-blue-50">
                        <h3 class="pl-1 font-semibold">Tamaño</h3>
                    </div>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-full form-item">
                            <x-jet-label for="ancho_mm">{{ __('Ancho(mm)') }}</x-jet-label>
                            <input  wire:model="producto.ancho_mm" type="number" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="desarrollo_mm">{{ __('Desarrollo(mm)') }}</x-jet-label>
                            <input  wire:model="producto.desarrollo_mm" type="number" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="grosor">{{ __('Grosor (mm)') }}</x-jet-label>
                            <input  wire:model.defer="producto.grosor_mm" type="number" step="any" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="ficheropdf">{{ __('Ficha producto') }} <span class="text-xs">{{ $producto->fichaproducto }}</span></x-jet-label>
                            <input type="file" wire:model="ficheropdf">
                            @error('ficheropdf') <p class="text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
                <div class="p-2 m-2 border border-blue-300 rounded shadow-md ">
                    <div class="p-1 rounded-md bg-blue-50">
                        <h3 class="pl-1 font-semibold ">Proveedor</h3>
                    </div>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-full form-item">
                            <x-jet-label for="entidad_id">{{ __('Proveedor') }}</x-jet-label>
                            <x-select wire:model="producto.entidad_id" selectname="entidad_id" class="w-full" required>
                                <option value="">-- Selecciona proveedor --</option>
                                @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="w-full form-item">
                            <x-jet-label for="costeprov">{{ __('Coste Prov') }}</x-jet-label>
                            <input  wire:model.defer="producto.costeprov" type="number" step="any" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="udcoste_id">{{ __('Ud/coste Prov') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udcoste_id" selectname="udcoste_id" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="costegrafitex">{{ __('Coste Grafitex') }}</x-jet-label>
                            <input  wire:model.defer="producto.costegrafitex" type="number" step="any" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                        </div>

                        <div class="w-full form-item">
                            <x-jet-label for="udproducto_id">{{ __('Ud Producto') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udproducto_id" selectname="udproducto_id" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="udsolicitud_id">{{ __('Ud Solicitud') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udsolicitud_id" selectname="udsolicitud_id" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->nombre }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>

                    </div>
                </div>
                <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                    <div class="w-full form-item">
                        <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                        <textarea wire:model.defer="producto.observaciones" class="w-full text-xs border-gray-300 rounded-md" rows="3">{{ old('observaciones') }} </textarea>
                        <input-error for="observaciones" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 />
                    </div>
                </div>

                <div class="flex mt-2 mb-2 ml-2 space-x-4">
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
                            >Saved!
                        </span>
                        <x-jet-secondary-button  onclick="location.href = '{{route('producto.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
