<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeePot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
    ];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
