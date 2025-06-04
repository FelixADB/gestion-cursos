<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::with('docente')->paginate(12);
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docentes = Docente::all();
        return view('cursos.create', compact('docentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:60',
            'descripcion' => 'required|string|max:100',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'docente_id' => 'required|exists:docentes,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('cursos', 'public');
        }

        Curso::create($data);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        $curso->load('docente');
        return view('cursos.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curso $curso)
    {
        $docentes = Docente::all();
        return view('cursos.edit', compact('curso', 'docentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'nombre' => 'required|string|max:60',
            'descripcion' => 'required|string|max:100',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'docente_id' => 'required|exists:docentes,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($curso->imagen) {
                Storage::disk('public')->delete($curso->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('cursos', 'public');
        }

        $curso->update($data);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        // Eliminar imagen si existe
        if ($curso->imagen) {
            Storage::disk('public')->delete($curso->imagen);
        }

        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado exitosamente.');

    }
}