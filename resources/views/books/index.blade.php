@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Llistat de llibres</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Títol</th>
                <th>Autor</th>
                <th>Any</th>
                <th>Accions</th>
            </tr>
        </thead>
        <tbody>
            @if($books->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">No hi ha llibres disponibles.</td>
                </tr>
            @else
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
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
