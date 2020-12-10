<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Validator;

class PacientesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->ajax()) :
            $query = Pacientes::with('entidad')->select('pacientes.*', DB::raw('CONCAT(pac_apellido1, " ", pac_apellido2, " ", pac_nombre1, " ", pac_nombre2) AS pac_nombre'));
            return datatables()->of($query)
                ->filterColumn('pac_nombre', function ($query, $keyword) {
                    $keywords = trim($keyword);
                    $query->whereRaw("CONCAT(pac_apellido1, pac_apellido2, pac_nombre1, pac_nombre2) like ?", ["%{$keywords}%"]);
                })
                ->addColumn('action', function ($data) {
                    return '<button class="btn-editar btn btn-sm btn-icon btn--raised btn-success" data-id="'.$data->id.'"><i class="zmdi zmdi-edit"></i></button>
                    <button class="btn-eliminar btn btn-sm btn-icon btn--raised btn-danger" data-id="'.$data->id.'"><i class="zmdi zmdi-delete"></i></button>';
                })->make(true);
        endif;
        $title = 'Pacientes';
        return view('paciente.listado', compact('title'));
    }

    public function buscar($id)
    {
        return Pacientes::find($id);    
    }

    public function nuevo(Request $request)
    {
        $validator = Validator::make($request->all(), Pacientes::rules());
        if ($validator->fails()) :
            return array(
                'success' => false,
                'error'   => $validator->errors()
            );
        endif;
    
        $data = $request->except('_token');
        $data['pac_fechaingreso'] = date('Y-m-d');
        Pacientes::create($data);
        
        return array(
            'success' => true,
            'msg'   => 'Paciente creado exitosamente',
            'pac_documento' => $request->input('pac_documento')
        );
    }

    public function editar(Request $request)
    {
        $paciente = Pacientes::find($request->input('id'));

        $validator = Validator::make($request->all(), Pacientes::rules('id'));
        if ($validator->fails()) :
            return array(
                'success' => false,
                'error'   => $validator->errors()
            );
        endif;
        
        $data = $request->except(['_token']);
        $paciente->fill($data);
		$paciente->save();
        
        return array(
            'success' => true,
            'msg'   => 'Paciente modificado exitosamente',
            'pac_documento' => $request->input('pac_documento')
        );
    }

    public function eliminar(Request $request)
    {
        $paciente = Pacientes::find($request->input('id'));
        $paciente->delete();
        
        return array(
            'success' => true,
            'msg'   => 'Paciente Eliminado exitosamente'
        );
    }
}
