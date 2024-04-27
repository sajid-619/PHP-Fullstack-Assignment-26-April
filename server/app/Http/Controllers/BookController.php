<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Bookstore API",
 *     version="1.0.0",
 *     description="API endpoints for managing bookstore operations.",
 *     @OA\Contact(
 *         email="admin@example.com",
 *         name="Admin"
 *     ),
 *     @OA\License(
 *         name="MIT License",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */
class BookController extends Controller
{
    /**
     * @OA\Get(
     *      path="/books",
     *      operationId="getBooksList",
     *      tags={"Books"},
     *      summary="Get list of books",
     *      description="Returns list of books",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Book")
     *          ),
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * @OA\Post(
     *      path="/books",
     *      operationId="storeBook",
     *      tags={"Books"},
     *      summary="Store a new book",
     *      description="Stores a new book",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Book")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Book created successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Book created successfully"),
     *              @OA\Property(property="book", ref="#/components/schemas/Book")
     *          ),
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'writer' => 'required|string',
            'cover_image_url' => 'required|url',
            'price' => 'required|numeric',
            'tags' => 'required|array',
        ]);

        $book = Book::create([
            'title' => $request->title,
            'writer' => $request->writer,
            'cover_image_url' => $request->cover_image_url,
            'price' => $request->price,
            'tags' => $request->tags,
        ]);

        return response()->json(['message' => 'Book created successfully', 'book' => $book], 201);
    }

    /**
     * @OA\Get(
     *      path="/books/{id}",
     *      operationId="getBookById",
     *      tags={"Books"},
     *      summary="Get book information",
     *      description="Returns book data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Book ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Book")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Book not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function show($id)
    {
        return Book::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/books/{id}",
     *      operationId="updateBook",
     *      tags={"Books"},
     *      summary="Update book information",
     *      description="Updates book information",
     *      @OA\Parameter(
     *          name="id",
     *          description="Book ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Book")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Book updated successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Book updated successfully"),
     *              @OA\Property(property="book", ref="#/components/schemas/Book")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Book not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'string',
            'writer' => 'string',
            'cover_image_url' => 'url',
            'price' => 'numeric',
            'tags' => 'array',
        ]);

        $book->update($request->all());

        return response()->json(['message' => 'Book updated successfully', 'book' => $book], 200);
    }

    /**
     * @OA\Delete(
     *      path="/books/{id}",
     *      operationId="deleteBook",
     *      tags={"Books"},
     *      summary="Delete book",
     *      description="Deletes a book",
     *      @OA\Parameter(
     *          name="id",
     *          description="Book ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Book deleted successfully"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Book not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}

