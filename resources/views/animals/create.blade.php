<x-layouts.app>
    <x-card>
        <h1 class="mb-6 text-2xl font-bold">Ajouter un animal</h1>

        <form method="POST" action="{{ route('animals.store') }}" class="space-y-4">
            @csrf

            <div>
                <x-label for="name">Nom</x-label>
                <x-input name="name" :value="old('name')" />
            </div>

            <div>
                <x-label for="species">Espèce</x-label>
                <x-select name="species">
                    @foreach (App\Enums\Species::cases() as $species)
                        <option value="{{ $species->value }}" @selected(old('species') === $species->value)>
                            {{ $species->label() }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div>
                <x-label for="shelter_id">Refuge</x-label>
                <x-select name="shelter_id">
                    @foreach ($shelters as $shelter)
                        <option value="{{ $shelter->id }}" @selected((int) old('shelter_id') === $shelter->id)>
                            {{ $shelter->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div>
                <x-label for="birth_date">Date de naissance</x-label>
                <x-input type="date" name="birth_date" :value="old('birth_date')" />
            </div>

            <div>
                <x-label for="description">Description</x-label>
                <x-textarea name="description">{{ old('description') }}</x-textarea>
            </div>

            <x-button type="submit">Enregistrer</x-button>
        </form>
    </x-card>
</x-layouts.app>
