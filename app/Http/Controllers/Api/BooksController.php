<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BooksRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()
            ->paginate(5);

        return response([
            'books' => BooksResource::collection($books),
            'message' => 'Success!'
        ], 200) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * Note: If we using Faker, then we use Illuminate\Http\Request
     *
     * @param  \App\Http\Requests\BooksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', $book);

        $path = "";
        if ($request->hasFile('cover_photo')){
            $path = $request->file('cover_photo')->store('photos');
        }

        $book = Book::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'publisher' => $request->input('publisher'),
            'author' => $request->input('author'),
            'cover_photo' => $path,
            'price' => $request->input('price'),
        ]);

        return response([
            'book' => new BooksResource($book),
            'message' => 'The book was created successfully.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return response([
            'book' => new BooksResource($book),
            'message' => 'Success!'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * Note: If we using Faker, then we use Illuminate\Http\Request
     *
     * @param  \App\Http\Requests\BooksRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $path = $book->cover_photo;
        if ($request->hasFile('cover_photo')){
            $path = $request->file('cover_photo')->store('photos');
        }

        $book->update([
            'title' => $request->input('title', $book->title),
            'description' => $request->input('description', $book->description),
            'publisher' => $request->input('publisher', $book->publisher),
            'author' => $request->input('author', $book->author),
            'cover_photo' => $path,
            'price' => $request->input('price', $book->price),
        ]);

        return response([
            'book' => new BooksResource($book),
            'message' => 'The book was updated successfully.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        $book->delete();

        return response([
            'id' => $book->id,
            'title' => $book->title,
            'message' => 'The book was deleted successfully.'
        ], 200);
    }

    /**
     * Borrow the specified book.
     *
     * @param  \App\Http\Requests\BooksRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function borrow(Request $request, Book $book)
    {
        $user_id = $request->user()->id;
        if ($book->borrowed_by) {
            return response([
                'message' => 'This book was borrowed by someone already.'
            ], 400);
        }

        $book->update([
            'borrowed_by' => $user_id,
        ]);

        return response([
            'id' => $book->id,
            'title' => $book->title,
            'message' => 'You borrowed the book successfully.'
        ], 200);
    }
}
