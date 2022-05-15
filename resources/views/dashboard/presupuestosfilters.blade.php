<div>
    <div class="flex justify-between space-x-1">
        <div class="inline-flex space-x-2">
            <div class="text-xs">
                <label class="px-1 text-gray-600">
                    Estado
                </label>
                <div class="flex">
                    <select wire:model="filtroestado"
                        class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                        <option value="">-- selecciona --</option>
                        <option value="0">En curso</option>
                        <option value="1">Aceptado</option>
                        <option value="2">Rechazado</option>
                    </select>
                    @if($filtroestado=='1')
                        <x-icon.filter-slash-a wire:click="$set('filtroestado', '')" class="pb-1" title="reset filter" />
                    @endif
                </div>
            </div>
            <div class="text-xs">
                <label class="px-1 text-gray-600">
                    Cliente
                </label>
                <div class="flex">
                    <select wire:model="filtroentidad"
                        class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                        <option value="">-- selecciona --</option>
                        @foreach ($clientes as $cliente )
                        <option value="{{ $cliente->id }}">{{ $cliente->entidad }}</option>
                        @endforeach
                    </select>
                    @if($filtroentidad!='')
                        <x-icon.filter-slash-a wire:click="$set('filtroentidad', '')" class="pb-1" title="reset filter" />
                    @endif
                </div>
            </div>
            <div class="text-xs">
                <label class="px-1 text-gray-600">
                    Comercial
                </label>
                <div class="flex">
                    <select wire:model="filtrosolicitante"
                        class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                        <option value="">-- selecciona --</option>
                        @foreach ($solicitantes as $solicitante )
                        <option value="{{ $solicitante->id }}">{{ $solicitante->name }}</option>
                        @endforeach
                    </select>
                    @if($filtrosolicitante!='')
                        <x-icon.filter-slash-a wire:click="$set('filtrosolicitante', '')" class="pb-1" title="reset filter" />
                    @endif
                </div>
            </div>
            <div class="text-xs">
                <div class="flex">
                    <div class="w-2/12">
                    </div>
                    <div class="w-10/12">
                        <label class="px-1 text-gray-600">
                            Periodo:
                        </label>
                    </div>
                </div>
                <div class="">
                    <div class="flex">
                        <p class="w-2/12">De: </p>
                        <input type="date" wire:model.lazy="filtroFi"
                        class="w-10/12 py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                        />
                    </div>
                    <div class="flex">
                        <p class="w-2/12">A: </p>
                        <input type="date" wire:model.lazy="filtroFf"
                        class="w-10/12 py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                        />
                    </div>
                </div>
            </div>
            <div class="text-xs">
                <div class="flex">
                    <div class="w-2/12">
                    </div>
                    <div class="w-10/12">
                        <label class="px-1 text-gray-600">
                            Cifra Ventas:
                        </label>
                    </div>
                </div>
               </label>
                <div class="">
                    <div class="flex">
                        <p class="w-2/12">De: </p>
                        <input type="number" wire:model="filtroventasIni"
                        class="w-10/12 py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                        placeholder="Cifra Inicial" />
                    </div>
                    <div class="flex">
                        <p class="w-2/12">A: </p>
                        <input type="number" wire:model="filtroventasFin"
                        class="w-10/12 py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                        placeholder="Cifra Final" />
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
