<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['overall_comission','paypal_mode','paypal_sandbox_api_secret','paypal_sandbox_api_password','paypal_sandbox_api_username','paypal_currency'];
}

