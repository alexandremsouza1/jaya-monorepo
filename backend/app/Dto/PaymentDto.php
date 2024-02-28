<?php


namespace App\Dto;

use Illuminate\Support\Str;


class PaymentDto implements DtoInterface
{

    public function build($payload) : array
    {
      try {
        $data = [
          'id' => Str::uuid(),
          'transaction_amount' => $payload['transaction_amount'],
          'installments' => $payload['installments'],
          'token' => $payload['token'],
          'payment_method_id' => $payload['payment_method_id'],
          'payer_email' => $payload['payer']['email'],
          'payer_identification_type' => $payload['payer']['identification']['type'],
          'payer_identification_number' => $payload['payer']['identification']['number'],
        ];
      } catch (\Exception $e) {
        return [];
      }
      return $data;
    }
}