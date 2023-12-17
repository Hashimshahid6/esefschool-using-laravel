<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class';

    static public function getRecord(){
        $record = ClassModel::select('class.*', 'users.name as created_by_name')
        ->join('users', 'users.id', 'class.created_by');
        if(!empty(Request::get('name'))){
            $record=$record->where('class.name', 'like', '%' .Request::get('name'). '%');
        }
        if(!empty(Request::get('date'))){
            $record=$record->whereDate('class.created_at', '=' , Request::get('date'));
        }
        $record= $record->where('class.is_deleted', 0)
        ->orderBy('class.id', 'ASC')
        ->paginate(10);
        return $record;
    }

    static public function getClass(){
        $record = ClassModel::select('class.*')
        ->join('users', 'users.id', 'class.created_by')
        ->where('class.is_deleted', 0)
        ->where('class.status', 0)
        ->orderBy('class.name', 'ASC')
        ->get();
        return $record;
    }
}
