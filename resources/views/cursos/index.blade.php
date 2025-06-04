@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Listado de Cursos</h1>
    <a href="{{ route('cursos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Nuevo Curso
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($cursos as $curso)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->nombre }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $curso->nombre }}</h2>
                <p class="text-gray-600 mb-2">{{ Str::limit($curso->descripcion, 100) }}</p>
                <p class="text-sm text-gray-500 mb-3">Docente: {{ $curso->docente->nombre }}</p>
                <div class="flex justify-between">
                    <a href="{{ route('cursos.show', $curso) }}" class="text-blue-500 hover:text-blue-700">Ver más</a>
                    <div class="space-x-2">
                        <a href="{{ route('cursos.edit', $curso) }}" class="text-yellow-500 hover:text-yellow-700">Editar</a>
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $cursos->links() }}
</div>
@endsection