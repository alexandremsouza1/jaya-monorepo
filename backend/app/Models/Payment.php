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
        'payer_entity_type' => 'string',
        'payer_type' => 'string',
        'payer_email' => 'required|email',
        'payer_identification_type' => 'required|string',
        'payer_identification_number' => 'required|string',
        'notification_url' => 'url',
        'status' => 'string|in:PENDING,PAID,CANCELED',
      ];
    }


    //get notification_url
    // public function getNotificationUrlAttribute($value)
    // {
    //     return env('NOTIFICATION_URL');
    // }

    //set notification_url
    public function setNotificationUrlAttribute($value)
    {
        $this->attributes['notification_url'] = env('NOTIFICATION_URL');
    }
}
