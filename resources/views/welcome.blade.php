<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="/css/welcome.css">


    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        {{-- @if (Route::has('login')) --}}
                            <nav class="-mx-3 flex flex-1 justify-end">
                                {{-- @auth --}}
                                    <a
                                        href="{{ url('/home') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Home
                                    </a>
                                {{-- @else --}}
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                {{-- @endauth --}}
                            </nav>
                        {{-- @endif --}}
                    </header>

                    <div class="container">
                        <!-- Header -->
                        <header>
                            <h1>TUS MART</h1>

                            <p>Menyediakan kue terbaik dengan rasa yang tak terlupakan</p>
                        </header>

                        <!-- Profile Content -->
                        <section class="profile-section">
                            <div class="profile-card">
                                <h2>Tentang Kami</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et purus quis enim aliquet fringilla. Nullam efficitur, neque vel eleifend euismod, felis nulla bibendum nunc, non sagittis urna metus ac eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Sed nec orci ut magna fermentum tincidunt. Sed convallis tincidunt risus, a tristique nunc convallis et. Integer scelerisque magna ac leo mollis luctus. Proin lobortis velit id justo faucibus, ut egestas nisl cursus. Curabitur fringilla dui magna, ac volutpat erat interdum ac. Donec ac ligula in turpis dictum venenatis. Nam a magna et quam viverra tempor a ut nisl. Vestibulum non gravida quam. Quisque nec metus eget mauris volutpat tincidunt. Nullam a erat ac ligula pharetra vehicula ut in libero. Suspendisse eget odio vel odio sollicitudin venenatis ut vitae eros. Duis eget lacus a ligula lobortis malesuada. Sed malesuada arcu a ante aliquet tempus. Vivamus in vehicula libero, nec ultrices turpis. Ut auctor ligula sit amet ex feugiat auctor. Nam tempor mi vel justo viverra, at posuere metus luctus. Ut gravida congue nisi, nec iaculis ligula dapibus quis. Ut viverra, enim ac pharetra placerat, elit sem iaculis eros, ut volutpat lorem augue ac sapien. Integer dapibus scelerisque felis, at maximus felis dictum ut. Donec at odio fringilla, vulputate urna sit amet, cursus dolor..</p>
                            </div>
                        </section>
                    </div>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
        </div>
    </body>
</html>
