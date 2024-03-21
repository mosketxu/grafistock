<x-app-layout>
    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                @livewire('presup',['presupuesto'=>$presupuesto,
                                    'search'=>$search,
                                    'filtroanyo'=>$filtroanyo,
                                    'filtromes'=>$filtromes,
                                    'filtroclipro'=>$filtroclipro,
                                    'filtrosolicitante'=>$filtrosolicitante,
                                    'filtropalabra'=>$filtropalabra,
                                    'filtroestado'=>$filtroestado,
                                    'filtropedidominimo'=>$filtropedidominimo
                ],key($presupuesto->id))
            </div>
        </div>
    </div>
</x-app-layout>
