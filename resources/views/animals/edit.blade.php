<x-layouts.app>
    <div class="mx-auto max-w-xl">
        <x-card>
            <h1 class="mb-6 text-2xl font-bold">Modifier {{ $animal->name }}</h1>

            <form method="POST" action="{{ route('animals.update', $animal->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <x-animal-fields :animal="$animal" :shelters="$shelters" :tags="$tags" />

                <x-button type="submit">Enregistrer</x-button>
            </form>
        </x-card>
    </div>
</x-layouts.app>
