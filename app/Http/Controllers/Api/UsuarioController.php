<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // GET /api/usuarios  -> usuarios con su rol (id + nombre)
    public function index()
    {
        // eager loading del rol (trae solo columnas necesarias)
        $usuarios = Usuario::with(['rol:id,nombre'])->get();

        return response()->json($usuarios, 200);
    }

    // GET /api/usuarios/pacientes -> solo usuarios que son pacientes
    public function getPacientes()
    {
        // Obtener usuarios con rol de paciente (id_rol = 3) y que tengan registro en la tabla pacientes
        $usuariosPacientes = Usuario::with(['rol:id,nombre'])
            ->where('id_rol', 3)
            ->whereHas('paciente') // Solo usuarios que tienen un registro en la tabla pacientes
            ->get();

        return response()->json($usuariosPacientes, 200);
    }

    // GET /api/usuarios/{id}
    public function show($id)
    {
        $usuario = Usuario::with(['rol:id,nombre'])->find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }
        return response()->json($usuario, 200);
    }

    // POST /api/usuarios
    // Acepta id_rol o rol_nombre (uno de los dos)
    public function store(Request $request)
    {
        $request->validate([
            'nombre'            => 'required|string|max:50',
            'apellido_paterno'  => 'required|string|max:50',
            'apellido_materno'  => 'required|string|max:50',
            'email'             => 'required|email|max:100|unique:usuarios,email',
            'password'          => 'required|string|min:6|max:255',
            'estado'            => 'nullable|boolean',
            'id_rol'            => 'nullable|exists:roles,id',
            'rol_nombre'        => 'nullable|string|max:50',
        ]);

        // Resolver rol (por id_rol o rol_nombre)
        $rolId = $request->id_rol;
        if (!$rolId && $request->filled('rol_nombre')) {
            $rolId = Rol::where('nombre', $request->rol_nombre)->value('id');
        }
        if (!$rolId) {
            return response()->json(['mensaje' => 'Debe indicar id_rol o rol_nombre válido.'], 422);
        }

        $usuario = Usuario::create([
            'id_rol'            => $rolId,
            'nombre'            => $request->nombre,
            'apellido_paterno'  => $request->apellido_paterno,
            'apellido_materno'  => $request->apellido_materno,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'estado'            => $request->estado ?? true,
        ]);

        // devolver con rol cargado
        $usuario->load('rol:id,nombre');

        return response()->json($usuario, 201);
    }

    // PUT /api/usuarios/{id}
    // También permite pasar rol por id_rol o rol_nombre
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json(['mensaje' => 'Usuario no encontrado'], 404);
        }

        $request->validate([
            'nombre'            => 'sometimes|string|max:50',
            'apellido_paterno'  => 'sometimes|string|max:50',
            'apellido_materno'  => 'sometimes|string|max:50',
            'email'             => 'sometimes|email|max:100|unique:usuarios,email,' . $id . ',id_usuario',
            'password'          => 'sometimes|string|min:6|max:255',
            'estado'            => 'sometimes|boolean',
            'id_rol'            => 'sometimes|nullable|exists:roles,id',
            'rol_nombre'        => 'sometimes|nullable|string|max:50',
        ]);

        // Resolver rol si se envía alguno de los dos
        $rolId = $request->id_rol;
        if (!$rolId && $request->filled('rol_nombre')) {
            $rolId = Rol::where('nombre', $request->rol_nombre)->value('id');
            if (!$rolId) {
                return response()->json(['mensaje' => 'rol_nombre no existe.'], 422);
            }
        }

        $usuario->fill($request->only([
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'email',
            'estado',
        ]));

        if ($rolId) {
            $usuario->id_rol = $rolId;
        }

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        $usuario->load('rol:id,nombre');

        return response()->json($usuario, 200);
    }

    // DELETE /api/usuarios/{id}
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
