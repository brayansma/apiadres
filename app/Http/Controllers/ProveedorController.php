<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProveedorController extends Controller
{
    // Método para mostrar todos los proveedores
    public function index()
    {
        $proveedores = Proveedor::all()->map(function ($proveedor) {
            return [
                'id' => $proveedor->id,
                'nombre' => $proveedor->nombre,
                'created_at' => $proveedor->created_at->format('Y-m-d'),
                'updated_at' => $proveedor->updated_at->format('Y-m-d'),
            ];
        });
        
        return response()->json( ['data' =>$proveedores], 200);
    }

    // Método para mostrar un proveedor específico por su ID
    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }
        return response()->json(['data' =>[
            'id' => $proveedor->id,
            'nombre' => $proveedor->nombre,
            'created_at' => $proveedor->created_at->format('Y-m-d'),
            'updated_at' => $proveedor->updated_at->format('Y-m-d')
        ]], 200);
    }

    // Método para almacenar un nuevo proveedor
    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya está registrado.',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:proveedores'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $proveedor = Proveedor::create($request->all());

        return response()->json([
            'message' => 'Proveedor creado correctamente',
            'data' => [
                'id' => $proveedor->id,
                'nombre' => $proveedor->nombre,
                'created_at' => $proveedor->created_at->format('Y-m-d'),
                'updated_at' => $proveedor->updated_at->format('Y-m-d')
            ]
        ], 201);
    }

    // Método para actualizar un proveedor existente
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['message' => 'Proveedor no encontrado para actualizar'], 404);
        }

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya está registrado y no se puede actualizar.',
        ];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255|unique:proveedores,nombre,' . $id . ',id'
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre = $request->input('nombre');
        $proveedor->save();

        return response()->json([
            'message' => 'Proveedor actualizado correctamente',
            'data' => [
                'id' => $proveedor->id,
                'nombre' => $proveedor->nombre,
                'created_at' => $proveedor->created_at->format('Y-m-d'),
                'updated_at' => $proveedor->updated_at->format('Y-m-d')
            ]
        ], 200);
    }

    // Método para eliminar un proveedor
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        $proveedor->delete();

        return response()->json(['message' => 'Proveedor eliminado correctamente'], 200);
    }

    // Método para restaurar un proveedor eliminado
    public function restore($id)
    {
        $proveedor = Proveedor::withTrashed()->find($id);

        if (!$proveedor) {
            return response()->json(['message' => 'Proveedor no encontrado'], 404);
        }

        if (!$proveedor->trashed()) {
            return response()->json(['message' => 'El proveedor no está eliminado'], 400);
        }

        $proveedor->restore();

        return response()->json([
            'message' => 'Proveedor restaurado correctamente',
            'data' => [
                'id' => $proveedor->id,
                'nombre' => $proveedor->nombre,
                'created_at' => $proveedor->created_at->format('Y-m-d'),
                'updated_at' => $proveedor->updated_at->format('Y-m-d')
            ]
        ], 200);
    }
}
