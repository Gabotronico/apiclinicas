<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        return response()->json(Usuario::all(), 200);
    }

    // Crear un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'id_rol' => 'required|exists:roles,id', // ✅ corregido
            'nombre' => 'required|string|max:50',
            'apellido_paterno' => 'required|string|max:50',
            'apellido_materno' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:usuarios,email',
            'password' => 'required|string|min:6|max:255',
            'estado' => 'nullable|boolean',
        ]);

        $usuario = Usuario::create([
            'id_rol' => $request->id_rol,
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'estado' => $request->estado ?? true,
        ]);

        return response()->json($usuario, 201);
    }

    // Mostrar un usuario por ID
    public function show($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'id_rol' => 'sometimes|exists:roles,id', // ✅ corregido y cambiado a "sometimes"
            'nombre' => 'sometimes|string|max:50',
            'apellido_paterno' => 'sometimes|string|max:50',
            'apellido_materno' => 'sometimes|string|max:50',
            'email' => 'sometimes|email|max:100|unique:usuarios,email,' . $id . ',id_usuario',
            'password' => 'sometimes|string|min:6|max:255',
            'estado' => 'sometimes|boolean',
        ]);

        $usuario->fill($request->only([
            'id_rol',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'email',
            'estado',
        ]));

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        return response()->json($usuario, 200);
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();
        return response()->json(['mensaje' => 'Usuario eliminado'], 200);
    }
}
