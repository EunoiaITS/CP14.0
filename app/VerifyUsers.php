<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUsers extends Model
{
    protected $table = 'verify_users';

    protected $fillable = [
        'email',
        'link'
    ];
}
