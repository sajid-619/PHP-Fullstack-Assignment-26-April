<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Order model",
 *     title="Order",
 *     required={"customer_id", "book_id"}
 * )
 */
class Order extends Model
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
     *     property="customer_id",
     *     type="integer",
     *     format="int64",
     *     description="ID of the customer"
     * )
     */
    private $customer_id;

    /**
     * @OA\Property(
     *     property="book_id",
     *     type="integer",
     *     format="int64",
     *     description="ID of the book"
     * )
     */
    private $book_id;

    /**
     * Define the relationship with book
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Define the relationship with customer
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id', 'book_id'];
}
