<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['users' => User::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/u',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'type' => $request->type,
        ]);

        return response()->json(['user' => $user], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/u',
                'email' => 'required|string|email|unique:users',
                'type' => 'required|string',
            ]);

            $user = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->type,
            ]);

            return response()->json(['user' => $user], 200);
        }
        else
            return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuario borrado'], 200);
        }
        else
            return response()->json(['message' => 'Usuario no encontrado'], 404);
    }
}
