<div>
    <form wire:submit.prevent="save">
        <div class="flex items-center justify-center h-screen bg-none">
            <div class="grid w-11/12 md:w-9/12 lg:w-1/2">
                <div class="flex justify-center py-4">
                    <img src="{{ asset('img/grafitexLogo.png') }}" alt="Grafitex" width="40px">
                </div>

                <div class="flex justify-center">
                    <div class="flex">
                        <h1 class="text-xl font-bold text-gray-600 md:text-2xl">Ficha stock</h1>
                    </div>
                </div>

                <input wire:model="stock.id" type="hidden"/>

                <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-3 md:gap-8 mx-7">
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">
                            Tipo Movimiento
                            @if($stock->tipomovimiento!='')
                                <x-icon.filter-slash-a wire:click="$set('stock.tipomovimiento', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="stock.tipomovimiento" class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                            <option value="">--selecciona--</option>
                            <option value="E">Entrada</option>
                            <option value="S">Salida</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">
                            Operario
                            @if($stock->solicitante_id!='')
                                <x-icon.filter-slash-a wire:click="$set('stock.solicitante_id', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="stock.solicitante_id"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            required>
                            <option value="">--selecciona--</option>
                            @foreach ($solicitantes as $solicitante)
                                <option value="{{ $solicitante->id }}">{{ $solicitante->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">
                            Fecha
                        </label>
                        <input wire:model="stock.fechamovimiento"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            type="date" required />
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 md:gap-8 mx-7">
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">
                            Material
                            @if($filtromaterial!='')
                                <x-icon.filter-slash-a wire:click="$set('filtromaterial', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtromaterial"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            <option value="">--filtra--</option>
                            @foreach ($materiales as $material)
                                <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">
                            Producto
                            @if($stock->producto_id!='')
                                <x-icon.filter-slash-a wire:click="$set('stock.producto_id', '')" class="pb-1" title="reset"/>
                            @endif
                        </label>
                        <select wire:model="stock.producto_id"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            required>
                            <option value="">--selecciona--</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->referencia }} -
                                    {{ $producto->descripcion }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 md:gap-8 mx-7">
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Cantidad</label>
                        <input wire:model="stock.cantidad"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            type="number" step="any" required />
                    </div>
                    <div class="grid grid-cols-1 ">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Reentrada</label>
                        <input type="checkbox" wire:model="stock.reentrada"
                            class="px-2 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            />
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Observaciones</label>
                    <textarea wire:model="stock.observaciones" rows="2" class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        placeholder="Observaciones, incidencias, comentarios,..."></textarea>
                </div>

                <div class='flex items-center justify-center gap-4 pt-5 pb-5 md:gap-8'>
                    <x-jet-button class="bg-blue-700">{{ __('Guardar') }}</x-jet-button>
                    <x-jet-secondary-button  class="text-white bg-red-500" wire:click="cancelar()">{{ __('Cancelar') }}</x-jet-secondary-button>
                    <x-jet-secondary-button  onclick="location.href = '{{route('stock.material')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                </div>

            </div>
        </div>
    </form>
</div>
