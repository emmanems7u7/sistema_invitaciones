<div class="mb-3">
    <label for="nombre_completo" class="form-label">Nombre Completo</label>
    <input type="text" class="form-control @error('nombre_completo') is-invalid @enderror" id="nombre_completo"
        name="nombre_completo" value="{{ old('nombre_completo') }}" required>
    @error('nombre_completo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Correo Electrónico</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
        value="{{ old('email') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="celular" class="form-label">Celular</label>
    <input type="tel" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular"
        value="{{ old('celular') }}" required>
    @error('celular')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">Agregar</button>