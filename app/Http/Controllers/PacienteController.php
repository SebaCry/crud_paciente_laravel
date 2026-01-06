<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\TipoDocumento;
use App\Models\Genero;
use App\Models\Departamento;
use App\Models\Municipio;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Json;

class PacienteController extends Controller
{
    public function index()
    {
        try {
            $pacientes = Paciente::with(['tipoDocumento', 'genero', 'departamento', 'municipio'])->paginate(10);
            return view('pacientes.index', [
                'pacientes' => $pacientes
            ]);
        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', "Error: $e, error al acceder pacientes");
        }
    }

    public function create()
    {
        try {
            $tiposDocumento = TipoDocumento::all();
            $generos = Genero::all();
            $departamentos = Departamento::all();
            return view('pacientes.create', [
                'tiposDocumento' => $tiposDocumento,
                'generos' => $generos,
                'departamentos' => $departamentos
            ]);
        } catch (Exception $e){
            return redirect()->back()
                ->with('error', "Error: $e, error al acceder a la ruta pacientes");
        }

    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipo_documento_id' => 'required|exists:tipos_documento,id',
                'numero_documento' => 'required|string|unique:paciente,numero_documento',
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
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error: $e, error al crear paciente");
        }
    }

    public function show(Paciente $paciente)
    {
        try {
            $paciente->load(['tipoDocumento', 'genero', 'departamento', 'municipio']);
            return view('pacientes.show', [
                'paciente' => $paciente
            ]);
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error: $e, error al cargar el paciente");
        }
    }

    public function edit(Paciente $paciente)
    {
        try {
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
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error: $e, error al editar el paciente");
        }

    }

    public function update(Request $request, Paciente $paciente)
    {
        try {
            $request->validate([
                'tipo_documento_id' => 'required|exists:tipos_documento,id',
                'numero_documento' => 'required|string|unique:paciente,numero_documento,' . $paciente->id,
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
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error: $e, error al editar el paciente");
        }

    }

    public function destroy(Paciente $paciente)
    {
        try {
            if ($paciente->foto) {
                Storage::disk('public')->delete($paciente->foto);
            }

            $paciente->delete();

            return redirect()
                    ->route('pacientes.index')
                    ->with('success', 'Paciente eliminado exitosamente.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', "Error: $e, error al editar el paciente");
        }

    }

    public function getMunicipios($departamentoId)
    {
        try {
            $municipios = Municipio::where('departamento_id', $departamentoId)->get();
            return response()->json($municipios);
        } catch (Exception $e) {
            return response()->json([
                'error' => "No se puede accedar a los datos por: $e"
            ]);
        }
    }


}
