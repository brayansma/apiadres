<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UnidadController extends Controller
{
    public function index()
    {
        $unidades = Unidad::select('id', 'nombre', 'created_at', 'updated_at')->get()->map(function ($unidad) {
            return [
                'id' => $unidad->id,
                'nombre' => $unidad->nombre,
                'created_at' => $unidad->created_at->format('Y-m-d'),
                'updated_at' => $unidad->updated_at->format('Y-m-d'),
            ];
        });
        return response()->json(['data' =>$unidades], 200);
    }

    public function show($id)
    {
        $unidad = Unidad::find($id);
        if (!$unidad) {
            return response()->json(['message' => 'Unidad no encontrada'], 404);
        }

        return response()->json([ 'data' =>[
            'id' => $unidad->id,
            'nombre' => $unidad->nombre,
            'created_at' => $unidad->created_at->format('Y-m-d'),
            'updated_at' => $unidad->updated_at->format('Y-m-d')
        ]], 200);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya esta registrado.',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:unidades'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $unidad = Unidad::create($request->all());

        return response()->json([
            'message' => 'Unidad creada correctamente',
            'data' => [
                'id' => $unidad->id,
                'nombre' => $unidad->nombre,
                'created_at' => $unidad->created_at->format('Y-m-d'),
                'updated_at' => $unidad->updated_at->format('Y-m-d')
            ]
        ], 201);
    }

    public function update(Request $request, $id)
    {

        $unidad = Unidad::find($id);
        if (!$unidad) {
            return response()->json(['message' => 'Unidad no encontrada para actualizar'], 404);
        }

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya esta registrado y no se pude actualizar.',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:unidades,nombre,' . $id . ',id'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $unidad = Unidad::findOrFail($id);
        $unidad->nombre = $request->input('nombre');
        $unidad->update($request->all());

        return response()->json([
            'message' => 'Unidad actualizada correctamente', 'data' => [
                'id' => $unidad->id,
                'nombre' => $unidad->nombre,
                'created_at' => $unidad->created_at->format('Y-m-d'),
                'updated_at' => $unidad->updated_at->format('Y-m-d')
            ]
        ], 200);
    }

    public function destroy($id)
    {
        $unidad = Unidad::find($id);
        if (!$unidad) {
            return response()->json(['message' => 'Unidad no encontrada'], 404);
        }

        $unidad->delete();

        return response()->json(['message' => 'Unidad eliminada correctamente'], 200);
    }


    public function restore($id)
    {
        $unidad = Unidad::withTrashed()->find($id);

        if ($unidad === null) {
            return response()->json(['error' => 'No se encontró la unidad'], 404);
        }

        if (!$unidad->trashed()) {
            return response()->json(['error' => 'La unidad no está eliminada'], 400);
        }

        $unidad->restore();

        return response()->json([
            'message' => 'Unidad restaurada correctamente', 'data' => [
                'id' => $unidad->id,
                'nombre' => $unidad->nombre,
                'created_at' => $unidad->created_at->format('Y-m-d'),
                'updated_at' => $unidad->updated_at->format('Y-m-d')
            ]
        ], 200);
    }
}
