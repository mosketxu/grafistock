<div class="w-2/12 text-xs">
    <label class="px-1 text-gray-600">
        Proveedor
    </label>
    <div class="flex">
        <select wire:model="filtroclipro" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
            <option value=""></option>
            @foreach ($proveedores as $proveedor)
            <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
            @endforeach
        </select>
        @if($filtroclipro!='')
            <x-icon.filter-slash-a wire:click="$set('filtroclipro', '')" class="pb-1" title="reset filter"/>
        @endif
    </div>
</div>
<div class="w-2/12 text-xs">
    <label class="px-1 text-gray-600">
        Ref./Descrip.
    </label>
    <div class="flex">
        <input type="text" wire:model.lazy="search" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Búsqueda Entidad/Factura" autofocus/>
        @if($search!='')
            <x-icon.filter-slash-a wire:click="$set('search', '')" class="pb-1" title="reset filter"/>
        @endif
    </div>
</div>
<div class="w-2/12 text-xs">
    <label class="px-1 text-gray-600">
        Tipo
    </label>
    <div class="flex">
        <select wire:model="filtrotipo" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
            <option value=""></option>
            @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
            @endforeach
        </select>
        @if($filtrotipo!='')
            <x-icon.filter-slash-a wire:click="$set('filtrotipo', '')" class="pb-1" title="reset filter"/>
        @endif
    </div>
</div>
<div class="w-2/12 text-xs">
    <label class="px-1 text-gray-600">
        Familia
    </label>
    <div class="flex">
        <select wire:model="filtrofamilia" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
            <option value=""></option>
            @foreach ($familias as $fam)
            <option value="{{ $fam->id }}">{{ $fam->nombre }}</option>
            @endforeach
        </select>
        @if($filtrofamilia!='')
            <x-icon.filter-slash-a wire:click="$set('filtrofamilia', '')" class="pb-1" title="reset filter"/>
        @endif
    </div>
</div>
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
<div class="w-1/12 text-xs">
    <label class="px-1 text-gray-600">
        Activo
    </label>
    <div class="flex">
        <select wire:model="filtroactivo" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
            <option value=""></option>
            <option value="0"> Descatalogado </option>
            <option value="1"> Activo </option>
        </select>
        @if($filtroactivo!='')
            <x-icon.filter-slash-a wire:click="$set('filtroactivo', '')" class="pb-1" title="reset filter"/>
        @endif
    </div>
</div>
