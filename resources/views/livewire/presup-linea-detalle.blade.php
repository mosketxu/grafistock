<div class="">
    @livewire('menu')
    <div class="">
        @include('presupuestolinea.presupuestocabecera')
        <div class="py-1 space-y-4">
            @include('errormessages')
        </div>
        <div class="mx-2 border rounded">
            @include('presupuestolinea.presupuestolineacabecera')
            <form>
                <div class="mx-2 mt-2">
                    {{-- Filtro para facilitar la elección de los producto --}}
                    @if($acciontipo->id==1)
                        <div class="flex px-2 space-x-2 bg-blue-100 rounded">
                            <div class="w-full mb-2">
                                <label class="px-1 text-sm text-gray-600">Filtro Familia</label>
                                    @if($filtrofamilia!='')
                                        <x-icon.filter-slash-a wire:click="$set('filtrofamilia', '')" class="pb-1" title="reset filter"/>
                                    @endif
                                <x-select wire:model.lazy="filtrofamilia" selectname="filtrofamilia"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                    <option value="">-- choose --</option>
                                    @foreach ($familias as $familia)
                                        <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="w-full mb-2">
                                <label for="filtrodescripcion" class="px-1 text-sm text-gray-600">Filtro Referencia/Descripción:</label>
                                @if($filtrodescripcion!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtrodescripcion', '')" class="pb-1" title="reset filter"/>
                                @endif
                                <input wire:model="filtrodescripcion" type="text"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            </div>
                        </div>
                    @endif
                    {{-- fin --}}

                    <div class="flex space-x-2">
                        <div class="w-1/12 mb-2">
                            <label for="visible" class="px-1 text-sm text-gray-600">Visible:</label>
                            <div class="w-full">
                                <input wire:model="visible" type="checkbox"
                                class="ml-4 text-xs border-gray-300 rounded-sm shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            </div>
                        </div>
                        <div class="w-1/12 mb-2">
                            <label for="orden" class="px-1 text-sm text-gray-600">Orden:</label>
                            <input wire:model="orden" type="number"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('orden') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full mb-2">
                            <label for="accionproducto_id" class="px-1 text-sm text-gray-600">{{ $acciontipo->nombre }}</label>
                            <x-select wire:model.lazy="accionproducto_id" selectname="accionproducto_id" required
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                    <option value="">-- choose --</option>
                                @foreach ($acciones as $accion)
                                    <option value="{{ $accion->id }}">{{ $accion->descripcion }}</option>
                                @endforeach
                            </x-select>
                            @error('accionproducto_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full mb-2">
                            <label for="descripcion" class="px-1 text-sm text-gray-600">Descripción:</label>
                            <input type="text" id="descripcion" wire:model.defer="descripcion" required
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <div class="w-full mb-2">
                            <label for="preciotarifa_ud" class="px-1 text-sm text-gray-600">€ Tarifa Ud:
                                <input type="hidden" id="udpreciotarifa_id" wire:model.defer="udpreciotarifa_id"/>
                                @if($accionproducto!='')
                                    (x {{ $unidadventa }})
                                @endif
                            </label>

                                <input type="number" id="preciotarifa_ud" wire:model.defer="preciotarifa_ud"
                                class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                disabled>
                            @error('preciotarifa_ud') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full mb-2">
                            <label for="preciotarifa" class="px-1 text-sm text-gray-600">€ Precio Tarifa:
                                <input type="hidden" id="udpreciotarifa_id" wire:model.defer="udpreciotarifa_id"/>
                                @if($accionproducto!='')
                                    (x {{ $unidadventa }})
                                @endif
                            </label>
                                <input type="number" id="preciotarifa" wire:model.defer="preciotarifa"
                                class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                disabled>
                            @error('preciotarifa') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        @if($showAnchoAlto)
                            <div class="w-full mb-2">
                                <label for="ancho" class="px-1 text-sm text-gray-600">Ancho(mts):</label>
                                <input type="number" id="ancho" wire:model.lazy="ancho"
                                class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            </div>
                                <div class="w-full mb-2">
                                <label for="alto" class="px-1 text-sm text-gray-600">Alto(mts):</label>
                                <input type="number" id="alto" wire:model.lazy="alto"
                                class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            </div>
                            <div class="w-full mb-2">
                                <label for="metros2" class="px-1 text-sm text-gray-600">Metros 2:</label>
                                <input type="number" id="metros2" wire:model="metros2"
                                class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                disabled>
                            </div>
                        @endif
                        <div class="w-full mb-2">
                            <label for="unidades" class="px-1 text-sm text-gray-600">Unidades:</label>
                            <input type="number" id="unidades" wire:model="unidades"
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('unidades') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full mb-2">
                            <label for="factor" class="px-1 text-sm text-gray-600">Factor:</label>
                            <input type="text" id="factor" wire:model.lazy="factor"
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('factor') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full mb-2">
                            <label for="factormin" class="px-1 text-sm text-gray-600">F.Min:</label>
                            <input type="number" id="factormin" wire:model="factormin"
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                            disabled>
                        </div>
                        <div class="w-full mb-2">
                            <label for="precioventa" class="px-1 text-sm text-gray-600">€ Venta:
                                @if($accionproducto!='')
                                    (x {{ $unidadventa }})
                                @endif
                            </label>
                            <input type="number" id="precioventa" wire:model.defer="precioventa"
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('precioventa') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full mb-2">
                            <label for="observaciones"
                                class="px-1 text-sm text-gray-600">Observaciones:</label>
                            <textarea id="observaciones" wire:model="observaciones"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                placeholder="Introduce las observaciones"></textarea>
                            @error('observaciones') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="flex pl-2 mt-2 mb-2 ml-2 space-x-4">
                    <div class="space-x-3">
                        <x-jet-button wire:click.prevent="save()" class="bg-blue-600">{{ __('Guardar') }}
                        </x-jet-button>
                        <x-jet-secondary-button
                            onclick="location.href = '{{route('presupuestolinea.index',$presuplinea)}}'">{{ __('Volver') }}</x-jet-secondary-button>
                    </div>
                </div>
            </form>
            <div class="space-y-2 ">
                @include('presupuestolinea.presupuestolineadetalles',['presupacciones' => $presupacciones,'acciontipoId'=>$acciontipo->id,'accion'=>$acciontipo->nombre])
            </div>
        </div>
    </div>
</div>
