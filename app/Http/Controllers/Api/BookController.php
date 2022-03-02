<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Book,
    Borrow
};

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        $booksResponse = $books->map(function($book) {
            $status = Borrow::where('book_id', $book->id)->where('status', Borrow::BORROWED)->first();

            return collect([
                'name' => $book->name,
                'author' => $book->author->name,
                'category' => $book->category->name,
                'published' => $book->published,
                'status' => ($status != null) ? 'No disponible' : 'Disponible',
            ]);
        });

        return response()->json(['books' => $booksResponse], 200);
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
            'author' => 'required|digits',
            'category' => 'required|digits',
            'published' => 'required|date',
        ]);

        $book = Book::create([
            'name' => $request->name,
            'author_id' => $request->author,
            'category_id' => $request->category,
            'published' => $request->published,
        ]);

        return response()->json(['book' => $book], 201);
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
        $book = Book::find($id);
        if ($book) {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/u',
                'author' => 'required|digits',
                'category' => 'required|digits',
                'published' => 'required|date',
            ]);

            $book = Book::where('id', $id)->update([
                'name' => $request->name,
                'author_id' => $request->author,
                'category_id' => $request->category,
                'published' => $request->published,
            ]);

            return response()->json(['book' => $book], 200);
        } else
            return response()->json(['message' => 'Libro no encontrado'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return response()->json(['message' => 'Libro borrado'], 200);
        } else
            return response()->json(['message' => 'Libro no encontrado'], 404);
    }
}
