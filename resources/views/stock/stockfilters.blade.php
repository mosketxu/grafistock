@include('producto.productofilters')
@if( Route::currentRouteName()=='stock.movimientos')
    <div class="w-2/12 text-xs">
        <label class="px-1 text-gray-600">
            Solicitante
        </label>
        <div class="flex">
            <select wire:model="filtrosolicitante" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                <option value=""></option>
                @foreach ($solicitantes as $solicitante)
                <option value="{{ $solicitante->id }}">{{ $solicitante->nombre }}</option>
                @endforeach
            </select>
            @if($filtrosolicitante!='')
                <x-icon.filter-slash-a wire:click="$set('filtrosolicitante', '')" class="pb-1" title="reset filter"/>
            @endif
        </div>
    </div>
@endif
<div class="text-xs">
    <label class="px-1 text-gray-600">
        Año
    </label>
    <div class="flex">
        <input type="text" wire:model="filtroanyo" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Año"/>
        @if($filtroanyo!='')
            <x-icon.filter-slash-a wire:click="$set('filtroanyo', '')" class="pb-1" title="reset filter"/>
        @endif
   </div>
</div>
<div class="text-xs">
    <label class="px-1 text-gray-600">
        Mes
    </label>
    <div class="flex">
        <input type="text" wire:model="filtromes" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Mes (número)"/>
        @if($filtromes!='')
           <x-icon.filter-slash-a wire:click="$set('filtromes', '')" class="pb-1" title="reset filter"/>
        @endif
    </div>
</div>
