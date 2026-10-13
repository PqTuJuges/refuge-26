@props(['animal', 'shelters', 'tags'])

@php
    $checkedTags = session()->hasOldInput()
        ? (array) old('tags', [])
        : $animal->tags->pluck('id')->all();
@endphp

<div>
    <x-label for="name">Nom</x-label>
    <x-input name="name" :value="old('name', $animal->name)" />
    @error('name')
        <p id="name-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <x-label for="species">Espèce</x-label>
    <x-select name="species">
        <option value="">Choisir une espèce</option>
        @foreach (App\Enums\Species::cases() as $species)
            <option value="{{ $species->value }}" @selected(old('species', $animal->species?->value) === $species->value)>
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
            <option value="{{ $shelter->id }}" @selected((int) old('shelter_id', $animal->shelter_id) === $shelter->id)>
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
    <x-input type="date" name="birth_date" :value="old('birth_date', $animal->birth_date?->format('Y-m-d'))" />
    @error('birth_date')
        <p id="birth_date-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <x-label for="description">Description</x-label>
    <x-textarea name="description">{{ old('description', $animal->description) }}</x-textarea>
    @error('description')
        <p id="description-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>

<fieldset>
    <legend class="text-sm font-medium">Traits de caractère</legend>
    <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-4">
        @foreach ($tags as $tag)
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, $checkedTags))>
                {{ $tag->name }}
            </label>
        @endforeach
    </div>
    @error('tags')
        <p id="tags-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @error('tags.*')
        <p id="tags-item-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</fieldset>
