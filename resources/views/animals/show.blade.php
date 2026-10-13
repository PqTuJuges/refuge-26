<x-layouts.app>
    <article>
        <div class="flex flex-wrap items-center gap-2">
            <x-badge>{{ $animal->species->label() }}</x-badge>
            @if ($animal->isAdopted())
                <x-badge variant="adopted">Adopté</x-badge>
            @endif
        </div>

        <h1 class="mt-2 text-2xl font-bold">{{ $animal->name }}</h1>

        <p>{{ $animal->shelter->name }}</p>

        @if ($animal->age() !== null)
            <p>{{ $animal->age() }} ans</p>
        @endif

        @if ($animal->description)
            <p class="mt-4">{{ $animal->description }}</p>
        @endif

        <div class="mt-4 flex flex-wrap gap-2">
            @foreach ($animal->tags as $tag)
                <x-badge variant="tag">{{ $tag->name }}</x-badge>
            @endforeach
        </div>
    </article>
</x-layouts.app>
