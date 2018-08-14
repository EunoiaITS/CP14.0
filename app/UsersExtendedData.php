<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersExtendedData extends Model
{
    protected $fillable = [
        'user_id', 'key', 'value'
    ];

    protected $table = 'users_extended_data';

}
