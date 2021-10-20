<div class="">
    @livewire('menu',['entidad'=>$entidad],key($entidad->id))

    <div class="p-1 mx-2">
        <div class="flex flex-row">
            <div class="w-6/12">
                <div class="flex flex-row items-center">
                    <div class="">
                        @if($entidad->id)
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $entidad->entidad }}</h1>
                        @else
                            <h1 class="text-2xl font-semibold text-gray-900">Nuevo </h1>
                        @endif
                    </div>
                    <div class="ml-3">
                        <x-select wire:model.defer="entidad.entidadtipo_id" class="text-xl" selectname="entidadtipo_id" required>
                            @foreach ($tiposentidad as $tipoentidad)
                            <option value="{{ $tipoentidad->id }}">{{ $tipoentidad->nombre }}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
            </div>
            <div class="w-6/12 text-right">
                {{-- @if($tipo=="Cliente")
                    <x-button.button  onclick="location.href = '{{ route('entidad.nueva','Cliente') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo Cliente') }}</x-button.button>
                @else
                    <x-button.button  onclick="location.href = '{{ route('entidad.nueva','Proveedor') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo Proveedor') }}</x-button.button>
                @endif --}}
                <x-button.button  onclick="location.href = '{{ route('entidad.nueva',$tipo->id) }}'" color="blue"><x-icon.plus/>Nuevo {{ $tipo->nombre }}</x-button.button>

            </div>
        </div>

    </div>
    <div class="px-2 py-1 space-y-4" >
        @if ($errors->any())
        <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
            <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                <span>×</span>
            </button>
        </div>
    @endif
        @if (session()->has('message'))
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-green-200 border-green-500 rounded border-1" >
                <span class="inline-block mx-8 align-middle" >
                    {{ session('message') }}
                </span>
                <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                    <span>×</span>
                </button>
            </div>
        @endif
    </div>
    {{-- <x-jet-validation-errors/> --}}


    <div class="flex-col space-y-4 text-gray-500">
        <form wire:submit.prevent="save" class="">
            <div class="px-2 mx-2 my-1 rounded-md bg-blue-50">
                <h3 class="font-semibold ">Datos generales</h3>
                <x-jet-input  wire:model.defer="entidad.id" type="hidden"/>
                <hr>
            </div>
            <div class="flex flex-col pl-2 mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                <div class="w-full form-item">
                    <x-jet-label for="entidad">{{ $tipo->nombre }}</x-jet-label>
                    <x-jet-input wire:model.defer="entidad.entidad" type="text" class="w-full " id="entidad" name="entidad" :value="old('entidad') "/>
                    <x-jet-input-error for="entidad" class="mt-2" />
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="nif">{{ __('Nif') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.nif" type="text" id="nif" name="nif" :value="old('nif')" class="w-full"/>
                    <x-jet-input-error for="nif" class="mt-2" />
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="emailgral">{{ __('Email Gral') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.emailgral" type="text" id="emailgral" name="emailgral" :value="old('emailgral')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="emailadm">{{ __('Email Adm') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.emailadm" type="text" id="emailadm" name="emailadm" :value="old('emailadm')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="emailadm">{{ __('Email Aux') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.emailaux" type="text" id="emailaux" name="emailaux" :value="old('emailaux')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="web">{{ __('Web') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.web" type="text" id="web" name="web" :value="old('web')" class="w-full"/>
                </div>
            </div>
            <div class="flex flex-col pl-2 mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                <div class="w-full form-item">
                    <x-jet-label for="tfno">{{ __('Tfno.') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.tfno" type="text" id="tfno" name="tfno" :value="old('tfno')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="direccion">{{ __('Dirección') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.direccion" type="text" id="direccion" name="direccion" :value="old('direccion')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="cp">{{ __('C.P.') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.cp" type="text" id="cp" name="cp" :value="old('cp')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="localidad">{{ __('Localidad') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.localidad" type="text" id="localidad" name="localidad" :value="old('localidad')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="provincia">{{ __('Provincia') }}</x-jet-label>
                    <x-select wire:model.defer="entidad.provincia_id" selectname="provincia_id" class="w-full">
                        <option value="">-- choose --</option>
                        @foreach ($provincias as $provincia)
                        <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="pais">{{ __('Pais') }}</x-jet-label>
                    <x-select wire:model.defer="entidad.pais_id" selectname="pais_id" class="w-full">
                        <option value="">-- choose --</option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais->id }}">{{ $pais->pais }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="px-2 mx-2 my-2 rounded-md bg-blue-50">
                <h3 class="font-semibold ">Datos Facturación</h3>
            </div>
            <div class="flex flex-col pl-2 mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                @if($entidad->entidadtipo_id=='1' || $entidad->entidadtipo_id=='3'|| $entidad->entidadtipo_id=='4' )
                <div class="w-full form-item">
                    <x-jet-label >{{ __('Cat.Empresa') }}</x-jet-label>
                    <x-select wire:model.defer="entidad.empresatipo_id" selectname="empresatipo_id" class="w-full">
                        <option value="">-- choose --</option>
                        @foreach ($tiposempresa as $tipoempresa)
                            <option value="{{ $tipoempresa->id }}">{{ $tipoempresa->nombre }}</option>
                        @endforeach
                    </x-select>
                </div>
                @endif
                <div class="w-full form-item">
                    <x-jet-label for="ratio" >{{ __('Ratio') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.ratio" type="number" step="any" id="ratio" name="ratio" :value="old('ratio')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="banco1" >{{ __('Banco 1') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.banco1" type="text" id="banco1" name="banco1" :value="old('banco1')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="iban1" >{{ __('Iban 1') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.iban1" type="text" id="iban1" name="iban1" :value="old('iban1')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="banco2" >{{ __('Banco 2') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.banco2" type="text" id="banco2" name="banco2" :value="old('banco2')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="iban2" >{{ __('Iban 2') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.iban2" type="text" id="iban2" name="iban2" :value="old('iban2')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="banco3" >{{ __('Banco 3') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.banco3" type="text" id="banco3" name="banco3" :value="old('banco3')" class="w-full"/>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="iban3" >{{ __('Iban 3') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.iban3" type="text" id="iban3" name="iban3" :value="old('iban3')" class="w-full"/>
                </div>
            </div>
            <div class="flex flex-col pl-2 mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                <div class="w-full form-item">
                    <x-jet-label for="metodopago_id">{{ __('Método Pago') }}</x-jet-label>
                    <x-select wire:model.defer="entidad.metodopago_id" class="w-full" selectname="metodopago_id">
                        <option value="">-- choose --</option>
                        @foreach ($metodopagos as $metodopago)
                        <option value="{{ $metodopago->id }}">{{ $metodopago->nombrecorto }}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="cuentactblepro" >{{ __('Cta.Contable Proveedor') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.cuentactblepro" type="number" id="cuentactblepro" name="cuentactblepro" :value="old('cuentactblepro')" class="w-full"/>
                    <x-jet-input-error for="cuentactblepro" class="mt-2" />
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="cuentactblecli" >{{ __('Cta.Contable Cliente') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.cuentactblecli" type="number" id="cuentactblecli" name="cuentactblecli" :value="old('cuentactblecli')" class="w-full"/>
                    <x-jet-input-error for="cuentactblecli" class="mt-2" />
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="diafactura" >{{ __('Dia Factura') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.diafactura" type="number" id="diafactura" name="diafactura" :value="old('diafactura')" class="w-full"/>
                    <x-jet-input-error for="diafactura" class="mt-2" />
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="diavencimiento" >{{ __('Dia Vencimiento') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.diavencimiento" type="number" id="diavencimiento" name="diavencimiento" :value="old('diavencimiento')" class="w-full"/>
                    <x-jet-input-error for="diavencimiento" class="mt-2" />
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="usuaroi" >{{ __('Usuario web') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.usuario" type="text" id="usuaroi" name="usuaroi" :value="old('usuaroi')" class="w-full"/>
                    <x-jet-input-error for="usuaroi" class="mt-2" />
                </div>
                <div class="w-full form-item">
                    <x-jet-label for="password" >{{ __('Password') }}</x-jet-label>
                    <x-jet-input  wire:model.defer="entidad.password" type="text" id="password" name="password" :value="old('password')" class="w-full"/>
                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-col pl-2 mx-2 space-y-4 md:space-y-0 md:flex-row md:space-x-4">
                <div class="w-full form-item">
                    <x-jet-label for="observaciones">{{ __('Observaciones') }}</x-jet-label>
                    <textarea wire:model.defer="entidad.observaciones" class="w-full text-xs border-gray-300 rounded-md" rows="3">{{ old('observaciones') }} </textarea>
                    <x-jet-input-error for="observaciones" class="mt-2" />
                </div>
            </div>

            <div class="flex pl-2 mt-2 mb-2 ml-2 space-x-4">
                <div class="space-x-3">
                    <x-jet-button class="bg-blue-600">
                        {{ __('Guardar') }}
                    </x-jet-button>
                    <span
                        x-data="{ open: false }"
                        x-init="
                            @this.on('notify-saved', () => {
                                if (open === false) setTimeout(() => { open = false }, 2500);
                                open = true;
                            })
                        "
                    x-show.transition.out.duration.1000ms="open"
                    style="display: none;"
                    class="p-2 m-2 text-gray-500 rounded-lg bg-green-50"
                    >Saved!</span>
                    {{-- @if($tipo=="Cliente")
                        <x-jet-secondary-button  onclick="location.href = '{{route('entidad.cli')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                    @else
                        <x-jet-secondary-button  onclick="location.href = '{{route('entidad.pro')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                    @endif --}}
                        <x-jet-secondary-button  onclick="location.href = '{{route('entidad.tipo',$tipo )}}'">{{ __('Volver') }}</x-jet-secondary-button>
                </div>
            </div>
        </form>
    </div>
</div>
