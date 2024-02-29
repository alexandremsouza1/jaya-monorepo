<?php

namespace Tests\Feature;

use App\Http\Controllers\PaymentsController;
use Mockery;
use Tests\TestCase;


class PaymentsControllerTest extends TestCase
{
  protected $controller;



  protected function setUp(): void
  {
    $this->controller = $this->mockController();
    parent::setUp();
  }

  public function mockController()
  {
    return Mockery::mock(PaymentsController::class)->makePartial();
  }

  //vendor/bin/phpunit --filter testCreatePayment tests/Feature/PaymentsControllerTest.php
  public function testCreatePayment() {
    $response = $this->post('/rest/payments',[
      'transaction_amount' => 245.90,
      'installments' => 3,
      'token' => 'ae4e50b2a8f3h6d9f2c3a4b5d6e7f8g9',
      'payment_method_id' => 'master',
      'payer' => [
        'email' => 'email@mail.com.br',
        'identification' => [
          'type' => 'CPF',
          'number' => '12345678909'
        ]
      ]
    ]);
    $response->assertStatus(201);
  }

  //vendor/bin/phpunit --filter testGetPayments tests/Feature/PaymentsControllerTest.php
  public function testGetPayments()
  {
    $response = $this->get('/rest/payments');
    $response->assertStatus(200);
  }

  //vendor/bin/phpunit --filter testGetPaymentById tests/Feature/PaymentsControllerTest.php
  public function testGetPaymentById()
  {
    $response = $this->get('/rest/payments/0a2e4bad-2638-46fa-9c59-3a46be91bc36');
    $response->assertStatus(200);
  }

  //vendor/bin/phpunit --filter testUpdatePayment tests/Feature/PaymentsControllerTest.php
  public function testUpdatePayment()
  {
    $response = $this->patch('/rest/payments/0a2e4bad-2638-46fa-9c59-3a46be91bc36',[
      'status' => 'PAID'
    ]);
    $response->assertStatus(204);
  }

  //vendor/bin/phpunit --filter testDeletePayment tests/Feature/PaymentsControllerTest.php
  public function testDeletePayment()
  {
    $response = $this->delete('/rest/payments/0a2e4bad-2638-46fa-9c59-3a46be91bc36');
    $response->assertStatus(204);
  }


}