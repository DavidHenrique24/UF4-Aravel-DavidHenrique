<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Tarjeta;
use Illuminate\Support\Facades\Auth;

class TarjetaController extends Controller
{
    public function index()
    {
        // Opcional: mostrar todas o solo públicas
        $tarjetas = Tarjeta::all();
        return response()->json(['tarjetas' => $tarjetas], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'imagen' => 'required|url',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $tarjeta = Tarjeta::create([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(), // Asignar propietario
        ]);

        return response()->json(['tarjeta' => $tarjeta], 201);
    }

    public function show($id)
    {
        $tarjeta = Tarjeta::find($id);

        if (!$tarjeta) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }

        return response()->json(['tarjeta' => $tarjeta], 200);
    }

    public function update(Request $request, $id)
    {
        $tarjeta = Tarjeta::find($id);

        if (!$tarjeta) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }

        // Verificar que es propietario o admin
        $user = Auth::user();
        if ($tarjeta->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'imagen' => 'required|url',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $tarjeta->update($request->only(['nombre', 'imagen', 'category_id']));

        return response()->json(['tarjeta' => $tarjeta], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $tarjeta = Tarjeta::find($id);

        if (!$tarjeta) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }

        // Verificar que es propietario o admin
        $user = Auth::user();
        if ($tarjeta->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|max:255',
            'imagen' => 'sometimes|url',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $tarjeta->update($request->only(['nombre', 'imagen', 'category_id']));

        return response()->json(['tarjeta' => $tarjeta], 200);
    }

    public function destroy($id)
    {
        $tarjeta = Tarjeta::find($id);

        if (!$tarjeta) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }

        // Verificar que es propietario o admin
        $user = Auth::user();
        if ($tarjeta->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $tarjeta->delete();
        return response()->json(['message' => 'Tarjeta eliminada'], 200);
    }




    // Listar tarjetas propias del usuario autenticado
    public function myCards()
    {
        $tarjetas = Tarjeta::where('user_id', Auth::id())->get();

        return response()->json([
            'message' => 'Tus tarjetas',
            'tarjetas' => $tarjetas
        ], 200);
    }

    // Listar tarjetas públicas (sin propietario)
    public function publicCards()
    {
        $tarjetas = Tarjeta::whereNull('user_id')->get();

        return response()->json([
            'message' => 'Tarjetas públicas',
            'tarjetas' => $tarjetas
        ], 200);
    }




    // Mostrar totes les targetes con admin 
public function all()
{
    return Card::with('user', 'category')->get();
}

// Eliminar qualsevol targeta (com admin)
public function adminDestroy(Card $card)
{
    $card->delete();
    return response()->json(['message' => 'Targeta eliminada per admin']);
}

// Opcional: editar targeta com admin
public function adminUpdate(Request $request, Card $card)
{
    $request->validate([
        'nombre' => 'sometimes|string|max:100',
        'url_imagen' => 'sometimes|url',
        'category_id' => 'nullable|exists:categories,id',
    ]);

    $card->update($request->all());

    return response()->json([
        'message' => 'Targeta actualitzada per admin',
        'data' => $card
    ]);
}

}
