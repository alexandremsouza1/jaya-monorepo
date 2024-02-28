<?php


namespace App\Dto;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;


class PaymentDto implements DtoInterface
{

    public function build(array $payload) : array
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

    public function transform($payload) : array
    {
      return $this->appendPayer($payload);
    }

    private function appendPayer($payment) : array
    {
      return [
        'id' => $payment->id,
        'status' => $payment->status,
        'transaction_amount' => $payment->transaction_amount,
        'installments' => $payment->installments,
        'token' => $payment->token,
        'payment_method_id' => $payment->payment_method_id,
        'payer' => [
            'entity_type' => $payment->payer_entity_type,
            'type' => $payment->payer_type,
            'email' => $payment->payer_email,
            'identification' => $payment->payer_identification_type,
            'number' => $payment->payer_identification_number
        ],
        'notification_url' => $payment->notification_url,
        'created_at' => $payment->created_at,
        'updated-at' => $payment->updated_at
      ];
    }
}