<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsuariosController extends Controller
{
   	protected function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
		
		$users = $this->listado();
		$roles = $this->listado_roles();
		$title = 'Usuarios';
        return view('usuarios', compact('users', 'roles', 'title'));
    }
	
	public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
			'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
		
		$user->roles()->attach(Role::where('name', $request->input('role'))->first());
        return $user;
    }
	
	public function edit(Request $request)
    {
        $user = User::find($request->input('id_usuario'));
		$role = Role::where('name','=',$request->input('role'))->first();
		
		$user->email = $request->input('email');  // email is just an example.... 
		$user->name = $request->input('name'); // just an example... 
 
		if($user->save()){
			$user->roles()->sync([$role->id]);
			return array('success' => true);
        }else{
			return array('success' => false);
		}
    }
	
	public function delete(Request $request)
    {
        $user = User::find($request->input('id_usuario'));
		
		if($user->delete()){
			return array('success' => true);
		}else{
			return array('success' => false);
		}
    }
	
	public function listado(){
		$data = array();
		$users = DB::table('users')
			->select('users.id as id', 'username', 'users.name as name', 'email', 'description', 'roles.name as rol_name',)
			->join('role_user', 'users.id', '=', 'role_user.user_id')
			->join('roles', 'role_user.role_id', '=', 'roles.id')
			->get();
		
		return $users;
	}
	
	public function listado_roles(){
		$data = array();
		$roles = DB::table('roles')
			->get();
		
		return $roles;
	}
}
