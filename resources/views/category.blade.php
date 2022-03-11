<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Tailwind CSS -->
        <link href="{{asset('/css/app.css')}}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body>

        <header class="bg-cover bg-center" style="background-image: url('/images/banner-principal.jpg');">

            <nav class="flex justify-between p-2 mb-2">
                @include('menu')
            </nav>

            <div class="flex flex-column items-center justify-center w-full px-3 py-6 md:py-32">

                <div class="ms:container ms:mx-auto flex flex-col items-center justify-end">
                    <h1 class="text-3xl mb-4 font-bold text-white">Sejá bem-vindo(a) a nossa loja!</h1>
                    <div class="flex flex-wrap md:justify-evenly w-full">
                        @foreach ($categories as $category)
                            <a href="{{$category->id}}" class="border border-white text-white px-5 py-3 items-center justify-center m-1 rounded-full hover:bg-white hover:text-black">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <div class="w-full pt-5">
                        <form method="post" action="" class="flex flex-col md:flex-row">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="O quê procura?" 
                                class="p-3 w-full outline-none rounded mr-2" />
                            <button type="submit" class="flex items-center justify-center bg-gray-800 py-3 px-5 text-white rounded mt-2 md:mt-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                Buscar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </header>

        <aside class="bg-gray-100 w-full p-2">

            <section class="container mx-auto grid gap-4 my-16 grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                @foreach ($products as $product)
                    <article class="bg-white flex flex-col border border-gray-300">
                        @if($product->photos->count())
                        <a href="{{route('detail',$product->slug)}}">
                            <img src="{{ asset('storage/'.$product->photos->first()->image) }}" alt="" class="w-full" />
                        </a>
                        @else
                            <img src="https://dummyimage.com/600x400/000/fff.jpg" alt="" class="w-full" />
                        @endif
                        <div class="flex p-3">
                            <div class="flex-1">
                                <a href="{{route('detail',$product->slug)}}">
                                    <h2>{{$product->title}}</h2>
                                </a>
                                <span class="text-2xl">R$ {{number_format($product->price,2,',','.')}}</span>
                                <br/>
                                <span class="text-red-700">Frete Grátis</span>
                            </div>
                            <div>
                                <a href="{{route('detail',$product->slug)}}" title="Adicionar item ao carrinho de compras.">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 hover:text-white hover:bg-black p-1 rounded-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach

            </section>

        </aside>

        @include('footer')

    </body>
</html>
