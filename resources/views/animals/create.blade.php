<x-layouts.app>
    <div class="mx-auto max-w-xl">
        <x-card>
            <h1 class="mb-6 text-2xl font-bold">Ajouter un animal</h1>

            <form method="POST" action="{{ route('animals.store') }}" class="space-y-4">
                @csrf

                <div>
                    <x-label for="name">Nom</x-label>
                    <x-input name="name" :value="old('name')" />
                    @error('name')
                        <p id="name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-label for="species">Espèce</x-label>
                    <x-select name="species">
                        <option value="">Choisir une espèce</option>
                        @foreach (App\Enums\Species::cases() as $species)
                            <option value="{{ $species->value }}" @selected(old('species') === $species->value)>
                                {{ $species->label() }}
                            </option>
                        @endforeach
                    </x-select>
                    @error('species')
                        <p id="species-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-label for="shelter_id">Refuge</x-label>
                    <x-select name="shelter_id">
                        <option value="">Choisir un refuge</option>
                        @foreach ($shelters as $shelter)
                            <option value="{{ $shelter->id }}" @selected((int) old('shelter_id') === $shelter->id)>
                                {{ $shelter->name }}
                            </option>
                        @endforeach
                    </x-select>
                    @error('shelter_id')
                        <p id="shelter_id-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-label for="birth_date">Date de naissance</x-label>
                    <x-input type="date" name="birth_date" :value="old('birth_date')" />
                    @error('birth_date')
                        <p id="birth_date-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <x-label for="description">Description</x-label>
                    <x-textarea name="description">{{ old('description') }}</x-textarea>
                    @error('description')
                        <p id="description-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <x-button type="submit">Enregistrer</x-button>
            </form>
        </x-card>
    </div>
</x-layouts.app>
