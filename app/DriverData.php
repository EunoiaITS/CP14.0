<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class DriverData extends Model
{

    protected $rules = array(
        'car_reg'  => 'required',
        'driving_license'  => 'required',
        'expiry' => 'required',
        'uploads' => 'mimes:jpeg,jpg,png,gif | max:2000',
    );

    protected $errors;

    protected $table = 'driver_data';

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
