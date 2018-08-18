<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Countries extends Model
{
    protected $rules = array(
        'name'  => 'required',
        'code'  => 'required',
        'lat' => 'required',
        'lng' => 'required'
    );

    protected $errors;

    protected $table = 'countries';

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
