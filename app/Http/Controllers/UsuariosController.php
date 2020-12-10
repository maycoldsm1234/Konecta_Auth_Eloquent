<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{

	public function index(Request $request)
    {
        if($request->ajax()) :
            $query = User::with('roles')->select('*');
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
        $title = 'Usuarios';
        return view('usuarios.listado', compact('title'));
	}

	public function buscar($id)
    {
        return User::with('roles')->find($id);    
    }

    public function nuevo(Request $request)
    {
        $validator = Validator::make($request->all(), User::rules());
        if ($validator->fails()) :
            return array(
                'success' => false,
                'error'   => $validator->errors()
            );
		endif;
				
		$user = User::create([
            'name' => $request->input('name'),
			'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
		
		$user->roles()->attach(Role::where('name', $request->input('role'))->first());
        
        return array(
            'success' => true,
            'msg'   => 'Usuario creado exitosamente',
        );
    }

    public function editar(Request $request)
    {
        $user = User::find($request->input('id'));

        $validator = Validator::make($request->all(), User::rules('id'));
        if ($validator->fails()) :
            return array(
                'success' => false,
                'error'   => $validator->errors()
            );
        endif;
        
        $data = $request->except(['_token', 'password']);
        $user->fill($data);
		$user->save();

		$user->roles()->sync(Role::where('name', $request->input('role'))->first());
        
        return array(
            'success' => true,
            'msg'   => 'Usuario modificado exitosamente'
        );
    }

    public function eliminar(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();
        
        return array(
            'success' => true,
            'msg'   => 'Usuario Eliminado exitosamente'
        );
    }
}
