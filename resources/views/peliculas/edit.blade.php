@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pelicula</h1>
    <form action="{{ route('peliculas.update', $pelicula, true) }}" method="POST">
        @csrf
        @method('PUT')
        @include('peliculas.form')
        <button type="submit" class="btn btn-primary">Actua</button>
    </form>
</div>
@endsection
