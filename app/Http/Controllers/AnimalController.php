<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\JsonResponse;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $animals = Animal::all();
        // return view('home', compact('animals'));
    }

    /**
     * Display the specified resource.
     */
    public function create()
    {
        $cages = Cage::all();
        $cages = array_filter($cages->values()->all(), static function ($cage) {
            return $cage->animals->count() < $cage->capacity;
        });

        return view('animal/create', compact("cages"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $cage = Cage::find($data['cage_id']);

        if ($cage->animals()->count() < $cage->capacity) {
            return response()->json(Animal::create($data), JsonResponse::HTTP_CREATED);
        }
        return response()->json(['message' => 'You can\'t create a new animal, cage is full'], JsonResponse::HTTP_CONFLICT);
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        return view('animal/show', compact('animal'));
    }

    public function edit(Animal $animal)
    {
        $cage_id = $animal->cage->id;
        return view('animal/edit', compact('animal', 'cage_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $data = $request->validated();

        $cage = Cage::find($data['cage_id']);
        if ($animal['cage_id'] == $data['cage_id'] || $cage->animals()->count() < $cage->capacity) {
            $animal->update($data);
            return response()->json($animal, JsonResponse::HTTP_OK);
        }
        return response()->json(['message' => 'You can\'t update an animal, cage is full'], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        $cage_id = $animal->cage->id;
        $animal->delete();
        // return redirect("/cages/" . $cage_id);
        return response()->json(['message' => 'Animal deleted'], JsonResponse::HTTP_OK);
    }
}
