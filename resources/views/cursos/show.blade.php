@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h1 class="text-3xl font-bold">{{ $curso->nombre }}</h1>
            <p class="text-gray-600 mt-2">Docente: {{ $curso->docente->nombre }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('cursos.edit', $curso) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                Editar
            </a>
            <form action="{{ route('cursos.destroy', $curso) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <div class="mb-6">
        <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->nombre }}" class="w-full h-64 object-cover rounded-lg">
    </div>

    <div class="prose max-w-none">
        <h2 class="text-xl font-semibold mb-2">Descripción del Curso</h2>
        <p class="text-gray-700">{{ $curso->descripcion }}</p>
        
        <h2 class="text-xl font-semibold mt-6 mb-2">Información del Docente</h2>
        <div class="bg-gray-50 p-4 rounded-lg">
            <p><strong>Nombre:</strong> {{ $curso->docente->nombre }}</p>
            <p><strong>Especialidad:</strong> {{ $curso->docente->especialidad }}</p>
            <p><strong>Email:</strong> {{ $curso->docente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $curso->docente->telefono }}</p>
            <a href="{{ route('docentes.show', $curso->docente) }}" class="text-blue-500 hover:text-blue-700 inline-block mt-2">Ver perfil completo</a>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('cursos.index') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver al listado de cursos
        </a>
    </div>
</div>
@endsection