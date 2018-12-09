<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Hash;
use App\VueTables\EloquentVueTables;
use App\Helpers\Helper;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    /**
     * Users View
     *
     * @return void
     */
    public function view()
    {
        $roles = Role::all();
        return view('admin.users', compact('roles'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            "role_id" => $request->role_id,
            "name" => $request->name,
            "slug" => str_slug($request->name),
            "phone" => $request->phone,
            "email" => $request->email,
            'birthday' => $request->date,
            "picture" => $request->picture,
            'password' => Hash::make("secret"),
        ]);

        return;
    }

    public function usersJson()
    {
        if(request()->ajax()) {
			$vueTables = new EloquentVueTables;
			$data = $vueTables->get(new User, ['id','role_id','name','phone','email','picture','created_at'], ['role']);
			return response()->json($data);
		}
		return abort(401);
    }

    public function librosSubidos(Request $request)
    {
        $type = $request->query('type') ? $request->query('type') : 'image';

        $user = auth()->user();
        $libros = $user->books()->with(['authors','categories'])->get();
        
        return view('user.subidos', compact('libros','type'));
    }

    public function librosIntercambiado(Request $request){
        $type = $request->query('type') ? $request->query('type') : 'image';

        $user = auth()->user();
        $libros = $user->books()->wherePivot('status','=','2')->get();
        return view('user.intercambiados', compact('libros','type'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        
        if($request->ajax()){

            $user = auth()->user();
            $picture = $user->picture;

            try{
                
                if($request->hasFile('photo')){

                    $picture = Helper::uploadFile( "photo", 'users');

                }

                $user->name = $request->name;
                $user->slug = str_slug($request->name);
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->birthday = $request->birthday;
                $user->picture = $picture;
                $user->save();
                $success = true;


            }catch( \Exception $e ){
                $success = false;
            }

            if(!$success){
                return response()->json([
                    'ok' => false,
                    'message' => 'No se pudo editar tu información',
                    'user' => null
                ]);
            }
    
            return response()->json([
                'ok' => true,
                'message' => 'Información editada correctamente',
                'user' => $user
            ]);
    
        }
        

    }
}
