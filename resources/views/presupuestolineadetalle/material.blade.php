<div class="flex space-x-2">
    <div class="w-full mb-2">
        <label for="preciocoste_ud" class="px-1 text-sm text-gray-600">€ Compra Ud:
            <input type="hidden" id="udpreciocoste_id" wire:model.defer="udpreciocoste_id"/>
            @if($accionproducto!='')
                (x {{ $unidadventa }})
            @endif
        </label>
        <input type="number" step="any" id="preciocoste_ud" wire:model.defer="preciocoste_ud"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
            disabled>
        @error('preciocoste_ud') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="precioventa_ud" class="px-1 text-sm text-gray-600">€ Venta Ud:
            <input type="hidden" id="udpreciocoste_id" wire:model.defer="udpreciocoste_id"/>
            @if($accionproducto!='')
                (x {{ $unidadventa }})
            @endif
        </label>
            <input type="number" step="any" id="precioventa_ud" wire:model.defer="precioventa_ud"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
            disabled>
        @error('precioventa_ud') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    @if($showAnchoAlto)
        <div class="w-full mb-2">
            <label for="ancho" class="px-1 text-sm text-gray-600">Ancho(mts):</label>
            <input type="number" step="any" id="ancho" wire:model.lazy="ancho"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        </div>
            <div class="w-full mb-2">
            <label for="alto" class="px-1 text-sm text-gray-600">Alto(mts):</label>
            <input type="number" step="any" id="alto" wire:model.lazy="alto"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        </div>
    @endif
    <div class="w-full mb-2">
        <label for="unidades" class="px-1 text-sm text-gray-600">Unidades:</label>
        <input type="number" id="unidades" wire:model.lazy="unidades"
        class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        @error('unidades') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="factor" class="px-1 text-sm text-gray-600">Factor:</label>
        <input type="number" step="any" id="factor" wire:model.lazy="factor"
        class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        @error('factor') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="factormin" class="px-1 text-sm text-gray-600">F.Min:</label>
        <input type="number" step="any" id="factormin" wire:model="factormin"
        class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
        disabled>
    </div>
    <div class="w-full mb-2">
        <label for="merma" class="px-1 text-sm text-gray-600">Merma:</label>
        <input type="number" step="any" id="merma" wire:model.lazy="merma"
        class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        @error('merma') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="precioventa" class="px-1 text-sm text-gray-600">€ Venta:
            @if($accionproducto!='')
                (x {{ $unidadventa }})
            @endif
        </label>
        <input type="number" step="any" id="precioventa" wire:model.defer="precioventa"
        class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        @error('precioventa') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
</div>
