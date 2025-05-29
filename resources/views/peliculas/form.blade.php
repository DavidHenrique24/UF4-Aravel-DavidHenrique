<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $pelicula->titulo ?? '') }}">
    @error('titulo')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="portada" class="form-label">Portada (URL de la imagen)</label>
    <input type="text" name="portada" class="form-control" value="{{ old('portada', $pelicula->portada ?? '') }}">
    @error('portada')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="mb-3">
    <label for="year" class="form-label">Any</label>
    <input type="number" name="year" class="form-control" value="{{ old('year', $pelicula->year ?? '') }}">
    @error('year')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label for="descripcion" class="form-label">Descripció</label>
    <textarea name="descripcion" class="form-control">{{ old('descripcion', $pelicula->descripcion ?? '') }}</textarea>
    @error('descripcion')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


