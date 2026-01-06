@extends('layouts.app')

@section('title', 'Inciar Sesion')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h4><i class="fas fa-hospital-user"></i> Sistema de Pacientes</h4>
                <p class="mb-0">Iniciar Sesión</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="documento" class="form-label">
                            <i class="fas fa-id-card"></i> Número de Documento
                        </label>
                        <input
                            type="text"
                            class="form-control @error('documento') is-invalid @enderror"
                            id="documento"
                            name="documento"
                            value="{{ old('documento') }}"
                            placeholder="Ingrese su número de documento"
                            required
                            autofocus
                        >
                        @error('documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Contraseña
                        </label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            placeholder="Ingrese su contraseña"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </button>
                    </div>
                </form>

                <div class="mt-3 text-center text-muted">
                    <small>
                        <i class="fas fa-info-circle"></i>
                        Credenciales de prueba: <br>
                        Documento: <strong>1234567890</strong> | Contraseña: <strong>1234567890</strong>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


