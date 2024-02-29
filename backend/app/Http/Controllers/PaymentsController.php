<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Payments",
 *     description="Operations related to payments"
 * )
 */
class PaymentsController extends DefaultApiController
{

    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }



    /**
     * @OA\Post(
     *     path="/rest/payments",
     *     tags={"Payments"},
     *     summary="Create a new payment",
     *     description="Endpoint to create a new payment",
     *     operationId="createPayment",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Payment details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="transaction_amount", type="number", example=245.90),
     *             @OA\Property(property="installments", type="integer", example=3),
     *             @OA\Property(property="token", type="string", example="ae4e50b2a8f3h6d9f2c3a4b5d6e7f8g9"),
     *             @OA\Property(property="payment_method_id", type="string", example="master"),
     *             @OA\Property(
     *                 property="payer",
     *                 type="object",
     *                 @OA\Property(property="email", type="string", example="example_random@gmail.com"),
     *                 @OA\Property(
     *                     property="identification",
     *                     type="object",
     *                     @OA\Property(property="type", type="string", example="CPF"),
     *                     @OA\Property(property="number", type="string", example="12345678909")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Payment created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Validation error"),
     *             @OA\Property(property="message", type="string", example="Invalid input data")
     *         )
     *     )
     * )
     */
    public function createPayment(Request $request)
    {
        $data = $request->all();

        $result = $this->paymentService->create($data);

        $statusCode = 201;

        return response()->json($result, $statusCode);
    }
    /**
     * @OA\Get(
     *     path="/rest/payments",
     *     tags={"Payments"},
     *     summary="Get a list of payments",
     *     description="Endpoint to retrieve a list of payments",
     *     operationId="getPayments",
     *     @OA\Response(
     *         response=200,
     *         description="List of payments",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="amount", type="number", example=245.90),
     *                 @OA\Property(property="status", type="string", example="completed"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2021-08-01T00:00:00.000000Z"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No payments found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Not Found"),
     *             @OA\Property(property="message", type="string", example="No payments found")
     *         )
     *     )
     * )
     */
    public function getPayments()
    {
        $result = $this->paymentService->getAll();

        $statusCode = 200;

        return response()->json($result, $statusCode);
    }
    /**
     * @OA\Get(
     *     path="/rest/payments/{id}",
     *     tags={"Payments"},
     *     summary="Get payment details by ID",
     *     description="Endpoint to retrieve details of a payment by ID",
     *     operationId="getPayment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the payment",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="transaction_amount", type="number", example=245.90),
     *             @OA\Property(property="installments", type="integer", example=3),
     *             @OA\Property(property="token", type="string", example="ae4e50b2a8f3h6d9f2c3a4b5d6e7f8g9"),
     *             @OA\Property(property="payment_method_id", type="string", example="master"),
     *             @OA\Property(
     *                 property="payer",
     *                 type="object",
     *                 @OA\Property(property="email", type="string", example="example_random@gmail.com"),
     *                 @OA\Property(
     *                     property="identification",
     *                     type="object",
     *                     @OA\Property(property="type", type="string", example="CPF"),
     *                     @OA\Property(property="number", type="string", example="12345678909")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Payment not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Not Found"),
     *             @OA\Property(property="message", type="string", example="Payment not found")
     *         )
     *     )
     * )
     */
    public function getPayment($id)
    {
        $result = $this->paymentService->get($id);

        $statusCode = 200;

        return response()->json($result, $statusCode);
    }
    /**
     * @OA\Patch(
     *     path="/rest/payments/{id}",
     *     tags={"Payments"},
     *     summary="Confirm payment by ID",
     *     description="Endpoint to confirm a payment by updating its status",
     *     operationId="confirmPayment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the payment",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Payment confirmation details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="status", type="string", example="PAID")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment confirmed successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Payment confirmed successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Payment not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Not Found"),
     *             @OA\Property(property="message", type="string", example="Payment not found")
     *         )
     *     )
     * )
     */
    public function confirmPayment(Request $request, $id)
    {
        $data = $request->all();

        $result = $this->paymentService->changeStatus($id, $data);

        $statusCode = $result ? 204 : 404;

        return response()->json([], $statusCode);
    }
    /**
     * @OA\Delete(
     *     path="/rest/payments/{id}",
     *     tags={"Payments"},
     *     summary="Cancel payment by ID",
     *     description="Endpoint to cancel a payment by ID",
     *     operationId="cancelPayment",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the payment",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment canceled successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Payment canceled successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Payment not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Not Found"),
     *             @OA\Property(property="message", type="string", example="Payment not found")
     *         )
     *     )
     * )
     */
    public function cancelPayment($id)
    {
        $data = ['status' => 'CANCELED'];

        $result = $this->paymentService->changeStatus($id, $data);

        $statusCode = $result ? 204 : 404;

        return response()->json([], $statusCode);
    }
}
