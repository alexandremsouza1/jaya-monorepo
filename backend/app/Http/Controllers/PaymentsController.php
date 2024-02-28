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

    public function getPayments()
    {
        $result = $this->paymentService->getAll();

        $statusCode = 200;

        return response()->json($result, $statusCode);
    }

    public function getPayment($id)
    {
        $result = $this->paymentService->get($id);

        $statusCode = 200;

        return response()->json($result, $statusCode);
    }

    public function confirmPayment(Request $request, $id)
    {
        $data = $request->all();

        $result = $this->paymentService->changeStatus($id, $data);

        $statusCode = $result ? 204 : 404;

        return response()->json([], $statusCode);
    }

    public function cancelPayment($id)
    {
        $data = ['status' => 'CANCELED'];
        
        $result = $this->paymentService->changeStatus($id, $data);

        $statusCode = $result ? 204 : 404;

        return response()->json([], $statusCode);
    }
}
