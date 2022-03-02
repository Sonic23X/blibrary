<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['authors' => Author::all()], 200);
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
            'name' => 'required|string|alpha'
        ]);

        $author = Author::create([
            'name' => $request->name,
        ]);

        return response()->json(['author' => $author], 201);
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
        $author = Author::find($id);
        if ($author) {
            $request->validate([
                'name' => 'required|string|alpha'
            ]);

            $author = Author::where('id', $id)->update([
                'name' => $request->name,
            ]);

            return response()->json(['author' => $author], 200);
        }
        else
            return response()->json(['message' => 'Autor no encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::find($id);
        if ($author) {
            $author->delete();
            return response()->json(['message' => 'Autor borrado'], 200);
        }
        else
            return response()->json(['message' => 'Autor no encontrado'], 404);

    }
}
