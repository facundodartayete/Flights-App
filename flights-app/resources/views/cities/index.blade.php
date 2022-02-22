<x-layout>
    {{-- @include ('cities._header') --}}

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($cities->count())
        <h1 class="text-center">Cities</h1>
        <table>
                @foreach ($cities as $city)
                    <tr><td>{{ $city->name }}</td></tr>
                @endforeach
            </table>
        @else
            <p class="text-center">No posts yet. Please check back later.</p>
        @endif
    </main>
</x-layout>
