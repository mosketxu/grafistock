<div class="">
    @livewire('menu',['producto'=>$producto],key($producto->id))

    <div class="p-1 mx-2">
        <div class="flex flex-row space-x-3" >
            @if($producto->id)
                <h1 class="text-2xl font-semibold text-gray-900">Producto: {{ $producto->referencia }}</h1>
            @else
                <h1 class="text-2xl font-semibold text-gray-900">Nuevo Producto</h1>
            @endif
            <x-button.button  onclick="location.href = '{{ route('producto.create') }}'" color="blue" >{{ __('Nuevo') }}</x-button.button>
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
                    <div class="p-1 rounded-md bg-blue-50">
                        <h3 class="pl-1 font-semibold">Producto</h3>
                        <input  wire:model.defer="producto.id" type="hidden"/>
                    </div>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-2/12 form-item">
                            <x-jet-label for="referencia">{{ __('Referencia') }}</x-jet-label>
                            <input wire:model="producto.referencia" type="text" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                        </div>
                        <div class="w-10/12 form-item">
                            <x-jet-label for="descripcion">{{ __('Descripción') }}</x-jet-label>
                            <input wire:model.defer="producto.descripcion" type="text" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" autofocus/>
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
                            <x-select wire:model.lazy="producto.entidad_id" selectname="entidad_id" class="w-full" required>
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
                            <x-jet-label for="udcosteprov_id">{{ __('Ud Prov') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udcosteprov_id" selectname="udcosteprov_id" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidadescoste as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="costegrafitex">{{ __('Coste Grafitex') }}</x-jet-label>
                            <input  wire:model.defer="producto.costegrafitex" type="number" step="any" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                        </div>

                        <div class="w-full form-item">
                            <x-jet-label for="udcostegrafitex_id">{{ __('Ud Grafitex') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udcostegrafitex_id" selectname="udcostegrafitex_id" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidadescoste as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="udsolicitud_id">{{ __('Ud Solicitud') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udsolicitud_id" selectname="udsolicitud_id" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
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
                            <x-select wire:model.lazy="producto.tipo_id" selectname="tipo_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="material_id">{{ __('Material') }} {{ $producto->material_id }}</x-jet-label>
                            <x-select wire:model.lazy="producto.material_id" selectname="material_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($materiales as $material)
                                <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="acabado_id">{{ __('Acabado') }} </x-jet-label>
                            <x-select wire:model.lazy="producto.acabado_id" selectname="acabado_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($acabados as $acabado)
                                <option value="{{ $acabado->id }}">{{ $acabado->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="grupoproduccion_id">{{ __('Grupo.Prod') }} </x-jet-label>
                            <x-select wire:model.defer="producto.grupoproduccion_id" selectname="grupoproduccion_id" class="w-full" required>
                                <option value="">-- Selecciona --</option>
                                @foreach ($gruposprod as $grupo)
                                <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="familia_id">{{ __('Familia') }} </x-jet-label>
                            <x-select wire:model.defer="producto.familia_id" selectname="familia_id" class="w-full" >
                                <option value="">-- Selecciona --</option>
                                @foreach ($familias as $familia)
                                <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="ubicacion_id">{{ __('Ubicación') }}</x-jet-label>
                            <x-select wire:model.defer="producto.ubicacion_id" selectname="ubicacion_id" class="w-full">
                                <option value="">-- Selecciona ubicación --</option>
                                @foreach ($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
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
                            <x-jet-label for="ancho">{{ __('Ancho') }}</x-jet-label>
                            <input  wire:model.lazy="producto.ancho" type="number" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="udancho_id">{{ __('Ud Ancho') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udancho_id" selectname="udancho_id" class="w-full" >
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="alto">{{ __('Alto') }}</x-jet-label>
                            <input  wire:model.lazy="producto.alto" type="number" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                        </div>
                        <div class="w-full form-item">
                            <x-jet-label for="udalto_id">{{ __('Ud Ancho') }}</x-jet-label>
                            <x-select wire:model.defer="producto.udalto_id" selectname="udalto_id" class="w-full">
                                <option value="">-- Selecciona unidad --</option>
                                @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="w-full form-item">
                            <x-jet-label for="grosor">{{ __('Grosor (mm)') }}</x-jet-label>
                            <input  wire:model.lazy="producto.grosor_mm" type="number" step="any" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
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
                        <h3 class="pl-1 font-semibold">Cajas</h3>
                        <input  wire:model.defer="producto.id" type="hidden"/>
                    </div>
                    <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-full form-item">
                            <x-jet-label for="caja_id">{{ __('Caja') }}</x-jet-label>
                            <x-select wire:model.defer="producto.caja_id" selectname="caja_id" class="w-full">
                                <option value="">-- Selecciona caja --</option>
                                @foreach ($cajas as $caja)
                                <option value="{{ $caja->id }}">{{ $caja->nombre }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="w-10/12 form-item">
                            <x-jet-label for="costecaja">{{ __('Coste Caja (€)') }}</x-jet-label>
                            <input  wire:model.defer="producto.costecaja" type="number" step="any" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                    <div class="w-full form-item">
                        <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                        <textarea wire:model.defer="producto.observaciones" class="w-full text-xs border-gray-300 rounded-md" rows="2">{{ old('observaciones') }} </textarea>
                        <input-error for="observaciones" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
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
