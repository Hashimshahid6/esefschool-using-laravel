<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;

    public static function getRecord(){
        return User::select('users.*', 'name as first_name', 'last_name as last_name', '')
        ->join('class', 'class.id', 'users.class_id')
        ->where('users.is_deleted', 0)
        ->where('users.role', 3)
        ->orderBy('users.id', 'DESC')
        ->paginate(10);
    }
}
