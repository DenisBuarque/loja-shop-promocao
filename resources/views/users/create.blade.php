<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Usuários') }}
            </h2>

            <a href="{{ route('user.index') }}" class="bg-gray-800 text-white py-2 px-5 rounded text-sm"
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
                                <h3 class="text-lg font-medium leading-6 text-gray-900">Cadastro de Usuário</h3>
                                <p class="mt-1 text-sm text-gray-600">Adicione os dados do usuário para ter acesso ao sistema, os compos com (*) são de preencimento obrigatório.</p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">

                            @if (session('alert'))
                                <div class="bg-gray-800 p-3 mb-3 text-white rounded-lg">
                                    {{ session('alert') }}
                                </div>
                            @endif
                            
                            <form action="{{route('user.store')}}" method="POST">
                                @csrf

                                <div class="shadow overflow-hidden sm:rounded-md">

                                    <div class="px-4 py-5 bg-white sm:p-6">

                                        <div class="grid grid-cols-2 gap-4">

                                            <div>
                                                <x-jet-label for="name" value="{{ __('Name *') }}" />
                                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" maxlength="30" autofocus />
                                                @error('name')
                                                    <div class="text-red-600">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <x-jet-label for="email" value="{{ __('Email *') }}" />
                                                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" maxlength="50" />
                                                @error('email')
                                                    <div class="text-red-600">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <x-jet-label for="password" value="{{ __('Password *') }}" />
                                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" maxlength="20" />
                                                @error('password')
                                                    <div class="text-red-600">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <x-jet-label for="password_confirmation" value="{{ __('Confirme Senha *') }}" />
                                                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" maxlength="20" />
                                                @error('password_confirmation')
                                                    <div class="text-red-600">{{$message}}</div>
                                                @enderror
                                            </div>
                                        
                                        </div>

                                    </div>

                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-800">
                                            Salvar Registro
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- end formulario -->

            </div>
        </div>
    </div>
</x-app-layout>
