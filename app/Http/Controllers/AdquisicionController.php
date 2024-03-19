<?php

namespace App\Http\Controllers;

use App\Models\Adquisicion;
use App\Models\Unidad;
use App\Models\Tipo;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdquisicionController extends Controller
{
    public function index()
    {
        $adquisiciones = Adquisicion::all()->map(function($adquisicion){
            return [
                'id' => $adquisicion->id,
                'presupuesto' => $adquisicion->presupuesto,
                'valor_unitario' => $adquisicion->valor_unitario,
                'valor_total' => $adquisicion->valor_total,
                'fecha_adquisicion' => $adquisicion->fecha_adquisicion,
                'cantidad' => $adquisicion->cantidad,
                'unidad_id' => $adquisicion->unidad_id,
                'tipo_id' => $adquisicion->tipo_id,
                'documentacion' => $adquisicion->documentacion,
                'proveedor_id' => $adquisicion->proveedor_id,
                'created_at' => $adquisicion->created_at->format('Y-m-d'),
                'updated_at' => $adquisicion->updated_at->format('Y-m-d')
            ];
        });

        return response()->json(['data' =>$adquisiciones], 200);
    }

    public function show($id)
    {
        $adquisicion = Adquisicion::findOrFail($id);
        #$adquisicion = Adquisicion::find($id);
        if (!$adquisicion) {
            return response()->json(['message' => 'Adquisicion no encontrado'], 404);
        }
        return response()->json(['data' =>[
            'id' => $adquisicion->id,
            'presupuesto' => $adquisicion->presupuesto,
            'valor_unitario' => $adquisicion->valor_unitario,
            'valor_total' => $adquisicion->valor_total,
            'fecha_adquisicion' => $adquisicion->fecha_adquisicion,
            'cantidad' => $adquisicion->cantidad,
            'unidad_id' => $adquisicion->unidad_id,
            'tipo_id' => $adquisicion->tipo_id,
            'documentacion' => $adquisicion->documentacion,
            'proveedor_id' => $adquisicion->proveedor_id,
            'created_at' => $adquisicion->created_at->format('Y-m-d'),
            'updated_at' => $adquisicion->updated_at->format('Y-m-d')
        ]], 200);
        return response()->json($adquisicion);
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya esta registrado.',
            'in' => 'La :attribute seleccionada no es válida.',
            'unidad_id.exists' => 'El campo unidad_id no corresponde a una unidad existente.',
            'tipo_id.exists' => 'El campo tipo_id no corresponde a un tipo existente.',
            'proveedor_id.exists' => 'El campo proveedor_id no corresponde a un proveedor existente.',
        ];
        /*  $adquisicion = Adquisicion::create($request->all());
        return response()->json($adquisicion, 201); */
        $rules = [
            'presupuesto' => 'required|numeric',
            'cantidad' => 'required|integer',
            'valor_unitario' => 'required|numeric',
            'valor_total' => 'required|numeric',
            'fecha_adquisicion' => 'required',
            'unidad_id' => 'required|exists:unidades,id',
            'tipo_id' => 'required|exists:tipos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ];

        // Realiza la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verifica si la validación falla
        if ($validator->fails()) {
            // Retorna un error de validación con los mensajes correspondientes
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtiene los datos validados
        $validatedData = $validator->validated();

        // Verifica si existen los registros referenciados por claves foráneas
        $unidadExists = Unidad::find($validatedData['unidad_id']);
        $tipoExists = Tipo::find($validatedData['tipo_id']);
        $proveedorExists = Proveedor::find($validatedData['proveedor_id']);


        if (!$unidadExists) {
            return response()->json(['message' => 'La unidad especificada no existe.'], 404);
        }

        if (!$tipoExists) {
            return response()->json(['message' => 'El tipo especificado no existe.'], 404);
        }

        if (!$proveedorExists) {
            return response()->json(['message' => 'El proveedor especificado no existe.'], 404);
        }


        $adquisicion = Adquisicion::create($request->all());
        return response()->json([
            'message' => 'Adquisición creada correctamente',
            'data' => [
                'id' => $adquisicion->id,
                'presupuesto' => $adquisicion->presupuesto,
                'valor_unitario' => $adquisicion->valor_unitario,
                'valor_total' => $adquisicion->valor_total,
                'fecha_adquisicion' => $adquisicion->fecha_adquisicion,
                'cantidad' => $adquisicion->cantidad,
                'unidad_id' => $adquisicion->unidad_id,
                'tipo_id' => $adquisicion->tipo_id,
                'documentacion' => $adquisicion->documentacion,
                'proveedor_id' => $adquisicion->proveedor_id,
                'created_at' => $adquisicion->created_at->format('Y-m-d'),
                'updated_at' => $adquisicion->updated_at->format('Y-m-d')
            ]
        ], 201);

        // Si todos los registros referenciados existen, procede con la inserción
        /* $adquisicion = new Adquisicion();
        $adquisicion->presupuesto = $validatedData['presupuesto'];
        $adquisicion->valor_unitario = $validatedData['valor_unitario'];
        $adquisicion->valor_total = $validatedData['valor_total'];
        $adquisicion->fecha_adquisicion = $validatedData['fecha_adquisicion'];
        $adquisicion->cantidad = $validatedData['cantidad'];
        $adquisicion->unidad_id = $validatedData['unidad_id'];
        $adquisicion->tipo_id = $validatedData['tipo_id'];
        $adquisicion->proveedor_id = $validatedData['proveedor_id'];
        $adquisicion->save(); */
        // Retorna una respuesta de éxito
        //return response()->json(['message' => 'Adquisición creada correctamente.'], 201);
    }

    public function update(Request $request, $id)
    {
        $adquisicion = Adquisicion::find($id);
        if (!$adquisicion) {
            return response()->json(['message' => 'Tipo no encontrado para actualizar'], 404);
        }

        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'max' => 'El campo :attribute no debe tener más de :max caracteres.',
            'unique' => 'El :attribute ya esta registrado.',
            'in' => 'La :attribute seleccionada no es válida.',
            'unidad_id.exists' => 'El campo unidad_id no corresponde a una unidad existente.',
            'tipo_id.exists' => 'El campo tipo_id no corresponde a un tipo existente.',
            'proveedor_id.exists' => 'El campo proveedor_id no corresponde a un proveedor existente.',
        ];
        /*  $adquisicion = Adquisicion::create($request->all());
        return response()->json($adquisicion, 201); */
        $rules = [
            'presupuesto' => 'required|numeric',
            'cantidad' => 'required|integer',
            'valor_unitario' => 'required|numeric',
            'valor_total' => 'required|numeric',
            'fecha_adquisicion' => 'required',
            'unidad_id' => 'required|exists:unidades,id',
            'tipo_id' => 'required|exists:tipos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
        ];

        // Realiza la validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verifica si la validación falla
        if ($validator->fails()) {
            // Retorna un error de validación con los mensajes correspondientes
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Obtiene los datos validados
        $validatedData = $validator->validated();

        // Verifica si existen los registros referenciados por claves foráneas
        $unidadExists = Unidad::find($validatedData['unidad_id']);
        $tipoExists = Tipo::find($validatedData['tipo_id']);
        $proveedorExists = Proveedor::find($validatedData['proveedor_id']);


        if (!$unidadExists) {
            return response()->json(['message' => 'La unidad especificada no existe.'], 404);
        }

        if (!$tipoExists) {
            return response()->json(['message' => 'El tipo especificado no existe.'], 404);
        }

        if (!$proveedorExists) {
            return response()->json(['message' => 'El proveedor especificado no existe.'], 404);
        }

        $adquisicion = Adquisicion::findOrFail($id);
        $adquisicion->update($request->all());

        return response()->json([
            'message' => 'Adquisición Actualizada correctamente',
            'data' => [
                'id' => $adquisicion->id,
                'presupuesto' => $adquisicion->presupuesto,
                'valor_unitario' => $adquisicion->valor_unitario,
                'valor_total' => $adquisicion->valor_total,
                'fecha_adquisicion' => $adquisicion->fecha_adquisicion,
                'cantidad' => $adquisicion->cantidad,
                'unidad_id' => $adquisicion->unidad_id,
                'tipo_id' => $adquisicion->tipo_id,
                'documentacion' => $adquisicion->documentacion,
                'proveedor_id' => $adquisicion->proveedor_id,
                'created_at' => $adquisicion->created_at->format('Y-m-d'),
                'updated_at' => $adquisicion->updated_at->format('Y-m-d')
            ]
        ], 201);
        //return response()->json($adquisicion, 200);
    }

    public function destroy($id)
    {
        $adquisicion = Adquisicion::findOrFail($id);
        if (!$adquisicion) {
            return response()->json(['message' => 'Adquisicion no encontrado'], 404);
        }

        $adquisicion->delete();

        return response()->json(['message' => 'Adquisicion eliminada correctamente'], 200);

    }


    public function restore($id)
    {
        $adquisicion = Adquisicion::withTrashed()->find($id);

        if (!$adquisicion) {
            return response()->json(['message' => 'Adquisicion no encontrado'], 404);
        }

        if (!$adquisicion->trashed()) {
            return response()->json(['message' => 'La adquisicion no está eliminado'], 400);
        }

        $adquisicion->restore();

        return response()->json([
            'message' => 'adquisicion restaurada correctamente',
            'data' => [
                'id' => $adquisicion->id,
                'presupuesto' => $adquisicion->presupuesto,
                'valor_unitario' => $adquisicion->valor_unitario,
                'valor_total' => $adquisicion->valor_total,
                'fecha_adquisicion' => $adquisicion->fecha_adquisicion,
                'cantidad' => $adquisicion->cantidad,
                'unidad_id' => $adquisicion->unidad_id,
                'tipo_id' => $adquisicion->tipo_id,
                'documentacion' => $adquisicion->documentacion,
                'proveedor_id' => $adquisicion->proveedor_id,
                'created_at' => $adquisicion->created_at->format('Y-m-d'),
                'updated_at' => $adquisicion->updated_at->format('Y-m-d')
            ]
        ], 200);
    }

}
