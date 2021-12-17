<div class="flex space-x-2">
    @if($acciontipo->nombrecorto=='EXT')
    <div class="w-full mb-2">
        <label for="proveedor_id" class="px-1 text-sm text-gray-600">Proveedor:</label>
        <x-select wire:model.lazy="proveedor_id" selectname="proveedor_id"
            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                <option value="">-- choose --</option>
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
            @endforeach
        </x-select>
        @error('proveedor_id') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    @endif
    <div class="w-full mb-2">
        <label for="preciotarifa_ud" class="px-1 text-sm text-gray-600">€ Tarifa Ud:</label>
        <input type="number" id="preciotarifa_ud" wire:model.defer="preciotarifa_ud"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 {{ $colorfondoTarifa }} border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
            {{ $deshabilitadoPTarifa }}>
        @error('preciotarifa_ud') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="precioventa_ud" class="px-1 text-sm text-gray-600">€ Venta Ud:</label>
            <input type="number" id="precioventa_ud" wire:model.lazy="precioventa_ud"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 {{ $colorfondoVenta }} border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
            {{ $deshabilitadoPVenta }}>
        @error('precioventa_ud') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="udpreciotarifa_id" class="px-1 text-sm text-gray-600">€ ud</label>
        <x-select wire:model.lazy="udpreciotarifa_id" selectname="udpreciotarifa_id"
            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                <option value="">-- choose --</option>
            @foreach ($unidadesventa as $uventa)
                <option value="{{ $uventa->id }}">{{ $uventa->nombre }}</option>
            @endforeach
        </x-select>
        @error('udpreciotarifa_id') <span class="text-red-500">{{ $message }}</span>@enderror
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
