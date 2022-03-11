<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Produto') }}
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

                    <div class="md:grid md:grid-cols-3 md:gap-6">

                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Alterar Produto</h3>
                                <p class="mt-1 text-sm text-gray-600">Atualize aqui os dados do produto da sua loja,
                                    todos os campo são de preenchimento obrigatório.</p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">

                            @if (session('alert'))
                                <div class="bg-gray-600 text-white p-3 mb-3 rounded-lg">
                                    {{ session('alert') }}
                                </div>
                            @endif

                            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="shadow overflow-hidden sm:rounded-md">

                                    <div class="px-4 py-5 bg-white sm:p-6">

                                        <div class="grid grid-cols-3 gap-4">

                                            <div class="md:col-span-2">
                                                <x-jet-label for="title" value="{{ __('Titulo: *') }}" />
                                                <x-jet-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$product->title" maxlength="200" autofocus autocomplete="title" />
                                                @error('name')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-1">
                                                <x-jet-label for="price" value="{{ __('Valor: *') }}" />
                                                <x-jet-input id="price" class="block mt-1 w-full" type="text" name="price" :value="$product->price" maxlength="8" autocomplete="price" placeholder="0.00" />
                                                @error('price')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-1">
                                                <label>Categoria:</label>
                                                <select name="categories[]"
                                                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if ($product->categories->contains($category)) selected @endif>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('categories')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 mt-2">
                                            <div class="mb-2">
                                                <label for="description"
                                                    class="block text-sm font-medium text-gray-700">
                                                    Fotos do produto:
                                                </label>
                                                <input type="file" name="photos[]" multiple class="w-full" />
                                            </div>

                                            <div>
                                                <label for="description"
                                                    class="block text-sm font-medium text-gray-700">Descrição sobre o
                                                    produto:</label>
                                                <textarea name="description" rows="5"
                                                    class="mt-1 h-64 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $product->description }}</textarea>
                                                @error('description')
                                                    <div class="text-red-600">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Alterar
                                            Registro</button>
                                    </div>
                                </div>
                            </form>

                            <div class="flex flex-row flex-wrap py-4">
                                @foreach ($product->photos as $photo)
                                    <div class="w-20 border m-1">
                                        <img src="{{asset('storage/'.$photo->image)}}" alt="fotodo produto" class="img-fluid" />
                                        <form action="{{route('photo.remove')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="photo" value="{{$photo->image}}" />
                                            <button type="submit" class="">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end formulario -->

            </div>
        </div>
    </div>
</x-app-layout>
