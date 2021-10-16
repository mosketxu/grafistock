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
            <div class="w-6/12 mr-4 text-right">

            </div>
        </div>

        {{-- mensajes y errores --}}
        @include('error')

        {{-- cabecera --}}
        <div class="flex-col text-gray-500 rounded-lg">
            @include('presupuesto.presupuestocabecera')
        </div>

        <hr class="my-2">

        @livewire('presup-lineas',['presupuesto'=>$presupuesto],key($presupuesto->id))


        <div class="flex mt-2 ml-2 space-x-4">
            <div class="space-x-3">
                <x-jet-secondary-button  onclick="location.href = '{{route('presupuesto.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
            </div>
        </div>
    </div>

</div>
