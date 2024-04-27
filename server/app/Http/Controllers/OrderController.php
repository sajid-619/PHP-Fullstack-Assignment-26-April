<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *      path="/orders",
     *      operationId="getOrdersList",
     *      tags={"Orders"},
     *      summary="Get list of orders",
     *      description="Returns list of orders",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Order")
     *          ),
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * @OA\Post(
     *      path="/orders",
     *      operationId="storeOrder",
     *      tags={"Orders"},
     *      summary="Place a new order",
     *      description="Places a new order",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"customer_id", "book_id"},
     *              @OA\Property(property="customer_id", type="integer", example=1),
     *              @OA\Property(property="book_id", type="integer", example=1)
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Order placed successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Order placed successfully"),
     *              @OA\Property(property="order", ref="#/components/schemas/Order")
     *          ),
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'book_id' => $request->book_id,
        ]);

        return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
    }

    /**
     * @OA\Get(
     *      path="/orders/{id}",
     *      operationId="getOrderById",
     *      tags={"Orders"},
     *      summary="Get order information",
     *      description="Returns order data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Order ID",
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
     *          @OA\JsonContent(ref="#/components/schemas/Order")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Order not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function show($id)
    {
        return Order::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/orders/{id}",
     *      operationId="updateOrder",
     *      tags={"Orders"},
     *      summary="Update order information",
     *      description="Updates order information",
     *      @OA\Parameter(
     *          name="id",
     *          description="Order ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="customer_id", type="integer", example=1),
     *              @OA\Property(property="book_id", type="integer", example=1)
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Order updated successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Order updated successfully"),
     *              @OA\Property(property="order", ref="#/components/schemas/Order")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Order not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'customer_id' => 'exists:customers,id',
            'book_id' => 'exists:books,id',
        ]);

        $order->update($request->all());

        return response()->json(['message' => 'Order updated successfully', 'order' => $order], 200);
    }

    /**
     * @OA\Delete(
     *      path="/orders/{id}",
     *      operationId="deleteOrder",
     *      tags={"Orders"},
     *      summary="Delete order",
     *      description="Deletes an order",
     *      @OA\Parameter(
     *          name="id",
     *          description="Order ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Order deleted successfully"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Order not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
}
