<?php

namespace App\Http\Controllers;


use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\Http\Request;
use App\Enums\Species;
use Illuminate\Validation\Rule;

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
            'shelters' => Shelter::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:50'],
        'species' => ['required', Rule::enum(Species::class)],
        'shelter_id' => ['required', 'integer', 'exists:shelters,id'],
        'birth_date' => ['nullable', 'date', 'before_or_equal:today'],
        'description' => ['nullable', 'string', 'max:1000'],
    ]);

    $animal = Animal::create($validated);

    return redirect()
        ->route('animals.show', $animal->id)
        ->with('status', "L'animal a été ajouté.");
}
}
