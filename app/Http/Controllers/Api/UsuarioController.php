<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255',
            'password' => 'required|string|max:255',
            'IdRol' => 'required|integer|exists:roles,IdRol',
            'FechaRegistro' => 'nullable|date'
        ]);

        $data = $request->all();
        // Opcional: Encripta el password si lo necesitas
        // $data['password'] = bcrypt($data['password']);

        logger()->info($data);

        $usuario = Usuario::create($data);
        logger()->info($usuario);

        return response()->json($usuario, 201);
    }

    public function show($id)
    {
        return Usuario::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return response()->json($usuario, 200);
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return response()->json(null, 204);
    }
}
