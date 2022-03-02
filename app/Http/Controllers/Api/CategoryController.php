<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['categories' => Category::all()], 200);
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
            'desc' => 'required|string|regex:/^[a-zA-Z\s]+$/u',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->desc
        ]);

        return response()->json(['category' => $category], 201);
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
        $category = Category::find($id);
        if ($category) {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/u',
                'desc' => 'required|string|regex:/^[a-zA-Z\s]+$/u',
            ]);

            $category = Category::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->desc
            ]);

            return response()->json(['category' => $category], 200);
        } else
            return response()->json(['message' => 'Categoria no encontrada'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Categoria borrada'], 200);
        } else
            return response()->json(['message' => 'Categoria no encontrada'], 404);
    }
}
