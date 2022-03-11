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

        <header class="bg-blue-900">

            <nav class="flex justify-between p-2">
                @include('menu')
            </nav>

        </header>

        <aside class="bg-gray-100 w-full py-5">

            <section class="container mx-auto">

                <div class="flex flex-wrap w-full mb-2">
                    @foreach ($categories as $category)
                        <a href="{{route('category',$category->slug)}}" class="border border-black text-black px-5 py-3 items-center justify-center m-1 rounded-full hover:bg-white hover:text-black">{{ $category->name }}</a>
                    @endforeach
                </div>
                
                <div class="mb-3 px-3 md:px-0">
                    <span>
                        <a href="/" class="text-blue-500">Ir a lista de produtos</a> | Produto > {{$product->title}}
                    </span>
                </div>
                <div class="flex flex-col md:flex-row bg-white p-2 rounded-lg">
                    <div class="flex-1">
                        
                        <script>
                            function changeImage(image){
                                var photo = document.querySelector("#photo");
                                photo.setAttribute('src', image);
                            }
                        </script>

                        @if($product->photos->count())
                            <img src="{{ asset('storage/'.$product->photos->first()->image) }}" id="photo" alt="Imagem" class="w-full mb-1" />
                            <div class="grid gap-1 grid-cols-3 sm:grid-cols-3 md:grid-cols-5">
                                @foreach ($product->photos as $photo)
                                    <div>
                                        <a onClick="changeImage('{{asset('storage/'.$photo->image)}}')" class="cursor-pointer">
                                            <img src="{{asset('storage/'.$photo->image)}}" alt="Imagem" class="w-full" />
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Foto não cadastrada!</p>
                        @endif

                    </div>
                    <div class="flex-1 p-6">
                        <h1 class="text-3xl text-blue-700">{{$product->title}}</h1>
                        <h2 class="text-2xl font-bold">R$ {{number_format($product->price,2,',','.')}}</h2>
                        <p class="text-red-600">Frete Grátis</p>
                        @php
                            echo '<p>Chega dia: '.date('d/m/Y', strtotime('+25 days')).'</p>'; 
                        @endphp
                        <br/>
                        <span class="bg-orange-600 text-white text-xs p-1 border border-orange-700 rounded-md">Classifcação em alta</span>

                        <p class="py-8">{{$product->description}}</p>
                        
                        <form method="POST" action="" class="flex">
                            <input type="number" name="qtd" value="1" min="1" max="10" class="border p-2 w-16 h-10 rounded mr-1 mb-2 md:mb-0" />
                            <button type="submit" class="bg-blue-800 py-2 px-5 text-white rounded flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                </svg> 
                                Fazer Pagamento
                            </button>
                        </form>
                        <br/><br/>
                        <img src="{{asset('images/formas-de-pagamento.jpg')}}" alt="Formas de pagamento" class="m-auto" />
                        
                    </div>

                </div>

                <div class="bg-white mb-5">
                    <br/><br/><br/>
                    <h1 class="text-3xl text-center">Veja esse produto no Market Place</h1>
                    <div class="flex flex-wrap justify-evenly">
                        <a href="#" class="m-3">
                            <img src="{{asset('images/marketplace/logo-amazon.jpg')}}" alt="Market place" title="Clique aqui para ver esse produto no Marlet Place" target="_blank" />
                        </a>
                        <a href="#" class="m-3">
                            <img src="{{asset('images/marketplace/logo-elo7.jpg')}}" alt="Market place" title="Clique aqui para ver esse produto no Marlet Place" target="_blank" />
                        </a>
                        <a href="#" class="m-3">
                            <img src="{{asset('images/marketplace/logo-enjoei.jpg')}}" alt="Market place" title="Clique aqui para ver esse produto no Marlet Place" target="_blank" />
                        </a>
                        <a href="#" class="m-3">
                            <img src="{{asset('images/marketplace/logo-facebook.jpg')}}" alt="Market place" title="Clique aqui para ver esse produto no Marlet Place" target="_blank" />
                        </a>
                        <a href="#" class="m-3">
                            <img src="{{asset('images/marketplace/logo-magalu.jpg')}}" alt="Market place" title="Clique aqui para ver esse produto no Marlet Place" target="_blank" />
                        </a>
                        <a href="#" class="m-3">
                            <img src="{{asset('images/marketplace/logo-mercado-livre.jpg')}}" alt="Market place" title="Clique aqui para ver esse produto no Marlet Place" target="_blank" />
                        </a>
                        <a href="#" class="m-3">
                            <img src="{{asset('images/marketplace/logo-olx.jpg')}}" alt="Market place" title="Clique aqui para ver esse produto no Marlet Place" target="_blank" />
                        </a>
                    </div>
                </div>


            </section>

        </aside>

        @include('footer')

    </body>
</html>
