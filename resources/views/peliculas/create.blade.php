@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Pelicula</h1>
    <form action="{{ route('peliculas.store', [], true) }}" method="POST">
        @csrf
        @include('peliculas.form')
        <button type="submit" class="btn btn-success">Desa</button>
    </form>
</div>
@endsection
