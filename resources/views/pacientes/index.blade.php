@extends('layouts.app')

@section('title', 'Listado de Pacientes')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2><i class="fas fa-users"></i> Lista de Pacientes</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('pacientes.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Paciente
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Foto</th>
                        <th>Tipo Doc.</th>
                        <th>Num. Documento</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Genero</th>
                        <th>Departamento</th>
                        <th>Municipio</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientes as $paciente)
                        <tr>
                            <td>
                                @if($paciente->foto)
                                    <img src="{{ asset('storage/' . $paciente->foto) }}"
                                        alt="Foto"
                                        class="rounded-circle"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $paciente->tipoDocumento->nombre }}</td>
                            <td>{{ $paciente->numero_documento }}</td>
                            <td>{{ $paciente->nombre1 }} {{ $paciente->nombre2 }}</td>
                            <td>{{ $paciente->apellido1 }} {{ $paciente->apellido2 }}</td>
                            <td>{{ $paciente->genero->nombre }}</td>
                            <td>{{ $paciente->departamento->nombre }}</td>
                            <td>{{ $paciente->municipio->nombre }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('pacientes.show', $paciente) }}"
                                        class="btn btn-sm btn-info"
                                        title="Ver">
                                            <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pacientes.edit', $paciente) }}"
                                        class="btn btn-sm btn-warning"
                                        title="Editar">
                                            <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pacientes.destroy', $paciente) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Quieres eliminar al paciente?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                <i class="fas fa-info-circle"></i> No hay pacientes registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $pacientes->links() }}
        </div>
    </div>
</div>
@endsection
