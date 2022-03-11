<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Termos e Políticas de Entrega</title>

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

                
                <div class="mb-3 px-3 md:px-0">
                    <h2 class="text-3xl font-bold">Termos e políticas de entrega da compra.</h2>
                </div>
                <div class="bg-white p-6 rounded-lg">
                    <div class="py-4">
                        <h2 class="text-2xl font-bold">Como comprar?</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit.</p>
                    </div>
                    <div class="py-4">
                        <h2 class="text-2xl font-bold">Fomas de pagamento:</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam.</p>
                    </div>
                    <div class="py-4">
                        <h2 class="text-2xl font-bold">Cancelamento da compra:</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit.</p>
                    </div>
                    <div class="py-4">
                        <h2 class="text-2xl font-bold">Quantos dias chega minha compra?</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint.</p>
                    </div>
                    <div class="py-4">
                        <h2 class="text-2xl font-bold">Quem pode comprar?</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint.</p>
                    </div>
                    <div class="py-4">
                        <h2 class="text-2xl font-bold">Os produtos são originais?</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste tenetur natus assumenda quam. Alias ratione nulla perspiciatis doloremque, quo quis sint. Nam soluta esse corrupti praesentium labore sequi, molestiae reprehenderit.</p>
                    </div>
                </div>

            </section>

        </aside>

        @include('footer')

    </body>
</html>
