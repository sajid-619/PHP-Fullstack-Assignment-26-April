<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Book model",
 *     title="Book",
 *     required={"title", "writer", "cover_image_url", "price", "tags"}
 * )
 */
class Book extends Model
{
    use HasFactory;

    /**
     * @OA\Property(
     *     property="id",
     *     type="integer",
     *     format="int64",
     *     description="ID"
     * )
     */
    private $id;

    /**
     * @OA\Property(
     *     property="title",
     *     type="string",
     *     description="Title of the book"
     * )
     */
    private $title;

    /**
     * @OA\Property(
     *     property="writer",
     *     type="string",
     *     description="Writer of the book"
     * )
     */
    private $writer;

    /**
     * @OA\Property(
     *     property="cover_image_url",
     *     type="string",
     *     description="URL of the book cover image"
     * )
     */
    private $cover_image_url;

    /**
     * @OA\Property(
     *     property="price",
     *     type="number",
     *     format="float",
     *     description="Price of the book"
     * )
     */
    private $price;

    /**
     * @OA\Property(
     *     property="tags",
     *     type="array",
     *     @OA\Items(type="string"),
     *     description="Tags associated with the book"
     * )
     */
    private $tags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'writer', 'cover_image_url', 'price', 'tags'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tags' => 'array',
    ];
}
