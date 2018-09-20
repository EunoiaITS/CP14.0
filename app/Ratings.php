<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Ratings extends Model
{
    //
    protected $fillable = [
        'ride_id', 'from', 'to', 'rating', 'comment',
    ];

    protected $rules = array(
        'ride_id'  => 'required',
        'from'  => 'required',
        'to' => 'required',
        'rating' => 'required'
    );
    protected $errors;

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
