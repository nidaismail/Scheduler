<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $primaryKey = 'userID';
    public $incrementing = false;
    protected $fillable = [
        'userID',
        'name',
        'email',
        'designation',
        'dep_id',
        'password',
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
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }




    // protected function role(): Attribute{
    //     return new Attribute(
    //         get: fn($value) => ["user","supervisor","admin"][$value],
    //     ); 

    // }
//     protected static function boot()
// {
//     parent::boot();

    //     static::created(function ($user) {
//         $user->setDefaultRole();
//     });
// }
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->assignRole('user');
        });
    }


}
