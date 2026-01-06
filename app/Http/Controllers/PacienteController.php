<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\TipoDocumento;
use App\Models\Genero;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with(['tipoDocumento', 'genero', 'departamento', 'municipio'])->paginate(10);
        return view('pacientes.index', [
            'pacientes' => $pacientes
        ]);
    }

    public function create()
    {
        $tiposDocumento = TipoDocumento::all();
        $generos = Genero::all();
        $departamentos = Departamento::all();
        return view('pacientes.create', [
            'tiposDocumento' => $tiposDocumento,
            'generos' => $generos,
            'departamentos' => $departamentos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
            'numero_documento' => 'required|string|unique:pacientes,numero_documento',
            'nombre1' => 'required|string|max:255',
            'nombre2' => 'nullable|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'nullable|string|max:255',
            'genero_id' => 'required|exists:genero,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pacientes', 'public');
            $data['foto'] = $path;
        }

        Paciente::create($data);

        return redirect()
            ->route('pacientes.index')
            ->with('success', 'Paciente creado exitosamente.');
    }

    public function show(Paciente $paciente)
    {
        $paciente->load(['tipoDocumento', 'genero', 'departamento', 'municipio']);
        return view('pacientes.show', [
            'paciente' => $paciente
        ]);
    }

    public function edit(Paciente $paciente)
    {
        $tiposDocumento = TipoDocumento::all();
        $generos = Genero::all();
        $departamentos = Departamento::all();
        $municipios = Municipio::where('departamento_id', $paciente->departamento_id)->get();
        return view('pacientes.edit', [
            'paciente' => $paciente,
            'tiposDocumento' => $tiposDocumento,
            'generos' => $generos,
            'departamentos' => $departamentos,
            'municipios' => $municipios
        ]);
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
            'numero_documento' => 'required|string|unique:pacientes,numero_documento,' . $paciente->id,
            'nombre1' => 'required|string|max:255',
            'nombre2' => 'nullable|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'nullable|string|max:255',
            'genero_id' => 'required|exists:genero,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($paciente->foto) {
                Storage::disk('public')->delete($paciente->foto);
            }
            $path = $request->file('foto')->store('pacientes', 'public');
            $data['foto'] = $path;
        }

        $paciente->update($data);

        return redirect()
                ->route('pacientes.index')
                ->with('success', 'Paciente actualizado exitosamente.');
    }

    public function destroy(Paciente $paciente)
    {
        if ($paciente->foto) {
            Storage::disk('public')->delete($paciente->foto);
        }

        $paciente->delete();

        return redirect()
                ->route('pacientes.index')
                ->with('success', 'Paciente eliminado exitosamente.');
    }

    public function getMunicipios($departamentoId)
    {
        $municipios = Municipio::where('departamento_id', $departamentoId)->get();
        return response()->json($municipios);
    }


}
