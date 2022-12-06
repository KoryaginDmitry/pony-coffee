<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bonuses extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_create',
        'user_id',
    ];

    public static function burningBonuses()
    {
        $dateBonus = Bonuses::select("created_at")
            ->where([
                "user_id" => auth()->id(),
                "usage" => "0"
            ])->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<", "30")
            ->orderBy("created_at", "DESC")
            ->first();
        
        if($dateBonus){
            return "Бонусы начнут сгорать " . Carbon::create($dateBonus->created_at)->addDays(30)->format("d-m-Y");
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userBonusCreate()
    {
        return $this->belongsTo(User::class, "user_id_create");
    }

    public function userBonusWrote()
    {
        return $this->belongsTo(User::class, "user_id_wrote");
    }
}
