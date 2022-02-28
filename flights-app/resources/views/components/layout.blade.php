<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Flights App</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.gstatic.com" />
<link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap"
    rel="stylesheet"
/>
<script
    src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
    defer
></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
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

    .table-wrapper {
        position: relative;
        width: 80%;
        margin: auto;
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        const formRequest = ({
            e,
            form,
            url = form.attr("action"),
            success = false,
            error = (error) => {
                alert(error.responseJSON.message);
            },
        }) => {
            e.preventDefault();
            const data = form.serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj;
            }, {});

            $.ajax({
                url,
                data,
                type: form.attr("method"),
                success,
                error,
            });
        };

        const fetchFormRequest = async ({
            e,
            form,
            url = form.attr("action"),
            method = form.attr("method"),
        }) => {
            e.preventDefault();
            const data = form.serializeArray().reduce((obj, item) => {
                obj[item.name] = item.value;
                return obj;
            }, {});
            const response = await fetch(url, {
                method,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });
            if (response.ok) {
                return response.json();
            } else {
                return response.json().then((error) => {
                    throw new Error(error.message);
                });
            }
        };

        const getQueryParams = () => window.location.href.split("?")[1] || "";
    </script>

    <div id="app">
        <section class="px-6 py-8">
            {{ $slot }}
        </section>
    </div>
</body>
