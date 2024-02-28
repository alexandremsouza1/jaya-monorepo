<?php


namespace App\Dto;

use Illuminate\Support\Str;


class PaymentDto implements DtoInterface
{

    public function build($payload) : array
    {
      try {
        $data = [
          'id' => Str::uuid()->toString(),
          'transaction_amount' => $payload['transaction_amount'],
          'installments' => $payload['installments'],
          'token' => $payload['token'],
          'payment_method_id' => $payload['payment_method_id'],
          'payer_email' => $payload['payer']['email'],
          'payer_identification_type' => $payload['payer']['identification']['type'],
          'payer_identification_number' => $payload['payer']['identification']['number'],
          'notification_url' => isset($payload['notification_url']) ? $payload['notification_url'] : env('NOTIFICATION_URL'),
        ];
      } catch (\Exception $e) {
        return [];
      }
      return $data;
    }
}