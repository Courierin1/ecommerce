<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    use Notifiable;
    protected $table = "email_notifications";

    protected $fillable = ['email'];
}
