<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Validator;

class PetController extends Controller

{
  public function index()
    {
        $pets = Pet::all();
        return response()->json(['Mascotas' => $pets], 200);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|url',
            'description' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pets = Pet::create($request->all());
        return response()->json(['MAscotas' => $pets], 201);
    }


     public function show($id)
    {
        $pets = Pet::find($id);

        if (!$pets) {
            return response()->json(['message' => 'Mascota no existente'], 404);
        }

        return response()->json(['mascota' => $pets], 200);
    }


     public function update(Request $request, $id)
    {
        $pets = Pet::find($id);

        if (!$pets) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|url',
            'description' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pets->update($request->all());
        return response()->json(['Mascota' => $pets], 200);
    }



      public function updatePartial(Request $request, $id)
    {
        $pets = Pet::find($id);

        if (!$pets) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|max:255',
            'image' => 'sometimes|url',
            'description' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $pets->update($request->all());
        return response()->json(['Mascotas' => $pets], 200);
    }

public function destroy($id)
    {
        $pets = Pet::find($id);

        if (!$pets) {
            return response()->json(['message' => 'Mascota no encontrada'], 404);
        }

        $pets->delete();
        return response()->json(['message' => 'Mascota eliminada'], 200);
    }









}
