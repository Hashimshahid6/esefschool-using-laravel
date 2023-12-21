<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

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
        'email',
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
    static public function getAdmins(){
        $query = self::select('users.*')
            ->whereIn('user_type', [1,2,3,4])
            ->where('is_deleted', '=' , 0);
            
        if(!empty(Request::get('email'))){
            $query->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('name'))) {
            $query->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('user_type'))) {
            $userTypeMap = [
                'admin' => 1,
                'teacher' => 2,
                'student' => 3,
                'parent' => 4,
            ];
            $userType = $userTypeMap[Request::get('user_type')];
            $query->where('user_type', '=', $userType);
        }
        if (!empty(Request::get('date'))) {
            $query->where('created_at', 'like', '%' . Request::get('date') . '%');
        }
        return $query->orderBy('id', 'desc')
            ->paginate(5);
    }
    public function getStudent(){
        $query = self::select('users.*')
        ->where('users.user_type', 3)
        ->where('users.is_deleted', '=' , 0);
        if(!empty(Request::get('email'))){
            $query->where('email', 'like', '%' , (Request::get('email'). '%'));
        }
        $query = $query->orderBy('users.id', 'desc')
        ->paginate(5);
        return $query;
    }
}
