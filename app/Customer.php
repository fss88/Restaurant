<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $primaryKey ='customer_id';
    protected $fillable = ["name", "email", "phone_no", "password"];
}