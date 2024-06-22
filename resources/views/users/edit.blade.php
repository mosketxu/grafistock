<x-app-layout>
    <div class="p-2">
        <div class="max-w-full mx-auto">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="">
                    @livewire('menu')

                    <div class="p-1 mx-2 ">
                        <div class="flex flex-row">
                            <h1 class="mx-2 text-2xl font-semibold text-gray-900"> {{ $user->name  }} </h1>
                        </div>
                        <div class="flex justify-between">
                            <div class="flex items-center w-2/4 space-x-2">
                            </div>
                            <div class="mr-10">
                                {{-- <x-button.button  onclick="location.href = '{{ route('users.create') }}'" color="blue"><x-icon.plus/>{{ __('Nuevo') }}</x-button.button> --}}
                            </div>
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
                        {{-- <x-jet-validation-errors/> --}}

                        {{-- formulario --}}
                        <form action="{{ route('users.update',$user) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="flex-col text-gray-500 rounded-lg">
                                <div class="flex">
                                    <div class="flex-initial w-full py-2 mr-1 bg-white rounded-lg shadow-md">
                                        <div class="px-2 mx-2 my-1 bg-blue-100 rounded-md">
                                            <h3 class="font-semibold ">Datos Usuario</h3>
                                        </div>
                                        <div class="flex flex-col ml-3 space-x-3 md:flex-row">
                                            <div class="w-full form-item lg:w-3/12">
                                                <label class="block text-sm font-medium text-gray-700">{{ __('Nombre') }}</label>
                                                <input  type="text" name="name" value="{{old('name',$user->name)}}" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                                            </div>
                                            <div class="w-full form-item lg:w-3/12">
                                                <label class="block text-sm font-medium text-gray-700">{{ __('eMail') }}</label>
                                                <input  type="email" name="email" value="{{old('email',$user->email)}}" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required/>
                                            </div>
                                            <div class="w-full form-item lg:w-3/12">
                                                <label class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                                                <input  type="password" name="password" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                                            </div>
                                            <div class="w-full form-item lg:w-3/12">
                                                <label class="block text-sm font-medium text-gray-700">{{ __('Cliente') }}</label>
                                                <select name="entidad_id" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                        <option value="" >-- Selecciona el cliente del usuario --</option>
                                                    @foreach ($entidades as $entidad)
                                                        <option value="{{ $entidad->id }}" {{ $entidad->id== $user->entidad_id? 'selected' : '' }}>{{ $entidad->entidad }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-2">

                            <h2 class="mx-2 text-xl font-semibold text-gray-500">Listado de roles</h2>
                            @foreach ($roles as $role)
                                <div class="ml-4">
                                    {{-- @can('user.edit') --}}
                                    {{ $role->id }}
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                        {{ (in_array($role->id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'roles.id')->contains($role->name)) ? 'checked' : '' }}>&nbsp {{$role->name}}
                                    {{-- @elsecan('user.show')
                                        <input type="checkbox" name="roles[]" value="{{$rol->id}}" class="d-none"
                                            {{ (in_array($rol->id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'roles.id')->contains($rol->name)) ? 'checked' : '' }}> &nbsp {{$rol->name}}  --}}
                                </div>
                            @endforeach


                            <div class="flex mt-2 ml-2 space-x-4">
                                <div class="space-x-3">
                                    <x-jet-button class="bg-blue-600">
                                        {{ __('Guardar') }}
                                    </x-jet-button>
                                    <x-jet-secondary-button  onclick="location.href = '{{route('users.index')}}'">{{ __('Volver') }}</x-jet-secondary-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

