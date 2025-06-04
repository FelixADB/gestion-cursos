@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold">{{ $docente->nombre }}</h1>
            <p class="text-gray-600 mt-2">{{ $docente->especialidad }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('docentes.edit', $docente) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Editar
            </a>
            <form action="{{ route('docentes.destroy', $docente) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de eliminar este docente?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-gray-50 p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-3">Información Personal</h2>
            <p><strong>Email:</strong> {{ $docente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $docente->telefono }}</p>
        </div>
        
        <div class="bg-gray-50 p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-3">Estadísticas</h2>
            <p><strong>Cursos asignados:</strong> {{ $docente->cursos->count() }}</p>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Cursos a cargo</h2>
        @if($docente->cursos->isEmpty())
            <p class="text-gray-500">Este docente no tiene cursos asignados.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($docente->cursos as $curso)
                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                        <h3 class="font-medium text-lg">{{ $curso->nombre }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($curso->descripcion, 80) }}</p>
                        <a href="{{ route('cursos.show', $curso) }}" class="text-blue-500 hover:text-blue-700 text-sm inline-block mt-2">Ver curso</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="mt-8">
        <a href="{{ route('docentes.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver al listado de docentes
        </a>
    </div>
</div>
@endsection