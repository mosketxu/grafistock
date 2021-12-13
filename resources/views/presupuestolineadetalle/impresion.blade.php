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
        <label for="factor" class="px-1 text-sm text-gray-600">%</label>
        <input type="text" id="factor" wire:model.lazy="factor"
        class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        @error('factor') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="factormin" class="px-1 text-sm text-gray-600">%.Min:</label>
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
