<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
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
            $query = Clientes::select('*');
            return datatables()->of($query)
                ->addColumn('action', function ($data) {
                    return '<button class="btn-editar btn btn-sm btn-icon btn--raised btn-success" data-id="'.$data->id.'"><i class="zmdi zmdi-edit"></i></button>
                    <button class="btn-eliminar btn btn-sm btn-icon btn--raised btn-danger" data-id="'.$data->id.'"><i class="zmdi zmdi-delete"></i></button>';
                })->make(true);
        endif;
        $title = 'Clientes';
        return view('clientes.listado', compact('title'));
    }

    public function buscar($id)
    {
        return Clientes::find($id);    
    }

    public function nuevo(Request $request)
    {
        $validator = Validator::make($request->all(), Clientes::rules());
        if ($validator->fails()) :
            return array(
                'success' => false,
                'error'   => $validator->errors()
            );
        endif;
    
        $data = $request->except('_token');
        Clientes::create($data);
        
        return array(
            'success' => true,
            'msg'   => 'Cliente creado exitosamente',
        );
    }

    public function editar(Request $request)
    {
        $paciente = Clientes::find($request->input('id'));

        $validator = Validator::make($request->all(), Clientes::rules('id'));
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
            'msg'   => 'Cliente modificado exitosamente'
        );
    }

    public function eliminar(Request $request)
    {
        $paciente = Clientes::find($request->input('id'));
        $paciente->delete();
        
        return array(
            'success' => true,
            'msg'   => 'Cliente Eliminado exitosamente'
        );
    }
}
