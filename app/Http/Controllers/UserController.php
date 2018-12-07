<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\Hash;
use App\VueTables\EloquentVueTables;

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
        $libros = $user->books;
        
        return view('user.subidos', compact('libros','type'));
    }
}
