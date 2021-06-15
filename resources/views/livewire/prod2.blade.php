<div class="">
    @livewire('menu',['producto'=>$producto],key($producto->id))

    <div class="">
        @if ($errors->any())
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                <x-jet-label class="text-red-600">Verifica los errores</x-jet-label>
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

    <div class="flex items-center justify-center h-screen bg-gray-200">
        <div class="grid w-11/12 bg-white rounded-lg shadow-xl md:w-9/12 lg:w-1/2">
            <div class="flex justify-center">
                <div class="flex">
                    @if($producto->id)
                        <h1 class="text-xl font-bold text-gray-600 md:text-2xl">Producto: {{ $producto->referencia }}</h1>
                    @else
                        <h1 class="text-xl font-bold text-gray-600 md:text-2xl">Nuevo Producto</h1>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Input 1</label>
                <input class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Input 1" />
            </div>

            <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 md:gap-8 mx-7">
                <div class="grid grid-cols-1">
                <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Input 2</label>
                <input class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Input 2" />
                </div>
                <div class="grid grid-cols-1">
                <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Input 3</label>
                <input class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Input 3" />
                </div>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Selection</label>
                <select class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent">
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
                </select>
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Another Input</label>
                <input class="px-3 py-2 mt-1 border-2 border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text" placeholder="Another Input" />
            </div>

            <div class="grid grid-cols-1 mt-5 mx-7">
                <label class="mb-1 text-xs font-semibold text-gray-500 uppercase md:text-sm text-light">Upload Photo</label>
                <div class='flex items-center justify-center w-full'>
                    <label class='flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-purple-300 group'>
                        <div class='flex flex-col items-center justify-center pt-7'>
                            <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class='pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-purple-600'>Select a photo</p>
                        </div>
                        <input type='file' class="hidden" />
                    </label>
                </div>
            </div>

            <div class='flex items-center justify-center gap-4 pt-5 pb-5 md:gap-8'>
                <button class='w-auto px-4 py-2 font-medium text-white bg-gray-500 rounded-lg shadow-xl hover:bg-gray-700'>Cancel</button>
                <button class='w-auto px-4 py-2 font-medium text-white bg-purple-500 rounded-lg shadow-xl hover:bg-purple-700'>Create</button>
            </div>

        </div>
    </div>
</div>
