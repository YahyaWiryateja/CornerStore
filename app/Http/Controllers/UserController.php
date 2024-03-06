<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\role;
use Hash,Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('user.index')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|unique:users',
            'nohp'=> 'required|numeric',
            'alamat' => 'required|string|max:255',
            'role'=> 'required|in: 1, 2, 3',
            'password'=>'required|string|confirmed'
            
        ]);
        try {
            $user = new User();
            // dd($user);
            $user->name     = $request->input('name');
            $user->alamat   = $request->input('alamat');
            $user->nohp     = $request->input('nohp');
            $user->role_id     = $request->input('role');
            $user->email    = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->emoney   = '0';
            $user->save();
            
        } catch (\Throwable $th) {
            return redirect('/User/create')->with('error',$th);
        }
        return redirect(route('User.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'nohp'=> 'required|numeric',
            'alamat' => 'required|string|max:255',
            'role'=> 'required|in: 1, 2, 3',

        ]);
        try {
           // manggil data user
           $user = User::findOrFail($id);
           // update data dasar
           $user->update([
            'name'=> $request->input('name'),
            'nohp'=> $request->input('nohp'),
            'alamat' => $request->input('alamat'),
            'role_id'=> $request->input('role'),
            ]);
          //jika email sama dengan yang sebelumnya maka akan tetap
          if($user->email != $request->input('email')){
          $request->validate([
          'email'=> 'string|email|unique:users',
          ]);
          $user->update([
            'email'=> $request->input('email'),
            ]);
          } 
          //jika user tidak memasukkan password field, maka password tidak diubah
         if(NULL != $request->input('password')){
            $request->validate([
                'password'=> 'string|confirmed',
                ]);
          $user->update([
            'password'=> Hash::make($request->input('password'))
            ]);
          } 
        } catch (\Throwable $th) {
            return redirect('/User/edit')->with('error',$th);
        }
        return redirect(route('User.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect(route('User.index'));
    }
}
