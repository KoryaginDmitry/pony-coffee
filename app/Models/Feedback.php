<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'grade',
        'user_id',
        'coffee_pot_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coffeePot()
    {
        return $this->belongsTo(CoffeePot::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
