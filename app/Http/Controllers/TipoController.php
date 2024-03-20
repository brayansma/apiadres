<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoController extends Controller
{
    public function index()
    {

        $tipos = Tipo::select('id', 'nombre', 'categoria', 'created_at', 'updated_at')->get()->map(function ($tipo) {
            return [
                'id' => $tipo->id,
                'nombre' => $tipo->nombre,
                'categoria' => $tipo->categoria,
                'created_at' => $tipo->created_at->format('Y-m-d'),
                'updated_at' => $tipo->updated_at->format('Y-m-d'),
            ];
        });
        return response()->json(['data' => $tipos], 200);
    }

    public function show($id)
    {
        $tipo = Tipo::find($id);
        if (!$tipo) {
            return response()->json(['message' => 'Tipo no encontrado'], 404);
        }

        return response()->json(['data' =>[
            'id' => $tipo->id,
            'nombre' => $tipo->nombre,
            'categoria' => $tipo->categoria,
            'created_at' => $tipo->created_at->format('Y-m-d'),
            'updated_at' => $tipo->updated_at->format('Y-m-d')
        ]], 200);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya esta registrado.',
            'in' => 'La :attribute seleccionada no es válida.',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:tipos',
            'categoria' => 'required|in:Bien,Servicio',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $tipo = Tipo::create($request->all());
        return response()->json([
            'message' => 'Tipo creado correctamente',
            'data' => [
                'id' => $tipo->id,
                'nombre' => $tipo->nombre,
                'categoria' => $tipo->categoria,
                'created_at' => $tipo->created_at->format('Y-m-d'),
                'updated_at' => $tipo->updated_at->format('Y-m-d')
            ]
        ], 201);

    }

    public function update(Request $request, $id)
    {
        $tipo = Tipo::find($id);
        if (!$tipo) {
            return response()->json(['message' => 'Tipo no encontrado para actualizar'], 404);
        }

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya esta registrado.',
            'in' => 'La :attribute seleccionada no es válida.',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:tipos,nombre,' . $id,
            'categoria' => 'required|in:Bien,Servicio',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $tipo = Tipo::findOrFail($id);
        $tipo->update($request->all());

        return response()->json([
            'message' => 'Tipo actualizado correctamente', 'data' => [
                'id' => $tipo->id,
                'nombre' => $tipo->nombre,
                'categoria' => $tipo->categoria,
                'created_at' => $tipo->created_at->format('Y-m-d'),
                'updated_at' => $tipo->updated_at->format('Y-m-d')
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $tipo = Tipo::find($id);
        if (!$tipo) {
            return response()->json(['message' => 'Tipo no encontrado'], 404);
        }
        $tipo->delete();
        return response()->json(['message' => 'Tipo eliminado correctamente'], 200);
    }

    public function restore($id)
    {
        $tipo = Tipo::withTrashed()->find($id);
        if (!$tipo) {
            return response()->json(['message' => 'Tipo no encontrado'], 404);
        }
        if (!$tipo->trashed()) {
            return response()->json(['message' => 'El tipo no está eliminado'], 400);
        }
        $tipo->restore();
        return response()->json([
            'message' => 'Tipo restaurado correctamente', 'data' => [
                'id' => $tipo->id,
                'nombre' => $tipo->nombre,
                'categoria' => $tipo->categoria,
                'created_at' => $tipo->created_at->format('Y-m-d'),
                'updated_at' => $tipo->updated_at->format('Y-m-d')
            ]
        ], 200);
    }
}
