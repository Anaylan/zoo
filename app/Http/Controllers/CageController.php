<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCageRequest;
use App\Http\Requests\UpdateCageRequest;
use App\Models\Animal;
use App\Models\Cage;
use Illuminate\Http\JsonResponse;

class CageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cages = Cage::all();
        return view('home', compact('cages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCageRequest $request): JsonResponse
    {
        $data = $request->validated();
        return response()->json(Cage::create($data), JsonResponse::HTTP_CREATED);
    }

    public function create()
    {
        return view('cage/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cage $cage)
    {
        $animals = Animal::where('cage_id', '=', $cage->id)->get();
        return view('cage/show', compact('animals'));
    }

    public function edit(Cage $cage)
    {
        return view('cage/edit', compact('cage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCageRequest $request, Cage $cage): JsonResponse
    {

        $data = $request->validated();
        // dd($cage->animals()->count());
        if ($data["capacity"] < $cage->animals()->count()) {
            return response()->json(["message" => 'The capacity of a cage cannot be less than the number of animals in it.'], JsonResponse::HTTP_CONFLICT);
        }
        $cage->update($data);
        return response()->json($cage, JsonResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cage $cage): JsonResponse
    {
        // dd($cage->animals->count());
        if ($cage->animals->count() < 1) {
            $cage->delete();
            return response()->json(['message' => 'Cage deleted'], JsonResponse::HTTP_OK);
        }

        return response()->json(['message' => 'The cage is not empty, free it.'], JsonResponse::HTTP_CONFLICT);
    }
}
