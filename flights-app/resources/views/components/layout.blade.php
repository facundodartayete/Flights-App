<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Flights App</title>
<link rel="preconnect" href="https://fonts.gstatic.com" />
<link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
    rel="stylesheet"
/>
<script
    src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
    defer
></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/layout.js') }}"></script>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="#">
                    <img
                        src="/images/logo.svg"
                        alt="Laracasts Logo"
                        width="165"
                        height="16"
                    />
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex items-center">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="text-xs font-bold uppercase">
                            Welcome, Darta!
                        </button>
                    </x-slot>
                    <x-dropdown-item href="/cities" :active="false">
                        Cities
                    </x-dropdown-item>
                    <x-dropdown-item href="/airlines" :active="false">
                        Airlines
                    </x-dropdown-item>
                    <x-dropdown-item href="/flights" :active="false">
                        Flights
                    </x-dropdown-item>
                </x-dropdown>

                <a
                    href="#newsletter"
                    class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5"
                >
                    Subscribe for Updates
                </a>
            </div>
        </nav>
        <div id="app">
            <section class="px-6 py-8">
                {{ $slot }}
            </section>
        </div>
    </section>
</body>
