<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Produto da Loja') }}
            </h2>

            <a href="{{ route('product.index') }}" class="bg-gray-800 text-white py-2 px-5 rounded text-sm"
                title="Clique aqui para listar os registro cadastrados.">Listar Registros</a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">

                <!-- start Formulario -->

                <div class="mt-10 sm:mt-0">

                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="md:grid md:grid-cols-3 md:gap-6">

                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Cadastro de Produto</h3>
                                    <p class="mt-1 text-sm text-gray-600">Adicione os dados do produto da sua loja, os campos com (*) são de preenchimento obrigatório.</p>
                                </div>
                            </div>

                            <div class="mt-5 md:mt-0 md:col-span-2">

                                @if (session('alert'))
                                    <div class="bg-gray-800 text-white p-3 mb-3 rounded-lg">
                                        {{ session('alert') }}
                                    </div>
                                @endif

                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-3 gap-4">
                                            <div class="md:col-span-2">
                                                <x-jet-label for="title" value="{{ __('Titulo: *') }}" />
                                                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" maxlength="200" autofocus autocomplete="title" />
                                                @error('title')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-1">
                                                <x-jet-label for="price" value="{{ __('Valor: *') }}" />
                                                <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" maxlength="8" autocomplete="price" placeholder="0.00" />
                                                @error('price')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-1">
                                                <label>Categoria: *</label>
                                                <select name="categories[]" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('categories')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 gap-4 mt-2">
                                            <div>
                                                <label for="description"
                                                    class="block text-sm font-medium text-gray-700">
                                                    Fotos do produto:
                                                </label>
                                                <input type="file" name="photos[]" multiple class="w-full" />
                                            </div>

                                            <div>
                                                <label for="description"
                                                    class="block text-sm font-medium text-gray-700">Descrição sobre o
                                                    produto: *</label>
                                                <textarea id="description" name="description" rows="7"
                                                    class="mt-1 h-64 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror

                                                <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
                                                <script>
                                                    CKEDITOR.replace( 'description' );
                                                </script>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Salvar Registro
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                        

                    </form>
                </div>

                <!-- end formulario -->

            </div>
        </div>
    </div>
</x-app-layout>
