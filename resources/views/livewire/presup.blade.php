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
            <div class="flex flex-row justify-end w-6/12 mr-4 text-right space-x-2">
                {{-- <x-icon.pdf-a wire:click="imprimir()" class="text-green-600" title="PDF" />
                <a href="{{ route('presupuesto.html',[$presupuesto,'con']) }}" target="_blank" class="w-6 h-6 text" title="Imprimir Ficha Presupuesto"><x-icon.html ></x-icon.html></a> --}}
                <x-jet-button  onclick="location.href = '{{route('presupuesto.html', [$presupuesto,'con']) }}'">{{ __('Ficha') }}</x-jet-button>
                <x-jet-secondary-button class="bg-green-400 "  onclick="location.href = '{{route('presupuesto.imprimir', [$presupuesto,'con']) }}'">{{ __('Pdf Con totales') }}</x-jet-secondary-button>
                <x-jet-secondary-button  class="bg-yellow-400" onclick="location.href = '{{route('presupuesto.imprimir', [$presupuesto,'sin']) }}'">{{ __('Pdf Sin totales') }}</x-jet-secondary-button>
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
                @if($search!='')
                    <x-jet-secondary-button  onclick="location.href = '{{route('presupuesto.indexvbles', [$search , $filtroanyo , $filtromes , $filtroclipro , $filtrosolicitante , $filtropalabra , $filtroestado ]) }} '">{{ __('Volver') }}</x-jet-secondary-button>
                @else
                    <x-jet-secondary-button  onclick="location.href = '{{route('presupuesto.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                @endif
            </div>
        </div>
    </div>

    <!-- PDF Transactions Modal -->
    <x-modal.confirmationPDF wire:model.defer="showPDFModal">
        <x-slot name="title">Generar Presupuesto en PDF</x-slot>

        <x-slot name="content">
            <div class="py-8 text-gray-700">Selecciona el tipo de Presupuesto a imprimir</div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button  onclick="location.href = '{{route('presupuesto.imprimir', [$presupuesto,'con']) }}'">{{ __('Con totales') }}</x-jet-button>
            <x-jet-secondary-button  onclick="location.href = '{{route('presupuesto.imprimir', [$presupuesto,'sin']) }}'">{{ __('Sin totales') }}</x-jet-secondary-button>
        </x-slot>
    </x-modal.confirmationPDF>
</div>
