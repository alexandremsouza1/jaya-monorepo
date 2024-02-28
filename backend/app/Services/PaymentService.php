<?php


namespace App\Services;

use App\Dto\PaymentDto;
use App\Repositories\PaymentRepository;

class PaymentService extends AbstractService
{

  private $paymentRepository;

  private $paymentDto;


  public function __construct(PaymentRepository $paymentRepository, PaymentDto $paymentDto)
  {
    $this->paymentDto = $paymentDto;
    $this->paymentRepository = $paymentRepository;
  }


  public function create($data)
  {
    $data = $this->paymentDto->build($data);
    $payment = $this->paymentRepository->save($data);
    return ['id' => $data['id'], 'created_at' => $payment->created_at];
  }

  public function getAll()
  {
    $result = [];
    $data = $this->paymentRepository->all();
    foreach ($data as $item) {
      $result[] = $this->paymentDto->transform($item);
    }
    return $result;
  }

  public function get($id)
  {
    $data = $this->paymentRepository->find($id);
    return $this->paymentDto->transform($data);
  }

  public function confirm($id)
  {
    $data = $this->get($id);
    if ($data) {
      $data['status'] = 'PAID';
      return $this->paymentRepository->update($id, $data);
    }
    return false;
  }

  public function cancel($id)
  {
    $data = $this->get($id);
    if ($data) {
      $data['status'] = 'CANCELED';
      return $this->paymentRepository->update($id, $data);
    }
    return false;
  }

}