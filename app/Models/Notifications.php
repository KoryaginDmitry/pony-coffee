<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'sms',
        'site',
        'text',
        'users_read_id'
    ];

    public static function countNotifications()
    {   
        $user_id = auth()->id();

        return Notifications::where("site", "1")
                ->where("users_read_id", NULL)
                ->orWhere("users_read_id", "NOT LIKE", "%[$user_id]%")
                ->count();
    }
}
