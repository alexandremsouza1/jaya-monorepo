<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentsController extends DefaultApiController
{

    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }




    public function createPayment(Request $request)
    {
        $data = $request->all();

        $result = $this->paymentService->create($data);

        $statusCode = 201;

        return response()->json($result, $statusCode);
    }

    public function getPayments(Request $request)
    {
        $result = $this->paymentService->getAll();

        $statusCode = 200;

        $messageText = 'Payments retrieved successfully';

        return response()->json(['data' => $result, 'message' => $messageText, 'status' => true], $statusCode);
    }

    public function getPayment(Request $request, $id)
    {
        $result = $this->paymentService->get($id);

        $statusCode = 200;

        $messageText = 'Payment retrieved successfully';

        return response()->json(['data' => $result, 'message' => $messageText, 'status' => true], $statusCode);
    }

    public function confirmPayment(Request $request, $id)
    {
        $result = $this->paymentService->confirm($id);

        $statusCode = 200;

        $messageText = 'Payment confirmed successfully';

        return response()->json(['data' => $result, 'message' => $messageText, 'status' => true], $statusCode);
    }

    public function cancelPayment(Request $request, $id)
    {
        $result = $this->paymentService->cancel($id);

        $statusCode = 200;

        $messageText = 'Payment canceled successfully';

        return response()->json(['data' => $result, 'message' => $messageText, 'status' => true], $statusCode);
    }
}
