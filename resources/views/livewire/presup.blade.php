<div class="">
    @livewire('menu')

    <div class="p-1 mx-2 ">
        <div class="flex flex-row">
            <div class="w-6/12 space-x-2">
                <div class="flex flex-row">
                    <div>
                        <h1 class="mx-2 text-2xl font-semibold text-gray-900"> Presupuesto: {{ $presupuesto->presupuesto }}</h1>
                    </div>
                </div>
            </div>
            <div class="flex flex-row-reverse w-6/12 mr-4 text-right">
                {{-- <div class="flex-row-reverse"> --}}
                    <a href="{{ route('presupuesto.show',$presupuesto) }}" target="_blank" class="w-6 h-6 ml-2 text" title="Imprimir Presupuesto"><x-icon.printer></x-icon.printer></a>
                    <a href="{{ route('presupuesto.imprimir',$presupuesto) }}" target="_blank" class="w-6 h-6 text" title="Imprimir Ficha Presupuesto"><x-icon.pdfred ></x-icon.pdfred></a>
                {{-- </div> --}}
            </div>
        </div>

        {{-- mensajes y errores --}}
        @include('error')

        {{-- cabecera --}}
        <div class="flex-col text-gray-500 rounded-lg">
            @include('presupuesto.presupuestocabecera')
        </div>

        {{-- Partidas --}}
        <div class="flex mb-2 ">
            <div class="flex-initial w-full py-1 mt-1 space-y-1 bg-white rounded-lg shadow-md">
                <div class="flex flex-row flex-wrap px-2 my-1 space-x-4 bg-blue-100 rounded-md">
                    <h3 class="mr-2 font-bold">Partidas:</h3>
                    @foreach($controlpartidas as $controlpartida)
                        @livewire('presup-controlpartida',['controlpartida'=>$controlpartida],key($controlpartida->id))
                    @endforeach
                </div>
            </div>
        </div>

        @livewire('presup-lineas',['presupuesto'=>$presupuesto],key($presupuesto->id))


        <div class="flex mt-2 ml-2 space-x-4">
            <div class="space-x-3">
                <x-jet-secondary-button  onclick="location.href = '{{route('presupuesto.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
            </div>
        </div>
    </div>

</div>
