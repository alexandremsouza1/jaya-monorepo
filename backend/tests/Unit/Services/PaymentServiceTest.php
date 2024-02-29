<?php

namespace Tests\Feature\Services;

use App\Dto\PaymentDto;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Services\PaymentService;
use Tests\TestCase;
use Mockery;
use App\Services\ResponsibleService;

class PaymentServiceTest extends TestCase
{

  protected $service;


  protected function setUp(): void
  {
    parent::setUp();
    $payment = new Payment();
    $payment->id = 'fbd48cfe-8d25-491a-8b35-64b0b7525ce1';
    $payment->transaction_amount = 245.90;
    $payment->installments = 3;
    $payment->token = 'ae4e50b2a8f3h6d9f2c3a4b5d6e7f8g9';
    $payment->payment_method_id = 'master';
    $payment->payer_entity_type = 'individual';
    $payment->payer_type = 'customer';
    $payment->payer_email = 'example_random@gmail.com';
    $payment->payer_identification_type = 'CPF';
    $payment->payer_identification_number = '12345678909';
    $payment->notification_url = 'http://example.com/notification';
    $payment->status = 'PENDING';

    $paymentRepository = Mockery::mock(PaymentRepository::class);
    $paymentRepository->shouldReceive('save')->andReturn($payment);
    $paymentRepository->shouldReceive('all')->andReturn([$payment]);
    $paymentRepository->shouldReceive('find')->andReturn($payment);
    $paymentRepository->shouldReceive('update')->andReturn(true);
    $paymentDto = new PaymentDto();
    $this->service = new PaymentService($paymentRepository, $paymentDto);
  }


  //vendor/bin/phpunit --filter testCreatePayment tests/Unit/Services/PaymentServiceTest.php
  public function testCreatePayment()
  {
    $data = [
      "transaction_amount" => 245.90,
      "installments" => 3,
      "token" => "ae4e50b2a8f3h6d9f2c3a4b5d6e7f8g9",
      "payment_method_id" => "master",
      "payer" => [
        "email" => "example_random@gmail.com",
        "identification" => [
          "type" => "CPF",
          "number" => "12345678909"
        ]
      ]
    ];
    $result = $this->service->create($data);
    $this->assertArrayHasKey('id', $result);
    $this->assertArrayHasKey('created_at', $result);
  }

  //vendor/bin/phpunit --filter testGetAll tests/Unit/Services/PaymentServiceTest.php
  public function testGetAll()
  {
    $result = $this->service->getAll();
    $this->assertIsArray($result);
  }

  //vendor/bin/phpunit --filter testGet tests/Unit/Services/PaymentServiceTest.php
  public function testGet()
  {
    $result = $this->service->get('fbd48cfe-8d25-491a-8b35-64b0b7525ce1');
    $this->assertIsArray($result);
  }

  //vendor/bin/phpunit --filter testChangeStatus tests/Unit/Services/PaymentServiceTest.php
  public function testChangeStatus()
  {
    $result = $this->service->changeStatus('fbd48cfe-8d25-491a-8b35-64b0b7525ce1', ['status' => 'PAID']);
    $this->assertTrue($result);
  }
}
