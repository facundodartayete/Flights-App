<!doctype html>

<title>Flights App</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
{{-- <script src="{{ asset('/js/app.js') }}" defer></script> --}}
{{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
<script src="{{ asset('/js/jquery.js') }}"></script>

<style>
    html {
        scroll-behavior: smooth;
    }

    .clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp.one-line {
        -webkit-line-clamp: 1;
    }

</style>

<body style="font-family: Open Sans, sans-serif">
    <script>
        const formRequest = ({
            e,
            form,
            success = () => {},
        }) => {
            e.preventDefault();
            const formData = form.serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj;
            }, {});

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                success: success,
            });
            return false;
        };
    </script>

    <div id="app">
        <section class="px-6 py-8">
            {{ $slot }}
        </section>
    </div>
</body>
