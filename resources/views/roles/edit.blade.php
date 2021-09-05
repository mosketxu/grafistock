<x-app-layout>
    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="">
                    @livewire('menu')
                    <div class="p-1 mx-2">
                        <div class="flex flex-row">
                            <h1 class="ml-2 text-2xl font-semibold text-gray-900">Permisos del Rol: {{ $role->name }}</h1>
                        </div>
                        @if(session('info'))
                            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-green-200 border-green-500 rounded border-1">
                                <span class="inline-block mx-8 align-middle">
                                    {{ session('info') }}
                                </span>
                                <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                                    <span>×</span>
                                </button>
                            </div>
                        @endif
                         {{-- mensajes y errores --}}
                         @if ($errors->any())
                            <div class="py-1 mx-4 space-y-4">
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
                            </div>
                        @endif
                        <form id="formrol" role="form" method="post" action="{{ route('roles.update',$role->id) }}" enctype="multipart/form-data">
                            <div class="mx-auto ">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-row flex-wrap -mx-2">
                                    @foreach($permissions->chunk(5) as $chunk)
                                        <div class="w-full px-2 mb-4 sm:w-1/2 md:w-1/4">
                                            <div class="relative bg-white border rounded">
                                                <div class="p-4 ">
                                                    <div class="min-w-full overflow-x-auto overflow-y-auto align-middle ">
                                                        <table>
                                                            @foreach ($chunk as $permission )
                                                            <tr>
                                                                <td class="pl-1"><input type="checkbox" name="permisos[]" value="{{$permission->id}}"
                                                                    {{ (in_array($permission->id, old('permissions', [])) || isset($role) && $role->permissions()->pluck('name', 'permissions.id')->contains($permission->name)) ? 'checked' : '' }}></td>
                                                                <td class="px-3">{{$permission->name}}</td>
                                                                <td class="text-sm italic tracking-tighter text-gray-600">{{$permission->description}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="card-footer">
                                        <x-jet-secondary-button  onclick="location.href = '{{route('administracion.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                                        <x-jet-button class="bg-blue-600">
                                            {{ __('Actualizar') }}
                                        </x-jet-button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
