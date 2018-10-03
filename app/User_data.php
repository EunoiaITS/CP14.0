<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class User_data extends Model
{

    protected $rules = array(
        'address'  => 'required',
        'gender' => 'required',
        'picture' => 'mimes:jpeg,jpg,png,gif | max:2000',
        'idc_picture' => 'mimes:jpeg,jpg,png,gif | max:2000'
    );

    protected $errors;

    protected $table = 'users_data';

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
