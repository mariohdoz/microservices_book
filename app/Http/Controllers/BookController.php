<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Author;
use App\Traits\ApiResponser;

use App\Models\Book;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return Book list.
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        
        $books = Book::All();

        return $this->successResponse($books);

    }

    /**
     * Create an instance of book.
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1'
        ];

        $this->validate($request, $rules);

        $book = Book::Create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED); 

    }

    /**
     * Return a specific book.
     *
     * @return Illuminate\Http\Response
     */
    public function show($book){

        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }

    /**
     * Update the information of an book.
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $book){
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1'
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($book);

        $book->fill($request->all());

        if($book->isClean()){
            return $this->errorResponse('Debe realizar al menos un cambio', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);

    }

    /** 
     * Remove an existing book.
     *
     * @return Illuminate\Http\Response
     */
    public function destroy( $book){

        $book = Book::findOrFail($book);

        $book->delete();

        return $this->successResponse($book);

    }
}
