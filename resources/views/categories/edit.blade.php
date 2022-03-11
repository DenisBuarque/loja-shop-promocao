<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categoria de Produto') }}
            </h2>

            <a href="{{ route('category.index') }}" class="bg-gray-800 text-white py-2 px-5 rounded text-sm"
                title="Clique aqui para listar os registro cadastrados.">Listar Registros</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">

                <!-- start Formulario -->

                <div class="mt-10 sm:mt-0">

                    <div class="md:grid md:grid-cols-3 md:gap-6">

                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Alterar Categoria</h3>
                                <p class="mt-1 text-sm text-gray-600">Atualize o nome da categoria do produto da sua loja.</p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">

                            @if (session('alert'))
                                <div class="bg-gray-800 text-white p-3 mb-3 rounded-lg">
                                    {{ session('alert') }}
                                </div>
                            @endif
                            
                            <form action="{{route('category.update',$category->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-1">
                                            <div>
                                                <x-jet-label for="name" value="{{ __('Nome da categoria:') }}" />
                                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$category->name" maxlength="30" autofocus autocomplete="name" />
                                                @error('name')
                                                    <div class="text-red-600">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Alterar Registro</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
