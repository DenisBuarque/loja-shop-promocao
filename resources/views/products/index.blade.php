<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">

                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full">

                            @if (session('alert'))
                                <div class="bg-gray-800 text-white p-3 mb-4 rounded-lg">
                                    {{ session('alert') }}
                                </div>
                            @endif

                            <div class="flex justify-between mb-4">
                                <form method="GET" action="{{ route('product.index') }}" class="flex">
                                    <x-jet-input id="search" class="block w-full" type="text" name="search"
                                        :value="$search" maxlength="50" autocomplete="search" />
                                    <select name="category" class="block w-full shadow-sm ml-1 text-sm border-gray-300 rounded-md">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if ($select == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit"
                                        class="inline-flex justify-center items-center ml-1 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800">
                                        Buscar
                                    </button>
                                </form>
                                <a href="{{ route('product.create') }}"
                                    class="bg-gray-800 text-white py-2 px-5 rounded-md text-sm flex items-center justify-center"
                                    title="Clique aqui para adicionar um novo registro.">Novo Registro</a>
                            </div>

                            <div class="shadow overflow-hidden border-b border-gray-200 rounded-lg">

                                <table class="w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left font-normal text-gray-800 uppercase">
                                                Fotos</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left font-normal text-gray-800 uppercase">
                                                Titulo do Produto</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left font-normal text-gray-800 uppercase">
                                                Valor</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left font-normal text-gray-800 uppercase">
                                                Categoria</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left font-normal text-gray-800 uppercase">
                                                A????es
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($products as $key => $product)
                                            <tr class="{{ $key % 2 == 0 ? 'bg-gray-50' : 'bg-gray-100' }}">
                                                <td class="px-6 py-1 flex flex-wrap">
                                                    @foreach ($product->photos as $photo)
                                                        <img src="{{ asset('storage/' . $photo->image) }}"
                                                            class="border m-1" alt="fotodo produto" width="30"
                                                            height="30" />
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-2">
                                                    <div class="text-normal text-gray-900">{{ $product->title }}</div>
                                                </td>
                                                <td class="px-6 py-2">
                                                    <div class="text-normal text-gray-900">
                                                        ${{ number_format($product->price, 2, '.', ',') }}</div>
                                                </td>
                                                <td class="px-6 py-2">
                                                    <div class="text-normal text-gray-900">
                                                        @foreach ($product->categories as $post)
                                                            {{ $post->name }}
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium flex items-center justify-center">
                                                    <div class="flex flex-row justify-center items-center">
                                                        <a href="{{ route('product.edit', $product->id) }}"
                                                            title="Clique aqui para altera os dados do registro."
                                                            class="text-indigo-500 items-center justify-center p-1 mr-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </a>

                                                        <form method="POST"
                                                            action="{{ route('product.destroy', $product->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 pt-1">
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
                                                </td>
                                            </tr>
                                        @endforeach

                                        <!-- More people... -->
                                    </tbody>
                                </table>

                                <div class="py-2 px-6">
                                    <!-- @ if (!$search && $products)
                                        { { $products->links() }}
                                    @ endif -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- end list -->

            </div>
        </div>
    </div>
</x-app-layout>
