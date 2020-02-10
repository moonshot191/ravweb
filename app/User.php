<?php
namespace App;
use App\Notifications\UserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Notification;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function routeNotificationForMail()
    {
        return $this->email_address;
    }
    protected $fillable = [
        'name', 'email', 'password','user_id','username'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();
        static ::created(function ($model){

            $admin = User::where('user_id','222112121')->first();
            Notification::send($admin, new UserRegistered($model));
//            $user = User::first();
//            $user->notify(new UserRegistered());
        });
        
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

