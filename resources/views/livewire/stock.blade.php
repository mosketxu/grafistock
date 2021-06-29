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

                <input wire:model.defer="stock.id" type="hidden"/>

                <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 md:gap-8 mx-7">
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Tipo Movimiento</label>
                        <select wire:model.defer="stock.tipomovimiento" class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" required>
                            <option value="">--selecciona--</option>
                            <option value="E">Entrada</option>
                            <option value="S">Salida</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Operario</label>
                        <select wire:model.defer="stock.user_id"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            required>
                            <option value="">--selecciona--</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 md:gap-8 mx-7">
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Fecha</label>
                        <input wire:model.defer="stock.fechamovimiento"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            type="date" required />
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Producto</label>
                        <select wire:model.defer="stock.producto_id"
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
                        <input wire:model.defer="stock.cantidad"
                            class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            type="number" step="any" required />
                    </div>
                    <div class="grid grid-cols-1 ">
                        <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Reentrada</label>
                        <input type="checkbox" wire:model.defer="stock.reentrada"
                            class="px-2 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                            />
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Observaciones</label>
                    <textarea wire:model.defer="stock.observaciones" rows="2" class="px-3 py-2 mt-1 border-2 border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                        placeholder="Observaciones, incidencias, comentarios,..."></textarea>
                </div>

                <div class='flex items-center justify-center gap-4 pt-5 pb-5 md:gap-8'>
                    <x-jet-button class="bg-blue-700">{{ __('Guardar') }}</x-jet-button>
                    <x-jet-secondary-button  class="text-white bg-red-500" wire:click="cancelar()">{{ __('Cancelar') }}</x-jet-secondary-button>
                    <x-jet-secondary-button  onclick="location.href = '{{route('stock.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                </div>

            </div>
        </div>
    </form>
</div>
