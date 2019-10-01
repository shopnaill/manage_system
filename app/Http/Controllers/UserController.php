<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function validations()
    {
        return [
            'name' => 'required|max:100',
            'photos.*' => 'image',
            'email' => ['required', 'string', 'email', 'max:255'],
        ];
    }

    public function validations2()
    {
        return [
            'name' => 'required|max:100',
            'photos.*' => 'image',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
    
    public function create()
    {
        
        if (Auth::guest())
        {
            return redirect()->route('login'); 
        }
       
        
        $role = User::roles();
        $admin = User::isAdmin();
         $new = true;
        if ($admin || $role == 3 || Auth::user()->id == $user->id)
        {
            return view('user.create_user', compact( 'role','admin','new'));
        }
        
            return redirect()->route('home')->with('info','User cannot be updated.'); 
        
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validations2());
        $role = User::roles();
        $admin = User::isAdmin();
      
        if ($admin || $role == 3  || Auth::user()->id == $user->id)
        {

        if ($request->role == 'user')
        {
            $request->role = null;

        }
      
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'photo' =>$request->photo ? $request->photo->store('public/users'): null,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->action(
            'UserController@show', ['id' => $user->id]
        );
        }
    }
    
    public function show(Request $request)
    {
        if (Auth::guest())
        {
            return redirect()->route('login'); 
        }
        
        $user = User::getUserPageData($request->id);
        $role = User::roles();
        $admin = User::isAdmin();
        if ($admin || $role == 3 || $role == 2 || $role == 1 || Auth::user()->id == $user->id)
        {
        return view('user.view_user', compact( 'user','role','admin'));
        }
        return redirect()->route('home')->with('info','Cannot View This Profile.'); 

    }

    
    
    public function edit(Request $request)
    {
        if (Auth::guest())
        {
            return redirect()->route('login'); 
        }
       
        
        $user = User::getUserPageData($request->user);
        $role = User::roles();
        $admin = User::isAdmin();

        if ($admin || $role == 3 && $user->role !=3 || Auth::user()->id == $user->id)
        {
            return view('user.edit_user', compact( 'user','role','admin'));

        }
        
            return redirect()->route('home')->with('info','User cannot be updated.'); 
        

     }
    
 
    public function update(Request $request)
    {
        $validatedData = $request->validate($this->validations());
        $role = User::roles();
        $admin = User::isAdmin();
        $user = User::findOrFail($request->id);

        if ($admin || $role == 3 ||  $role == 2 || Auth::user()->id == $user->id)
        {

        
    


        $user->name = $request->name;
        $user->email = $request->email;
  
        if (isset($request->role))
        {

        if ($request->role == 'user')
        {
            $request->role = null;
        }
        $user->role = $request->role;
           }

        
       
            $user->photo = $request->photo ? $request->photo->store('public/users') : null;

    
        
        $user->save();
        $request->session()->flash('message.info', 'success');
        
        return redirect()->action(
            'UserController@show', ['id' => $request->id]
        );
    }
     return redirect()->route('home')->with('info','User cannot be updated.'); 

    }



    public function delete(Request $request)
    {
        $role = User::roles();
        $admin = User::isAdmin();
         $user = User::findOrFail($request->id);
        if ( $role == 3 && $user->role !=3 || $admin)
        {
            User::destroy($request->id);
            return redirect()->route('home')->with('info','User deleted successfully.');

        }
       
        return redirect()->route('home')->with('info','User cannot be deleted.');
    }
}

