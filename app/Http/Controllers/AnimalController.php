<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Animal;
use App\Models\Shelter;
use App\Models\Tag;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::with('shelter')
            ->whereNull('adopted_at')
            ->orderBy('name')
            ->get();

        return view('animals.index', ['animals' => $animals]);
    }

    public function show($id)
    {
        $animal = Animal::with(['shelter', 'tags'])->findOrFail($id);

        return view('animals.show', ['animal' => $animal]);
    }

    public function create()
    {
        return view('animals.create', [
            'animal' => new Animal,
            'shelters' => Shelter::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    public function store(AnimalRequest $request)
    {
        $animal = Animal::create($request->safe()->except('tags'));
        $animal->tags()->sync($request->validated('tags') ?? []);

        return redirect()
            ->route('animals.show', $animal->id)
            ->with('status', "L'animal a été ajouté.");
    }

    public function edit($id)
    {
        $animal = Animal::with('tags')->findOrFail($id);

        return view('animals.edit', [
            'animal' => $animal,
            'shelters' => Shelter::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    public function update(AnimalRequest $request, $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->update($request->safe()->except('tags'));
        $animal->tags()->sync($request->validated('tags') ?? []);

        return redirect()
            ->route('animals.show', $animal->id)
            ->with('status', "L'animal a été modifié.");
    }
        public function adopt($id)
    {
        $animal = Animal::findOrFail($id);

        if (! $animal->isAdopted()) {
            $animal->update(['adopted_at' => today()]);
        }

        return redirect()
            ->route('animals.show', $animal->id)
            ->with('status', "{$animal->name} a trouvé une famille.");
    }
        public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return redirect()
            ->route('animals.index')
            ->with('status', "L'animal a été supprimé.");
    }

}
