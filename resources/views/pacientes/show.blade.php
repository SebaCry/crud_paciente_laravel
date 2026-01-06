@extends('layouts.app')

@section('title', 'Detalle del Paciente')

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <h2><i class="fas fa-user"></i> Detalle del Paciente</h2>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center mb-3">
                @if($paciente->foto)
                    <img src="{{ asset('storage/' . $paciente->foto) }}"
                        class="img-fluid rounded-circle"
                        style="max-width: 200px; max-height: 200px; object-fit: cover;">
                @else
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-5x text-white"></i>
                    </div>
                @endif
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Tipo de Documento:</label>
                        <p>{{ $paciente->tipoDocumento->nombre }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Número de Documento:</label>
                        <p>{{ $paciente->numero_documento }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Primer Nombre:</label>
                        <p>{{ $paciente->nombre1 }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Segundo Nombre:</label>
                        <p>{{ $paciente->nombre2 ?? 'No tiene segundo nombre' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Primer Apellido:</label>
                        <p>{{ $paciente->apellido1 }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold">Segundo Apellido:</label>
                        <p>{{ $paciente->apellido2 ?? 'No tiene segundo apellido' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Genero:</label>
                        <p>{{ $paciente->genero->nombre }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Departamento:</label>
                        <p>{{ $paciente->departamento->nombre }}</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Municipio:</label>
                        <p>{{ $paciente->municipio->nombre }}</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atras
                </a>
                <form action="{{ route('pacientes.destroy', $paciente) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Quiere eliminar al paciente?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

