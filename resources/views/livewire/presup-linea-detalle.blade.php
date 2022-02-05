<div class="">
    @livewire('menu')
    <div class="">
        {{-- @include('presupuestolinea.presupuestocabecera') --}}
        {{-- <div class="items-center">
                        <div class="py-0 my-0">
                            <p class="text-xl font-semibold text-gray-900">Presupuesto: <span class="font-light"> {{ $presuplinea->presupuesto->presupuesto ?? '-'}} </span></p>
                        </div>
                        <div class="">
                            <p class="text-xl font-semibold text-gray-900">Cliente: <span class="font-light">{{ $presuplinea->presupuesto->entidad->entidad ?? '-' }} </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="items-center">
            <div class="flex mx-6 space-x-4 align-baseline">
                <div class="">
                    <p class="text-lg font-bold text-gray-900"> Partida: {{ $acciontipo->nombre }} </p>
                </div>
                <div class="align-baseline">
                    <p class="font-semibold text-gray-900 ">Presupuesto: <span class="font-light"> {{ $presuplinea->presupuesto->presupuesto ?? '-'}} </span></p>
                </div>
                <div class="align-baseline">
                    <p class="font-semibold text-gray-900 ">Cliente: <span class="font-light">{{ $presuplinea->presupuesto->entidad->entidad ?? '-' }} </span></p>
                </div>
            </div>
        </div>

        {{-- <div class="py-1 space-y-4">
            @include('errormessages')
        </div> --}}
        <div class="mx-2 border rounded">
            @include('presupuestolinea.presupuestolineacabecera')
            <form>
                <div class="mx-2 mt-2">
                    {{-- Filtro para facilitar la elección de los producto --}}
                    @if($acciontipo->id==1)
                        <div class="flex px-2 space-x-2 bg-blue-100 rounded">
                            <div class="w-full mb-2">
                                <label class="px-1 text-sm text-gray-600">Filtro Familia</label>
                                <div class="flex">
                                    <x-select wire:model.lazy="filtrofamilia" selectname="filtrofamilia"
                                        class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                        <option value="">-- choose --</option>
                                        @foreach ($familias as $familia)
                                            <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                                        @endforeach
                                    </x-select>
                                    @if($filtrofamilia!='')
                                        <x-icon.filter-slash-a wire:click="$set('filtrofamilia', '')" class="pb-1" title="reset filter"/>
                                    @endif
                                </div>
                            </div>
                            <div class="w-full mb-2">
                                <label for="filtrodescripcion" class="px-1 text-sm text-gray-600">Filtro Referencia/Descripción:</label>
                                @if($filtrodescripcion!='')
                                    <x-icon.filter-slash-a wire:click.lazy="$set('filtrodescripcion', '')" class="pb-1" title="reset filter"/>
                                @endif
                                <input wire:model="filtrodescripcion" type="text"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            </div>
                        </div>
                    @endif
                    {{-- fin --}}

                    {{-- seleccion accionproducto y material--}}
                    <div class="flex space-x-2">
                        <input wire:model="presupuestolinea_id" type="hidden"/>
                        <div class="w-1/12 mb-2">
                            <label for="orden" class="px-1 text-sm text-gray-600">Orden:</label>
                            <input wire:model="orden" type="number"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('orden') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full mb-2">
                            <label for="accionproducto_id" class="px-1 text-sm text-gray-600">{{ $acciontipo->nombre }}</label>
                            <x-select wire:model.lazy="accionproducto_id" selectname="accionproducto_id"
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
                @if($acciontipo->nombrecorto=='MAT')
                    @include('presupuestolinea.presupuestolineadetallesMaterial',['presupacciones' => $presupacciones,'acciontipoId'=>$acciontipo->id,'accion'=>$acciontipo->nombre])
                @else
                    @include('presupuestolinea.presupuestolineadetallesNomaterial',['presupacciones' => $presupacciones,'acciontipoId'=>$acciontipo->id,'accion'=>$acciontipo->nombre])
                @endif
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
