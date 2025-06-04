@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Editar Curso: {{ $curso->nombre }}</h1>
    
    <form action="{{ route('cursos.update', $curso) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre del Curso</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $curso->nombre) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required maxlength="60">
            @error('nombre')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 font-medium mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required maxlength="100">{{ old('descripcion', $curso->descripcion) }}</textarea>
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Imagen Actual</label>
            <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->nombre }}" class="h-32 mb-2">
            <label for="imagen" class="block text-gray-700 font-medium mb-2">Nueva Imagen (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" accept="image/*">
            @error('imagen')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="docente_id" class="block text-gray-700 font-medium mb-2">Docente</label>
            <select name="docente_id" id="docente_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}" {{ $curso->docente_id == $docente->id ? 'selected' : '' }}>{{ $docente->nombre }} ({{ $docente->especialidad }})</option>
                @endforeach
            </select>
            @error('docente_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('cursos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Actualizar Curso
            </button>
        </div>
    </form>
</div>
@endsection