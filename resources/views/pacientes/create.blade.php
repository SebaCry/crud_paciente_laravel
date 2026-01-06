@extends('layouts.app')

@section('title', 'Nuevo paciente')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2><i class="fas fa-user-plus"></i> Nuevo Paciente</h2>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('pacientes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tipo_documento_id" class="form-label">Tipo de Documento <span>*</span></label>
                    <select name="tipo_documento_id" id="tipo_documento_id" class="form-select @error('tipo_documento_id') is-invalid @enderror" required>
                        <option value="">Seleccione...</option>
                        @foreach($tiposDocumento as $tipo)
                            <option value="{{ $tipo->id }}" {{ old('tipo_documento_id') == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo_documento_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="numero_documento" class="form-label">Número de Documento <span>*</span></label>
                    <input type="text" name="numero_documento" id="numero_documento" class="form-control @error('numero_documento') is-invalid @enderror" value="{{ old('numero_documento') }}" required>
                    @error('numero_documento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre1" class="form-label">Primer Nombre <span>*</span></label>
                    <input type="text" name="nombre1" id="nombre1" class="form-control @error('nombre1') is-invalid @enderror" value="{{ old('nombre1') }}" required>
                    @error('nombre1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nombre2" class="form-label">Segundo Nombre</label>
                    <input type="text" name="nombre2" id="nombre2" class="form-control @error('nombre2') is-invalid @enderror" value="{{ old('nombre2') }}">
                    @error('nombre2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="apellido1" class="form-label">Primer Apellido <span>*</span></label>
                    <input type="text" name="apellido1" id="apellido1" class="form-control @error('apellido1') is-invalid @enderror" value="{{ old('apellido1') }}" required>
                    @error('apellido1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="apellido2" class="form-label">Segundo Apellido</label>
                    <input type="text" name="apellido2" id="apellido2" class="form-control @error('apellido2') is-invalid @enderror" value="{{ old('apellido2') }}">
                    @error('apellido2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="genero_id" class="form-label">Género <span>*</span></label>
                    <select name="genero_id" id="genero_id" class="form-select @error('genero_id') is-invalid @enderror" required>
                        <option value="">Seleccione...</option>
                        @foreach($generos as $genero)
                            <option value="{{ $genero->id }}" {{ old('genero_id') == $genero->id ? 'selected' : '' }}>
                                {{ $genero->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('genero_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="departamento_id" class="form-label">Departamento <span>*</span></label>
                    <select name="departamento_id" id="departamento_id" class="form-select @error('departamento_id') is-invalid @enderror" required>
                        <option value="">Seleccione...</option>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->id }}" {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                                {{ $departamento->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('departamento_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="municipio_id" class="form-label">Municipio <span>*</span></label>
                    <select name="municipio_id" id="municipio_id" class="form-select @error('municipio_id') is-invalid @enderror" required>
                        <option value="">Seleccione departamento primero...</option>
                    </select>
                    @error('municipio_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="foto" class="form-label">Foto del Paciente</label>
                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Formatos permitidos: JPG, PNG, GIF</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('js/getMunicipios.js') }}"></script>
<script>
getMunicipios('#departamento_id', '#municipio_id');
</script>
@endpush
