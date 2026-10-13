<x-layouts.app>
    <h1 class="mb-6 text-2xl font-bold">Les animaux à adopter</h1>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($animals as $animal)
            <x-card>
                <x-slot:image>
                    <img src="{{ asset('images/species/chat.svg') }}" alt="" width="200" height="200" class="aspect-4/3 w-full bg-brand-50 object-contain dark:bg-brand-100">
                </x-slot:image>

                <x-badge variant="species">{{ $animal->species->label() }}</x-badge>

                <h2 class="mt-2 text-lg font-semibold">
                    <a href="{{ route('animals.show', $animal->id) }}">{{ $animal->name }}</a>
                </h2>

                <p>{{ $animal->shelter->name }}</p>
            </x-card>
        @empty
            <p>Aucun animal à adopter pour le moment.</p>
        @endforelse
    </div>
</x-layouts.app>
