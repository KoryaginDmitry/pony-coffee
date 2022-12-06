<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'password',
        'agreement',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function countBonusesSevenDays($id)
    {
        return Bonuses::where("user_id", $id)->where(DB::raw("DATEDIFF(NOW(), created_at)"), "<=", "7")->count();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function bonuses()
    {
        return $this->hasMany(Bonuses::class);
    }

    public function bonusesCreate()
    {
        return $this->hasMany(Bonuses::class, "user_id_create", "id");
    }

    public function bonusesWrote()
    {
        return $this->hasMany(Bonuses::class, "user_id_wrote", "id");
    }

    public function userCoffeePot()
    {
        return $this->hasOne(UserCoffeePotPivot::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
