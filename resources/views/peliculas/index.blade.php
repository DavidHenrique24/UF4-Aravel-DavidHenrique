@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Lista de películas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Portada</th>
                <th>Año</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($peliculas->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No hay películas disponibles.</td>
                </tr>
            @else
                @foreach($peliculas as $pelicula)
                    <tr>
                        <td>{{ $pelicula->titulo }}</td>
                       <td>

        <img src="{{ $pelicula->portada }}" alt="{{ $pelicula->titulo }}" width="80">


</td>

                        <td>{{ $pelicula->year }}</td>
                        <td>{{ $pelicula->descripcion }}</td>
                        <td>
                            <a href="{{ route('peliculas.edit', $pelicula) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('peliculas.destroy', $pelicula) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
