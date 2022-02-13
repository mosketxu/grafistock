<div class="flex space-x-2">
    @if($acciontipo->nombrecorto=='EXT')
    <div class="w-full mb-2">
        <label for="filtrocategoria" class="px-1 text-sm text-gray-600">Cat.Proveedor:</label>
        <x-select wire:model.lazy="filtrocategoria" selectname="filtrocategoria"
            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                <option value="">-- choose --</option>
            @foreach ($entidadcategorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
            @endforeach
        </x-select>
    </div>
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
        <label for="preciocoste_ud" class="px-1 text-sm text-gray-600">€ Compra Ud:</label>
        <input type="number" id="preciocoste_ud" wire:model.lazy="preciocoste_ud"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 {{ $colorfondoCoste }} border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
            {{ $deshabilitadoPCoste }}>
        @error('preciocoste_ud') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="precioventa_ud" class="px-1 text-sm text-gray-600">€ Venta Ud:</label>
            <input type="number" id="precioventa_ud" wire:model.lazy="precioventa_ud"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 {{ $colorfondoVenta }} border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
            {{ $deshabilitadoPVenta }}>
        @error('precioventa_ud') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    <div class="w-full mb-2">
        <label for="udpreciocoste_id" class="px-1 text-sm text-gray-600">€ ud</label>
        <x-select wire:model.lazy="udpreciocoste_id" selectname="udpreciocoste_id"
            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                <option value="">-- choose --</option>
            @foreach ($unidadesventa as $uventa)
                <option value="{{ $uventa->id }}">{{ $uventa->nombre }}</option>
            @endforeach
        </x-select>
        @error('udpreciocoste_id') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>
    @if($showMinutos)
    <div class="w-full mb-2">
        <label for="minutos" class="px-1 text-sm text-gray-600">Minutos:</label>
            <input type="number" id="minutos" wire:model.lazy="minutos"
            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 {{ $colorfondoVenta }} border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
        @error('minutos') <span class="text-red-500">{{ $message }}</span>@enderror
    </div>

    @endif
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
    <div class="w-full form-item">
        <x-jet-label for="fichero">{{ __('Cálculo Externo') }}
        </x-jet-label>
        <div class="flex">
            <input type="file" wire:model="fichero">
            {{-- @if($producto->fichaproducto)
                <x-icon.pdf-a wire:click="presentaPDF({{ $producto }})" class="pt-2 ml-2" title="PDF"/>
            @endif --}}
            @error('fichero') <p class="text-red-500">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
