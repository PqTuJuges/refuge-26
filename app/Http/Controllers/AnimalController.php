<?php

namespace App\Http\Controllers;

use App\Models\Animal;

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
}
