<?php

namespace App\Models;


class Payment extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payments';

    protected $casts = [
      'id' => 'string',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'transaction_amount',
        'installments',
        'token',
        'payment_method_id',
        'payer_entity_type',
        'payer_type',
        'payer_email',
        'payer_identification_type',
        'payer_identification_number',
        'notification_url',
        'status',
    ];

    public function rules()
    {
      return [
        'transaction_amount' => 'required|numeric',
        'installments' => 'required|integer',
        'token' => 'required|string',
        'payment_method_id' => 'required|string',
        'payer_entity_type' => 'string',
        'payer_type' => 'string',
        'payer_email' => 'required|email',
        'payer_identification_type' => 'required|string',
        'payer_identification_number' => 'required|string',
        'notification_url' => 'url',
        'status' => 'string|in:PENDING,PAID,CANCELED',
      ];
    }

}
