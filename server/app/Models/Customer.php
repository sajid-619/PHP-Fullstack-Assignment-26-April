<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="Customer model",
 *     title="Customer",
 *     required={"name", "points"}
 * )
 */
class Customer extends Model
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
     *     property="name",
     *     type="string",
     *     description="Name of the customer"
     * )
     */
    private $name;

    /**
     * @OA\Property(
     *     property="points",
     *     type="integer",
     *     description="Points of the customer"
     * )
     */
    private $points;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'points'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $attributes = [
        'points' => 100, // New customers get 100 points
    ];
}
