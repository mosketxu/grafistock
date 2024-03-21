<div class="">
    @livewire('menu')
    <div class="">
        <div class="items-center">
            <div class="flex mx-6 space-x-4 align-baseline">
                <div class="">
                    <p class="text-lg font-bold text-gray-900"> Partida: {{ $acciontipo->nombre }} </p>
                </div>
                <div class="align-baseline">
                    <p class="font-semibold text-gray-900 ">Presupuesto: <span class="font-light"> {{ $presuplinea->presupuesto->presupuesto ?? '-'}} </span></p>
                </div>
                <div class="align-baseline">
                    <p class="font-semibold text-gray-900 ">Cliente: <span class="font-light">{{ $presuplinea->presupuesto->ent->entidad ?? '-' }} </span></p>
                </div>
            </div>
        </div>

        <div class="mx-2 border rounded">
            @include('presupuestolinea.presupuestolineacabecera')
            {{-- Filtros --}}
            <form>
                <div class="mx-2 mt-2">
                    @if($acciontipo->id==1)
                        <div class="bg-blue-100 rounded">
                            <div class="px-2">Filtros de producto</div>
                                <div class="flex w-full p-2 space-x-2 ">
                                    @include('producto.productofilters')
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($acciontipo->nombrecorto=="EMB")
                        <div class="bg-blue-100 rounded">
                            <div class="px-2">Filtros de embalaje</div>
                                <div class="flex w-full p-2 space-x-2 ">
                                    <div class="w-2/12 text-xs">
                                        <label class="px-1 text-gray-600">
                                            Material
                                        </label>
                                        <div class="flex">
                                            <select wire:model="filtromaterial" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                                <option value=""></option>
                                                @foreach ($materiales as $mat)
                                                <option value="{{ $mat->id }}">{{ $mat->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @if($filtromaterial!='')
                                                <x-icon.filter-slash-a wire:click="$set('filtromaterial', '')" class="pb-1" title="reset filter"/>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-2/12 text-xs">
                                        <label class="px-1 text-gray-600">
                                            Acabado
                                        </label>
                                        <div class="flex">
                                            <select wire:model="filtroacabado" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                                <option value=""></option>
                                                @foreach ($acabados as $acabado)
                                                <option value="{{ $acabado->id }}">{{ $acabado->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @if($filtroacabado!='')
                                                <x-icon.filter-slash-a wire:click="$set('filtroacabado', '')" class="pb-1" title="reset filter"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="flex space-x-2">
                        <input wire:model="presupuestolinea_id" type="hidden"/>
                        <div class="w-1/12 mb-2">
                            <label for="orden" class="px-1 text-sm text-gray-600">Orden:</label>
                            <input wire:model="orden" type="number"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('orden') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        @if($acciontipo->nombrecorto=='IMP')
                            <div class="w-1/12 mb-2">
                                <label for="empresatipo_id" class="px-1 text-sm text-gray-600">Cat.Empresa</label>
                                <x-select wire:model.lazy="empresatipo_id" selectname="empresatipo_id"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                    @foreach ($empresatipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombrecorto }}</option>
                                    @endforeach
                                </x-select>
                                @error('empresatipo_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        @endif
                        <div class="w-full mb-2">
                            <label for="accionproducto_id" class="px-1 text-sm text-gray-600">{{ $acciontipo->nombre }}</label>
                            <x-select wire:model.lazy="accionproducto_id" selectname="accionproducto_id"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                <option value="">-- choose --</option>
                                @foreach ($acciones as $accion)
                                    <option value="{{ $accion->id }}">
                                        @if ($accion->favorito)
                                        ★
                                        @endif
                                        {{ $accion->descripcion }}
                                    </option>
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
                    {{-- seleccion accionproducto y material --}}
                    {{-- Cálculo en función del tipo de accion --}}
                    @if($acciontipo->id=='1')
                        @include('presupuestolineadetalle.material')
                    @else
                        @include('presupuestolineadetalle.nomaterial')
                    @endif
                </div>
                <div class="flex pl-2 mb-2 ml-2 space-x-4">
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
  </script>
