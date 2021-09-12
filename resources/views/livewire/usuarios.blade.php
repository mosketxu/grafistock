<div class="w-full px-2 mb-4 md:w-1/3 lg:w-2/4" >
    <div class="relative bg-white border rounded">
        <div class="p-4 ">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-bold">Usuarios</h3>
                </div>
                <div>
                    <input type="text" wire:model="search" class="w-full py-2 mb-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Búsqueda..." autofocus/>
                </div>
            </div>
            <div class="py-1 space-y-4">
                @if (session()->has('message'))
                    <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                        <span class="inline-block mx-8 align-middle">
                            {{ session('message') }}
                        </span>
                        <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                            <span>×</span>
                        </button>
                    </div>
                @endif
            </div>
            {{-- tabla users --}}
            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-t-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="w-2/6 px-1 py-3 pl-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" >{{ __('Nombre') }}</th>
                            <th class="w-4/6 px-1 py-3 pl-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" >{{ __('email') }} </th>
                            <th class="px-1 py-3 pl-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" ></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="h-64 min-w-full overflow-x-auto overflow-y-auto align-middle shadow sm:rounded-b-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @forelse ($users as $user)
                        <tr wire:loading.class.delay="opacity-50">
                            <td class="w-2/6 px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap" >
                                <input type="hidden" value="{{ $user->id }}"/>
                                <input type="text" value="{{ $user->name }}"
                                    class="w-full text-xs font-thin text-gray-500 border-0 rounded-md"  readonly/>
                            </td>
                            <td class="w-2/6 px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap" >
                                <input type="text" value="{{ $user->email }}"
                                class="w-full text-xs font-thin text-gray-500 border-0 rounded-md"  readonly/>
                            </td>
                            <td class="w-2/6 px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap" >
                                <div class="flex items-center justify-center space-x-3">
                                    <x-icon.edit-a href="{{ route('users.edit',$user) }}"  title="Editar"/>
                                    <x-icon.delete-a wire:click.prevent="delete({{ $user->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="w-2/6 px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap" >
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado usuarios...
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
                <table min-w-full divide-y divide-gray-200>
                    <tbody>
                        <tr>
                            <td class="w-2/6 text-xs tracking-tighter text-gray-600 whitespace-no-wrap" >
                                <x-button.button onclick="location.href = '{{ route('users.create') }}'" color="blue"><x-icon.plus/>Nuevo Usuario</x-button.button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
