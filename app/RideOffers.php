<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class RideOffers extends Model
{

    protected $fillable = [
        'request_id',
        'offer_by',
        'origin',
        'destination',
        'arrival_time',
        'departure_time',
        'price_per_seat',
        'total_seats',
        'currency',
        'link',
        'status'
    ];

    protected $rules = array(
        'origin'  => 'required',
        'destination'  => 'required',
        'arrival_time' => 'required',
        'departure_time' => 'required',
        'price_per_seat' => 'required',
        'total_seats' => 'required'
    );

    protected $errors;

    protected $table = 'ride_offers';

    public function validate($data)
    {
        $valid = Validator::make($data, $this->rules);
        if ($valid->fails())
        {
            $this->errors = $valid->errors();
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
