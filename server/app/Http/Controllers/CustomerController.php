<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class CustomerController extends Controller
{
    /**
     * @OA\Get(
     *      path="/customers",
     *      operationId="getCustomersList",
     *      tags={"Customers"},
     *      summary="Get list of customers",
     *      description="Returns list of customers",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Customer")
     *          ),
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * @OA\Post(
     *      path="/customers",
     *      operationId="storeCustomer",
     *      tags={"Customers"},
     *      summary="Store a new customer",
     *      description="Stores a new customer",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(property="name", type="string", example="John Doe")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Customer created successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Customer created successfully"),
     *              @OA\Property(property="customer", ref="#/components/schemas/Customer")
     *          ),
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'points' => 100, // New customers get 100 points
        ]);

        return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 201);
    }

    /**
     * @OA\Get(
     *      path="/customers/{id}",
     *      operationId="getCustomerById",
     *      tags={"Customers"},
     *      summary="Get customer information",
     *      description="Returns customer data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer ID",
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
     *          @OA\JsonContent(ref="#/components/schemas/Customer")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function show($id)
    {
        return Customer::findOrFail($id);
    }

    /**
     * @OA\Put(
     *      path="/customers/{id}",
     *      operationId="updateCustomer",
     *      tags={"Customers"},
     *      summary="Update customer information",
     *      description="Updates customer information",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer ID",
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
     *              @OA\Property(property="name", type="string", example="John Doe")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer updated successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Customer updated successfully"),
     *              @OA\Property(property="customer", ref="#/components/schemas/Customer")
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'string',
        ]);

        $customer->update($request->all());

        return response()->json(['message' => 'Customer updated successfully', 'customer' => $customer], 200);
    }

    /**
     * @OA\Delete(
     *      path="/customers/{id}",
     *      operationId="deleteCustomer",
     *      tags={"Customers"},
     *      summary="Delete customer",
     *      description="Deletes a customer",
     *      @OA\Parameter(
     *          name="id",
     *          description="Customer ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Customer deleted successfully"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Customer not found"
     *      ),
     *      security={{"api_key": {}}}
     * )
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
